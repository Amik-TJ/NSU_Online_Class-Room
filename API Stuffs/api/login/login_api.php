    <?php
    header("Access-Control-Allow-Origin: *");
    header('Content-Type: application/json');
    header("Access-Control-Allow-Headers: access");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Allow-Credentials: true");


    // Including Database and Methods of Login
    include_once "../../tools/Database.php";
    include_once "../../models/login/Login_methods.php";
    // Response array
    $login_arr = array(
        'success' => 0,
        'error_message' => ""
    );

    // Getings things from User
    $data = json_decode(file_get_contents("php://input"));


    // Instantiate DB and Connect
    $database = new Database();
    $db = $database->connect();

    // Instantiate Login MEthod Object
    $login = new Login($db);
    $login->user_id = $data->user_id;
    $login->password = $data->password;
    // Checking any Null Value
    if (empty($login->user_id)) {
        $login->error_message = "Id is Required";
        $login_arr['error_message'] = $login->error_message;
        echo json_encode($login_arr);
        die();
    }
    if (empty($login->password)) {
        $login->error_message = "Password is Required";
        $login_arr['error_message'] = $login->error_message;
        echo json_encode($login_arr);
        die();
    }
    // Checking Student or Teacher
    // Student
    if ( strlen($login->user_id) > 5 ){

        $token = 1;
        $login->login_student();
        //Get Login Student Credentials
        if($login->message) {
            //Create Array
            $login_arr = array(
                'success' => 1,
                'token' => $token,
                'nsu_id' => $login->user_id,
                'student_name' => $login->student_name,
                'email' => $login->email,
                'gender' => $login->gender
            );
            // Make Json
            echo json_encode($login_arr);
        }else{
            $login_arr['error_message'] = $login->error_message;
            echo json_encode($login_arr);
            die();
        }
     // Faculty
    }else{
        $token = 0;
        $login->login_teacher();
        //Get Login Faculty Credentials
        if($login->message) { //$message for checking query is executed && password matching
            //Create Array
            $login_arr = array(
                'success' => 1,
                'token' => $token,
                'faculty_name' => $login->faculty_name,
                'faculty_initial' => $login->user_id,
                'nsu_id' => $login->faculty_id,
                'email' => $login->email,
                'gender' => $login->gender
            );
            // Make Json
            echo json_encode($login_arr);
        }else{
            $login_arr['error_message'] = $login->error_message;
            echo json_encode($login_arr);
            die();
        }
    }





    ?>