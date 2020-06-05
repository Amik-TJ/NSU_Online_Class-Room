<?php
    session_start();
    if (!$_SESSION['security']) {
        header('Location: index.php');
    }
    $success = $_SESSION['ex_res']['success'];
    if($success){
        $ex_res = $_SESSION['ex_res']['data'];
    }



    /*echo "<pre>";
    print_r($_SESSION['ex_res']);
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
        <h1 class="display-1">Exam Announcement</h1>

    </div>
</div>


<!--This Container Contains Everything.
    Arranged In A Row With Three Main Component
    Two Tables And A Middle Part-->
<div class="container-fluid">
    <div class="jumbotron">
        <div class="row" >

            <!--Exam Table Stays At Left-->
            <div class="col-md-3">

            </div>

            <!--Create Post and Timeline Stays At Middle-->
            <div class="col-md-6">
                <?php
                    if($success){
                        echo '<table class="table table-striped">';
                        echo '<thead class="thead-primary">';
                        echo '<tr>';
                        echo '<th scope="col">Title</th>';
                        echo '<th scope="col">Discussion</th>';
                        echo '<th scope="col">Posted</th>';
                        echo '<th scope="col">Exam Date</th>';
                        echo '</tr>';
                        echo '</thead>';
                        echo '<tbody>';
                        foreach ( $ex_res as $ex){
                            $exam_time = strtotime($ex['exam_time_date']);
                            $exam_time = date('d F Y h:ia' , $exam_time);
                            $posted_time = strtotime($ex['created_time']);
                            $posted_time = date('d F Y' , $posted_time);
                            echo '<tr>';
                            echo '<th scope="row">';
                            echo $ex['exam_title'];
                            echo '</th>';
                            echo '<td>';
                            echo $ex['post_text'];
                            echo '</td>';
                            echo '<td class="text-success">';
                            echo  $posted_time;
                            echo '</td>';
                            echo '<td class="text-danger">';
                            echo $exam_time;
                            echo '</td>';
                        }
                        echo '</tbody>';
                        echo '</table>';
                    }else
                    {
                        echo '<h2 class="text-center">';
                        echo "Hurray ! There is No Exam !!";
                        echo '</h2>';
                    }
                ?>



            </div>

            <!--Assignment Table Stays At Right-->
            <div class="col-md-3">

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
