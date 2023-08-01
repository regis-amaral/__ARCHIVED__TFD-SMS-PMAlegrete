<?php require_once('Connections/conSaude.php'); ?>
<?php

$pagina = $_POST['pagina'];
$pac = $_POST['pac'];
$idint = $_POST['idint'];
$login = $_POST['login'];
$senha = $_POST['senha']; 
//pesquisa e conecção ao banco
mysql_select_db($database_conSaude, $conSaude);
$query_recusuario = "SELECT id, nome FROM usuarios WHERE login = '$login' AND senha = '$senha'";
$recusuario = mysql_query($query_recusuario, $conSaude) or die(mysql_error());
$row_recusuario = mysql_fetch_assoc($recusuario);
$totalRows_recusuario = mysql_num_rows($recusuario);	
//		
if($totalRows_recusuario > 0)
	{$id 	= $row_recusuario["id"];				
	 $nome 	= $row_recusuario["nome"]; 

session_start();

$_SESSION["id"]		= $id;
$_SESSION["nome"]	= $nome;
$_SESSION["login"]	= $login; 
if ($pagina==true){$continua="$pagina?id=$pac&idint=$idint";}
else {$continua="busca.php";}
header("Location:".$continua);		
	}
else	
	{		
		
	echo "<b>Nenhum usuário foi encontrado com os dados informados...retornando...</b>";		
	echo "<meta http-equiv='refresh' content='3;URL=login.php'>";
	}
?>