<?php
$error = null;
if (isset($_POST['submit'])) {
    // Including API starter pack
    include_once '../api_stuffs/tools/global.php';
    $load = array(
        'user_id' => $_POST['user_id'],
        'password' => $_POST['password']
    );
    $res = make_req($login_url, $load);
    $res = json_decode($res, true);

    if ($res['success'] === 1){
        // Checking Student or Faculty !
        if ( $res['token'] ){
            session_start();
            $_SESSION['token'] = $res['token'];
            $_SESSION['nsu_id'] = $res['nsu_id'];
            $_SESSION['person_id'] = $res['person_id'];
            $_SESSION['student_name'] = $res['student_name'];
            $_SESSION['email'] = $res['email'];
            $_SESSION['gender'] = $res['gender'];
            $_SESSION['security'] = true;
            header('Location: home.php');

        }else{// This is for Faculty
            session_start();
            $_SESSION['token'] = $res['token'];
            $_SESSION['nsu_id'] = $res['nsu_id'];
            $_SESSION['person_id'] = $res['person_id'];
            $_SESSION['faculty_name'] = $res['faculty_name'];
            $_SESSION['faculty_initial'] = $res['faculty_initial'];
            $_SESSION['email'] = $res['email'];
            $_SESSION['gender'] = $res['gender'];
            $_SESSION['security'] = true;
            header('Location: home.php');
        }
    }else{
        $error = $res['error_message'];
    }
}// end of postcheck
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
    <title>NSU Portal | North South University</title>
    <link rel="stylesheet" href="https://rds3.northsouth.edu/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://rds3.northsouth.edu/assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://rds3.northsouth.edu/assets/css/login-style.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-blue-grey.css">
    <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Open+Sans'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <script type="text/javascript" src="https://rds3.northsouth.edu/assets/js/jquery-2.1.4.min.js"></script>
    <script type="text/javascript" src="https://rds3.northsouth.edu/assets/js/login.js"></script>
    <script type="text/javascript">
        var ctoday = 1575734021000;
    </script>
</head>
<body>
<div id="navbar" class="navbar navbar-default navbar-collapse faculty-header">
    <div class="navbar-container  container" id="navbar-container">
        <div class="navbar-header pull-left">
            <a href="#" class="navbar-brand">
                <img src="imgs/logo-wide.png" style="max-width:340px">
            </a>
        </div>
    </div>
    <div class="clearfix"></div>
</div>
<div class="main-container ace-save-state container" id="main-container">
    <div class="page-content main-content">
        <div class="row">
            <div class="col-md-6 col-md-offset-3 text-center" style="margin-top:20px;margin-bottom:20px;">
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6 col-lg-offset-3">
                <div class="login-form">
                    <h3>RDS</h3>
                    <div class="row">
                        <div class="col-md-3 text-center">
                            <img src="imgs/login.png" width="80" height="80" style="margin-top:10px;">
                        </div>
                        <div class="col-md-9">
                            <form method="post" action="#">
                                <?php
                                if ($error){
                                    echo '<p id="error_msg">'. $error . '</p>';
                                }
                                ?>
                                <p class="headings">NSU Portal : Login<br /><br /></p>
                                <div class="row">
                                    <div class="col-md-3">Username</div>
                                    <div class="col-md-9">
                                        <div class="form-group ">
                                            <input type="text" name="user_id" maxlength="10" class="form-control"
                                                   placeholder="Enter your User id" id="UserName" autofocus>
                                            <i class="fa fa-user"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">Password</div>
                                    <div class="col-md-9">
                                        <div class="form-group ">
                                            <input type="password" name="password" class="form-control"
                                                   placeholder="Enter your password" id="password" autofocus
                                            >
                                            <i class="fa fa-lock"></i>
                                        </div>
                                    </div>
                                </div>
                                <input type="submit" name="submit" value="Submit"
                                       class="btn btn-success pull-right" />
                                <div class="clearfix" style="margin-bottom:10px;"></div>
                            </form>

                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer">
        <div class="footer-inner">
            <div class="footer-content">
                <span class="blue">Developed &amp; Maintained By Full_of_BUGS</span>
            </div>
        </div>
    </div>
</div>
</div>
</body>
</html>