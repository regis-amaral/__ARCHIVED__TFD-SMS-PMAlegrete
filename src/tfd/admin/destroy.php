<?php
//Inicia a sessão
session_start();
//Elimina os dados da sessão
session_unregister($_SESSION['id']);
session_unregister($_SESSION['nome']);
session_unregister($_SESSION['login']); 
//Encerra a sessão
session_destroy();
header("Location:Busca.php");
?>