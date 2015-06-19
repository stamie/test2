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
        require_once './classes/connection.php';
        session_start();
        if (isset($_SESSION['user_id'])) {
            
        ?>
        <title>Search transaction</title>
    </head>
    <body>
        
        
        
        <h1>Search transaction</h1>
        <div class="sm-4">
        
            <form class="form-inline" role="form" action="searcher.php" method="post">
                <div class="form-group">
                <label for="src"><span class="glyphicon glyphicon-search"></span></label>
                <input id="src" name="src" type="text" class="form-control">
                <label for="am">Amount:</label>
                <input id="am" name="am" type="number" class="form-control">
                <label for="cur">Currency:</label>
                <select id="cur" name="cur" class="form-control">
                        <option value="0">---</option>
                        <option value="EUR">EUR</option>
                        <option value="GBP">GBP</option>
                        <option value="HUF">HUF</option>
                        <option value="USD">USD</option>
                        
                </select>
                <label for="suc">Succes:</label>
                <select id="suc" name="suc" class="form-control">
                        <option value="0">---</option>
                        <option value="1">not succes</option>
                        <option value="2"> succes</option>
                </select>
                <label for="dat">Date</label>
                <input id="dat" name="dat" type="datetime">
                <button id="src2" type="submit" class="btn-succes">Search</button>
                </div>
            </form>
        </div>
        
    </body>
    
    <table class="table">
        
        <thead>
            <tr>
                <th>Unique name</th>
                <th>Succes</th>
                <th>Source client</th>
                <th>Target client</th>
                <th>Amount</th>
                <th>Currency</th>
                <th>Date</th>
                <th>Comment</th>
                <th>View</th>
                <th>Edit</th>
            </tr>
            
        </thead>
        <tbody>
    <?php 
    
            if (isset($_POST['src'])){
                
                $trans = new transaction(connection::HOST, connection::USER, connection::DB, connection::PASSWORD);
               
                               
                $res = $trans->search($_POST['src'],$_POST['am'],$_POST['suc'],$_POST['dat'],$_POST['cur']);
                
                foreach ($res as $row) {
                    echo '<tr>';
                        echo '<td>'.$row['name'].'</td>';
                        if ($row["succes"]==1) {
                            echo '<td>True</td>';
                        } else {
                            echo '<td>False</td>';
                        }
                        echo '<td>'.$row['sclient'].'</td>';
                        echo '<td>'.$row['tclient'].'</td>';
                        echo '<td>'.$row['amount'].'</td>';
                        echo '<td>'.$row['currency'].'</td>';
                        echo '<td>'.$row['date'].'</td>';
                        echo '<td>'.$row['comment'].'</td>';
                        echo '<td><a href="./view.php?id='.$row['id'].'">View</a></td>';
                        echo '<td><a href="./edit.php?id='.$row['id'].'">Edit</a></td>';
                        
                        
                    
                    echo '</tr>'; 
                }
                
                
            }
        ?>
        </tbody>
    </table>
    <?php
    } else {
    
            header('Location: ./error404.html');
   
        }
    ?>
</html>
