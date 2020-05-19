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
                    <a class="nav-item nav-link active" href="#">Home</a>
                    <a class="nav-item nav-link" href="#">Profile</a>
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


    <div class="container">
        <div class="d-flex flex-row-reverse">
            <div class="p-2">
                <div class="container-fluid  ">
                    <div class="card ">
                        <div class="card-body px-3 py-3">
                            <h4><?php echo $name; ?></h4>
                            <h4><?php echo $nsu_id; ?></h4>
                        </div>
                    </div>
                </div>
            </div>
            <div class="p-2">
                <div class="container-fluid ">
                    <div class="card" style="width: 8rem;">
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
        </div>
    </div>



    <div class="container text-muted px-5 py-5">
        <div class="row justify-content-center px-15 py-15 ">
            <div class="col-4 mb-3">

                <div class="card text-white bg-warning " style="max-width: 30rem;">

                    <div class="card-body px-3 py-3">
                        <a href="#" class="text-white"> <h2>CSE 425</h2> </a>
                        <h5 class="card-text">Section: 6</h5>
                        <h4 class="card-text"> </h4>
                        <h4 class="card-text"> </h4>
                        <h4 class="card-text">Time: MW 1:00-2:40 </h4>
                        <h4 class="card-text">Room: Sac 312 </h4>
                    </div>
                </div>
            </div>

            <div class="col-4 mb-3">
                <div class="card text-white bg-success  " style="max-width: 30rem;">

                    <div class="card-body px-3 py-3">
                        <a href="#" class="text-white"> <h2>MAT 361</h2> </a>
                        <h5 class="card-text">Section: 12</h5>
                        <h4 class="card-text"> </h4>
                        <h4 class="card-text"> </h4>
                        <h4 class="card-text">Time: RA 8:00-9:40 </h4>
                        <h4 class="card-text">Room: NAC 901 </h4>
                    </div>
                </div>
            </div>
            <div class="col-4 mb-3">
                <div class="card text-white bg-danger " style="max-width: 30rem;">

                    <div class="card-body px-3 py-3">
                        <a href="#" class="text-white"> <h2>CSE 327</h2> </a>
                        <h5 class="card-text">Section: 10</h5>
                        <h4 class="card-text"> </h4>
                        <h4 class="card-text"> </h4>
                        <h4 class="card-text">Time: ST 4:20-5:50 </h4>
                        <h4 class="card-text">Room: SAC 402 </h4>
                    </div>
                </div>
            </div>
            <div class="col-4 mb-3">
                <div class="card text-white bg-success " style="max-width: 30rem;">

                    <div class="card-body px-3 py-3">
                        <a href="#" class="text-white"> <h2>CSE 327</h2> </a>
                        <h5 class="card-text">Section: 10</h5>
                        <h4 class="card-text"> </h4>
                        <h4 class="card-text"> </h4>
                        <h4 class="card-text">Time: ST 4:20-5:50 </h4>
                        <h4 class="card-text">Room: SAC 402 </h4>
                    </div>
                </div>
            </div>
            <div class="col-4 mb-3">
                <div class="card text-white bg-danger " style="max-width: 30rem;">

                    <div class="card-body px-3 py-3">
                        <a href="#" class="text-white"> <h2>CSE 327</h2> </a>
                        <h5 class="card-text">Section: 10</h5>
                        <h4 class="card-text"> </h4>
                        <h4 class="card-text"> </h4>
                        <h4 class="card-text">Time: ST 4:20-5:50 </h4>
                        <h4 class="card-text">Room: SAC 402 </h4>
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
