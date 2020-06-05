<?php
    session_start();
    if (!$_SESSION['security']) {
        header('Location: index.php');
    }
    include_once "../api_stuffs/tools/Database.php";
    $conn = new Database();
    $token = $_SESSION['token'];
    if($token){
        $name = $_SESSION['student_name'];
    }else{
        $name = $_SESSION['faculty_name'];
    }
    $nsu_id = $_SESSION['nsu_id'];
    $email = $_SESSION['email'];
    $gender = $_SESSION['gender'];

    $i = $_GET['id'];
    $i--;
    $single_class_data = $_SESSION['class_data']['data'][$i];
    // API called for post Data
    include_once '../api_stuffs/tools/global.php';
    $load = array(
        'class_id' => $single_class_data['class_id'],
        'secret_message' => "Give All Posts"
    );
    $post_res = make_req($post_url, $load);
    $post_res = json_decode($post_res, true);
    $_SESSION['post'] = $post_res;

    /*echo "<pre>";
    print_r($post_data);
    echo "</pre>";*/
    /*echo "<pre>";
    print_r($post_res);
    echo "</pre>";*/
    // Get Assignment Api Calling
    $ass_load = array(
        'class_id' => $single_class_data['class_id'],
        'secret_message' => "Give All Assignment Announcements"
    );
    $ass_res = make_req($assignment_url, $ass_load);
    $ass_res = json_decode($ass_res, true);
    // Get Exam Api Calling
    $ex_load = array(
        'class_id' => $single_class_data['class_id'],
        'secret_message' => "Give All Exam Announcements"
    );
    $ex_res = make_req($exam_url, $ex_load);
    $ex_res = json_decode($ex_res, true);
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
                    <a class="nav-item nav-link" href="#">Exam</a>
                    <a class="nav-item nav-link" href="#">Assignment</a>
                    <a class="nav-item nav-link" href="#">Download</a>
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

            </div>

            <!--Create Post and Timeline Stays At Middle-->
            <div class="col-md-6">

                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">File Name</th>
                            <th scope="col">Download</th>

                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row">
                                NFRs for CV
                            </th>
                            <td>
                                <button type="button" class="btn btn-primary ">Download</button>
                            </td>
                        </tr>

                        <tr>
                            <th scope="row">
                                Requirement Analysis
                            </th>
                            <td>
                                <button type="button" class="btn btn-primary ">Download</button>
                            </td>

                        </tr>
                        <tr>
                            <th scope="row">
                                Functional Requirements
                            </th>
                            <td>
                                <button type="button" class="btn btn-primary">Download</button>
                            </td>

                        </tr>

                    </tbody>
                </table>

            </div>

            <!--Assignment Table Stays At Right-->
            <div class="col-md-3">

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
