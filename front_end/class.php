<?php
//include_once 'includes/header.php';
    session_start();
    $token = $_SESSION['token'];
    // log out
    if (isset($_GET['log_out'])) {
        if ($token){
            $_SESSION['token'] = null;
            $_SESSION['nsu_id'] = null;
            $_SESSION['person_id'] = null;
            $_SESSION['student_name'] = null;
            $_SESSION['email'] = null;
            $_SESSION['gender'] = null;
        }else{
            $_SESSION['token'] = null;
            $_SESSION['nsu_id'] = null;
            $_SESSION['person_id'] = null;
            $_SESSION['faculty_name'] = null;
            $_SESSION['faculty_initial'] = null;
            $_SESSION['email'] = null;
            $_SESSION['gender'] = null;
        }
        session_destroy();
        header('Location: index.php');
    }else{
        // Session er data rakhtesi home e display korar jnnno !
        if($token){
            $name = $_SESSION['student_name'];
        }else{
            $name = $_SESSION['faculty_name'];
        }
        $nsu_id = $_SESSION['nsu_id'];
        $email = $_SESSION['email'];
        $gender = $_SESSION['gender'];
    }

    // API
    include_once '../api_stuffs/tools/global.php';
    $load = array(
        'token' => $token,
        'success' => "Give All Classes Data",
        'user_id' => $nsu_id
    );
    $res = make_req($class_url, $load);
    $res = json_decode($res, true);
    $_SESSION['res'] = $res;
    echo "<pre>";
    //print_r($_SESSION['res']);
    echo "</pre>";
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



    </style>
  </head>
  <body>

    <!-- navbar -->
    <nav class="navbar navbar-toggleable-md bg-primary navbar-inverse">
        <div class="container">
            <button class="navbar-toggler" data-toggle="collapse" data-target="#mainNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="mainNav">
                <div class="navbar-nav">
                    <a class="nav-item nav-link" href="#">Home</a>
                    <a class="nav-item nav-link active" href="#">CSE 327</a>
                    <a class="nav-item nav-link" href="#">Classroom</a>
                    <a class="nav-item nav-link" href="#">Timeline</a>
                    <a class="nav-item nav-link" href="#">Exam</a>
                    <a class="nav-item nav-link" href="#">Assignment</a>
                    <a class="nav-item nav-link" href="#">Download</a>
                </div>
            </div>
        </div>
    </nav>


    <div class="jumbotron jumbotron-fluid bg-info text-white text-center">
        <div class="container">
            <h1 class="display-1">CSE 327: Software Engineering</h1>
            <p class="lead ">Section: 5</p>
            <h5 class="text-monospace">MW 1:00-4:20</h5>
            <h6 class="text-monospace">SAC 312</h6>
        </div>
    </div>


    <div class="container-fluid">
        <div class="row" >
            <div class="col">
                <div class="d-flex justify-content-center">


                <div class="card " style="width: 25rem;">
                    <div class="card-header">
                        <h3>Exam</h3>
                    </div>
                    <ul class="list-group list-group-flush w-100 align-items-stretch">
                        <li class="list-group-item ">1. Quiz 1: 15 May 2020</li>
                        <li class="list-group-item">2. Mid 1: June 3 2020</li>
                        <li class="list-group-item">3. Project Submission TBA</li>
                    </ul>
                </div>
                </div>
            </div>
            <div class="col-6">

                <div class="col">
                    <div class="row">
                        <div class="container">
                            <form>
                                <h3> Create Post</h3>
                                <div class="space-4"></div>
                                <textarea class="form-control" id="exampleFormControlTextarea1" rows="5"></textarea>
                                <div class="space-4"></div>
                                <select class="form-control form-control-sm">
                                    <option>Assignment</option>
                                    <option>Exam</option>
                                    <option>Discussion</option>
                                </select>
                                <div class="space-4"></div>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                            <div class="space-6"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="card">
                            <div class="card-header">
                                <h4>Topic of Assignment 1</h4>
                            </div>
                            <div class="card-body">
                                <blockquote class="blockquote mb-0">
                                    <p>of the world's most powerful and easy-to-use multi-protocol VPN software. It runs on Windows, Linux, Mac, FreeBSD and Solaris.

                                        SoftEther VPN is open source. You can use SoftEther for any personal or commercial use for free charge.

                                        SoftEther VPN is an optimum alternative to OpenVPN and Microsoft's VPN servers. SoftEther VPN has a clone-function of OpenVPN Server. You can integrate from OpenVPN to SoftEther VPN smoothly. SoftEther VPN is faster than OpenVPN. SoftEther VPN also supports Microsoft SSTP VPN for Windows Vista / 7 / 8. No more need to pay expensive charges for Windows Server license for Remote-Access VPN function.</p>
                                    <footer class="blockquote-footer"> Posted by Faculty 2 days ago <cite title="Source Title">#Exam</cite></footer>
                                </blockquote>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <h4>Mid 1 Syllabus</h4>
                            </div>
                            <div class="card-body">
                                <blockquote class="blockquote mb-0">
                                    <p>of the world's most powerful and easy-to-use multi-protocol VPN software. It runs on Windows, Linux, Mac, FreeBSD and Solaris.

                                        SoftEther VPN is open source. You can use SoftEther for any personal or commercial use for free charge.

                                        SoftEther VPN is an optimum alternative to OpenVPN and Microsoft's VPN servers. SoftEther VPN has a clone-function of OpenVPN Server. You can integrate from OpenVPN to SoftEther VPN smoothly. SoftEther VPN is faster than OpenVPN. SoftEther VPN also supports Microsoft SSTP VPN for Windows Vista / 7 / 8. No more need to pay expensive charges for Windows Server license for Remote-Access VPN function.</p>
                                    <footer class="blockquote-footer"> Posted by Faculty 2 days ago <cite title="Source Title">#Assignment</cite></footer>
                                </blockquote>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
            <div class="col">
                <div class="d-flex justify-content-center">
                <div class="card" style="width: 25rem;">
                    <div class="card-header">
                        <h3>Assignment</h3>
                    </div>
                    <ul class="list-group list-group-flush w-100 align-items-stretch">
                        <li class="list-group-item">1. Assignment 1, Due: 5 May 2020</li>
                        <li class="list-group-item">2. Assignment 2, Due: 15 June 2020</li>

                    </ul>
                </div>
            </div>
            </div>
        </div>
    </div>






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
