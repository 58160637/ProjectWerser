<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

$app = new \Slim\App;




//Get AlL Reply
$app->get('/api/reply', function(Request $request, Response $response){
    $sql = "SELECT * FROM reply";
    try{
        // Get DB Object
        $db = new db();
        // Connect
        $db = $db->connect();
        $stmt = $db->query($sql);
        $replyID = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        echo json_encode($replyID);
    } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
});

// Get Single Question
$app->get('/api/reply/{id}', function(Request $request, Response $response){
    $id = $request->getAttribute('id');
    $sql = "SELECT * FROM reply WHERE id = $id";
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

// Get Single CreateDate
$app->get('/api/reply/{id}', function(Request $request, Response $response){
    $id = $request->getAttribute('id');
    $sql = "SELECT * FROM reply WHERE id = $id";
    try{
        // Get DB Object
        $db = new db();
        // Connect
        $db = $db->connect();
        $stmt = $db->query($sql);
        $CreateID = $stmt->fetch(PDO::FETCH_OBJ);
        $db = null;
        echo json_encode($CreateID);
    } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
});

// Get Single Details
$app->get('/api/reply/{id}', function(Request $request, Response $response){
    $id = $request->getAttribute('id');
    $sql = "SELECT * FROM reply WHERE id = $id";
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

// Get Single Name
$app->get('/api/reply/{id}', function(Request $request, Response $response){
    $id = $request->getAttribute('id');
    $sql = "SELECT * FROM reply WHERE id = $id";
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

// Add Customer
$app->post('/api/reply/add', function(Request $request, Response $response){
    $Details = $request->getParam('Details');
    $Name = $request->getParam('Name');
    
    $sql = "INSERT INTO reply (Details,Name) VALUES
    (:Details,:Name,)";
    try{
        // Get DB Object
        $db = new db();
        // Connect
        $db = $db->connect();
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':Details', $Details);
        $stmt->bindParam(':Name',  $Name);
     
        $stmt->execute();
        echo '{"notice": {"text": "Customer Added"}';
    } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
});
// Update Customer
$app->put('/api/customer/update/{id}', function(Request $request, Response $response){

    $id = $request->getAttribute('id');

    $fristName = $request->getParam('fristName');
    $surName = $request->getParam('surName');
    $phone = $request->getParam('phone');

    $sql = "UPDATE customers SET
				fristName 	= :fristName,
				surName 	= :surName,
                phone		= :phone

			WHERE id = $id";
    try{
        // Get DB Object
        $db = new db();
        // Connect
        $db = $db->connect();
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':fristName', $fristName);
        $stmt->bindParam(':surName',  $surName);
        $stmt->bindParam(':phone',      $phone);
        $stmt->execute();
        echo '{"notice": {"text": "Customer Updated"}';
    } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
});

// Delete Customer
$app->delete('/api/customer/delete/{id}', function(Request $request, Response $response){
    $id = $request->getAttribute('id');
    $sql = "DELETE FROM customers WHERE id = $id";
    try{
        // Get DB Object
        $db = new db();
        // Connect
        $db = $db->connect();
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $db = null;
        echo '{"notice": {"text": "Customer Deleted"}';
    } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
});