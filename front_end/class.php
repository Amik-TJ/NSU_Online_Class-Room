<?php
    session_start();
    if (!$_SESSION['security']) {
        header('Location: index.php');
    }
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
    // API
    include_once '../api_stuffs/tools/global.php';
    $load = array(
        'class_id' => $single_class_data['class_id'],
        'secret_message' => "Give All Posts"
    );
    $res = make_req($post_url, $load);
    $res = json_decode($res, true);
    $_SESSION['post'] = $res;
    $post_data = $res;
    /*echo "<pre>";
    print_r($post_data);
    echo "</pre>";*/
    /*echo "<pre>";
    print_r($post_data);
    echo "</pre>";*/

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
            <div class="col-sm-3">
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

            <!--Create Post and Timeline Stays At Middle-->
            <div class="col-sm-6">

                <!--Separated In Two Parts
                    Create Post And Time Line-->
                <div class="col">

                    <!--Create Post Section-->
                    <div class="row mb-5">
                        <div class="container">
                            <form>
                                <!--Text Box-->
                                <h3> Create Post</h3>
                                <div class="space-4"></div>
                                <textarea class="form-control" id="exampleFormControlTextarea1" rows="5"></textarea>
                                <div class="space-3"></div>

                                <!--Choose File-->
                                <label for="exampleFormControlFile1">Upload a file</label>
                                <input type="file" class="form-control-file" id="exampleFormControlFile1">
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
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                            <div class="space-8"></div>
                        </div>
                    </div>

                    <!--Timline Section-->
                    <div class="row">
                        <div class="card">
                            <div class="card-header">
                                <img src="Imgs/faculty_male.png" class="rounded float-left" alt="">
                                </a>
                                <h5>Khan Md Habibullah</h5>
                                <p>161000042</p>
                            </div>
                            <div class="card-body">
                                <blockquote class="blockquote mb-0">
                                    <p>of the world's most powerful and easy-to-use multi-protocol VPN software. It runs on Windows, Linux, Mac, FreeBSD and Solaris. SoftEther VPN is open source. You can use SoftEther for any personal or commercial use for free charge.</p>
                                    <footer class="blockquote-footer"> Posted 2 days ago <cite title="Source Title">#Exam</cite></footer>
                                </blockquote>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <img src="Imgs/faculty_male.png" class="rounded float-left" alt="">
                                </a>
                                <h5>Khan Md Habibullah</h5>
                                <p>161000042</p>
                            </div>
                            <div class="card-body">
                                <blockquote class="blockquote mb-0">
                                    <p>of the world's most powerful and easy-to-use multi-protocol VPN software. It runs on Windows, Linux, Mac, FreeBSD and Solaris. SoftEther VPN is open source. You can use SoftEther for any personal or commercial use for free charge.</p>
                                    <footer class="blockquote-footer"> Posted 2 days ago <cite title="Source Title">#Exam</cite></footer>
                                </blockquote>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <a href="#"></a>
                                <img src="Imgs/student_male.jpg" class="rounded float-left " alt="">
                                </a>
                                <h5>Yearat Hossain</h5>
                                <p>1712275642</p>
                            </div>
                            <div class="card-body">
                                <blockquote class="blockquote mb-0">
                                    <p>of the world's most powerful and easy-to-use multi-protocol VPN software. It runs on Windows, Linux, Mac, FreeBSD and Solaris.

                                        SoftEther VPN is open source. You can use SoftEther for any personal or commercial use for free charge.

                                        SoftEther VPN is an optimum alternative to OpenVPN and Microsoft's VPN servers. SoftEther VPN has a clone-function of OpenVPN Server. You can integrate from OpenVPN to SoftEther VPN smoothly. SoftEther VPN is faster than OpenVPN. SoftEther VPN also supports Microsoft SSTP VPN for Windows Vista / 7 / 8. No more need to pay expensive charges for Windows Server license for Remote-Access VPN function.</p>
                                    <footer class="blockquote-footer"> Posted 5 days ago <cite title="Source Title">#Assignment</cite></footer>
                                </blockquote>
                            </div>
                        </div>
                    </div>

                </div>

            </div>

            <!--Assignment Table Stays At Right-->
            <div class="col-sm-3">
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
