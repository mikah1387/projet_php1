<?php 
require 'functions.php'; 

require 'datapdo.php'; 

require 'header.php'; 

$post=$_POST;
$erreur = null;

if ($post){

   
    if(!empty($post['username'])&& !empty($post['password'])){
      
        $sql = "SELECT * from users where (user_name =:username or email=:username) and create_at is not null ";
        $requet = $pdo-> prepare($sql);
        $requet->execute(['username'=>$post['username']]);
        $result= $requet->fetch();

        if($result){
            $password_hach =$result['user_pass'] ;
           
            if( password_verify($post['password'],$password_hach) ){

                $_SESSION['auth']= $result;
                $_SESSION['flash']['success']= " Bien venu cher " . $_SESSION['auth']['user_name'];
         
       
                header('location: account.php');
                exit();

            }else{
                   $erreur = " votre Email ou Mot de passe est incorrect";
                  

            }
            
        }else{
            $erreur = " votre Email ou Mot de passe est incorrect";

        }
        

    }else{

        // $_SESSION['flash']['alert'] = 'votre mot de passe ou email est incorrecte';
        $erreur = " votre Email ou Mot de passe est incorrect";
    }
}

?>
<!-- (isset($_SESSION['flash']['alert'])) -->


<div class="erreur">





</div>

<?php if (isset($erreur)) :?>

    <div class="erreur">
    <?= $erreur?>
    <!-- <?= dump($post['password'])?>
    <?= dump($password_hach)?>
    <?= dump($result)?> -->
  
    

    </div>
    <?php endif?>
    
<div class="container">

<form action="" method="POST" >


<div>
    <label for="username">Username or email</label>
    <input type="text" id="username" name="username" placeholder="username">

</div>

<div>
    <label for="password">Password</label>
    <input type="password" id="password" name="password" placeholder="password">
    
   
</div>      

   
<div class="password_foget">

<a href="forget.php"> Mot de passe oublier </a>
</div>


<button type="submit"> Se connecter  </button>

</form>
</div>

<?php 
require 'footer.php'
?>