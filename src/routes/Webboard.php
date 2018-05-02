<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

$app = new \Slim\App;




//Get AlL webboard
$app->get('/api/webboard', function(Request $request, Response $response){
    $sql = "SELECT * FROM webboard";
    try{
        // Get DB Object
        $db = new db();
        // Connect
        $db = $db->connect();
        $stmt = $db->query($sql);
        $Question = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        echo json_encode($Question);
    } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
});

// Get questID webboard
$app->get('/api/webboard/{id}', function(Request $request, Response $response){
    $id = $request->getAttribute('id');
    $sql = "SELECT * FROM webboard WHERE id = $id";
    try{
        // Get DB Object
        $db = new db();
        // Connect
        $db = $db->connect();
        $stmt = $db->query($sql);
        $QuestionID = $stmt->fetch(PDO::FETCH_OBJ);
        $db = null;
        echo json_encode($QuestionID);
    } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
});

// Get createdate webboard
$app->get('/api/webboard/{id}', function(Request $request, Response $response){
    $id = $request->getAttribute('id');
    $sql = "SELECT * FROM webboard WHERE id = $id";
    try{
        // Get DB Object
        $db = new db();
        // Connect
        $db = $db->connect();
        $stmt = $db->query($sql);
        $CreateDate = $stmt->fetch(PDO::FETCH_OBJ);
        $db = null;
        echo json_encode($CreateDate);
    } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
});

// Get quest webboard
$app->get('/api/webboard/{id}', function(Request $request, Response $response){
    $id = $request->getAttribute('id');
    $sql = "SELECT * FROM webboard WHERE id = $id";
    try{
        // Get DB Object
        $db = new db();
        // Connect
        $db = $db->connect();
        $stmt = $db->query($sql);
        $Question = $stmt->fetch(PDO::FETCH_OBJ);
        $db = null;
        echo json_encode($Question);
    } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
});

// Get Details webboard
$app->get('/api/webboard/{id}', function(Request $request, Response $response){
    $id = $request->getAttribute('id');
    $sql = "SELECT * FROM webboard WHERE id = $id";
    try{
        // Get DB Object
        $db = new db();
        // Connect
        $db = $db->connect();
        $stmt = $db->query($sql);
        $Details = $stmt->fetch(PDO::FETCH_OBJ);
        $db = null;
        echo json_encode($Details);
    } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
});

// Get Name webboard
$app->get('/api/webboard/{id}', function(Request $request, Response $response){
    $id = $request->getAttribute('id');
    $sql = "SELECT * FROM webboard WHERE id = $id";
    try{
        // Get DB Object
        $db = new db();
        // Connect
        $db = $db->connect();
        $stmt = $db->query($sql);
        $Name = $stmt->fetch(PDO::FETCH_OBJ);
        $db = null;
        echo json_encode($Name);
    } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
});

// Get View webboard
$app->get('/api/webboard/{id}', function(Request $request, Response $response){
    $id = $request->getAttribute('id');
    $sql = "SELECT * FROM webboard WHERE id = $id";
    try{
        // Get DB Object
        $db = new db();
        // Connect
        $db = $db->connect();
        $stmt = $db->query($sql);
        $View = $stmt->fetch(PDO::FETCH_OBJ);
        $db = null;
        echo json_encode($View);
    } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
});

// Get Reply webboard
$app->get('/api/webboard/{id}', function(Request $request, Response $response){
    $id = $request->getAttribute('id');
    $sql = "SELECT * FROM webboard WHERE id = $id";
    try{
        // Get DB Object
        $db = new db();
        // Connect
        $db = $db->connect();
        $stmt = $db->query($sql);
        $Reply = $stmt->fetch(PDO::FETCH_OBJ);
        $db = null;
        echo json_encode($Reply);
    } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
});

// Add Webboard
$app->post('/api/webboard/add', function(Request $request, Response $response){
    $QuestionID = $request->getParam('QuestionID');
    $CreateDate = $request->getParam('CreateDate');
    $Question = $request->getParam('Question');
    $Details = $request->getParam('Details');
    $Name = $request->getParam('Name');
    $View = $request->getParam('View');
    $Reply = $request->getParam('Reply');
    
    $sql = "INSERT INTO webboard (QuestionID,CreateDate,Question,Details,Name
    ,View,Reply) VALUES
    (:QuestionID,:CreateDate,:Question,:Details,:Name,:View,:Reply)";
    try{
        // Get DB Object
        $db = new db();
        // Connect
        $db = $db->connect();
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':QuestionID', $QuestionID);
        $stmt->bindParam(':CreateDate', $CreateDate);
        $stmt->bindParam(':Question', $Question);
        $stmt->bindParam(':Details',  $Details);
        $stmt->bindParam(':Name',      $Name);
        $stmt->bindParam(':View',      $View);
        $stmt->bindParam(':Reply',      $Reply);
     
        $stmt->execute();
        echo '{"notice": {"text": "Customer Added"}';
    } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
});
// Update Webboard
$app->put('/api/webboard/update/{id}', function(Request $request, Response $response){

    $id = $request->getAttribute('id');

    $CreateDate = $request->getParam('CreateDate');
    $Question = $request->getParam('Question');
    $Details = $request->getParam('Details');
    $Name = $request->getParam('Name');
    $View = $request->getParam('View');
    $Reply = $request->getParam('Reply');

    $sql = "UPDATE webboard SET
                CreateDate  = :CreateDate,
				Question 	= :Question,
				Details 	= :Details,
                Name		= :Name,
                View        = :View,
                Reply       = :Reply

			WHERE id = $id";
    try{
        // Get DB Object
        $db = new db();
        // Connect
        $db = $db->connect();
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':CreateDate', $CreateDate);
        $stmt->bindParam(':Question', $Question);
        $stmt->bindParam(':Details',  $Details);
        $stmt->bindParam(':Name',      $Name);
        $stmt->bindParam(':View',      $View);
        $stmt->bindParam(':Reply',      $Reply);
        $stmt->execute();
        echo '{"notice": {"text": "Webbroad Updated"}';
    } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
});

// Delete Customer
$app->delete('/api/webboard/delete/{id}', function(Request $request, Response $response){
    $id = $request->getAttribute('id');
    $sql = "DELETE FROM webboard WHERE id = $id";
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