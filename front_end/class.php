<?php
    session_start();
    if (!$_SESSION['security']) {
        header('Location: index.php');
    }


    // Checking for Post submit
    if (isset($_POST['post_submit'])){
        // Checking any file uploaded or not
        if(isset($_FILES['file']) && !empty($_FILES['file']['name'])){
            include_once "upload_file.php";
            $material = $file_name;
        }else{
            $material = NULL;
            echo "Upload hoy nai";
        }
        $class_serial = $_SESSION['class_serial'];
        // Create Post API Calling
        include_once '../api_stuffs/tools/global.php';
        // Loading Payloads
        $class_id = $_SESSION['class_id'];
        $load = array(
            'class_id' => $class_id,
            'secret_message' => "Create a Post",
            'created_by' => $_SESSION['person_id'],
            'token' => $_SESSION['token'],
            'priority' => 3,
            'material' => $material,
            'post_text' => $_POST['post_text']
        );
        $create_post_res = make_req($create_post_url, $load);
        $create_post_res = json_decode($create_post_res, true);
        /*echo "<pre>";
        print_r($create_post_res);
        echo "</pre>";*/
    }


    // Checking for Comment submit
    if (isset($_POST['comment_submit'])){
        $class_serial = $_SESSION['class_serial'];
        // Create Comment API Calling
        include_once '../api_stuffs/tools/global.php';
        // Loading Payloads
        $load = array(
            'post_id' => $_POST['post_id'],
            'secret_message' => "Create a Comment",
            'commiter_id' => $_SESSION['person_id'],
            'comments' => $_POST['comment_text']
        );
        $create_comment_res = make_req($create_comment_url, $load);
        $create_comment_res = json_decode($create_comment_res, true);

    }



    if (!isset($_POST['post_submit']) && !isset($_POST['comment_submit']) ){
        $class_serial = $_GET['id'];
    }

    $_SESSION['class_serial'] = $class_serial;
    $single_class_data = $_SESSION['class_data']['data'][$class_serial];
    $class_id = $single_class_data['class_id'];
    $_SESSION['class_id'] = $class_id;

    // API called for post Data
    include_once '../api_stuffs/tools/global.php';
    $class_url = 'class.php?id='.$class_serial;
    $load = array(
        'class_id' => $class_id,
        'secret_message' => "Give All Posts"
    );
    $post_res = make_req($post_url, $load);
    $post_res = json_decode($post_res, true);
    $_SESSION['post_res'] = $post_res;


    /*echo "<pre>";
    print_r($post_res);
    echo "</pre>";*/
    // Get Assignment Api Calling
    $ass_load = array(
        'class_id' => $class_id,
        'secret_message' => "Give All Assignment Announcements"
    );
    $ass_res = make_req($assignment_url, $ass_load);
    $ass_res = json_decode($ass_res, true);
    $_SESSION['ass_res'] = $ass_res;
    // Get Exam Api Calling
    $ex_load = array(
        'class_id' => $class_id,
        'secret_message' => "Give All Exam Announcements"
    );
    $ex_res = make_req($exam_url, $ex_load);
    $ex_res = json_decode($ex_res, true);
    $_SESSION['ex_res'] = $ex_res;
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    <meta charset="utf-8"/>
    <title>Online Portal | North South University</title>
    <meta name="description" content="NSU Student Information Management System"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0"/>
    <link rel="stylesheet" href="includes/css/bootstrap/bootstrap.min.css"/>
    <link rel="stylesheet" href="includes/css/bootstrap/font-awesome.min.css"/>
    <link rel="stylesheet" href="includes/css/bootstrap/chosen.min.css"/>
    <link rel="stylesheet" href="includes/css/bootstrap/jquery.dataTables.min.css"/>
    <link rel="stylesheet" href="includes/css/bootstrap/main.css"/>

    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-blue-grey.css">
    <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Open+Sans'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">

    <!--<style>
        .row div{padding: 20px 10px; border: 1px solid;}
    </style>-->
    <style>
        .card {
            margin: 0 auto; /* Added */
            float: none; /* Added */
            margin-bottom: 15px;

             /* Added */
    }

        img {
      border: 1px solid #ddd;
      border-radius: 3px;
      padding: 3px;
      width: 60px;
    }

        img:hover {
      box-shadow: 0 0 2px 1px rgba(0, 140, 186, 0.5);
    }

    </style>

  </head>
  <body>

    <!-- navbar -->
    <nav class="navbar navbar-toggleable-md navbar-inverse" style="background-color: #06265F;">
        <div class="container">
            <button class="navbar-toggler" data-toggle="collapse" data-target="#mainNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="mainNav">
                <div class="navbar-nav text-white ml-auto" >
                    <a class="nav-item nav-link" href="home.php">Back to RDS</a>
                    <a class="nav-item nav-link" href="home2.php">Home</a>
                    <a class="nav-item nav-link" href="exam.php">Exam</a>
                    <a class="nav-item nav-link" href="assignment.php">Assignment</a>
                    <a class="nav-item nav-link" href="download.php">Download</a>
                    <a class="nav-item nav-link" href="logout.php">Log Out</a>
                </div>
            </div>
        </div>
    </nav>


    <!--The Huge Blue Banner-->
    <div class="jumbotron jumbotron-fluid bg-info text-white text-center">
        <div class="container">
            <h1 class="display-1"><?php echo strtoupper($single_class_data['course_id']).' : '.$single_class_data['course_title']?></h1>
            <p class="lead ">Section : <?php echo $single_class_data['section']?></p>
            <h5 class="text-monospace">Time : <?php  echo  $single_class_data['time'];?></h5>
            <h6 class="text-monospace"><?php echo strtoupper($single_class_data['room_no']);?></h6>
        </div>
    </div>


    <!--This Container Contains Everything.
        Arranged In A Row With Three Main Component
        Two Tables And A Middle Part-->

    <div class="container-fluid">
        <div class="row" >

            <!--Exam Table Stays At Left-->
            <div class="col-md-3">
                <div class="d-flex justify-content-center">


                <div class="card " style="width: 25rem;">
                    <div class="card-header">
                        <h3>Exam</h3>
                    </div>
                    <ul class="list-group list-group-flush w-100 align-items-stretch">
                        <?php
                        if( $ex_res['success']){
                            foreach ( $ex_res['data'] as $ex_data){
                                $time = strtotime($ex_data['exam_time_date']);
                                $time = date('d F Y' , $time);
                                echo "<li class=\"list-group-item\">";
                                echo $ex_data['exam_title'];
                                echo ": ".$time;
                                echo "</li>";

                            }
                        }else{
                            echo "<li class=\"list-group-item\">";
                            echo "Hurray !There is no Exam";
                            echo "</li>";
                        }
                        ?>
                    </ul>
                </div>
                </div>
            </div>

            <!--Create Post and Timeline Stays At Middle-->
            <div class="col-md-6">

                <!--Separated In Two Parts
                    Create Post And Time Line-->
                <div class="col">

                    <!--Create Post Section-->
                    <div class="row mb-5">
                        <div class="container">
                            <form  action="<?php echo $class_url?>" method="post" enctype="multipart/form-data">
                                <!--Text Box-->
                                <h3> Create Post</h3>
                                <div class="space-4"></div>
                                <textarea class="form-control" id="exampleFormControlTextarea1" name="post_text" rows="5"></textarea>
                                <div class="space-3"></div>

                                <!--Choose File-->
                                <label for="exampleFormControlFile1">Upload a file</label>
                                <input type="file" name="file" class="form-control-file" id="exampleFormControlFile1">
                                <div class="space-4"></div>

                                <!--Topic Selecter-->
                                <?php
                                    if (!$_SESSION['token']){
                                        echo'<select class="form-control form-control-sm">';
                                            echo'<option>Assignment</option>';
                                            echo'<option>Exam</option>';
                                            echo'<option>Discussion</option>';
                                        echo'</select>';
                                    }
                                ?>

                                <div class="space-4"></div>
                                <input type="submit" class="btn btn-primary" value="Submit" name="post_submit">
                            </form>
                            <div class="space-8"></div>
                        </div>
                    </div>

                    <!--Timline Section-->
                    <?php
                    if ($post_res['success']){
                        echo "<div class=\"row mb-5\">";
                        foreach ( $post_res['data'] as $post){
                            $id = $post['post_id'];
                            echo "<div class=\"card\"  style='margin-left: 15px; width: 100%;'>";
                            echo "<div class=\"card-header\">";
                            echo "<img src=\"Imgs/faculty_male.png\" class=\"rounded float-left\" alt=\"\">";
                            echo "<h5>".$post['creator_name']."</h5>";
                            $time = strtotime($post['created_time']);
                            $time = date('d F Y' , $time);
                            echo "<p>".$time."</p>";
                            echo "</div>";
                            echo "<div class=\"card-body\">";
                            echo "<blockquote class=\"blockquote mb-0\">";
                            echo "<p>".$post['post_text']."</p>";
                            echo "<footer class=\"blockquote-footer\">Download Item</footer>";
                            echo "</blockquote>";
                            echo"<div class=\"space-4\"></div>";
                            echo "</div>";
                            echo "</div>";
                            // Comments Part Start
                            if($post['comments']['success']){
                                //Comments
                                echo"<ul class=\"list-group list-group-flush w-100 align-items-stretch\">";
                                // Drop Down section
                                echo"<li class=\"list-group-item \">";
                                echo"<p>";
                                echo"<a class=\"btn btn-primary\" data-toggle=\"collapse\" href=\"#".$id."\" role=\"button\" aria-expanded=\"false\" aria-controls=\"post2\">";
                                echo"See Comments";
                                echo"</a>";
                                echo"</p>";
                                echo"<div class=\"collapse\" id=\"".$id."\">";
                                //  Each one is a comment
                                foreach ($post['comments']['data'] as $cmnt){
                                    echo"<div class=\"card card-body\" >";
                                    echo"<h5 class=\"card-title\">";
                                    echo $cmnt['commiter_name'];
                                    echo"</h5>";
                                    echo $cmnt['comments'];
                                    echo"</div>";
                                }
                                echo "</div>";
                                echo "</li>";

                            }
                            // Add A Comment Form
                            echo "<li class=\"list-group-item\" style='margin-left: 15px; width: 100%;'>";
                            echo "<form  action=\"".$class_url."\" method=\"post\" >";
                            echo "<div class=\"form-group\">";
                            echo '<input type="hidden" name="post_id" value="'.$id.'">';
                            echo '<input class="form-control" name="comment_text" type="text" placeholder="add a comment.." style="width: 100%;">';
                            echo "</div>";
                            echo "<button type=\"submit\" class=\"btn btn-success\" name=\"comment_submit\">Submit</button>";
                            echo "</form>";
                            echo "</li>";
                            echo "</ul>";

                        }
                        echo "</div>";
                        echo "</div>";
                    }

                    ?>
                    

            </div>

            <!--Assignment Table Stays At Right-->
            <div class="col-md-3">
                <div class="d-flex justify-content-center">
                <div class="card" style="width: 25rem;">
                    <div class="card-header">
                        <h3>Assignment</h3>
                    </div>
                    <ul class="list-group list-group-flush w-100 align-items-stretch">
                        <?php
                            if( $ass_res['success']){
                                foreach ( $ass_res['data'] as $ass_data){
                                    $due = strtotime($ass_data['assignment_due_date']);
                                    $due = date('d F Y' , $due);
                                    echo "<li class=\"list-group-item\">";
                                    echo $ass_data['assignment_title'];
                                    echo ", Due: ".$due;
                                    echo "</li>";

                                }
                            }else{
                                echo "<li class=\"list-group-item\">";
                                echo "There is no Assignments !";
                                echo "</li>";
                            }
                        ?>

                    </ul>
                </div>
            </div>
            </div>
        </div>
    </div>

    <div class="footer">
        <div class="footer-inner">
            <div class="footer-content">
                <span class="bigger-120 blue bolder mleft">Developed & Maintained By Full_Of_BUGS.</span>
            </div>
        </div>
    </div>
    <a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse"><i
                class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i></a>




    <!-- jQuery first, then Tether, then Bootstrap JS. -->
    <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
    <script>
    $(function () {
        $('[data-toggle="tooltip"]').tooltip();
    });
    </script>
  </body>
</html>
