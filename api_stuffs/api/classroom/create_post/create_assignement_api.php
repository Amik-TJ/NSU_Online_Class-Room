<?php
    header("Access-Control-Allow-Origin: *");
    header('Content-Type: application/json');
    header("Access-Control-Allow-Headers: access");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Allow-Credentials: true");


    // Including Database and Methods of Login
    include_once "../../../tools/Database.php";
    include_once "../../../models/classroom/create_post/Create_assignment_methods.php";


    // Response Array That will send Back to Web
    $create_assignment_arr = array (
        'success' => 0,
        'error_message' => "Initially No Error"
    );

    // Instantiate DB and Connect
    $database = new Database();
    $db = $database->connect();

    // Getting Data From User for API
    $data = json_decode(file_get_contents("php://input"));

    // Instantiate Create Post Method Object
    $create_assignment = new Create_assignment($db);
    $create_assignment->class_id = $data->class_id;
    $create_assignment->secret_message = $data->secret_message;
    $create_assignment->created_by = $data->created_by;
    $create_assignment->token = $data->token;
    $create_assignment->priority = $data->priority;
    $create_assignment->material = $data->material;
    $create_assignment->post_text = $data->post_text;
    $create_assignment->assignment_title = $data->assignment_title;
    $create_assignment->assignment_due_date = $data->assignment_due_date;


    // Injection Checking
    $create_assignment->injection_checking();
    if(!$create_assignment->message){
        $create_assignment_arr['success'] = 0;
        $create_assignment_arr['error_message'] = $create_assignment->error_message;
        $db = null;
        echo json_encode($create_assignment_arr);
        die();
    }
    // Null Checking
    $create_assignment->null_checking();
    if(!$create_assignment->message){
        $create_assignment_arr['success'] = 0;
        $create_assignment_arr['error_message'] = $create_assignment->error_message;
        $db = null;
        echo json_encode($create_assignment_arr);
        die();
    }

    // Matching Secret Message
    if (! $create_assignment->secret_message === "Create a Assignment"){
        $create_assignment_arr['success'] = 0;
        $create_assignment_arr['error_message'] = "Secret Message is Wrong";
        $db = null;
        echo json_encode($create_assignment_arr);
        die();
    }
    // Need To query
    $result = $create_assignment->set_assignment();
    // Checking Error in Set Assignment Function
    if($create_assignment->message){
        $create_assignment_arr = array(
            'success' => 1,
            'error_message' => "Assignment Created Successfully"
        );
        echo json_encode($create_assignment_arr);
        die();


    }else{// Set Assignment Function e Jhamela Ase
        $create_assignment_arr['success'] = 0;
        $create_assignment_arr['error_message'] = $create_post->error_message;
        $db = null;
        echo json_encode($create_assignment_arr);
        die();
    }

?>

