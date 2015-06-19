<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->

<?php
require_once './classes/user.php';
require_once './classes/connection.php';
session_start();
if(isset($_POST['uname']) && isset($_POST['password'])) {

    $user = new user(connection::HOST, connection::USER, connection::DB, connection::PASSWORD);
    if (!$user->login($_POST['uname'], $_POST['password'])) {

        header('Location: ./index.php?error=1');
    }
        $_SESSION['user_id']=$user->user_id();
        header('Location: ./searcher.php');
        

} else {

    header('Location: ./index.php?error=2');
}
?>
