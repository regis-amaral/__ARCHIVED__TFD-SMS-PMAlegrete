<?php
//Inicia a sess�o
session_start();
//Elimina os dados da sess�o
session_unregister($_SESSION['id']);
session_unregister($_SESSION['nome']);
session_unregister($_SESSION['login']); 
//Encerra a sess�o
session_destroy();
header("Location:busca.php");
?>
