<?php

if (!session_id()){
    session_start();

}
require 'functions.php';
require 'datapdo.php';
require 'header.php';


$get= $_GET;

$user_id = $get['id'];
$tokken = $get['tokken'];

$requet = $pdo-> prepare("SELECT * from users where id_user =? and reset_tokken =? and reset_at > DATE_SUB(NOW(), INTERVAL 30 MINUTE) ");
$requet-> execute([$user_id, $tokken ]);

$userfetch = $requet->fetch();

if ($userfetch ){
 
  $post = $_POST;
  if(!empty($post)){

        if ( !empty($post['password']) && $post['password']===$post['co_password']  ){
                  
            $password = password_hash($post['password'],PASSWORD_BCRYPT);
            $pdo-> prepare('UPDATE users set user_pass=? ,reset_tokken = null, reset_at = null where id_user = ?')-> execute([$password,$user_id]);
                  $_SESSION['auth']= $userfetch;

                  $_SESSION['flash']['auth']= 'votre mot de passe a bien été modifier';

                   header('location:account.php');
                   exit();
            
        }else{

            $erreur ="mot de passe incorrect ";
        }

  }

    
    



}else{

    $_SESSION['flash']['alert'] ="ce n'est pas le bon lien ";
    

 header('location:connexion.php');
 exit();



}
?>
<div class="erreur">
<?php if(isset($erreur)): ?>

    <?= $erreur?>
<?php endif?>
</div>
<div class="container">

<form action="" method="POST" >




<div>
    <label for="password">Password</label>
    <input type="password" id="password" name="password" placeholder="password">
    
   
</div>     
<div>
    <label for="password">confirm Password</label>
    <input type="password" id="co_password" name="co_password" placeholder="confirm_password">
    
   
</div>  



<button type="submit"> Change password  </button>

</form>
</div>

<?php 
require 'footer.php'
?>
