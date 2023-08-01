<?php require_once('Connections/conSaude.php'); ?>
<?php

					
mysql_select_db($database_conSaude, $conSaude);
$query_recInternacao = "SELECT * FROM internacao WHERE urgencia='urgente'and istatus='pendente'";
$recInternacao = mysql_query($query_recInternacao, $conSaude) or die(mysql_error());
$row_recInternacao = mysql_fetch_assoc($recInternacao);
$totalRows_recInternacao = mysql_num_rows($recInternacao);
$row = $totalRows_recInternaca;
?>
<html>
<head>
<title>Documento sem t&iacute;tulo</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="exibicao.css" rel="stylesheet" type="text/css">
<link href="tabelas.css" rel="stylesheet" type="text/css">
</head>

<body>
<form name="form1" action="relcons_emergencial.php" method="post">
  <table width="829" border="0" cellpadding="0" cellspacing="0">
    <!--DWLayoutTable-->
    <tr> 
      <td width="13" height="13"></td>
      <td width="126"></td>
      <td width="62"></td>
      <td width="628"></td>
    </tr>
    <tr> 
      <td height="29" colspan="4" valign="top"><div align="center"><strong>Rela&ccedil;&atilde;o 
          de Pacientes com URGENCIA habilitada no cadastro!<br>
          </strong></div></td>
    </tr>
    <tr> 
      <td height="42">&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr> 
      <td height="24" colspan="4" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0">
          <!--DWLayoutTable-->
          <tr> 
            <td width="50" height="24" valign="top" class="tabelas"><strong>Marcar</strong></td>
            <td width="231" valign="top" class="tabelas"><strong>Nome do paciente</strong></td>
            <td width="226" valign="top" class="tabelas"><strong>Especialidade</strong></td>
            <td width="228" valign="top" class="tabelas"><strong>Data de entrada</strong></td>
            <td width="94">&nbsp;</td>
          </tr>
        </table></td>
    </tr>
    <tr> 
      <td height="60" colspan="4" valign="top"> 
        <?php
		$row = mysql_num_rows($recInternacao); 
		$inicio = 0;
		$fim = $row; 
		do {
		?>
        <table width="100%" border="0" cellpadding="0" cellspacing="0">
          <?php $id = $row_recInternacao[idpac];
	$query_recPaciente = "SELECT * FROM paciente WHERE idp='$id' ";
	$recPaciente = mysql_query($query_recPaciente, $conSaude) or die(mysql_error());
	$row_recPaciente = mysql_fetch_assoc($recPaciente);
    ?>
          <tr> 
            <td width="50" height="24" valign="top" class="tabelas"> <input type="checkbox" name="id[]" value="<?php echo $row_recInternacao['idpac']; ?>"></td>
            <td width="231" valign="top" class="tabelas"><?php echo $row_recPaciente['pnome']; ?></td>
            <td width="226" valign="top" class="tabelas"> 
              <?php if($row_recInternacao['especialidade']==true){echo $row_recInternacao['especialidade'];}else{echo"&nbsp;";}?>
            </td>
			<?php 
			if($row_recInternacao['edia']==true){
			$data=$row_recInternacao['edia']."/".$row_recInternacao['emes']."/".$row_recInternacao['eano'];
			}else{$data="&nbsp;";}
			?>
            <td width="228" valign="top" class="tabelas"><?php  if($data==true){echo $data;}else{echo"&nbsp;";}?></td>
            <td width="94">&nbsp;</td>
          </tr>
        </table>
        <?php } while ($row_recInternacao = mysql_fetch_assoc($recInternacao));?>
      </td>
    </tr>
    <tr> 
      <td height="24">&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr> 
      <td height="41">&nbsp;</td>
      <td colspan="2" valign="top"><strong>Data do Envio:</strong><br> <input name="data" type="text" id="data" size="10"> 
      </td>
      <td>&nbsp;</td>
    </tr>
    <tr> 
      <td height="32">&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td height="32">&nbsp;</td>
      <td valign="top"><input type="hidden" name="total" value="<?php echo $totalRows_recInternacao?>"> 
        <input type="submit" name="Submit" value="Enviar"></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td height="99">&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
  </table>
</form>
</body>
</html>
<?php
mysql_free_result($recInternacao);

mysql_free_result($recPaciente);
?>

