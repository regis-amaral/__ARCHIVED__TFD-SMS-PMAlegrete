<?php require_once('Connections/conSaude.php'); ?>
<?php

mysql_select_db($database_conSaude, $conSaude);
$query_recEspecialidade = "SELECT * FROM especialidades ORDER BY especialidade ASC";
$recEspecialidade = mysql_query($query_recEspecialidade, $conSaude) or die(mysql_error());
$row_recEspecialidade = mysql_fetch_assoc($recEspecialidade);
$totalRows_recEspecialidade = mysql_num_rows($recEspecialidade);
$selec=$_POST['especialidade'];
if ($selec==true) 
{echo "<script>window.open('relespera.php?especialidade=".$selec."','Janela','toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=no,width=900,height=900,left=120,top=25');</script>";}

?>
<link href="exibicao.css" rel="stylesheet" type="text/css">
<form method="post" name="form1" action="pacespera.php" >
<table width="291" border="0" cellpadding="0" cellspacing="0">
  <!--DWLayoutTable-->
  <tr> <br>
    <td width="17" height="14"></td>
    <td width="106"></td>
    <td width="137"></td>
    <td width="31"></td>
  </tr>
  <tr> 
    <td height="60"></td>
    <td colspan="2" valign="top" class="usuario"> 
      <p>Clique em imprimir para gerar todos os pacientes na fila de espera, ou 
        filtre por especialidade.</p></td>
    <td></td>
  </tr>
  <tr> 
    <td height="22"></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td></td>
  </tr>
  <tr> 
    <td height="24">&nbsp;</td>
    <td colspan="2" valign="top">
<select name="especialidade">
          <option value="todos" selected >Exibir todos na fila de espera</option>
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
    <td>&nbsp;</td>
  </tr>
  <tr> 
    <td height="15"></td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
  <tr>
    <td height="36"></td>
    <td valign="top">
<input type="submit" name="Submit" value="Imprimir"></td>
    <td></td>
    <td></td>
  </tr>
  <tr>
    <td height="132"></td>
    <td>&nbsp;</td>
    <td></td>
    <td></td>
  </tr>
</table></form>
<?php
mysql_free_result($recEspecialidade);
?>
