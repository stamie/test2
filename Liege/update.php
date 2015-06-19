<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once './classes/transaction.php';
//require_once './classes/client.php';
require_once './classes/connection.php';

session_start();
if(isset($_SESSION['user_id'])) {
    
    if (isset($_GET['id'])) {
        
        $transaction = new transaction(connection::HOST, connection::USER, connection::DB, connection::PASSWORD);
        $res = $transaction->update($_GET['id'], $_POST['name'], $_POST['succes'], $_POST['sclient'], $_POST['tclient'], $_POST['amount'], $_POST['currency'], $_POST['date'], $_POST['comment']);
//        print_r('Ez van'.$res);
//        die();
        if (!$res) {
            
            header('Location: ./edit.php?id='.$_GET['id'].'&error=1');
            
        } else {
            header('Location: ./view.php?id='.$_GET['id']);
        }
        
        
    } else {
    
        header('Location: ./error404.html');
    }

} else {
    
    header('Location: ./error404.html');
}




