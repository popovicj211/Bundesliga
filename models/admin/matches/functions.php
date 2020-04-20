<?php



function TeamQuery(){
    return "SELECT team_id , name FROM teams ";
}

function Team(){
    return executeQuery(TeamQuery());
}

function insertMatch($team1Id, $team2Id, $score , $date ){
    global $connection;
    
    $queryIns = "INSERT INTO matches (match_id , team1_id, team2_id, result, date) VALUES(null,?,?,?,? )";
    $prepMat = $connection->prepare($queryIns); 
    $exeMat = $prepMat -> execute([$team1Id, $team2Id, $score, $date]);
    return $exeMat;
    }


    function getAllScQuery(){
             return "SELECT matches.match_id, matches.result, matches.date , t.name as team1 , t2.name as team2 , matches.team1_id , matches.team2_id FROM matches INNER JOIN teams t ON matches.team1_id = t.team_id INNER JOIN teams t2 ON matches.team2_id = t2.team_id INNER JOIN images im1 ON im1.img_id = t.id_img ";
    }

    function getAllScores(){
           return  executeQuery(getAllScQuery());
    }

    function getUpScore($id){
        global $connection;
        $queryUpM =  getAllScQuery(); 
        $queryUpM .= " WHERE matches.match_id = ?";
        $prepUpM = $connection->prepare($queryUpM);
          $prepUpM -> execute([$id]);
          $match = $prepUpM -> fetch();
          return  $match;
    }

   function UpdMatch($matchId , $team1, $team2, $score , $dateTime ){ 
        global $connection;
        $queryUp = "UPDATE matches SET team1_id = ? , team2_id = ?, result = ?, date = ? WHERE match_id = ?";
        $prepMatUp = $connection->prepare($queryUp); 
        $exeMatUp = $prepMatUp -> execute([$team1, $team2, $score, $dateTime , $matchId]);
        return $exeMatUp;
    } 

    function DelMatch($id){
        global $connection;
        $queryDel = "DELETE FROM matches WHERE match_id = ?";
        $prepMatDel = $connection->prepare($queryDel); 
        $exeMatDel = $prepMatDel -> execute([$id]);
        return $exeMatDel;
    }


    function getLimitMat($limit , $func){
        global $connection;
        $queryResM = $func;
       $queryResM .= $limit;
        $resultMLimit = executeQuery($queryResM);
        return $resultMLimit;
    }
    
    function CountMatches(){
       // return executeQuery("SELECT COUNT(*) as counts FROM matches");
       global $connection;
         $queryCon = "SELECT COUNT(*) as counts FROM matches";
         $prepCon = $connection -> prepare($queryCon);
         $prepCon -> execute();
       $resCon = $prepCon -> fetch();
       return $resCon;
    }

