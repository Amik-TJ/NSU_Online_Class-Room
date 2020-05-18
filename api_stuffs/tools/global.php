<?php
    $login_url = "http://localhost/nsu_online_classroom/api_stuffs/api/login/login_api.php";
    $class_url = "http://localhost/nsu_online_classroom/api_stuffs/api/classroom/classroom_api.php";
    $post_url = "http://localhost/nsu_online_classroom/api_stuffs/api/classroom/get_post/get_post_api.php";
    $assignment_url = "http://localhost/nsu_online_classroom/api_stuffs/api/classroom/get_post/get_assignment_api.php";
    $exam_url = "http://localhost/nsu_online_classroom/api_stuffs/api/classroom/get_post/get_exam_api.php";



    function make_req($url, $load ){
    //url-ify the data for the POST
    $json_string = json_encode($load);

    //open connection
    $ch = curl_init();

    //set the url, number of POST vars, POST data
    curl_setopt($ch,CURLOPT_URL, $url);
    curl_setopt($ch,CURLOPT_POST, true);
    curl_setopt($ch,CURLOPT_POSTFIELDS, $json_string);

    //So that curl_exec returns the contents of the cURL; rather than echoing it
    curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);

    //execute post
    $result = curl_exec($ch);
    return $result;
}
?>