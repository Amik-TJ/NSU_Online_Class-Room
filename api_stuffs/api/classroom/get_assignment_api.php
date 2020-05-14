<?php
    header("Access-Control-Allow-Origin: *");
    header('Content-Type: application/json');
    header("Access-Control-Allow-Headers: access");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Allow-Credentials: true");


    // Including Database and Methods of Login
    include_once "../../tools/Database.php";
    include_once "../../models/classroom/Get_assignment_methods.php";
    include_once "../../tools/injection_checking.php";

    // Response Array That will send Back to Web
    $assignment_arr = array(
        'success' => 0,
        'error_message' => "Initially No Error for Assignments"
    );

    // Instantiate DB and Connect
    $database = new Database();
    $db = $database->connect();

    // Getting Data From User for API
    $data = json_decode(file_get_contents("php://input"));

    // Instantiate Get Post Method Object
    $assignment = new Assignment($db);
    $assignment->class_id = $data->class_id;
    $assignment->secret_message = $data->secret_message;

    // Instantiate Injection Checking Class
    $injection = new Tools();

    // Checking Class ID is Null
    if(empty($assignment->class_id)) {
        $db = null;
        $assignment->error_message = "Class ID is Null";
        $assignment_arr['error_message'] = $assignment->error_message;
        echo json_encode($assignment_arr);
        die();
    }
    //Checking Secret Message is Null
    if(empty($assignment->secret_message)){
        $db = null;
        $assignment->error_message = "Secret Message is Null";
        $assignment_arr['error_message'] = $assignment->error_message;
        echo json_encode($assignment_arr);
        die();
    }else{ // Secret Message is Fine
        // Injection Checking for Secret Message
        if (!$injection->test_input($assignment->secret_message)) {
            $db = null;
            $assignment->error_message = "HTML Injection Detected on Secret Message"; // Injection Detected ... Character: 23
            $assignment_arr['error_message'] = $assignment->error_message;
            echo json_encode($assignment_arr);
            die();
        }else{  // No injection on Secret Message ! Fine Bingo

            // Matching Secret Message
            if ($assignment->secret_message === "Give All Assignment Announcements"){

                // Need To query
                $result = $assignment->get_assignment();
                $num = $result->rowCount();
                // Checking Error in Post Function
                if($assignment->message){
                    // CHecking any post available or not
                    if ($num > 0){
                        $assignment_arr = array (
                            'success' => 1,
                            'class_id' => $assignment->class_id
                        );

                        //Putting Post Data into $post_arr['data']
                        $assignment_arr['data'] = array();
                        // Fetching Data
                        while ( $row = $result->fetch(PDO::FETCH_ASSOC)){
                            extract($row);

                            $assignment_item = array(
                                'assignment_title' => $assignment_title,
                                'created_time' => $created_time,
                                'assignment_due_date' => $assignment_due_date,
                                'material' => $material,
                                'post_text' => $post_text
                            );

                            // Push to $post_arr['data']
                            array_push($assignment_arr['data'], $assignment_item);
                        }
                        // All Done
                        echo json_encode($assignment_arr);
                        die();

                    }else{// No Post Found
                        $db = null;
                        $assignment->error_message = "No Assignments Availabe";
                        $assignment_arr['error_message'] = $assignment->error_message;
                        echo json_encode($assignment_arr);
                        die();
                    }
                }else{// get_assignment Function e Jhamela Ase
                    $db = null;
                    $assignment_arr['error_message'] = $assignment->error_message;
                    echo json_encode($assignment_arr);
                    die();
                }
            }else{ // Secret Message is Wrong
                $db = null;
                $assignment->error_message = "Secret Message is Wrong";
                $assignment_arr['error_message'] = $assignment->error_message;
                echo json_encode($assignment_arr);
                die();
            }
        }
    }

?>