<?php
session_start();
require("inc/functions.php");
require_once("login_files/login_functions.php");
require_once("inc/open_db.php");

if(isset($_POST['select_appointment'])){
    $id = $_SESSION['service_type'];
    $user = $_SESSION['user'];
    $serviceDate = $_POST['select_appointment'];
    
    make_appointment($db, $id, $serviceDate, $user, $_POST['user_note']);   
//    print_r($_POST['select_appointment']);
//    if(isset($_POST['user_note'])){
//        print_r($_POST['user_note']);
//    }
    print_r($_SESSION['service_type']);
    print_r($_POST['select_appointment']);
    print_r($_SESSION['user']);
    print_r($_POST['user_note']);
    
}
//if(isset($_POST['user_note'])){
//        print_r($_POST['user_note']);
//    }
?>


<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="css/normalize.css">
        <link rel="stylesheet" href="css/main.css">
        <link href="https://fonts.googleapis.com/css?family=Bowlby+One|Francois+One|Rubik+Mono+One" rel="stylesheet">
        <title></title>
    </head>
    <body>
        
        <?php 
        if(!isset($_SESSION['user'])){
            echo '<form action="login_files/login_start.php">';
            echo    '<input type="submit" value="login">';
            echo '</form>';
        }
        if(isset($_SESSION['user'])){
            echo '<form action="login_files/logout.php">';
            echo    '<input type="submit" value="logout">';
            echo '</form>';            
        }          
        
        ?>
        <section class="block">

            <div class="left-p">
                <p>Leading to Success From Homeroom to Home</p>
                
            </div>
            
            <div class="right-p">
                <p>Our Services</p>
                
                <a href="schedule.php">View Appointments</a>
                <a href="user_account_history.php">View History</a>
                
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec aliquam mauris eget 
                    elit molestie, a tempor arcu scelerisque. Nullam laoreet interdum placerat. Ut non 
                    eros id lacus laoreet dictum. Duis fringilla aliquam varius. Cras eleifend turpis 
                    eget ex sollicitudin consequat. Curabitur ultrices sit amet lectus vitae feugiat. Nunc 
                    mollis nisi ut metus malesuada, eget vehicula purus aliquet. Aliquam sodales ut arcu 
                    commodo pretium. Aenean varius nisi eu lorem scelerisque iaculis.</p>
                
                <div class="right-subcontainer">
                    <figure>
                        <img src="images/therapy.jpg" alt="therapy">
                        <figcaption>Center-based therapy</figcaption>
                    </figure>
                    <figure>
                        <img src="images/inhome.jpg" alt="inhome">
                        <figcaption>In-home therapy</figcaption>
                    </figure>
                    <figure>
                        <img src="images/inschool.jpg" alt="school">
                        <figcaption>Classroom intervention</figcaption>
                    </figure>
                    <figure>
                        <img src="images/evidence.jpg" alt="data-based">
                        <figcaption>Evidence-based reports</figcaption>                        
                    </figure>
                    <figure>
                        <img src="images/certified.jpg" alt="therapists">
                        <figcaption>Certified therapists</figcaption>
                    </figure>
                </div>
                
                
            </div>

        </section>

        
        <?php
        // put your code here
        ?>
        
        <footer>
            Aljagthmi - Zook        Project 2       Fall 2017
        </footer>
    </body>
</html>
