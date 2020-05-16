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
    print_r($_SESSION['res']);
    echo "</pre>";
?>
<!DOCTYPE html>
<html lang="en">

<head>
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

</head>
<body class="no-skin ">
<div id="navbar" class="navbar navbar-default navbar-collapse student-header">
    <div class="navbar-container  container" id="navbar-container">
        <div class="navbar-header pull-left">
            <a href="#" class="navbar-brand">
                <img src="Imgs/logo-wide.png" style="max-width:340px">
            </a>
            <button class="pull-right navbar-toggle collapsed" type="button" data-toggle="collapse"
                    data-target="#sidebar">
                <span class="sr-only">Toggle sidebar</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>
    </div>
    <div class="clearfix"></div>
</div>
<div class="main-container ace-save-state " id="main-container">
    <div id="sidebar" class="sidebar h-sidebar navbar-collapse collapse ace-save-state">
        <ul class="nav nav-list">
            <li class="hover blank" style="width:189px">&nbsp;</li>
            <li class="hover">
                <a href="Home.php">
                    <i class="menu-icon fa fa-home"></i>
                    <span class="menu-text">Home</span>
                </a>
                <b class="arrow"></b>
            </li>
            <li class="hover">
                <a href="class.php">
                    <i class="menu-icon fa fa-book"></i>
                    <span class="menu-text">Classroom</span>
                </a>
                <b class="arrow"></b>
            </li>
            <li class="hover">
                <a href="home.php?log_out=true">
                    <i class="menu-icon fa fa-power-off"></i>
                    <span class="menu-text">Logout</span>
                    <b class="arrow fa fa-angle-down"></b>
                </a>
                <b class="arrow"></b>
            </li>
        </ul>
        <!-- /.nav-list -->
    </div>
    <!-- Html Starts -->

    <script type="text/javascript">
    </script>

    <div class="main-content">
        <div class="main-content-inner">
            <div class="page-content">
                <div class="page-header">
                    <h1>Welcome &nbsp;<?php echo $name; ?></h1>
                </div>
                <div class="row">
                    <div class="clearfix"></div>
                    <div class="col-xs-12">
                        <div id="user-profile-1" class="user-profile row">
                            <div class="col-xs-12 col-sm-4 center">
                                <div>
                                    <span class="profile-picture">
                                        <img id="avatar" class="editable img-responsive" alt="Avatar"
                                             src="Imgs/<?php
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
                                            } ?>" width="160"/>
                                    </span>
                                    <div class="space-4"></div>
                                    <div class="width-80 label label-info label-xlg arrowed-in arrowed-in-right">
                                        <div class="inline position-relative">
                                            <a href="#" class="user-title-label">
                                                <span class="white">&nbsp;<?php echo $name; ?>&nbsp;&nbsp;</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="space-6"></div>
                                <div class="profile-contact-info">
                                    <div class="profile-contact-links align-left">
                                        <a href="#" class="btn btn-link">
                                            <i class="ace-icon fa fa-cog bigger-120 green"></i>
                                            <?php echo $nsu_id; ?>
                                        </a>

                                        <a href="#" class="btn btn-link">
                                            <i class="ace-icon fa fa-envelope bigger-120 pink"></i>
                                            <?php echo $email; ?>
                                        </a>
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
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>