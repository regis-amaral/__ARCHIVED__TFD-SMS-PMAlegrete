<?php
// Recebemos os dados digitados pelo usuário
$pagina = $_POST['pagina'];
$pac = $_POST['pac'];
$idint = $_POST['idint'];
$login = $_POST['login'];
$senha = $_POST['senha']; 
//Estabelecemos uma conexão com o banco de dados
//mysql_connect("Nome ou IP do servidor", "Usuario", "Senha");
$conn = mysql_connect("localhost", "root", "") or die("Impossivel conectar");
//caso a conexão seja estabelecida corretamente seleciona o banco de dados a ser usado 
if($conn)
	{
			mysql_select_db("saude", $conn);
	} 
//Criamos o comando que efetua a busca do banco	
	$sql = "SELECT id, nome FROM usuarios WHERE login = '$login' AND senha = '$senha'";
			//Executamos o comando
			$rs = mysql_query($sql, $conn);
			//Retornamos o numero de linhas afetadas		
			$num = mysql_num_rows($rs);		
			//Verificams se alguma linha foi afetada, caso sim retornamos suas informações		
			if($num > 0)
					{			
					//Retorna os dados do banco			
					$rst = mysql_fetch_array($rs);				
						$id 	= $rst["id"];				
						$nome 	= $rst["nome"]; 
//Inicia a sessão
session_start();
//Registra os dados do usuário na sessão
$_SESSION["id"]		= $id;
$_SESSION["nome"]	= $nome;
$_SESSION["login"]	= $login; 
	//Encerra a conexão com o banco				
		mysql_close($conn);				
	//Redireciona para o index
		header("Location:$pagina?id=$pac&idint=$idint");		
	}
else	
	{		
	//Encerra a conexão com o banco
	mysql_close($conn);		
	//Caso nenhuma linha seja retornada emite o alerta e retorna		
	echo "<b>Nenhum usuário foi encontrado com os dados informados...retornando...</b>";		
	echo "<meta http-equiv='refresh' content='3;URL=login.php'>";
	}
?>
