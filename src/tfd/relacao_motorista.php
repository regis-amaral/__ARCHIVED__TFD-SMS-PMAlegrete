<?php require_once('Connections/conSaude.php'); ?>
<?php
$dia = $_GET[dia];
$mes = $_GET[mes];
$ano = $_GET[ano];
mysql_select_db($database_conSaude, $conSaude);
$query_recInternacao = "select * from paciente, internacao where idp=idpac  and idia='$dia' and iano='$ano' and imes='$mes'";
$recInternacao = mysql_query($query_recInternacao, $conSaude) or die(mysql_error());
$row_recInternacao = mysql_fetch_assoc($recInternacao);
$totalRows_recInternacao = mysql_num_rows($recInternacao);
$data = $_GET[dia]."/".$_GET[mes]."/".$_GET[ano];



$rec_tot_hospital = "select * from paciente, internacao where idp=idpac  and idia='$dia' and iano='$ano' and imes='$mes' GROUP BY ihospital";
?>
<html>
<head>
<title>Documento sem t&iacute;tulo</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="exibicao.css" rel="stylesheet" type="text/css">
<link href="tabelas.css" rel="stylesheet" type="text/css">
</head>

<body>

<table width="816" border="0" cellpadding="0" cellspacing="0">
  <!--DWLayoutTable-->
  <tr> 
    <td width="526" height="26">&nbsp;</td>
    <td width="288">&nbsp;</td>
    <td width="2">&nbsp;</td>
  </tr>
  <tr> 
    <td height="29" colspan="2" valign="top"><div align="center"><strong>Rela&ccedil;&atilde;o 
        de Passageiros para Motorista<br>
        </strong></div></td>
    <td>&nbsp;</td>
  </tr>
  <tr> 
    <td height="24" valign="top"><form name="form1" method="get" action="relacao_motorista.php">
        <strong>Data da Viagem: </strong> 
        <select name="dia" id="dia">
          <option value="<?php echo $_GET[dia]?>"><?php echo $_GET[dia]?></option>
          <option value="<?php echo $_GET[dia]?>">-----</option>
          <option value="1">1</option>
          <option value="2">2</option>
          <option value="3">3</option>
          <option value="4">4</option>
          <option value="5">5</option>
          <option value="6">6</option>
          <option value="7">7</option>
          <option value="8">8</option>
          <option value="9">9</option>
          <option value="10">10</option>
          <option value="11">11</option>
          <option value="12">12</option>
          <option value="13">13</option>
          <option value="14">14</option>
          <option value="15">15</option>
          <option value="16">16</option>
          <option value="17">17</option>
          <option value="18">18</option>
          <option value="19">19</option>
          <option value="20">20</option>
          <option value="21">21</option>
          <option value="22">22</option>
          <option value="23">23</option>
          <option value="24">24</option>
          <option value="25">25</option>
          <option value="26">26</option>
          <option value="27">27</option>
          <option value="28">28</option>
          <option value="29">29</option>
          <option value="30">30</option>
          <option value="31">31</option>
        </select>
        <select name="mes" id="mes">
          <option value="<?php echo $_GET[mes]?>" ><?php echo $_GET[mes]?></option>
          <option value="<?php echo $_GET[mes]?>">-----------------</option>
          <option value="Janeiro">Janeiro</option>
          <option value="Fevereiro">Fevereiro</option>
          <option value="Mar&ccedil;o">Mar&ccedil;o</option>
          <option value="Abril">Abril</option>
          <option value="Maio">Maio</option>
          <option value="Junho">Junho</option>
          <option value="Julho">Julho</option>
          <option value="Agosto">Agosto</option>
          <option value="Setembro">Setembro</option>
          <option value="Outubro">Outubro</option>
          <option value="Novembro">Novembro</option>
          <option value="Dezembro">Dezembro</option>
        </select>
        <select name="ano" id="ano">
          <option value="<?php echo $_GET[ano]?>"><?php echo $_GET[ano]?></option>
          <option value="<?php echo $_GET[ano]?>">--------</option>
          <option value="2008">2008</option>
          <option value="2009">2009</option>
          <option value="2010">2010</option>
          <option value="2011">2011</option>
          <option value="2012">2012</option>
          <option value="2013">2013</option>
          <option value="2014">2014</option>
          <option value="2015">2015</option>
        </select>
        <input type="submit" name="Submit" value="Exibir">
      </form></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr> 
    <td height="23">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr> 
    <td height="42" colspan="2" valign="top"> 
      <?php if ($dia==true) {?>
      <span class="usuario"> Selecione os pacientes para a rela&ccedil;&atilde;o<br>
      </span> <table width="100%" border="0" cellpadding="0" cellspacing="0">
        <!--DWLayoutTable-->
        <tr> 
          <td width="50" height="24" valign="top" class="tabelas"><strong>Marcar</strong></td>
          <td width="231" valign="top" class="tabelas"><strong>Nome do paciente</strong></td>
          <td width="226" valign="top" class="tabelas"><strong>Cidade</strong></td>
          <td width="271" valign="top" class="tabelas"><strong>Hospital</strong></td>
          <td width="45">&nbsp;</td>
        </tr>
      </table></td>
  </tr>
  <tr>
	  <form method="get" action="rel_motorista.php" name="form2">  
    <td height="60" colspan="2" valign="top"> 
      <?php
		$row = mysql_num_rows($recInternacao); 
		$inicio = 0;
		$fim = $row; 
        for($i=$inicio; $i<$fim; $i++) {
		?>
	
      <table width="100%" border="0" cellpadding="0" cellspacing="0">
        <!--DWLayoutTable-->
        <?php $id = mysql_result($recInternacao, $i, "idpac");
	$query_recPaciente = "SELECT * FROM paciente WHERE idp='$id' ";
	$recPaciente = mysql_query($query_recPaciente, $conSaude) or die(mysql_error());
	$row_recPaciente = mysql_fetch_assoc($recPaciente);
	
	$hospitalselec = mysql_result($recInternacao, $i, "ihospital");
	
	$query_rechospital = "SELECT * FROM hospital WHERE hospital='$hospitalselec'";
	$rechospital = mysql_query($query_rechospital, $conSaude) or die(mysql_error());
	$row_rechospital = mysql_fetch_assoc($rechospital);
	$totalRows_rechospital = mysql_num_rows($rechospital);
	
	if($row_rechospital[cidade]==true){$cidade = $row_rechospital[cidade];} 
	else {$cidade= mysql_result($recInternacao, $i, "icidade");}
	
	$query_recsigla = "SELECT * FROM cidade WHERE nome='$cidade'";
	$recsigla = mysql_query($query_recsigla, $conSaude) or die(mysql_error());
	$row_recsigla = mysql_fetch_assoc($recsigla);
	$totalRows_recsigla = mysql_num_rows($recsigla);
	
	$id = $row_recPaciente['idp'];
    ?>
        <tr> 
          <td width="50" height="24" valign="top" class="tabelas"> <input type="checkbox" name="id[]" value="<?php echo $id; ?>"></td>
          <td width="231" valign="top" class="tabelas"><?php echo $row_recPaciente['pnome']; ?></td>
          <td width="226" valign="top" class="tabelas"> 
            <?php if($row_recsigla['nome']==true){echo $row_recsigla['nome'];}else{echo"&nbsp;";}?>
          </td>
          <td width="275" valign="top" class="tabelas"> 
            <?php  if($row_rechospital['hospital']==true){echo $row_rechospital['hospital'];}else{echo"&nbsp;";}?>
          </td>
          <td width="43">&nbsp;</td>
        </tr>
      </table>
      <?php } while ($row_recInternacao = mysql_fetch_assoc($recInternacao)); ?>
      <br>
	  <input type="hidden" name="dia" value="<?php echo  $_GET['dia']?>">
	  <input type="hidden" name="mes" value="<?php echo $_GET['mes']?>">
	  <input type="hidden" name="ano" value="<?php echo $_GET['ano']?>">	  	  
      <input type="submit" name="Submit2" value="Gerar Relat&oacute;rio"> </td></form>
	  <?php } ?>
    <td>&nbsp;</td>
  </tr>
  <tr> 
    <td height="191">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
</body>
</html>
<?php
mysql_free_result($recInternacao);
?>

