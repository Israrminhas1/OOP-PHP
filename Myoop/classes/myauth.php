<?php 
include_once('../includes/config.php');

class Auth extends DbConnection{
    public $email;
    public $password;
    
    public function __construct(){

        parent::__construct();
        $this->email = '';
        $this->password = '';
        
    }
    public function Login(){
    $sql = "SELECT * FROM `users` WHERE `email` = '$this->email'";
    $result = $this->connection->query($sql);
    if ($result->num_rows == 1){
        return $result -> fetch_assoc();
    }

      
    }
    public function  checkPassword($password){
        $value = password_verify($this->password, $password);
        return $value;
    }

    public function setEmail($email){
        $this->email=$email;
        }
    public function setPassword($password){
        $this->password=$password;
        }
        
    public function verify($v_code){
        $sql = "SELECT * FROM `users` WHERE `verification_code` = '$_GET[v_code]'";
        $result = $this->connection->query($sql);
        if ($result->num_rows == 1){
            return $result -> fetch_assoc();
        }
    }
    public function update($email){
        $sql = "UPDATE `users` SET `active` = '1' WHERE `email` = '$email'";;
        $result = $this->connection->query($sql);
        return $result;
    }
    public function validate(){
        $chkEmail=$this->validateEmail();
        
        $chkPass=$this->validatePassword();
        if($chkEmail && $chkPass ){
            return true;
        }
        else{
            return false;
        }
    }
    public function validateEmail(){
        if (empty($this->email)) {
            
        $_SESSION['errorEmail']="Email is required";
        return false;
        } else {
            $_SESSION['useremail']=$this->email;
            // check if e-mail address is well-formed
            if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            
            $_SESSION['errorEmail']="Invalid email format";
            return false;
            }
            return true;
        }
    }

    public function validatePassword() {
        if (empty($this->password)){
            $_SESSION['errorPass']="Please Enter Password";
            return false;
        }else {
        return true;
    }
        
    }
    public function emailExists(){
        echo $this->email;

    $user_exist_query = "SELECT * FROM `users` WHERE `email` = '$this->email'";
    $result = $this->connection->query($user_exist_query);
    if($result){
        if($result->num_rows > 0){
            return $result -> fetch_assoc();
        } else {
            return false;
        }
        
    }
    }
    public function addNewPass($password)
    {
        $sql = "UPDATE `users` SET `password` = '$password' WHERE `email` = '$this->email'";
        $result = $this->connection->query($sql);
        return $result;
    }
    public function getUserId(){
        $sql="SELECT `id` FROM `users` WHERE `email`='$this->email'";
        $result = $this->connection->query($sql);
        if ($result->num_rows == 1){
            return $result -> fetch_assoc();
        }
    }
    public function getPermissions($id){
        $sql="SELECT `permissions` FROM `permission` WHERE `userid`=$id ";
        $result = $this->connection->query($sql);
        if ($result->num_rows == 1){
            return $result -> fetch_assoc();
        }
    }
}


?>