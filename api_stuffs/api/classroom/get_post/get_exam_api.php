<?php
    header("Access-Control-Allow-Origin: *");
    header('Content-Type: application/json');
    header("Access-Control-Allow-Headers: access");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Allow-Credentials: true");


    // Including Database and Methods of Login
    include_once "../../../tools/Database.php";
    include_once "../../../models/classroom/get_post/Get_exam_methods.php";
    include_once "../../../tools/injection_checking.php";

    // Response Array That will send Back to Web
    $exam_arr = array(
        'success' => 0,
        'error_message' => "Initially No Error for Exams"
    );

    // Instantiate DB and Connect
    $database = new Database();
    $db = $database->connect();

    // Getting Data From User for API
    $data = json_decode(file_get_contents("php://input"));

    // Instantiate Get Post Method Object
    $exam = new Exam($db);
    $exam->class_id = $data->class_id;
    $exam->secret_message = $data->secret_message;

    // Instantiate Injection Checking Class
    $injection = new Tools();

    // Checking Class ID is Null
    if(empty($exam->class_id)) {
        $db = null;
        $exam->error_message = "Class ID is Null";
        $exam_arr['error_message'] = $exam->error_message;
        echo json_encode($exam_arr);
        die();
    }
    //Checking Secret Message is Null
    if(empty($exam->secret_message)){
        $db = null;
        $exam->error_message = "Secret Message is Null";
        $exam_arr['error_message'] = $exam->error_message;
        echo json_encode($exam_arr);
        die();
    }else{ // Secret Message is Fine
        // Injection Checking for Secret Message
        if (!$injection->test_input($exam->secret_message)) {
            $db = null;
            $exam->error_message = "HTML Injection Detected on Secret Message"; // Injection Detected ... Character: 23
            $exam_arr['error_message'] = $exam->error_message;
            echo json_encode($exam_arr);
            die();
        }else{  // No injection on Secret Message ! Fine Bingo

            // Matching Secret Message
            if ($exam->secret_message === "Give All Exam Announcements"){

                // Need To query
                $result = $exam->get_exam();
                $num = $result->rowCount();
                // Checking Error in Post Function
                if($exam->message){
                    // CHecking any post available or not
                    if ($num > 0){
                        $exam_arr = array (
                            'success' => 1,
                            'class_id' => $exam->class_id,
                            'priority' => 1
                        );

                        //Putting Post Data into $exam_arr['data']
                        $exam_arr['data'] = array();
                        // Fetching Data
                        while ( $row = $result->fetch(PDO::FETCH_ASSOC)){
                            extract($row);

                            $exam_item = array(
                                'post_id' => $post_id,
                                'exam_title' => $exam_title,
                                'created_time' => $created_time,
                                'exam_time_date' => $exam_time_date,
                                'post_text' => $post_text,
                                'material' => $material

                            );
                            // Push to $post_arr['data']
                            array_push($exam_arr['data'], $exam_item);
                        }
                        // All Done
                        echo json_encode($exam_arr);
                        die();

                    }else{// No Post Found
                        $db = null;
                        $exam->error_message = "No Exams Availabe";
                        $exam_arr['error_message'] = $exam->error_message;
                        echo json_encode($exam_arr);
                        die();
                    }
                }else{// get_exam Function e Jhamela Ase
                    $db = null;
                    $exam_arr['error_message'] = $exam->error_message;
                    echo json_encode($exam_arr);
                    die();
                }
            }else{ // Secret Message is Wrong
                $db = null;
                $exam->error_message = "Secret Message is Wrong";
                $exam_arr['error_message'] = $exam->error_message;
                echo json_encode($exam_arr);
                die();
            }
        }
    }

?>