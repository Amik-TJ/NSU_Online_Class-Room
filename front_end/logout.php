<?php
    session_start();
    $_SESSION['security'] = false;
    session_destroy();
    header('Location: index.php');
?>
