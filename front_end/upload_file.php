<?php



        $file = $_FILES['file'];
        $file_name = $file['name'];
        $file_tmp_name = $file['tmp_name'];
        $file_size = $file['size'];
        $file_error = $file['error'];
        $file_type = $file['type'];

        // Geting Extension from uploaded File
        $file_extension = explode('.', $file_name); // Breakes the name where dot found into array
        $file_actual_extension = strtolower(end($file_extension));
        // allowed extensions which user can upload
        $allowed_extension = array('jpg', 'jpeg', 'png', 'pdf', 'docx', 'rtf', 'pptx', 'ppt', 'txt', 'mp4', 'rar', 'zip');
        // checking file is valid type extension or not
        if (!in_array($file_actual_extension, $allowed_extension)){
            echo "You cannot upload ".$file_actual_extension." type of file";
            exit();
        }
        // cheking File Error
        if(!$file_error === 0){
            echo "THere is Problem uploadng your File. Try Again Letter";
            exit();
        }
        // Checking for file size wheather it is large or not
        if($file_size > 10000000){
            echo "You file size is larger than 100mb. Pleas try to upload a smaller file";
            exit();
        }
        // Setting file new name
        $file_new_name = $_SESSION['class_id']."$".$_SESSION['person_id']."$".$file_name;
        // Selecting Destination
        $file_destination = "uploads/".$file_new_name;
        // moving file to the destination
        if(!move_uploaded_file($file_tmp_name, $file_destination)){
            echo "Problem on file uploading on server";
            exit();
        }


?>
<!--<!DOCTYPE html>
<html>
<head>
    <title></title>
    <meta charset="utf-8">
</head>
<form action="upload.php" method="post" enctype="multipart/form-data">
    <input type="file" name="file">
    <button type="submit" name="submit">Upload</button>
</form>
</body>
</html>-->