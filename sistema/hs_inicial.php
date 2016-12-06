<?php
if(isset($_GET['msg'])){
     echo $_GET['msg'];
   }else{
      echo "<h1 align='center'>Bem vindo, ".$_SESSION['usuario']."!</h1>";
    }
?>
