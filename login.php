<?php
$username=$_POST['username'];
$password=$_POST['password'];
if($username=='admin'){
    if($password='admin'){
        header('Location:admin.html');
        exit;
    }
    else{echo 'Incorrect Password';}
}
else{echo 'Invalid User';}
?>