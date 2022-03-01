<?php 

 require("./functions.php");

 if(athenticated()){
     redirect('panel.php');
 }

if($_SERVER["REQUEST_METHOD"] == 'POST' and isset($_POST['email'])  and isset($_POST['password'])){
      $errors = [];
     $email = $_POST['email'];
     $password = $_POST['password'];

     $errors = validate($email,$password);

     if(! count($errors)){

        $users = get_data('user');
        $check_login = login($users,$email,$password);
   
        if($check_login){
              $_SESSION['user'] = $check_login;
              redirect("panel.php");
        }else{
              $errors[] = "کاربر یافت نشد ";
   
        }
   
     }

    
}


?>



<html>
    <head>
        <meta charset="UTF-8">
        <title>Login to system</title>

        <link rel="stylesheet" href="<?= assets('CSS/style.css') ?>">
        <link rel="stylesheet" href="<?= assets('CSS/panel.css') ?>">
    </head>
    <body>
        <main>
        <?php require('./parts/header.php') ?>
           <?php require('./parts/navar.php') ?>
            <form   method='post'  style="margin-right: 400px;">
                <div class='login'>
                    <h3>Login to system</h3>  
                    <?php if (isset($errors)   and   count($errors)): ?>                 
                        <div class="errors">                              
                            <ul>                  
                               <?php foreach($errors as $error): ?>              
                                    <li><?= $error ?></li>  
                                <?php endforeach ?>                             
                            </ul>                            
                        </div>  
                    <?php endif ?>              
                    <div>
                        <label for="email">Email:</label>
                        <input type="text" id="email" name="email" value="<?= isset($email)? $email : '' ?>">
                    </div>
                    <div>
                        <label for="password">Password:</label>
                        <input type="password" id="password" name="password">
                    </div>
                    <div>
                        <input type="submit" value="Login">
                    </div>
                </div>
            </form>
       
        </main>
    </body>
</html> 