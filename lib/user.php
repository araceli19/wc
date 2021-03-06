<?php
include_once('../api/db.include.php');

class RegUser {
    public static $name;
    public static $email;
    public function __construct(){

    }

   //function if the user exits
   public static function isUser($uname){
        //select statement for pulling user name
        $db = getDatabaseConnection();
        $sql = "SELECT username FROM registered_user WHERE username ='$uname'";
        $val = $db->prepare($sql);
        $val->execute();
        $shoop = $val->fetch();
        //echo $sql;
        //var_dump($shoop);
        if($uname == $shoop['username']){
            //echo "hit";
            return true;
        }
        else
        {
            return false;
        }
    }

    public static function insertUser($username,$password,$email,$firstname,$lastname,$age,$zipcode,$employment,$cert_body,$date, $imgUrl){
        $db = getDatabaseConnection();
       $sql= "INSERT INTO registered_user (username, password, email,firstname,lastname, age, zipcode, employment,cert_body,date_cert, img_url) VALUES
        ('$username','$password','$email','$firstname','$lastname','$age','$zipcode','$employment','$cert_body','$date', '$imgUrl')";
       $val = $db->prepare($sql);

       if($val->execute()){
            return true;
        }
        else{
            return false;
        }
    }

    public static function deleteUser($uname){
        $db = getDatabaseConnection();
        $sql = "DELETE FROM registered_user WHERE username ='$uname'";
        $val = $db->prepare($sql);
        if($val->execute()){
            return true;
        }
        else{
            return false;
        }
    }

    public static function updatePassword($newPassword,$currentUsername){
        $db = getDatabaseConnection();
        $sql = "UPDATE registered_user
  			SET password = '$newPassword'
  			WHERE username = '$currentUsername'";

  		  $val = $db->prepare($sql);
  	    if($val->execute()){
              return true;
          }
           else{
               return false;
          }
    }
    public static function updateEmail($newEmail,$currentUsername){
        $db = getDatabaseConnection();
        $sql = "UPDATE registered_user
        SET email = '$newEmail'
        WHERE username ='$currentUsername'";

        $val = $db->prepare($sql);
        if($val->execute()){
            return true;
        }
         else{
             return false;
        }
    }

    public static function updateZip($newZip,$currentUsername){
        $db = getDatabaseConnection();
        $newZipcode = intval($newZip);
        $sql = "UPDATE registered_user
			  SET zipcode = '$newZipcode'
			  WHERE username = '$currentUsername'";

        $val = $db->prepare($sql);

  	    if($val->execute()){
              return true;
          }
        return false;
    }

    public static function getPassword($username){
        $db = getDatabaseConnection();
        $sql = "SELECT password
        FROM registered_user
        WHERE username = '$username'";
        $val = $db->prepare($sql);
        $val->execute();
        $record = $val->fetch(PDO::FETCH_ASSOC);
        return $record['password'];
    }

    public static function emailExists($fbEmail){
        $db = getDatabaseConnection();
        $sql = "SELECT email,username FROM registered_user WHERE email ='$fbEmail'";
        $val = $db->prepare($sql);
        $val->execute();
        $shoop = $val->fetch();
        //can return a user name here
        if($fbEmail == $shoop['email']){
            $username = $shoop['username'];
            return $username;
        }
        else {
            return false;
        }
    }

}
?>
