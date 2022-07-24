<?php 
require 'functions.php'; 

require 'datapdo.php'; 

require 'header.php';

$post= $_POST;

$user_id = $_SESSION['auth']['id_user'];
if(($post)){
    if (isset($post['password']) && (empty($post['password']))){

        $erreur['password']=  'remplissez les champs';
    } elseif ( $post['password'] !==$post['co_password'] ) 
    {
    
        $erreur['password']=  'les mots de passe ne sont pas identique';
    }
  
     if(empty($erreur)) {
      

    //  $password = password_hash($post['password'],PASSWORD_BCRYPT ); 
    $password = password_hash($post['password'],PASSWORD_BCRYPT );
     
     $requet= $pdo->prepare( "UPDATE users set user_pass=?  where id_user =?");
     $requet-> execute([ $password,
                        $user_id]);
     $result = $requet->fetch();

     
        $_SESSION['flash']['success']= 'votre mot de pass est modifier';
        header('location:account.php');
       
     }
    
}



?>

<div>
   
</div>

<div class="container">

<form action="" method="POST" >


<div>
    <label for="password">New Password</label>
    <input type="password" id="password" name="password" placeholder="password">
    <div class="erreur">
    <?php if (isset($erreur['password'])):?>

        <?= $erreur['password']?>
        <?php endif;?>
        </div>
   
</div>  

<div>
    <label for="password">Confirm Password</label>
    <input type="password" id="co_password" name="co_password" placeholder="password">
    <div class="erreur">
   
</div>      


<button type="submit"> Modify </button>

</form>
</div>


<?php 
require 'footer.php'
?>