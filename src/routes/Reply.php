<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;


///Get AlL Reply
$app->get('/api/replys', function(Request $request, Response $response){
    $sql = "SELECT * FROM reply";
    try{
        // Get DB Object
        $db = new db();
        // Connect
        $db = $db->connect();
        $stmt = $db->query($sql);
        $reply = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        echo json_encode($reply);
    } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
});

// Get Single reply
$app->get('/api/reply/{id}', function(Request $request, Response $response){
    $id = $request->getAttribute('id');
    $sql = "SELECT * FROM reply WHERE ReplyID = $id";
    try{
        // Get DB Object
        $db = new db();
        // Connect
        $db = $db->connect();
        $stmt = $db->query($sql);
        $reply = $stmt->fetch(PDO::FETCH_OBJ);
        $db = null;
        echo json_encode($reply);
    } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
});

// Add reply
$app->post('/api/reply/add', function(Request $request, Response $response){
    $QuestionID = $request->getParam('QuestionID');
    $CreateDate = $request->getParam('CreateDate');
    $Details = $request->getParam('Details');
    $Name = $request->getParam('Name');
    
    $sql = "INSERT INTO reply (QuestionID,CreateDate,Details,Name) VALUES
    (:QuestionID,:CreateDate,:Details,:Name)";
    try{
        // Get DB Object
        $db = new db();
        // Connect
        $db = $db->connect();
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':QuestionID', $QuestionID);
        $stmt->bindParam(':CreateDate',  $CreateDate);
        $stmt->bindParam(':Details',      $Details);
        $stmt->bindParam(':Name',      $Name);
     
        $stmt->execute();
        echo '{"notice": {"text": "Reply Added"}';
    } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
});
// Update reply
$app->put('/api/reply/update/{id}', function(Request $request, Response $response){

    $id = $request->getAttribute('id');

    $QuestionID = $request->getParam('QuestionID');
    $CreateDate = $request->getParam('CreateDate');
    $Details = $request->getParam('Details');
    $Name = $request->getParam('Name');

    $sql = "UPDATE reply SET
                QuestionID   = :QuestionID,
                CreateDate   = :CreateDate,
                Details      = :Details,
                Name         = :Name
            WHERE ReplyID = $id";
    try{
        // Get DB Object
        $db = new db();
        // Connect
        $db = $db->connect();
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':QuestionID', $QuestionID);
        $stmt->bindParam(':CreateDate',  $CreateDate);
        $stmt->bindParam(':Details',      $Details);
        $stmt->bindParam(':Name',      $Name);
        $stmt->execute();
        echo '{"notice": {"text": "Reply Updated"}';
    } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
});

// Delete reply
$app->delete('/api/reply/delete/{id}', function(Request $request, Response $response){
    $id = $request->getAttribute('id');
    $sql = "DELETE FROM reply WHERE ReplyID = $id";
    try{
        // Get DB Object
        $db = new db();
        // Connect
        $db = $db->connect();
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $db = null;
        echo '{"notice": {"text": "Reply Deleted"}';
    } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
});