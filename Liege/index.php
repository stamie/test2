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
        <title>Login</title>
    </head>
    <body>
        
        <h1>Login</h1>
        
        <form method="post" action="login.php" >
        <div class="login">
        <div class="form-group">
          <label for="usr">Name:</label>
          <input type="text" class="form-control" id="uname" name="uname">
        </div>
        <div class="form-group">
          <label for="pwd">Password:</label>
          <input type="password" class="form-control" id="password" name="password">
        </div>   
        <div class="form-group">
            <button type="submit" class="btn-succes" id="sm" >Login</button>
            
        </div>
        </div>
        </form>
        
        <?php 
            if (!empty($_GET['error'])) {
                
                echo '<p class="text-danger" >The username and/or the password are wrong!</p>';
                
            }
        
        ?>
        
        
    </body>
</html>
