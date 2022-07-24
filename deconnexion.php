<?php 
if (!session_id()){
    session_start();

}
unset($_SESSION['auth']);
$_SESSION['flash']['success']= " vous etes bien déconnecter";

header('location:connexion.php');