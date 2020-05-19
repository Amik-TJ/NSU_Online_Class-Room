<?php
header("Access-Control-Allow-Origin: *");
header('Content-Type: application/json');
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Credentials: true");


// Including Database and Methods of Login
include_once "../../../tools/Database.php";
include_once "../../../models/classroom/create_post/Create_comment_methods.php";


// Response Array That will send Back to Web
$create_comment_arr = array (
    'success' => 0,
    'error_message' => "Initially No Error"
);

// Instantiate DB and Connect
$database = new Database();
$db = $database->connect();

// Getting Data From User for API
$data = json_decode(file_get_contents("php://input"));

// Instantiate Create Post Method Object
$create_comment = new Create_comment($db);
$create_comment->post_id = $data->post_id;
$create_comment->secret_message = $data->secret_message;
$create_comment->commiter_id = $data->commiter_id;
$create_comment->comments = $data->comments;



// Injection Checking
$create_comment->injection_checking();
if(!$create_comment->message){
    $create_comment_arr['success'] = 0;
    $create_comment_arr['error_message'] = $create_comment->error_message;
    $db = null;
    echo json_encode($create_comment_arr);
    die();
}
// Null Checking
$create_comment->null_checking();
if(!$create_comment->message){
    $create_comment_arr['success'] = 0;
    $create_comment_arr['error_message'] = $create_comment->error_message;
    $db = null;
    echo json_encode($create_comment_arr);
    die();
}

// Matching Secret Message
if (! $create_comment->secret_message === "Create a Comment"){
    $create_comment_arr['success'] = 0;
    $create_comment_arr['error_message'] = "Secret Message is Wrong";
    $db = null;
    echo json_encode($create_comment_arr);
    die();
}
// Need To query
$result = $create_comment->set_comment();
// Checking Error in Set comment Function
if($create_comment->message){
    $create_comment_arr = array(
        'success' => 1,
        'error_message' => "Comment Created Successfully"
    );
    echo json_encode($create_comment_arr);
    die();


}else{// Set Comment Function e Jhamela Ase
    $create_comment_arr['success'] = 0;
    $create_comment_arr['error_message'] = $create_comment->error_message;
    $db = null;
    echo json_encode($create_comment_arr);
    die();
}

?>

