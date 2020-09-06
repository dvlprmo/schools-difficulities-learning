<?php

session_start();
include('inc/functions.php');
require_once("inc/open_db.php");

/*****************************VERIFY USER LOGGED IN***************************************/
if(!isset($_SESSION['user'])){
    echo "Log in to view available appointments. You will be redirected to the home page in 2 seconds.";    
    header( "refresh:5; url=index.php" );
}
else {
    echo "Available apointments.";
/*****************************************************************************************/
    
echo "<html>";

include('inc/head.php');   
    
    
                /*  DETERMINE REASON FOR LANDING ON schedule.php   */


                /****************************************************
                *       Populate the SERVICE TYPE Dropdown 
                ****************************************************/
/*****************************************************************************************/
if(empty($_POST['service_type']) or isset($_POST['reset'])){
    
    echo "<br>Please choose from the menu below to SELECT SERVICE TYPE<br>";
    
    $services = get_services($db);      //Store Service Types 
    
    echo "<form action='schedule.php' method='post'>";    
    
            /**** Service Type Dropdown *******/
    echo "<select name='service_type'>"; 
    
    echo "<option value=''>--Chose Service Type--</option>";
        foreach($services as $service) {               
            echo "<option value='{$service[Service_ID]}'>$service[Service_Name]</option>";
        }        
    echo "</select><br><br>";
    
    echo "<input type='submit' name='search_schedule' value='SEARCH SERVICE'>";
    echo "</form>";    
    
    include ('inc/change_appointment.php');
}
/*****************************************************************************************/

                /****************************************************
                *       Populate the SERVICE DATE dropdown 
                ****************************************************/
/*****************************************************************************************/ 
if(isset($_POST['service_type'])){
    echo "<br>Serivce type is set<br>";
    
    $id = $_POST['service_type'];
    
    $_SESSION['service_type'] = $id;            /*<-------SESSION VARIABLE for Service Type  */
    echo "Post array for service type inlcudes Service ID ";
    print_r($id);
    echo "<br>";    
    
    $serviceDates = get_services_dates($db, $id);       //Store Service_Dates for the Service_Type 
    
    
    $serviceHours = get_services_hours_dates($db, $id); //Store schedule for on Service_Type 
    
            /**** Service Date Dropdown *******/
    echo "Please choose form the menue below to SELECT SERVICE DATE";
    echo "<form action='schedule.php' method='post'>";
    echo "<select name='service_date'>";
    echo "<option>--Choose Date--</option>";
        foreach($serviceDates as $date){   
           
            $strDate = date('l F jS Y', strtotime($date[0]));
            if ($previousDate != $strDate){           
                echo "<option value=$date[0]>$strDate</option>";
            }
            $previousDate = $strDate;
        }
    echo "</select><br><br>";
    echo "<input type='submit' name='search_schedule' value='SEARCH DATE'>";
    echo "<input type='submit' name='reset' value='RESET SEARCH'>";
    echo "</form>"; 

    /*** DISPLAY SCHEDULE AVAILABLE FOR SERVICE TYPE **/
  
    display_schedule($serviceHours);
}
/*****************************************************************************************/

                /****************************************************
                *   DISPLAY AVAILABLE SERVICE APPOINTMENTS ON SERVICE DATE
                ****************************************************/
/*****************************************************************************************/
    if(isset($_POST['service_date'])) {
        
        echo "Date was set";
        $id = $_SESSION['service_type'];
        $selectedDate = $_POST['service_date'];     // this is a string, and only shows 2017-11-30 no TIME
        
        echo "Post array for service_date includes ";
        print_r($selectedDate);
        
        $formattedDate = date("Y-m-d H:i:s", strtotime($selectedDate));
        $available = get_service_by_date($db, $id, $formattedDate); //this expects a DateTime parameter
        
        echo "<form action='schedule.php' method='post'>";
        echo "<input type='submit' name='reset' value='Restart Search'>";
        echo "<form action='schedule.php method='post'>";
        
        /*** DISPLAY SCHEDULE AVAILABLE FOR SERVICE DATE AND TYPE**/
        
        display_schedule($available);
        
    }
/*****************************************************************************************/
    
                /****************************************************
                 *      SELECT ONE APPOINTMENT TO MODIFY NOTE
                ****************************************************/
/*****************************************************************************************/
    if(isset($_POST['modify'])){
        
        $user = $_SESSION['user'];
        $existingAppts = get_existing_appointments($db, $user);
        $reason = 'Modify';
        
        /*** DISPLAY EXSITING APPOINTMENTS **/
        display_existing_appointments($existingAppts, $reason);        
        
        unset($_POST['modify']);
    }
/*****************************************************************************************/    
    
                /****************************************************
                 *      ENTER A NEW APPOINTMENT NOTE
                ****************************************************/
/*****************************************************************************************/    
    if(isset($_POST['modify_existing'])){
        
        $selectedAppt = $_POST['modify_existing'];
        $_SESSION['selected_appt'] = $selectedAppt;
        echo "Post array for modify_existing includes ";
        print_r($_POST['modify_existing']);//Displaying DATE not DATETIME        
        
        echo "<form action='' method='post'>";
        echo "Update Appointment Note: <input type='text' name='note_text'>";
        echo "<input type='submit' value='UPDATE APPOINTMENT'>";
        echo "<input type='submit' name='reset' value='RESET'>";
        echo "</form>";
    }
    
/*****************************************************************************************/    
    
                /****************************************************
                 *      MODIFY APPOINTMENT WITH NEW NOTE
                ****************************************************/
/*****************************************************************************************/  
    if(isset($_POST['note_text'])){
        $id = $_SESSION['service_type'];
        $selectedAppt = $_SESSION['selected_appt'];
        $newText = $_POST['note_text'];
        echo $newText;
               
    }
/*****************************************************************************************/
    
                /****************************************************
                 *      SELECT AN APPOINTMENT TO CANCEL 
                ****************************************************/
/*****************************************************************************************/
    if(isset($_POST['cancellation'])){
        echo "Cancellations within 48 hours of the appointment cannot be made without contacting your case supervisor.";
        $user = $_SESSION['user'];
        $existingAppts = get_existing_appointments($db, $user);
        $reason = "Cancel";
        display_existing_appointments($existingAppts, $reason);        
    }
/*****************************************************************************************/
    
                /****************************************************
                 *      CANCEL SELECTED APPOINTMENT
                ****************************************************/
/*****************************************************************************************/
    if(isset($_POST['cancel_existing'])){
        $user = $_SESSION['user'];
        $selectedAppt = $_POST['cancel_existing'];
        echo "Post array for cancel_existing includes ";
        print_r($selectedAppt);
    }
}
    
echo "</html>";
?>
    
        
 

