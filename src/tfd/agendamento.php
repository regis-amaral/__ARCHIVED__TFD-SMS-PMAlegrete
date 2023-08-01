<?php require_once('Connections/conSaude.php'); 
$paciente = $_GET[paciente];
$internacao = $_GET[internacao];
mysql_select_db($database_conSaude, $conSaude);
$query_recInternacao = "SELECT * FROM internacao WHERE idint = '$internacao'";
$recInternacao = mysql_query($query_recInternacao, $conSaude) or die(mysql_error());
$row_recInternacao = mysql_fetch_assoc($recInternacao);
$totalRows_recInternacao = mysql_num_rows($recInternacao);

$status = $row_recInternacao['istatus'];
if($row_recInternacao['origemconsulta']!=true){$status=NULL;}
else{$tipo=$row_recInternacao['origemconsulta'];};

switch($status){ case "Pendente": 
						echo "<script>alert('Movimentação com Status: Pendente. Altere o status para Imprimir o relatório desejado!'); close();</script>";     
						break;
              case "Aguardando Resposta" :
					    echo "<script>alert('Movimentação com Status: Aguardando Resposta. Altere o status para Imprimir o relatório desejado!'); close();</script>";  
						break;
			  case "Concluído": 
					   	echo "<meta http-equiv='refresh' content='0;URL=relagendamento.php?id=$paciente&internacao=$internacao&tipo=$tipo'>";
			   			break;
			  default: 		
			  			echo "<script>alert('Origem da Consulta não foi definida!'); close();</script>";
					   	echo "<meta http-equiv='refresh' content='0;URL=$redir'>";
			     	   	break;
			 }
?>

