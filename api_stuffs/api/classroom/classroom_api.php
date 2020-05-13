<?php
    header("Access-Control-Allow-Origin: *");
    header('Content-Type: application/json');
    header("Access-Control-Allow-Headers: access");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Allow-Credentials: true");


    // Including Database and Methods of Login
    include_once "../../tools/Database.php";
    include_once "../../models/classroom/Classroom_methods.php";
    include_once "../../tools/injection_checking.php";

    // Response Array
    $classroom_arr = array (
        'success' => 0,
        'error_message' => ""
    );

    // Getting Data From User for API
    $data = json_decode(file_get_contents("php://input"));

    // Instantiate DB and Connect
    $database = new Database();
    $db = $database->connect();

    // Instantiate Classroom Method OBject
    $classroom = new Classroom($db);
    $classroom->token = $data->token;
    $classroom->success = $data->success; // Secret Message
    $classroom->user_id = $data->user_id;

    // Instantiate Injection Checking Class
    $injection = new Tools();
    // Injection Checking for Secret Message
    if (!$injection->test_input($classroom->success)) {
        $db = null;
        $classroom->error_message = "HTML Injection Detected"; // Injection Detected ... Character: 23
        $classroom_arr['error_message'] = $classroom->error_message;
        echo json_encode($classroom_arr);
        die();
    }else{
        // Matching Secret Message
        if ($classroom->success === "Give All Classes Data"){
            // Checking any Null Value
            if(is_null($classroom->token)){
                $classroom->error_message = "Token is Required";
                $classroom_arr['error_message'] = $classroom->error_message;
                echo json_encode($classroom_arr);
                die();
            }
            if(empty($classroom->success)){
                $classroom->error_message = "Success message is Required";
                $classroom_arr['error_message'] = $classroom->error_message;
                echo json_encode($classroom_arr);
                die();
            }
            if(empty($classroom->user_id)){
                $classroom->error_message = "User ID is Required";
                $classroom_arr['error_message'] = $classroom->error_message;
                echo json_encode($classroom_arr);
                die();
            }

            // Checking Student or Faculty
            if($classroom->token){
                $result = $classroom->classroom_student();
                // Get row count
                $num = $result->rowCount();
                if($classroom->message) {
                    if($num > 0){
                        $classroom_arr = array(
                            'success' => 1,
                            'token' => $classroom->token
                        );
                        $classroom_arr['data'] = array();

                        while( $row = $result->fetch(PDO::FETCH_ASSOC)){
                            extract($row);

                            $class_item = array(
                                'class_id' => $class_id,
                                'course_id' => $course_id,
                                'course_title' => $course_title,
                                'section' => $section,
                                'time' => $time,
                                'room_no' => $room_no,
                                'faculty_name' => $faculty_name
                            );

                            // Push to $classroom_arr['data']
                            array_push($classroom_arr['data'], $class_item);
                        }
                        echo json_encode($classroom_arr);
                        die();

                    }else{
                        $classroom->error_message = "No Classes Found";
                        $classroom_arr['error_message'] = $classroom->error_message;
                        echo json_encode($classroom_arr);
                        die();
                    }


                }else{
                    $classroom_arr['error_message'] = $classroom->error_message;
                    echo json_encode($classroom_arr);
                    die();
                }
            } // Faculty
            else{
                $result = $classroom->classroom_faculty();
                // Get row count
                $num = $result->rowCount();
                if($classroom->message) {
                    if($num > 0){
                        $classroom_arr = array(
                            'success' => 1,
                            'token' => $classroom->token
                        );
                        $classroom_arr['data'] = array();

                        while( $row = $result->fetch(PDO::FETCH_ASSOC)){
                            extract($row);

                            $class_item = array(
                                'class_id' => $class_id,
                                'course_id' => $course_id,
                                'course_title' => $course_title,
                                'section' => $section,
                                'time' => $time,
                                'room_no' => $room_no
                            );

                            // Push to $classroom_arr['data']
                            array_push($classroom_arr['data'], $class_item);
                        }
                        echo json_encode($classroom_arr);
                        die();

                    }else{
                        $classroom->error_message = "No Classes Found";
                        $classroom_arr['error_message'] = $classroom->error_message;
                        echo json_encode($classroom_arr);
                        die();
                    }


                }else{
                    $classroom_arr['error_message'] = $classroom->error_message;
                    echo json_encode($classroom_arr);
                    die();
                }
            }
        }
        else{
            $classroom->error_message = "Secret Message is Wrong";
            $classroom_arr['error_message'] = $classroom->error_message;
            echo json_encode($classroom_arr);
            die();
        }
    }



?>

