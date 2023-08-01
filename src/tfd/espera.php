<?php require_once('Connections/conSaude.php'); ?>
<?php
mysql_select_db($database_conSaude, $conSaude);
$query_recColocacao = "SELECT idint, idpac, istatus, especialidade, edia, emes, eano
FROM internacao
WHERE istatus = 'pendente'
ORDER BY 'eano', 'emes', 'edia', 'idint'";
$recColocacao = mysql_query($query_recColocacao, $conSaude) or die(mysql_error());
$row_recColocacao = mysql_fetch_assoc($recColocacao);
$totalRows_recColocacao = mysql_num_rows($recColocacao);

?>
<html>
<head>
<title>Documento sem t&iacute;tulo</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>

<body>

<table width="977" border="0" cellpadding="0" cellspacing="0">
  <!--DWLayoutTable-->
  <tr> 
    <td width="66" height="19" valign="top">Coloca&ccedil;&atilde;o</td>
    <td width="58" valign="top">ID</td>
    <td width="234" valign="top">Nome</td>
    <td width="222" valign="top">Especialidade</td>
    <td width="29" valign="top">Dia</td>
    <td width="34" valign="top">Mês</td>
    <td width="36" valign="top">Ano</td>
    <td width="298">&nbsp;</td>
  </tr>
  <tr> 
    <td height="55" colspan="8" valign="top"> 
      <?php 
	$row = mysql_num_rows($recColocacao); 
	$inicio = 0;
    $fim = $row;
	for ($i=$inicio; $i<$fim; $i++){?>
      <table width="977" border="0" cellpadding="0" cellspacing="0">
        <!--DWLayoutTable-->
        <tr> 
          <td width="66" height="19" valign="top"><?php echo $i+1;?></td>
          <td width="58" valign="top"> 
            <?php $idpac=mysql_result($recColocacao, $i, "idint"); echo $idpac; ?>
          </td>
          <td width="234" valign="top"> 
            <?php $idpac=mysql_result($recColocacao, $i, "idpac");
			$query_recPaciente = "SELECT * FROM paciente WHERE idp=$idpac";
			$recPaciente = mysql_query($query_recPaciente, $conSaude) or die(mysql_error());
			$row_recPaciente = mysql_fetch_assoc($recPaciente);
			$totalRows_recPaciente = mysql_num_rows($recPaciente);
			echo $row_recPaciente[pnome];
			?>
          </td>
          <td width="222" valign="top"> 
            <?php $idpac=mysql_result($recColocacao, $i, "especialidade"); echo $idpac; ?>
          </td>
          <td width="29" valign="top"> 
            <?php $idpac=mysql_result($recColocacao, $i, "edia"); echo $idpac; ?>
          </td>
          <td width="35" valign="top"> 
            <?php $idpac=mysql_result($recColocacao, $i, "emes"); echo $idpac; ?>
          </td>
          <td width="37" valign="top"> 
            <?php $idpac=mysql_result($recColocacao, $i, "eano"); echo $idpac; ?>
          </td>
          <td width="296">&nbsp;</td>
        </tr>
      </table>
      <?php }?>
    </td>
  </tr>
  <tr> 
    <td height="2"></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
</table>
</body>
</html>
<?php
mysql_free_result($recPaciente);

mysql_free_result($recColocacao);
?>

