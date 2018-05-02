<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

///Get AlL webboard
$app->get('/api/webboards', function(Request $request, Response $response){
    $sql = "SELECT * FROM webboard";
    try{
        // Get DB Object
        $db = new db();
        // Connect
        $db = $db->connect();
        $stmt = $db->query($sql);
        $customers = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        echo json_encode($customers);
    } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
});

// Get Single webboard
$app->get('/api/webboard/{id}', function(Request $request, Response $response){
    $id = $request->getAttribute('id');
    $sql = "SELECT * FROM webboard WHERE QuestionID = $id";
    try{
        // Get DB Object
        $db = new db();
        // Connect
        $db = $db->connect();
        $stmt = $db->query($sql);
        $webboard = $stmt->fetch(PDO::FETCH_OBJ);
        $db = null;
        echo json_encode($webboard);
    } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
});

// Add webboard
$app->post('/api/webboard/add', function(Request $request, Response $response){
    $CreateDate = $request->getParam('CreateDate');
    $Question = $request->getParam('Question');
    $Details = $request->getParam('Details');
    $Name = $request->getParam('Name');
    $View = $request->getParam('View');
    $Reply = $request->getParam('Reply');
    
    $sql = "INSERT INTO webboard (CreateDate,Question,Details,Name,View,Reply) VALUES
    (:CreateDate,:Question,:Details,:Name,:View,:Reply)";
    try{
        // Get DB Object
        $db = new db();
        // Connect
        $db = $db->connect();
        $stmt = $db->prepare($sql);

        $stmt->bindParam(':CreateDate', $CreateDate);
        $stmt->bindParam(':Question',  $Question);
        $stmt->bindParam(':Details',      $Details);
        $stmt->bindParam(':Name',      $Name);
        $stmt->bindParam(':View',      $View);
        $stmt->bindParam(':Reply',      $Reply);
     
        $stmt->execute();
        echo '{"notice": {"text": "Webboard Added"}';
    } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
});

// Update webboard
$app->put('/api/webboard/update/{id}', function(Request $request, Response $response){

    $id = $request->getAttribute('id');

    $CreateDate = $request->getParam('CreateDate');
    $Question = $request->getParam('Question');
    $Details = $request->getParam('Details');
    $Name = $request->getParam('Name');
    $View = $request->getParam('View');
    $Reply = $request->getParam('Reply');

    $sql = "UPDATE webboard SET
                CreateDate   = :CreateDate,
                Question     = :Question,
                Details      = :Details,
                Name         = :Name,
                View         = :View,
                Reply        = :Reply

            WHERE QuestionID = $id";
    try{
        // Get DB Object
        $db = new db();
        // Connect
        $db = $db->connect();
        $stmt = $db->prepare($sql);

        $stmt->bindParam(':CreateDate', $CreateDate);
        $stmt->bindParam(':Question',  $Question);
        $stmt->bindParam(':Details',      $Details);
        $stmt->bindParam(':Name',      $Name);
        $stmt->bindParam(':View',      $View);
        $stmt->bindParam(':Reply',      $Reply);

        $stmt->execute();
        echo '{"notice": {"text": "Webboard Updated"}';
    } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
});

// Delete webboard
$app->delete('/api/webboard/delete/{id}', function(Request $request, Response $response){
    $id = $request->getAttribute('id');
    $sql = "DELETE FROM webboard WHERE QuestionID = $id";
    try{
        // Get DB Object
        $db = new db();
        // Connect
        $db = $db->connect();
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $db = null;
        echo '{"notice": {"text": "Webboard Deleted"}';
    } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
});