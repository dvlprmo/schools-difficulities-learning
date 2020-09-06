<?php
session_start();
require('inc/functions.php');
require_once("inc/open_db.php");
require ('inc/head.php');
if(!isset($_SESSION['user'])){
    echo "Log in to view appointment history. You will be redirected to the home page in 2 seconds.";    
    header( "refresh:5; url=index.php" );
}
else {
    $user = $_SESSION['user'];
    echo "Appointment History.";
    $history = get_appointment_history($db, $user);
    
    if (empty($history)){
        echo "You currently have no previous appointments scheduled.";
    }
    else{
        display_history($history);
    }
}
