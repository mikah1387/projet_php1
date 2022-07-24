<?php 


require 'functions.php';
require 'header.php';

require 'datapdo.php';

$post = $_POST;
$erreur = [];

if ( isset($post['username'])&& (empty($post['username']) ||!preg_match('/^[a-z0-9A-Z_]+$/',$post['username']) )  ){

    $erreur['username']=  'Entrez votre pseudo correctement';
}elseif ($post){

    $sql = "SELECT * from users where user_name =?";
    $rqt = $pdo->prepare($sql);
    $rqt->execute([$post['username']]);
    $result= $rqt->fetch();

    if($result){

        $erreur['username']= 'Ce psuedo existe déjas';
    }
}

if (isset($post['lastname']) && (empty($post['lastname']) ||!preg_match('/^[a-zA-Z_]+$/',$post['lastname']) ) )
{

    $erreur['lastname']=  'Entrez votre nom correctement';
}

if (isset($post['email']) && (empty($post['email']) ||!filter_var($post['email'], FILTER_VALIDATE_EMAIL) ) )
{

    $erreur['email']=  'Entrez votre email correctement';
}elseif($post){

    $sql = "SELECT * from users where email =?";
    $rqt = $pdo->prepare($sql);
    $rqt->execute([$post['email']]);
    $result= $rqt->fetch();

    if($result){

        $erreur['email']= 'Cet email existe déjas';
    }
}

if (isset($post['password']) && (empty($post['password']) || ( $post['password'] !==$post['c_password'] ) ) )
{

    $erreur['password']=  'Entrez votre passeword correctement';
}

if (isset($post)&& !empty($post)&& empty($erreur)){

    $password = password_hash($post['password'],PASSWORD_BCRYPT );
    $tokken = tokken(60);
    

   $sql = "INSERT INTO users  set user_name=? , last_name =? , email= ?, user_pass=?, 
   =? ";
   $requet = $pdo->prepare($sql);
   $requet->execute(
                    [ 
                    $post['username'],
                    $post['lastname'],
                    $post['email'],
                    $password,
                    $tokken
                    
                    ]

                      );
                      $user_id = $pdo->lastInsertId();
         
                      mail($post['email'], 'confirmation de votre compte',"pour valider votre compte cliquer sur ce lien\n\nhttp://localhost/php6/confirmer.php?id=$user_id&token=$tokken");

                      $_SESSION['flash']['success'] = 'un mail de confirmation vous a été envoyer, verifiez votre boite mail';

                    //   die( 'message envoyer');

                      header('location:connexion.php');


}



?>








 <div class="container">

    <form action="" method="POST" >


        <div>
         <label for="username">Username</label>
         <input type="text" id="username" name="username" placeholder="username">
             <div  class="erreur" >
                 <?php if (isset($erreur['username']) ):?>

                      <?= $erreur['username']?>
                 <?php endif;?>

             </div>
        </div>


<div>
    <label for="lastname">Lastname</label>
    <input type="text" id="lastname" name="lastname" placeholder="lastname">
    <div class="erreur">
        <?php if (isset($erreur['lastname'])):?>

        <?= $erreur['lastname']?>
         <?php endif;?>
     </div>

</div>


<div>
    <label for="email">Email</label>
    <input type="email" id="email" name="email" placeholder="Email">
       <div class="erreur">
     <?php if (isset($erreur['email'])):?>

         <?= $erreur['email']?>
        <?php endif;?>
        </div>
</div>
<div>
    <label for="password">Password</label>
    <input type="password" id="password" name="password" placeholder="password">
    <div class="erreur">
    <?php if (isset($erreur['password'])):?>

        <?= $erreur['password']?>
        <?php endif;?>
        </div>
</div>      
<div>
    <label for="c_password">Confirm Password</label>
    <input type="password" id="c_password" name="c_password" placeholder="password">
    <div class="erreur">
    <?php if (isset($erreur['password'])):?>

        <?= $erreur['password']?>
        <?php endif;?>
        </div>
</div>

<button type="submit"> S'inscrire  </button>

</form>
</div>

<?php 
require 'footer.php'
?>
