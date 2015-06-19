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
        <script src="./js/ajax.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
        <?php
        require_once './classes/transaction.php';
        require_once './classes/connection.php';
        session_start();
        if (isset($_SESSION['user_id'])) {
            
        ?>
        <title>View transaction</title>
    </head>
    <body> 
        
        <h1>View transaction</h1>
        <?php
        
        if (!empty($_GET['id'])) {
            
            $trans= new transaction(connection::HOST, connection::USER, connection::DB, connection::PASSWORD);
            $row = $trans->search_id($_GET['id']);
            
            echo '<div class="col-sm-4"  id="view-edit">';
            
                        echo '<h3>Unique name: </h3><p id="sc">'.$row['name'].'</p>';
                        echo '<h3>Source client: </h3><p id="sc">'.$row['sclient'].'</p>';
                        echo '<h3>Target client: </h3><p id="tc">'.$row['tclient'].'</p>';
                        echo '<h3>Amount: </h3><p id="am">'.$row['amount'].' '.$row['currency'].'</p>';
                        echo '<h3>Succes: </h3>';
                        if ($row['succes']==1){
                            
                            echo '<p>yes</p>';
                        } else {
                            echo '<p>no</p>';
                        }
                        echo '<h3>Date: </h3><p id="date">'.$row['date'].'</p>';
                        echo '<h3>Comment: </h3><p id="com">'.$row['comment'].'</p>';
                        echo '<div class="form-group"><button type="button" class="btn btn-succes" onclick="tr_edit('.$row['id'].')" >Edit</button></div>';
            echo '</div>';
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
