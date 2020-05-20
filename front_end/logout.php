<?php
    session_start();
    unset($_SESSION['security']);
    session_destroy();
    header('Location: index.php');
?>
