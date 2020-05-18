<?php
header("Access-Control-Allow-Origin: *");
header('Content-Type: application/json');
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Credentials: true");


// Including Database and Methods of Login
include_once "../../../tools/Database.php";
include_once "../../../models/classroom/create_post/Create_post_methods.php";


// Response Array That will send Back to Web
$create_post_arr = array (
    'success' => 0,
    'error_message' => "Initially No Error"
);

// Instantiate DB and Connect
$database = new Database();
$db = $database->connect();

// Getting Data From User for API
$data = json_decode(file_get_contents("php://input"));

// Instantiate Create Post Method Object
$create_post = new Create_post($db);
$create_post->class_id = $data->class_id;
$create_post->secret_message = $data->secret_message;
$create_post->created_by = $data->created_by;
$create_post->token = $data->token;
$create_post->priority = $data->priority;
$create_post->material = $data->material;
$create_post->post_text = $data->post_text;


// Injection Checking
$create_post->injection_checking();
if(!$create_post->message){
    $create_post_arr['success'] = 0;
    $create_post_arr['error_message'] = $create_post->error_message;
    $db = null;
    echo json_encode($create_post_arr);
    die();
}
// Null Checking
$create_post->null_checking();
if(!$create_post->message){
    $create_post_arr['success'] = 0;
    $create_post_arr['error_message'] = $create_post->error_message;
    $db = null;
    echo json_encode($create_post_arr);
    die();
}

// Matching Secret Message
if (! $create_post->secret_message === "Create a Post"){
    $create_post_arr['success'] = 0;
    $create_post_arr['error_message'] = "Secret Message is Wrong";
    $db = null;
    echo json_encode($create_post_arr);
    die();
}
// Need To query
$result = $create_post->set_post();
// Checking Error in Set Post Function
if($create_post->message){
    $create_post_arr = array(
        'success' => 1,
        'error_message' => "Post Created Successfully"
    );
    echo json_encode($create_post_arr);
    die();


}else{// Set Post Function e Jhamela Ase
    $create_post_arr['success'] = 0;
    $create_post_arr['error_message'] = $create_post->error_message;
    $db = null;
    echo json_encode($create_post_arr);
    die();
}

?>

