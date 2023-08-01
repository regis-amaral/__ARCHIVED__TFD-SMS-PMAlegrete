<?php require_once('Connections/conSaude.php'); ?>
<?php
mysql_select_db($database_conSaude, $conSaude);
$query_recEspecialidade = "SELECT * FROM especialidades ORDER BY especialidade ASC";
$recEspecialidade = mysql_query($query_recEspecialidade, $conSaude) or die(mysql_error());
$row_recEspecialidade = mysql_fetch_assoc($recEspecialidade);
$totalRows_recEspecialidade = mysql_num_rows($recEspecialidade);
$selec=$_POST['especialidade'];

$query_reccidade = "SELECT * FROM cidade ORDER BY nome ASC";
$reccidade = mysql_query($query_reccidade, $conSaude) or die(mysql_error());
$row_reccidade = mysql_fetch_assoc($reccidade);
$totalRows_reccidade = mysql_num_rows($reccidade);


?>
<link href="exibicao.css" rel="stylesheet" type="text/css">
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<form method="get" name="form1" action="rel_encaminhados.php" target="_blank">
  <table width="306" border="0" cellpadding="0" cellspacing="0">
    <!--DWLayoutTable-->
    <tr> <br>
      <td width="88" height="4"></td>
      <td width="8"></td>
      <td width="98"></td>
      <td width="4"></td>
      <td width="93"></td>
      <td width="12"></td>
      <td width="3"></td>
    </tr>
    <tr> 
      <td height="15" colspan="5" align="center" valign="middle" class="usuario"> 
        <p>Pacientes Encaminhados a tratamento</p></td>
      <td></td>
      <td></td>
    </tr>
    <tr> 
      <td height="24"></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td></td>
      <td></td>
    </tr>
    <tr> 
      <td height="20" valign="top" class="usuario"><font size="1">&nbsp;&nbsp;Especialidade</font></td>
      <td colspan="6" valign="top"> &nbsp; <select name="especialidade" class="textbox">
          <option value="all" selected >Todas as Especialidades</option>
          <?php
do {  
?>
          <option value="<?php echo $row_recEspecialidade['especialidade']?>"><?php echo $row_recEspecialidade['especialidade']?></option>
          <?php
} while ($row_recEspecialidade = mysql_fetch_assoc($recEspecialidade));
  $rows = mysql_num_rows($recEspecialidade);
  if($rows > 0) {
      mysql_data_seek($recEspecialidade, 0);
	  $row_recEspecialidade = mysql_fetch_assoc($recEspecialidade);
  }
?>
        </select></td>
    </tr>
    <tr> 
      <td height="6"></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
    </tr>
    <tr> 
      <td height="20" valign="top" class="usuario"><font size="1">&nbsp;&nbsp;Cidade</font></td>
      <td colspan="6" valign="top"> &nbsp; <select name="cidade" class="textbox" id="cidade">
          <option value="all">--------</option>
          <?php
do {  
?>
          <option value="<?php echo $row_reccidade['nome']?>"><?php echo $row_reccidade['nome']?></option>
          <?php
} while ($row_reccidade = mysql_fetch_assoc($reccidade));
  $rows = mysql_num_rows($reccidade);
  if($rows > 0) {
      mysql_data_seek($reccidade, 0);
	  $row_reccidade = mysql_fetch_assoc($reccidade);
  }
?>
        </select> <font size="1">&nbsp; </font></td>
    </tr>
    <tr> 
      <td height="7"></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
    </tr>
    <tr> 
      <td height="20" valign="top" class="usuario"><strong><font size="1">&nbsp;&nbsp;Ano</font></strong></td>
      <td colspan="6" valign="top"> &nbsp; <select name="ano" class="textbox" id="ano">
          <option value="2009">2009</option>
          <option value="2010">2010</option>
          <option value="2011">2011</option>
          <option value="2012">2012</option>
          <option value="2013">2013</option>
          <option value="2014">2014</option>
          <option value="2015">2015</option>
        </select> </td>
    </tr>
    <tr> 
      <td height="8"></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
    </tr>
    <tr> 
      <td height="19" valign="top" class="usuario">&nbsp;&nbsp;<font size="1">Meses</font></td>
      <td></td>
      <td rowspan="2" valign="top" class="usuario"><font size="1"><br>
        <input name="janeiro" type="checkbox" class="textbox" id="janeiro" value="janeiro">
        jANEIRO<br>
        <input name="fevereiro" type="checkbox" class="textbox" id="fevereiro" value="fevereiro">
        fEVEREIRO<br>
        <input name="marco" type="checkbox" class="textbox" id="marco" value="marco">
        mAR&Ccedil;O<br>
        <input name="abril" type="checkbox" class="textbox" id="abril" value="abril">
        aBRIL<br>
        <input name="maio" type="checkbox" class="textbox" id="maio" value="maio">
        mAIO<br>
        <input name="junho" type="checkbox" class="textbox" id="junho" value="junho">
        jUNHO<br>
        </font></td>
      <td>&nbsp;</td>
      <td colspan="2" rowspan="2" valign="top" class="usuario"><font size="1"><br>
        <input name="julho" type="checkbox" class="textbox" id="julho" value="julho">
        jULHO <br>
        <input name="agosto" type="checkbox" class="textbox" id="agosto" value="agosto">
        AGOSTO<br>
        <input name="setembro" type="checkbox" class="textbox" id="setembro" value="setembro">
        SETEMBRO <br>
        <input name="outubro" type="checkbox" class="textbox" id="outubro" value="outubro">
        OUTUBRO <br>
        <input name="novembro" type="checkbox" class="textbox" id="novembro" value="novembro">
        NOVEMBRO <br>
        <input name="dezembro" type="checkbox" class="textbox" id="dezembro" value="dezembro">
        DEZEMBRO</font></td>
      <td>&nbsp;</td>
    </tr>
    <tr> 
      <td height="85"></td>
      <td></td>
      <td></td>
      <td>&nbsp;</td>
    </tr>
    <tr> 
      <td height="28"></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
    </tr>
    <tr> 
      <td height="20" colspan="6" align="center" valign="top" class="usuario"> 
        <input name="Submit" type="submit" class="textbox" value="Gerar Relat&oacute;rio"></td>
      <td></td>
    </tr>
  </table>
</form>
<?php
mysql_free_result($recEspecialidade);
mysql_free_result($reccidade);
?>
