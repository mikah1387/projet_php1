<?php 
if (!session_id()){
    session_start();

}
require 'functions.php';
require 'datapdo.php';


$get= $_GET;

$user_id = $get['id'];
$tokken = $get['token'];


$sql = "SELECT * from users where id_user =?";

$requet = $pdo-> prepare($sql);
$requet-> execute([$user_id ]);

$userfetch = $requet->fetch();

if ($userfetch && $userfetch['confirm_tokken']==$tokken ){

   $sql = "UPDATE users set confirm_tokken = null, create_at= NOW() where id_user =? ";
   $requet = $pdo->prepare($sql);
   $requet->execute([$user_id]);

   $_SESSION['auth']= $userfetch;

    $_SESSION['flash']['auth']= 'votre compte a bien été  creer';

   header('location:account.php');


}else{

    $_SESSION['flash']['alert'] ="ce n'est pas le bon lien ";

 header('location:connexion.php');


}






