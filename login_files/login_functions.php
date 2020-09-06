
  <?php 
    
    function verify_login($db, $username, $password)
    {
      $query = "SELECT Password FROM customers WHERE Email = :username";
      $statement = $db->prepare($query);
      $statement->bindValue(':username', $username);
      $statement->execute();
      $result = $statement->fetch();
      $statement->closeCursor();
      $hash = $result['Password'];
      return password_verify($password, $hash);
    }
    
    function existing_username($db, $username)
    {
      $query = "SELECT COUNT(Email) FROM customers WHERE Email = :username";
      $statement = $db->prepare($query);
      $statement->bindValue(':username', $username);
      $statement->execute();
      $exists = $statement->fetch();
      $statement->closeCursor();
      return $exists[0] == 1;
    }

    function addUser($db, $username, $password, $lname, $fname, $address, $city, $state, $zip, $phone) {
      $query = "INSERT INTO customers (Email, Password, Last_Name, First_Name, Address, City, State, Zip, Phone)
                VALUES (:Email, :Password, :Last_Name, :First_Name, :Address, :City, :State, :Zip, :Phone)";
      $statement = $db->prepare($query);
      $statement->bindValue(':Email', $username);            
      $statement->bindValue(':Password', $password);
      $statement->bindValue(':Last_Name', $lname);
      $statement->bindValue(':First_Name', $fname);
      $statement->bindValue(':Address', $address);
      $statement->bindValue(':City', $city);
      $statement->bindValue(':State', $state);
      $statement->bindValue(':Zip', $zip);
      $statement->bindValue(':Phone', $phone);      
      $success = $statement->execute();
      $statement->closeCursor();     
      return $success;
    }
    
     
    function validPassword($password){
      $valid_pattern = '/(?=^.{8,}$)(?=.*\d)(?=.*[A-Z])(?=.*[a-z]).*$/';
      if (preg_match($valid_pattern, $password))
        return true;
      else
        return false;
    }

?>
