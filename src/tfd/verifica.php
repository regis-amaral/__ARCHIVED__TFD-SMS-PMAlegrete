<?php

	//Inicia a sess�o
		session_start();
 	//Verifica se h� dados ativos na sess�o
		if(empty($_SESSION["id"]) || empty($_SESSION["nome"]) || empty($_SESSION["login"]))	
		{
	//Caso n�o exista dados registrados, exige login		
		header("Location:login.php?pagina=$pagina&id=$id&idint=$idint");
	}
?>