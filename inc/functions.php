<?php


        /**********************
  * Populates the Service dropdown menu 
         *********************/
function get_services($db){
    $query = 'SELECT Service_ID, Service_Name from services';
    $statement = $db->prepare($query);
    $statement->execute();
    $all_services = $statement->fetchAll(PDO::FETCH_ASSOC);
    $statement->closeCursor();
    return $all_services;
}
    /*************************************/


        /**********************
  * Populates the Date dropdown menu
         *********************/
function get_services_dates ($db, $serviceID){
    $query = 'SELECT DISTINCT Service_Date FROM appointments WHERE Service_ID = :id AND Service_Date > CURRENT_TIME AND appointments.Email IS NULL';
    $statement = $db->prepare($query);
    $statement->bindValue(':id', $serviceID);
    $statement->execute();
    $service_dates = $statement->fetchAll();
    $statement->closeCursor();    
    return $service_dates;  
}
    /*************************************/


        /**********************
  * Populates the Schedule table with service appointments for all dates
         *********************/
function get_services_hours_dates ($db, $serviceID){
    $query = 'SELECT Service_Date FROM appointments WHERE Service_ID = :id AND Service_Date > CURRENT_TIME AND appointments.Email IS NULL';
    $statement = $db->prepare($query);
    $statement->bindValue(':id', $serviceID);
    $statement->execute();
    $service_dates = $statement->fetchAll(PDO::FETCH_ASSOC);
    $statement->closeCursor();    
    return $service_dates;  
}
    /*************************************/


        /**********************
  * Populates the Schedule table with service appointments for one date
        *********************/
function get_service_by_date($db, $serviceID, $serviceDate) {
    $query = 'SELECT Service_Date FROM `appointments` INNER JOIN services ON services.Service_ID = appointments.Service_ID WHERE appointments.Service_Id  = :id AND Date (Service_Date) = :date AND appointments.Email IS NULL';
    $statement = $db->prepare($query);
    $statement->bindValue(':id', $serviceID);
    $statement->bindValue(':date', $serviceDate);
    $statement->execute();
    $service_by_date = $statement->fetchAll(PDO::FETCH_ASSOC);
    $statement->closeCursor();
    return $service_by_date;  
}
    /*************************************/


//gets all avaialble appointments based on service type
function get_schedule($db, $serviceID){
    $query = 'SELECT * FROM appointments INNER JOIN services ON services.Service_ID = appointments.Service_ID WHERE services.Service_ID = :id AND appointments.Email IS NULL';
    $statement = $db->prepare($query);
    $statement->bindValue(':id', $serviceID);    
    $statement->execute();
    $calander_by_service = $statement->fetchAll(PDO::FETCH_ASSOC);
    $statement->closeCursor();
    return $calander_by_service;  
}
function get_appointment_history($db, $user){
    $query = 'SELECT Service_Date, Notes FROM appointments INNER JOIN customers ON customers.Email = appointments.Email WHERE Service_Date < CURRENT_DATE AND appointments.Email = :Email';
    $statement = $db->prepare($query);
    $statement->bindValue(':Email', $user); 
    $statement->execute();
    $service_history = $statement->fetchAll(PDO::FETCH_ASSOC);
    $statement->closeCursor();
    return $service_history;  
}
function make_appointment($db, $id, $serviceDate, $user, $note){
    $query = 'INSERT INTO appointments (Service_ID, Service_Date, Email, Notes) values (:id, :service_date, :user, :note)'; 
    $statement = $db->prepare($query);
    $statement->bindValue(':id', $id); 
    $statement->bindValue(':service_date', $serviceDate);
    $statement->bindValue(':user', $user);
    $statement->bindValue(':note', $note);
    $statement->execute();    
    $statement->closeCursor();
    return; 
}
function get_existing_appointments($db, $user){
    $query = 'SELECT Service_ID, Service_Date, Notes FROM appointments INNER JOIN customers ON customers.Email = appointments.Email WHERE Service_Date > CURRENT_TIMESTAMP AND appointments.Email = :Email';
    $statement = $db->prepare($query);
    $statement->bindValue(':Email', $user); 
    $statement->execute();
    $service_history = $statement->fetchAll(PDO::FETCH_ASSOC);
    $statement->closeCursor();
    return $service_history;  
}
function update_existing_appointment($db, $id, $serviceDate, $note){
    $query = 'UPDATE appointments SET Notes = :note WHERE Service_ID = :id AND Service_Date = :date';
    $statement = $db->prepare($query);
    $statement->bindValue(':note', $note); 
    $statement->bindValue(':id', $id); 
    $statement->bindValue(':date', $serviceDate);
    $statement->execute();    
    $statement->closeCursor();
}
function delete_existing_appointment($db, $id, $serviceDate){
    $query = 'DELETE FROM `appointments` WHERE Service_ID = :id AND Service_Date = :date AND (NOW() + INTERVAL 48 HOUR) < Service_Date';
    $statement = $db->prepare($query);
    $statement->bindValue(':id', $id); 
    $statement->bindValue(':date', $serviceDate); 
    $statement->execute();    
    $statement->closeCursor();
}
function display_schedule($available){
    echo "<div id='schedule_div'>";
    echo "<form action='index.php' method='post'>";
        
    $key = array_keys($available);
    $value = array_values($available);

       if( empty($available)){
           echo "No Available Appointments";
       }
       else {  
           echo "You may also SELECT SERVICE DATE from the following available appointments";
           echo "<div id='schedule_table'>";
           echo "<table>";
           echo "<thead>";
           echo "<tr>";

           foreach ($available[0] as $key => $item) {
             echo "<th> {$key} </th>";
          }
           echo "</tr>"; 
           echo "</thead>";

          foreach ($available as $entry) { 
            echo "<tr>";
            foreach ($entry as $key => $item)  {  
              echo "<td><input type='radio' name='select_appointment' value=$item>{$item}</td>";
        
            }
            echo "</tr>";
          }
          echo "</table>";       
          echo "</div>";
          echo "<div id=schedule_controls>";
        echo "<input type='text' name='user_note' placeholder='Optional Note'>"; 
        echo "<input type='submit' name='set_appt_button' value='SET APPOINTMENT'>";       
        echo "</form>";
        echo "<div>";
         echo "</div>";

    }
}


function display_history($history){
    
        
    $key = array_keys($history);
    $value = array_values($history);  
    echo "<table>";
    echo "<thead>";
    echo "<tr>";

    foreach ($history[0] as $key => $item) {
        echo "<th> {$key} </th>";
    }
    echo "</tr>"; 
    echo "</thead>";

    foreach ($history as $entry) { 
        echo "<tr>";
        
        foreach ($entry as $key => $item)  {  
            echo "<td>{$item}</td>";              
        }
        echo "</tr>";
    }
    echo "</table>";       
 }
 
 //Displays the user's existing appointments for modifiying
 function display_existing_appointments($existing, $reason){
    echo "<form action='schedule.php' method='post'>";
        
    $key = array_keys($existing);
    $value = array_values($existing);

       if( empty($existing)){
           echo "No Available Appointments";
       }
       else {  
           
           echo "<table>";
           echo "<thead>";
           echo "<tr>";

           foreach ($existing[0] as $key => $item) {
             echo "<th> {$key} </th>";
          }
           echo "</tr>"; 
           echo "</thead>";

          foreach ($existing as $entry) { 
            echo "<tr>";            
              if ($reason == 'Modify'){
                echo "<td><input type='radio' name='modify_existing' value={$entry['Service_ID']}{$entry['Service_Date']}>{$entry['Service_ID']}   {$entry['Service_Date']}</td>";              
                echo "<td>{$entry['Notes']}</td>";
              }
              else{
                echo "<td><input type='radio' name='cancel_existing' value={$entry['Service_Date']}>{$entry['Service_Date']}{$entry['Notes']}</td>";    
              }
            echo "</tr>";
          }
          echo "</table>";              
        
        echo "<input type='submit' value='SELECT APPOINTMENT'>";
        echo "<input type='submit' name='reset' value='RESET'>";
        echo "</form>";
        }
}