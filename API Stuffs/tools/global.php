<?php
$login_url = "http://localhost/nsu_online_classroom/my_File/rds_api/login_api.php";

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