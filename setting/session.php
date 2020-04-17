<?php
session_start();
$_SESSION['status'] = "login";
if($status =="Y" and $_SESSION['status']!="login"){
 // header("location:$domain/pages/login");
    
}
?>
