<?php 
include_once('../includes/config.php');
session_start();
class User extends DbConnection{
    public $id;
    public $name;
    public $email;
    public $phone;
    public $password;
    public $v_code;
    public $photo;
    public $active;
    public $role;
    public function __construct(){
        parent::__construct();
        $this->name = '';
        $this->email = '';
        $this->phone = '';
        $this->password='';
        $this->v_code='';
        $this->photo='';
        $this->id='';
        $this->active='';
        $this->role='';
    }
   
   public function register(){
    
       $sql = "INSERT INTO `users`(`name`, `phone`, `email`, `password`, `verification_code`, `active`) 
       VALUES ('$this->name','$this->phone','$this->email','$this->password','$this->v_code','0')";
       $result = $this->connection->query($sql);
      return $result;
       
   }
   public function profileUpdate(){
    $sql = "UPDATE `users` SET `name`='$this->name',`phone`='$this->phone',`password`='$this->password',`image`='$this->photo' WHERE `email`='$this->email'";
    $result = $this->connection->query($sql);
   return $result;
   }
   
   public function emailExists(){
       echo $this->email;

    $user_exist_query = "SELECT * FROM `users` WHERE `email` = '$this->email'";
    $result = $this->connection->query($user_exist_query);
    if($result){
        if($result->num_rows > 0){
            return true;
        } else {
            return false;
        }
        
    }
   }
   public function setId($id){
    $this->id=$id;
   
}
   public function setEmail($email){
    $this->email=$email;
    }
    public function setName($name){
        $this->name=$name;
    }
    public function setPhoto($photo){
        $this->photo=$photo;
    }
    public function setPhone($phone){
        $this->phone=$phone;
    }
    public function setActive($active){
        $this->active=$active;
    }
    public function setRole($role){
        $this->role=$role;
    }
    public function setPassword($password){
        if(empty($password)){
            $this->password=$password;
        } else {
            $this->password=password_hash($password, PASSWORD_BCRYPT);
        }
        
    
    }
    public function setVcode($v_code){
        $this->v_code=$v_code;
    }
    public function validate(){
        $chkEmail=$this->validateEmail();
        $chkName=$this->validateName();
        $chkPhone=$this->validatePhone();
        $chkPass=$this->validatePassword();
        if($chkEmail && $chkName && $chkPass && $chkPhone){
             return true;
        }
        else{
            return false;
        }
    }
    public function validateEmail(){
        if (empty($this->email)) {
            
           $_SESSION['emailError']="Email is required";
           return false;
          } else {
            $_SESSION['email']=$this->email;
            // check if e-mail address is well-formed
            if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
               
              $_SESSION['emailError']="Invalid email format";
              return false;
            }
            return true;
          }
    }
    
    public function validateName(){
        if (empty($this->name)) {
            
            $_SESSION['nameError']="Name is required";
            return false;
          } else {
            
            $_SESSION['name']=$this->name;
            // check if name only contains letters and whitespace
            if (!preg_match("/^[a-zA-Z-' ]*$/",$this->name)) {
              $_SESSION['nameError']= "Only letters and white space allowed";
              return false;
            }
            return true;
          }
    }
    public function validatePhone(){
        if (empty($this->phone)){
          
           $_SESSION['errorPhone']="Please Enter phone";
           return false;
    }else {
           
            $_SESSION['phone']=$this->phone;
        if (!preg_match("/^[0-9]*$/", $this->phone)) {
            
          $_SESSION['errorPhone']="Please Enter Number(0-9)";
            return false;
        }
        return true;
    }
          
    }
    public function validatePassword() {
        if (empty($this->password)){
            $_SESSION['errorPassword']="Please Enter Password";
            return false;
           }else {
        return true;
    }
           
    }
   public function verifyPassword(){
    $user_exist_query = "SELECT * FROM `users` WHERE `email` = '$this->email'";
    $result = $this->connection->query($user_exist_query);
    if ($result->num_rows == 1){
        return $result -> fetch_assoc();
    }
 
}
    public function getAllUsers(){
    $user = "SELECT * FROM `users`";
    $result = $this->connection->query($user);
    
   return $result -> fetch_all(MYSQLI_ASSOC);

}
   public function deleteUser($id){
    $deluser = "DELETE FROM `users` WHERE `id`='$id'";
    $result = $this->connection->query($deluser);
    if($result)
    {
    return $result;
    } else {
        echo("Error description: " . $this->connection -> error);
    }
}
    public function editUser(){
    $user = "UPDATE `users` SET `name`='$this->name',
    `phone`='$this->phone',`email`='$this->email',`active`='$this->active',`role`='$this->role' WHERE `id`='$this->id'";
    $result = $this->connection->query($user);
    return $result;
}
public function setDefaultPermission($id,$json){
    $sql="INSERT INTO `permission`(`userid`, `permissions`) VALUES ('$id','$json')";
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
public function getPermissions(){
    $sql="SELECT * FROM `permission`";
     $result = $this->connection->query($sql);
     return $result -> fetch_all(MYSQLI_ASSOC);
}
public function setPermissions($json_arr){
    $sql="UPDATE `permission` SET `permissions`='$json_arr' WHERE `id`='$this->id'";
    $result = $this->connection->query($sql);
    return $result;
}
}
?>