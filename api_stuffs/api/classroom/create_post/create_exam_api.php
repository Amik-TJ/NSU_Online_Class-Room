<?php
header("Access-Control-Allow-Origin: *");
header('Content-Type: application/json');
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Credentials: true");


// Including Database and Methods of Login
include_once "../../../tools/Database.php";
include_once "../../../models/classroom/create_post/Create_exam_methods.php";


// Response Array That will send Back to Web
$create_exam_arr = array (
    'success' => 0,
    'error_message' => "Initially No Error"
);

// Instantiate DB and Connect
$database = new Database();
$db = $database->connect();

// Getting Data From User for API
$data = json_decode(file_get_contents("php://input"));

// Instantiate Create Post Method Object
$create_exam = new Create_exam($db);
$create_exam->class_id = $data->class_id;
$create_exam->secret_message = $data->secret_message;
$create_exam->created_by = $data->created_by;
$create_exam->token = $data->token;
$create_exam->priority = $data->priority;
$create_exam->material = $data->material;
$create_exam->post_text = $data->post_text;
$create_exam->exam_title = $data->exam_title;
$create_exam->exam_time_date = $data->exam_time_date;


// Injection Checking
$create_exam->injection_checking();
if(!$create_exam->message){
    $create_exam_arr['success'] = 0;
    $create_exam_arr['error_message'] = $create_exam->error_message;
    $db = null;
    echo json_encode($create_exam_arr);
    die();
}
// Null Checking
$create_exam->null_checking();
if(!$create_exam->message){
    $create_exam_arr['success'] = 0;
    $create_exam_arr['error_message'] = $create_exam->error_message;
    $db = null;
    echo json_encode($create_exam_arr);
    die();
}

// Matching Secret Message
if (! $create_exam->secret_message === "Create a Exam"){
    $create_exam_arr['success'] = 0;
    $create_exam_arr['error_message'] = "Secret Message is Wrong";
    $db = null;
    echo json_encode($create_exam_arr);
    die();
}
// Need To query
$result = $create_exam->set_exam();
// Checking Error in Set Exam Function
if($create_exam->message){
    $create_exam_arr = array(
        'success' => 1,
        'error_message' => "Exam Notice Created Successfully"
    );
    echo json_encode($create_exam_arr);
    die();


}else{// Set Exam Function e Jhamela Ase
    $create_exam_arr['success'] = 0;
    $create_exam_arr['error_message'] = $create_exam->error_message;
    $db = null;
    echo json_encode($create_exam_arr);
    die();
}

?>

