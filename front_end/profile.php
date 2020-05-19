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
    //echo "<pre>";
    //print_r($_SESSION['res']);
    //echo "</pre>";
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
                    <a class="nav-item nav-link active" href="#">Profile</a>
                    <a class="nav-item nav-link" href="#">Classroom</a>
                    <a class="nav-item nav-link" href="#">Logout</a>
                    <a class="nav-item nav-link" href="#">Contact</a>
                </div>
            </div>
        </div>
    </nav>

    <div class="jumbotron jumbotron-fluid bg-info text-white text-center">
        <div class="container">
            <h1 class="display-1">NSU Online Classroom</h1>
            <p class="lead">An Online Portal for Managing Courses</p>
        </div>
    </div>


    <div class="container text-muted">

        <!-- cards -->

        <div class="col py-5">
            <div class="row">
                <div class="container-fluid">
                    <h2>Welcome &nbsp;<?php echo $name; ?></h2>
                </div>
            </div>
            <div class="row">
            <div class="container-fluid py-3">
                <div class="card">
                    <img class="card-img-top img-fluid" src="Imgs/<?php
                    if($token){
                       if($gender == "male"){
                           echo "student_male.jpg";
                       }else{
                           echo "student_female.jpg";
                       }
                   }else{
                        if($gender == "male"){
                            echo "faculty_male.png";
                        }else{
                            echo "faculty_female.png";
                        }
                   } ?>">
                </div>
            </div>
            </div>
            <div class="row">
                <div class="container-fluid">
                    <div class="width-80 label label-info label-xlg arrowed-in arrowed-in-right">
                        <div class="inline position-relative">
                            <a href="#" class="user-title-label">
                                <span class="white">&nbsp;<?php echo $name; ?>&nbsp;&nbsp;</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="container-fluid py-3">


                <div class="card align-items-center bg-light border-info " style="width: 25rem;">
                    <div class="card-body">

                        <ul class="list-group list-group-flush w-100 align-items-stretch">
                            <li class="list-group-item text-center d-inline-block">
                                <a href="#" class="btn btn-link">
                                    <i class="ace-icon fa fa-cog bigger-120 green"></i>
                                    <?php echo $nsu_id; ?>
                                </a>  </li>
                            <li class="list-group-item text-center d-inline-block">
                                <a href="#" class="btn btn-link">
                                    <i class="ace-icon fa fa-envelope bigger-120 pink"></i>
                                    <?php echo $email; ?>
                                </a>
                            </li>
                            <li class="list-group-item text-center d-inline-block">
                                <a href="#" class="btn btn-link">
                                    <i class="ace-icon fa fa-globe bigger-125 blue"></i>
                                    <?php
                                        if($token){
                                            echo "Degree: BS in CSE";
                                        }else{
                                            echo "Department: Electrical & Computer Engineering";
                                        }
                                    ?>
                                </a>
                            </li>
                            <li class="list-group-item text-center d-inline-block">
                                <a href="#" class="btn btn-link">
                                    <i class="ace-icon fa fa-book bigger-125 green"></i>
                                    <?php
                                    if($token){
                                        echo "Curriculum Name: BS in CSE - 130 Credit";
                                    }else{
                                        echo "Full Time Faculty";
                                    }
                                    ?>

                                </a>
                            </li>
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
