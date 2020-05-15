<?php
    header("Access-Control-Allow-Origin: *");
    header('Content-Type: application/json');
    header("Access-Control-Allow-Headers: access");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Allow-Credentials: true");


    // Including Database and Methods of Login
    include_once "../../tools/Database.php";
    include_once "../../models/classroom/Get_post_methods.php";
    include_once "../../tools/injection_checking.php";

    // Response Array That will send Back to Web
    $post_arr = array (
        'success' => 0,
        'error_message' => "No Error"
    );

    // Instantiate DB and Connect
    $database = new Database();
    $db = $database->connect();

    // Getting Data From User for API
    $data = json_decode(file_get_contents("php://input"));

    // Instantiate Get Post Method Object
    $get_post = new Get_post($db);
    $get_post->class_id = $data->class_id;
    $get_post->secret_message = $data->secret_message;

    // Instantiate Injection Checking Class
    $injection = new Tools();

    // Checking Class ID is Null
    if(empty($get_post->class_id)) {
        $db = null;
        $get_post->error_message = "Class ID is Null";
        $post_arr['error_message'] = $get_post->error_message;
        echo json_encode($post_arr);
        die();
    }
    //Checking Secret Message is Null
    if(empty($get_post->secret_message)){
        $db = null;
        $get_post->error_message = "Secret Message is Null"; // Injection Detected ... Character: 23
        $post_arr['error_message'] = $get_post->error_message;
        echo json_encode($post_arr);
        die();
    }else{ // Secret Message is Fine
        // Injection Checking for Secret Message
        if (!$injection->test_input($get_post->secret_message)) {
            $db = null;
            $get_post->error_message = "HTML Injection Detected"; // Injection Detected ... Character: 23
            $post_arr['error_message'] = $get_post->error_message;
            echo json_encode($post_arr);
            die();
        }else{  // No injection on Secret Message ! Fine Bingo

            // Matching Secret Message
            if ($get_post->secret_message === "Give All Posts"){

                // Need To query
                $result = $get_post->posts();
                $num = $result->rowCount();
                // Checking Error in Post Function
                if($get_post->message){
                    // CHecking any post available or not
                    if ($num > 0){
                        $post_arr = array (
                            'success' => 1,
                            'class_id' => $get_post->class_id
                            );

                        //Putting Post Data into $post_arr['data']
                        $post_arr['data'] = array();
                        // Fetching Data
                        while ( $row = $result->fetch(PDO::FETCH_ASSOC)){
                            extract($row);

                            $post_item = array(
                                'post_id' => $post_id,
                                'creator_id' => $creator_id,
                                'creator_name' => $creator_name,
                                'created_time' => $created_time,
                                'post_text' => $post_text,
                                'post_material' => $post_material
                            );
                            // Getting Commetns;
                            $get_post->comments($post_id);
                            //$get_post->comments($post_id);
                            $post_item['comments'] = $get_post->comments_arr;
                            // Push to $post_arr['data']
                            array_push($post_arr['data'], $post_item);
                        }
                        // All Done
                        echo json_encode($post_arr);

                        die();
                        // No Post Found
                    }else{
                        $db = null;
                        $post_arr['error_message'] = "No Posts Available";
                        echo json_encode($post_arr);
                        die();
                    }
                }else{// Post Function e Jhamela Ase
                    $post_arr['error_message'] = $get_post->error_message;
                    echo json_encode($post_arr);
                    die();
                }
            }else{ // Secret Message is Wrong
                $get_post->error_message = "Secret Message is Wrong";
                $post_arr['error_message'] = $get_post->error_message;
                echo json_encode($post_arr);
                die();
            }
        }
    }
?>

