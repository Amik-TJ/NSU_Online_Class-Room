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
            <div class="navbar-nav text-white ml-auto">
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
        <h1 class="display-1">CSE327 : Software Engineering</h1>
        <p class="lead ">Section : 6</p>
        <h5 class="text-monospace">Time : 13:00:00</h5>
        <h6 class="text-monospace">SAC210</h6>
    </div>
</div>


<!--This Container Contains Everything.
    Arranged In A Row With Three Main Component
    Two Tables And A Middle Part-->

<div class="container-fluid">
    <div class="row">

        <!--Exam Table Stays At Left-->
        <div class="col-md-3">
            <div class="d-flex justify-content-center">


                <div class="card " style="width: 25rem;">
                    <div class="card-header">
                        <h3>Exam</h3>
                    </div>
                    <ul class="list-group list-group-flush w-100 align-items-stretch">
                        <li class="list-group-item">Quiz 1: 13 May 2020</li>
                        <li class="list-group-item">Quiz 2: 29 May 2020</li>
                        <li class="list-group-item">Quiz 3: 20 May 2020</li>
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
                        <form action="class.php?id=0" method="post">
                            <!--Text Box-->
                            <h3> Create Post</h3>
                            <div class="space-4"></div>
                            <textarea class="form-control" id="exampleFormControlTextarea1" name="post_text"
                                      rows="5"></textarea>
                            <div class="space-3"></div>

                            <!--Choose File-->
                            <label for="exampleFormControlFile1">Upload a file</label>
                            <input type="file" class="form-control-file" id="exampleFormControlFile1">
                            <div class="space-4"></div>

                            <!--Topic Selecter-->

                            <div class="space-4"></div>
                            <input type="submit" class="btn btn-primary" value="Submit" name="post_submit">
                        </form>
                        <div class="space-8"></div>
                    </div>
                </div>

                <!--Timline Section-->
                <div class="row mb-5">
                    <div class="card" style='margin-left: 15px; width: 100%;'>
                        <div class="card-header"><img src="Imgs/faculty_male.png" class="rounded float-left" alt=""><h5>
                                Khan Mohammad Habibullah</h5>
                            <p>05 June 2020</p></div>
                        <div class="card-body">
                            <blockquote class="blockquote mb-0"><p>This is from Faculty Portal Post Created By Fahaad
                                    Rahman Amik to check wheAther the post api works or Not</p>
                                <footer class="blockquote-footer">Download Item</footer>
                            </blockquote>
                            <div class="space-4"></div>
                        </div>
                    </div>
                    <li class="list-group-item" style='margin-left: 15px; width: 100%;'>
                        <form action="class.php?id=0" method="post">
                            <div class="form-group"><input type="hidden" name="post_id" value=" cse_327_6_19 "><input
                                        class="form-control" name="comment_text" type="text"
                                        placeholder="add a comment.." style="width: 100%;"></div>
                            <button type="submit" class="btn btn-secondary" name="comment_submit">Submit</button>
                        </form>
                    </li>
                    </ul>
                    <div class="card" style='margin-left: 15px; width: 100%;'>
                        <div class="card-header"><img src="Imgs/faculty_male.png" class="rounded float-left" alt=""><h5>
                                Fahad Rahman Amik</h5>
                            <p>05 June 2020</p></div>
                        <div class="card-body">
                            <blockquote class="blockquote mb-0"><p>This is Second Post By Fahad Rahman After Solving All
                                    the problem on It to check it Correct or Not</p>
                                <footer class="blockquote-footer">Download Item</footer>
                            </blockquote>
                            <div class="space-4"></div>
                        </div>
                    </div>
                    <li class="list-group-item" style='margin-left: 15px; width: 100%;'>
                        <form action="class.php?id=0" method="post">
                            <div class="form-group"><input type="hidden" name="post_id" value=" cse_327_6_18 "><input
                                        class="form-control" name="comment_text" type="text"
                                        placeholder="add a comment.." style="width: 100%;"></div>
                            <button type="submit" class="btn btn-secondary" name="comment_submit">Submit</button>
                        </form>
                    </li>
                    </ul>
                    <div class="card" style='margin-left: 15px; width: 100%;'>
                        <div class="card-header"><img src="Imgs/faculty_male.png" class="rounded float-left" alt=""><h5>
                                Fahad Rahman Amik</h5>
                            <p>05 June 2020</p></div>
                        <div class="card-body">
                            <blockquote class="blockquote mb-0"><p>This is a post for CSE 327 by Fahad Rahman AMik after
                                    connecting front end with API. All Work done by Amik</p>
                                <footer class="blockquote-footer">Download Item</footer>
                            </blockquote>
                            <div class="space-4"></div>
                        </div>
                    </div>
                    <li class="list-group-item" style='margin-left: 15px; width: 100%;'>
                        <form action="class.php?id=0" method="post">
                            <div class="form-group"><input type="hidden" name="post_id" value=" cse_327_6_17 "><input
                                        class="form-control" name="comment_text" type="text"
                                        placeholder="add a comment.." style="width: 100%;"></div>
                            <button type="submit" class="btn btn-secondary" name="comment_submit">Submit</button>
                        </form>
                    </li>
                    </ul>
                    <div class="card" style='margin-left: 15px; width: 100%;'>
                        <div class="card-header"><img src="Imgs/faculty_male.png" class="rounded float-left" alt=""><h5>
                                Fahad Rahman Amik</h5>
                            <p>05 June 2020</p></div>
                        <div class="card-body">
                            <blockquote class="blockquote mb-0"><p>This is a post for CSE 327 by Fahad Rahman AMik after
                                    connecting front end with API. All Work done by Amik</p>
                                <footer class="blockquote-footer">Download Item</footer>
                            </blockquote>
                            <div class="space-4"></div>
                        </div>
                    </div>
                    <li class="list-group-item" style='margin-left: 15px; width: 100%;'>
                        <form action="class.php?id=0" method="post">
                            <div class="form-group"><input type="hidden" name="post_id" value=" cse_327_6_16 "><input
                                        class="form-control" name="comment_text" type="text"
                                        placeholder="add a comment.." style="width: 100%;"></div>
                            <button type="submit" class="btn btn-secondary" name="comment_submit">Submit</button>
                        </form>
                    </li>
                    </ul>
                    <div class="card" style='margin-left: 15px; width: 100%;'>
                        <div class="card-header"><img src="Imgs/faculty_male.png" class="rounded float-left" alt=""><h5>
                                Fahad Rahman Amik</h5>
                            <p>19 May 2020</p></div>
                        <div class="card-body">
                            <blockquote class="blockquote mb-0"><p>This is a trial for CREATE POST API</p>
                                <footer class="blockquote-footer">Download Item</footer>
                            </blockquote>
                            <div class="space-4"></div>
                        </div>
                    </div>
                    <li class="list-group-item" style='margin-left: 15px; width: 100%;'>
                        <form action="class.php?id=0" method="post">
                            <div class="form-group"><input type="hidden" name="post_id" value=" cse_327_6_9 "><input
                                        class="form-control" name="comment_text" type="text"
                                        placeholder="add a comment.." style="width: 100%;"></div>
                            <button type="submit" class="btn btn-secondary" name="comment_submit">Submit</button>
                        </form>
                    </li>
                    </ul>
                    <div class="card" style='margin-left: 15px; width: 100%;'>
                        <div class="card-header"><img src="Imgs/faculty_male.png" class="rounded float-left" alt=""><h5>
                                Fahad Rahman Amik</h5>
                            <p>18 May 2020</p></div>
                        <div class="card-body">
                            <blockquote class="blockquote mb-0"><p>Hello ! THis is post 1 created by 1721277042
                                    Student</p>
                                <footer class="blockquote-footer">Download Item</footer>
                            </blockquote>
                            <div class="space-4"></div>
                        </div>
                    </div>
                    <ul class="list-group list-group-flush w-100 align-items-stretch">
                        <li class="list-group-item "><p><a class="btn btn-primary" data-toggle="collapse"
                                                           href="#cse_327_6_1" role="button" aria-expanded="false"
                                                           aria-controls="post2">See Comments</a></p>
                            <div class="collapse" id="cse_327_6_1">
                                <div class="card card-body"><h5 class="card-title">Fahad Rahman Amik</h5>This is 1 st
                                    comment by 1721277042
                                </div>
                                <div class="card card-body"><h5 class="card-title">Yearat Hossain</h5>This is comments
                                    By Student S3
                                </div>
                                <div class="card card-body"><h5 class="card-title">Fahad Rahman Amik</h5> This is a
                                    comment for test
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item" style='margin-left: 15px; width: 100%;'>
                            <form action="class.php?id=0" method="post">
                                <div class="form-group"><input type="hidden" name="post_id" value=" cse_327_6_1 "><input
                                            class="form-control" name="comment_text" type="text"
                                            placeholder="add a comment.." style="width: 100%;"></div>
                                <button type="submit" class="btn btn-secondary" name="comment_submit">Submit</button>
                            </form>
                        </li>
                    </ul>
                    <div class="card" style='margin-left: 15px; width: 100%;'>
                        <div class="card-header"><img src="Imgs/faculty_male.png" class="rounded float-left" alt=""><h5>
                                Fahad Rahman Amik</h5>
                            <p>18 May 2020</p></div>
                        <div class="card-body">
                            <blockquote class="blockquote mb-0"><p>THis is Post 2 created by Fahad Rahman AMik . Class
                                    CSE 327 Section 6 . KMB sir. AND this post API works correctly</p>
                                <footer class="blockquote-footer">Download Item</footer>
                            </blockquote>
                            <div class="space-4"></div>
                        </div>
                    </div>
                    <li class="list-group-item" style='margin-left: 15px; width: 100%;'>
                        <form action="class.php?id=0" method="post">
                            <div class="form-group"><input type="hidden" name="post_id" value=" cse_327_6_7 "><input
                                        class="form-control" name="comment_text" type="text"
                                        placeholder="add a comment.." style="width: 100%;"></div>
                            <button type="submit" class="btn btn-secondary" name="comment_submit">Submit</button>
                        </form>
                    </li>
                    </ul></div>
            </div>

        </div>

        <!--Assignment Table Stays At Right-->
        <div class="col-md-3">
            <div class="d-flex justify-content-center">
                <div class="card" style="width: 25rem;">
                    <div class="card-header">
                        <h3>Assignment</h3>
                    </div>
                    <ul class="list-group list-group-flush w-100 align-items-stretch">
                        <li class="list-group-item">Assignment 3, Due: 20 May 2020</li>
                        <li class="list-group-item">Assignment 1, Due: 11 May 2020</li>
                        <li class="list-group-item">Assignment 2, Due: 26 May 2020</li>
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
