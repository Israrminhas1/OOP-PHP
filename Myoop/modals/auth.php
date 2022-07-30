<?php
 require('../classes/user.php');
 require('../classes/myauth.php');
 
 use PHPMailer\PHPMailer\PHPMailer;
 use PHPMailer\PHPMailer\SMTP;
 use PHPMailer\PHPMailer\Exception;

function sendMail($email, $v_code)
{ echo $v_code;
     require '../PHPMailer/PHPMailer.php';
     require '../PHPMailer/SMTP.php';
     require '../PHPMailer/Exception.php';
     

$yahoo_mail = new PHPMailer;

$yahoo_mail->IsSMTP();
// Send email using Yahoo SMTP server
$yahoo_mail->Host = 'smtp.mail.yahoo.com';
// port for Send email
$yahoo_mail->Port = 465;
$yahoo_mail->SMTPSecure = 'ssl';
$yahoo_mail->SMTPDebug = 1;
$yahoo_mail->SMTPAuth = true;
$yahoo_mail->Username = 'minhasisrar@yahoo.com';
$yahoo_mail->Password = 'cdaatexibzxcufgl';

$yahoo_mail->From = 'minhasisrar@yahoo.com';
$yahoo_mail->FromName = 'Israr';// frome name

$yahoo_mail->AddAddress($email);  // Name is optional

$yahoo_mail->IsHTML(true); // Set email format to HTML

$yahoo_mail->Subject = 'Email Verification for Israr Login-System';
$yahoo_mail->Body     = "Thanks for registrations
Click the Link below to verify the email address
<a href='http://localhost/Myoop/modals/verify.php?v_code=$v_code'>Verify</a>'
";


if(!$yahoo_mail->Send()) {
echo 'Message could not be sent.';
echo 'Mailer Error: ' . $yahoo_mail->ErrorInfo;
exit;
}
else
{
return true;
}
}
function forgetMail($email)
{
    require '../PHPMailer/PHPMailer.php';
    require '../PHPMailer/SMTP.php';
    require '../PHPMailer/Exception.php';
    

$yahoo_mail = new PHPMailer;

$yahoo_mail->IsSMTP();
// Send email using Yahoo SMTP server
$yahoo_mail->Host = 'smtp.mail.yahoo.com';
// port for Send email
$yahoo_mail->Port = 465;
$yahoo_mail->SMTPSecure = 'ssl';
$yahoo_mail->SMTPDebug = 1;
$yahoo_mail->SMTPAuth = true;
$yahoo_mail->Username = 'minhasisrar@yahoo.com';
$yahoo_mail->Password = 'cdaatexibzxcufgl';

$yahoo_mail->From = 'minhasisrar@yahoo.com';
$yahoo_mail->FromName = 'Israr';// frome name

$yahoo_mail->AddAddress($email);  // Name is optional

$yahoo_mail->IsHTML(true); // Set email format to HTML

$yahoo_mail->Subject = 'Reset password link for Israr Login-System';
$yahoo_mail->Body     = "
Click the Link below to reset the password
<a href='http://localhost/Myoop/views/resetpass.php?email=$email'>Verify</a>'
";


if(!$yahoo_mail->Send()) {
echo 'Message could not be sent.';
echo 'Mailer Error: ' . $yahoo_mail->ErrorInfo;
exit;
}
else
{
return true;
}
}
#Registration
if (isset($_POST['register'])) {
    
    $email=test_input($_POST["email"]);
    $name=test_input($_POST["name"]);
    $phone=test_input($_POST["phone"]);
    $password=$_POST["password"];
    $v_code = bin2hex(random_bytes(16));
    $userdata=new User();
    
    $userdata -> setName($name);
    $userdata -> setEmail($email);
    $userdata -> setPhone($phone);
   $userdata -> setPassword($password);
    
    
    $userdata -> setVcode($v_code);
    if( !$userdata -> validate() ){
        header("location:../views/regform.php");
    }
    else { if (!$userdata->emailExists()){
        // $v_code=$userdata -> getVcode();
         $result = $userdata->register();
         
         if ($result && sendMail($email,$v_code) 
         ) {$id_fetch=$userdata->getUserId();
            $json= '{"EditBlog": "0", "CreateBlog": "0", "DeleteBlog": "0"}';
            $setPermission = $userdata->setDefaultPermission($id_fetch['id'],$json);
             
            header("location:../views/regform.php?status=success&code=123");
            session_unset();
         } else { 
             header("location:../views/regform.php?status=danger&code=124");
         }
     } else {
         
         header("location:../views/regform.php?status=warning&code=126");
     }
       
    }
    
    
}
#Login
if (isset($_POST['login'])){
echo "me working";
$email=test_input($_POST["email"]);
$password=$_POST["password"];
$userlogin=new Auth();
$userlogin -> setEmail($email);
$userlogin -> setPassword($password);
if( !$userlogin -> validate() ){
    header("location:../views/loginform.php");
}
else { $result_fetch= $userlogin->login();

    if($result_fetch){
        if ($result_fetch['active'] == 1){
            if($userlogin -> checkPassword($result_fetch['password'])){
                if($result_fetch['role']=='a') {
                    $_SESSION['logged_in'] = $result_fetch['role'];
                    $_SESSION['userid'] = $result_fetch['id'];
                    $_SESSION['username'] = $result_fetch['name'];
                    $_SESSION['userphone'] = $result_fetch['phone'];
                    $_SESSION['emailuser'] = $result_fetch['email'];
                    $_SESSION['profileimage'] = $result_fetch['image'];
                    header("location:../views/loginform.php?status=success&code=130");
                }
                else{
                    $id_fetch=$userlogin->getUserId();
                    $getUserPermissions= $userlogin->getPermissions($id_fetch['id']);
                    $the_json = json_decode($getUserPermissions['permissions'], true);

                    $_SESSION['permissions']=$the_json;
                    $_SESSION['logged_in'] = $result_fetch['role'];
                    $_SESSION['loginid'] = $result_fetch['id'];
                    $_SESSION['username'] = $result_fetch['name'];
                    $_SESSION['userphone'] = $result_fetch['phone'];
                    $_SESSION['emailuser'] = $result_fetch['email'];
                    $_SESSION['profileimage'] = $result_fetch['image'];
                    header("location:../views/loginform.php?status=success&code=130");
                }
               
            } else {
                header("location:../views/loginform.php?status=danger&code=129");
            }
        } else {
            header("location:../views/loginform.php?status=danger&code=128");
        }
        
    } else {
        header("location:../views/loginform.php?status=danger&code=127");
    }}

}
#My Forgetpass
if (isset($_POST['forgetpass'])) {
    $email=test_input($_POST["email"]);
    $userforget=new Auth();
    $userforget->setEmail($email);
   if(!$userforget->validateEmail()) {
    header("location:../views/forgetpass.php");
   } else {
    $result_fetch=$userforget->emailExists();
    if ($result_fetch)
    {
        if ($result_fetch['email'] == $email && forgetMail($email)) { #email is registered
            header("location:../index.php?status=success&code=134");
            unset($_SESSION["useremail"]);
    } else {
        header("location:../views/forgetpass.php?status=warning&code=124");
    }
} else {
    header("location:../views/forgetpass.php?status=warning&code=127");
}
   }
    
    
}
if (isset($_POST['resetpass']))
{  $email=test_input($_SESSION['resetemail']);
    $userreset=new Auth();
    $userreset->setEmail($email);
    $result_fetch=$userreset->emailExists();
    if ($result_fetch)
    { if (
        $_POST['newpassword']==$_POST["password"]
      ){
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
        $update= $userreset->addNewPass($password);
        if($update) {
            header("location:../index.php?status=primary&code=136");
            unset($_SESSION["resetemail"]);
        }
        else {
            header("location:../index.php?status=danger&code=125");
        }
       // $update = "UPDATE `registered` SET `password` = '$password' WHERE `email` = '$result_fetch[email]'";
      } else {
        header("location:../views/resetpass.php?status=danger&code=137");
      }

    } else {
        header("location:../views/resetpass.php?status=warning&code=127");
    }
}


?>