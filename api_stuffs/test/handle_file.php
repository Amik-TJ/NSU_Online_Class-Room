<?php
$error = array(
    'success' => 0,
    'message' => 'Initially No Error'
);
$post_id = "cse_327_6_11";
if(isset($_POST['submit'])) {
    $file = $_FILES['file'];


    echo "<pre>";
    print_r($file);
    echo "</pre>";

    // Getting File name
    $file_name = $_FILES['file']['name'];
    $file_tmp_name = $_FILES['file']['tmp_name'];
    $file_size = $_FILES['file']['size'];
    $file_error = $_FILES['file']['error'];
    $file_type = $_FILES['file']['type'];

    // Checking File Size
    if($file_size > 10240000){
        $error['success'] = 0;
        $error['message'] = "File Size exceed 100 MB . So this can not be uploaded ! ";
    }else{
        // breaks strings in to array
        $file_ext = explode('.', $file_name); // $file_ext get array of file name and type of file
        $file_actual_ext = strtolower(end($file_ext)); //  end() get last thing from array
        // allowed type of files
        $allowed = array('zip', 'rar', 'php', 'sql', 'html', 'jpg', 'jpeg', 'png', 'txt', 'doc', 'pdf', 'docx', 'ppt', 'pptx');

        // Checking valid type of file
        if (in_array($file_actual_ext, $allowed)) {
            $file_new_name = $post_id. '.' .$file_actual_ext;
            $file_destination = 'uploads/' .$file_new_name;
            move_uploaded_file($file_tmp_name, $file_destination);
            $error['success'] = 1;
            $error['message'] = "File Uploaded Successfully";

        } else {
            $error['success'] = 0;
            $error['message'] = "You Cannot upload files of this type";
        }
    }
}
echo "<pre>";
print_r($error);
echo "</pre>";
?>
























<!DOCTYPE html>
<html>
<head>
    <title></title>
    <meta charset="utf-8">
</head>
<body>
    <form action="#" method="POST" enctype="multipart/form-data">
        <input type="file" name="file">
        <button type="submit" name="submit">Submit</button>
    </form>
</body>
</html>
