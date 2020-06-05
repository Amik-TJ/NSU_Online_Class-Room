<?php
//include_once 'includes/header.php';
session_start();
if (!$_SESSION['security']) {
    header('Location: index.php');
}
    $token = $_SESSION['token'];
    // Session er data rakhtesi home e display korar jnnno !
    if ($token) {
        $name = $_SESSION['student_name'];
    } else {
        $name = $_SESSION['faculty_name'];
    }
    $nsu_id = $_SESSION['nsu_id'];
    $email = $_SESSION['email'];
    $gender = $_SESSION['gender'];


// API
include_once "random_color.php";
include_once '../api_stuffs/tools/global.php';
$load = array(
    'token' => $token,
    'success' => "Give All Classes Data",
    'user_id' => $nsu_id
);
$res = make_req($class_url, $load);
$res = json_decode($res, true);
$_SESSION['class_data'] = $res;
$class_data = $res; // for showing information in Home2.php
/*echo "<pre>";
print_r($_SESSION['class_data']);
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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css"
          integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
</head>
<body>

<!-- navbar -->
<nav class="navbar navbar-toggleable-md  navbar-inverse" style="background-color: #000545;">
    <div class="container">
        <button class="navbar-toggler" data-toggle="collapse" data-target="#mainNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="mainNav">
            <div class="navbar-nav ml-auto">
                <a class="nav-item nav-link active" href="home.php">Back to RDS</a>
                <a class="nav-item nav-link" href="logout.php">Logout</a>
            </div>
        </div>
    </div>
</nav>

<div class="jumbotron jumbotron-fluid text-white text-center" style="background-color: #06265F;">
    <div class="container">
        <h1 class="display-1">NSU Online Classroom</h1>
        <p class="lead">An Online Portal for Managing Courses</p>
    </div>
</div>


<div class="container">
    <div class="d-flex flex-row-reverse">
        <div class="p-2">
            <div class="container-fluid  ">
                <div class="card" style="box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19); ">
                    <div class="card-body px-3 py-3">
                        <h4><?php echo $name; ?></h4>
                        <h4>ID:<?php echo $nsu_id; ?></h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="p-2">
            <div class="container-fluid ">
                <div class="card" style="width: 8rem;">
                    <img class="card-img-top img-fluid" src="<?php echo $_SESSION['image']; ?>">
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container">
<div class="row">
        <?php
        if ($class_data['success']) {
            $class_id = null;
            $i = 0;
            foreach ($class_data['data'] as $data) {
                $color = random_color();

                $class_id = 'class.php?id='.$i;
                $i++;
                echo '<a href="' .$class_id.   '" style="text-decoration: none;">';
                echo '<div class="text-muted px-5 py-5">';
                echo '<div class="justify-content-center px-15 py-15 ">';


                echo '<div class="col-md-3 mb-3">';
                echo '<div class="card text-white" style="height: 17rem;box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19); width: 25rem; background-color: #'.$color.';" >';
                echo '<div class="card-body px-3 py-3">';


                echo '<h2>';
                echo strtoupper($data['course_id']);
                echo '</h2>';

                echo '<h4 class="card-text">';
                echo $data['course_title'];
                echo '</h4>';
                echo '<h5 class="card-text">';
                echo 'Section: ' . $data['section'];
                echo '</h5>';
                echo '<h4 class="card-text">Time: ' . $data['time'];
                echo '</h4>';
                echo '<h4 class="card-text">Room: ' . $data['room_no'];
                echo '</h4>';
                echo '</h4>';
                if ($_SESSION['token']){
                    echo '<h4 class="card-text">Faculty: ' . $data['faculty_name'];
                    echo '</h4>';
                }
                echo '</div>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
                echo '</a>';

            }

        } else {
           echo '<div class="row">';
           echo '<div class="col-md-6 col-md-offset-4 text-center py-5">' ;
            echo '<div class="card bg-primary text-white"
                    style="box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19);">' ;
                echo '<div class="card-body">' ;
                 echo '<h1 class="display-3 p-4">' ;
                  echo 'You are not in any Class !';
                  echo '</h1>';
                 echo   '</div>';
              echo '</div>';
           echo  '</div>';
          echo   '</div>';
        }
        ?>
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
<script src="https://code.jquery.com/jquery-3.1.1.slim.min.js"
        integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n"
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js"
        integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb"
        crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js"
        integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn"
        crossorigin="anonymous"></script>
<script>
    $(function () {
        $('[data-toggle="tooltip"]').tooltip();
    });
</script>
</body>
</html>
