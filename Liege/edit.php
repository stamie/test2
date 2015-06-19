<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet">
        <link href="./css/style.css" rel="stylesheet">
        <script src="./js/jquery.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
        <?php
        require_once './classes/transaction.php';
        require_once './classes/client.php';
        require_once './classes/connection.php';
        session_start();
        if (isset($_SESSION['user_id'])) {
            
            if (!empty($_GET['id'])) {
            
                $trans= new transaction(connection::HOST, connection::USER, connection::DB, connection::PASSWORD);
                $row = $trans->search_id($_GET['id']);
            
        ?>
        <title>Edit transaction</title>
               
      </head>
    <body>  
        <div class="col-sm-4">
        <h1>Edit transaction</h1>
        
        <?php 
        if (isset($_GET['error']) && $_GET['error']==1) {
            
            echo '<p class="text-danger">The save is error!<p>';
        }
        ?>
        <div class="edit">
        <form class="form-group" role="form" action="update.php?id=<?php echo $_GET['id']; ?>" method="post">
                <div class="form-group">
                <label for="name">Unique name:</label>
                <input id="name" name="name" type="text" class="form-control" value="<?php echo $row['name']; ?>">
                <label for="sclient">Source client:</label>
                <select id="sclient" name="sclient" class="form-control">
                    <?php
                    
                        $client = new client(connection::HOST, connection::USER, connection::DB, connection::PASSWORD);
                        $res = $client->searcher();
                        
                        foreach ($res as $value) {
                            $str ='';
                            if ($value['id']==$row['sid']) {
                                $str = ' selected ';
                            }
                            echo '<option value="'.$value['id'].'"'.$str.'>'.$value['name'].'</option>';
                        }
                    ?>
                </select>
                <label for="tclient">Target client:</label>
                
                <select id="tclient" name="tclient" class="form-control">
                    <?php

                        foreach ($res as $value) {
                            $str ='';
                            if ($value['id']==$row['tid']) {
                                $str = ' selected ';
                            }
                            echo '<option value="'.$value['id'].'"'.$str.'>'.$value['name'].'</option>';
                        }
                    ?>
                </select>
                <label for="amount">Amount:</label>
                <input id="amount" name="amount" type="number" class="form-control" value="<?php echo $row['amount']; ?>">
                <label for="currency">Currency:</label>
                <select id="currency" name="currency" class="form-control">
                        <option value="EUR" <?php if ($row['currency']=='EUR') echo 'selected'; ?>>EUR</option>
                        <option value="GBP" <?php if ($row['currency']=='GBP') echo 'selected'; ?>>GBP</option>
                        <option value="HUF" <?php if ($row['currency']=='HUF') echo 'selected'; ?>>HUF</option>
                        <option value="USD" <?php if ($row['currency']=='USD') echo 'selected'; ?>>USD</option>
                        
                </select>
                <label for="succes">Succes:</label>
                <select id="succes" name="succes" class="form-control">
                        <option value="1" <?php if ($row['succes']==0) echo 'selected'; ?>>not succes</option>
                        <option value="2" <?php if ($row['succes']==1) echo 'selected'; ?>> succes</option>
                </select>
                <label for="dat">Date</label>
                <input id="date" name="date" type="datetime" class="form-control" value="<?php echo $row['date']; ?>">
                <label for="comment">Comment:</label>
                <textarea id="comment" name="comment"  class="form-control"><?php echo $row['comment']; ?></textarea>
                <button id="edit" type="submit" class="btn-succes">Edit</button>
                </div>
            </form>
        </div>
        </div>
      <?php
            } else {
    
            header('Location: ./error404.html');
   
            }
        ?>
    </body>
    <?php
    } else {
    
            header('Location: ./error404.html');
   
        }
    ?>
</html>
