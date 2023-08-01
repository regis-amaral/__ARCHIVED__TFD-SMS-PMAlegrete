<?php require_once('Connections/conSaude.php'); ?>
<?php include_once('verifica.php');?>
<?php
$id = $_GET[paciente];
$pac = $_POST[idpac];
$valor=$_POST[ivalor];
$valor=explode(",",$valor);
$valor=implode(".",$valor);

function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  $theValue = (!get_magic_quotes_gpc()) ? addslashes($theValue) : $theValue;

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? "'" . doubleval($theValue) . "'" : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}

$editFormAction = $HTTP_SERVER_VARS['PHP_SELF'];
if (isset($HTTP_SERVER_VARS['QUERY_STRING'])) {
  $editFormAction .= "?" . $HTTP_SERVER_VARS['QUERY_STRING'];
}


if ((isset($HTTP_POST_VARS["MM_insert"])) && ($HTTP_POST_VARS["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO internacao(idpac, ivalor, ivalorextenso, icidade, ihospital, ihora, iretorno, iacompanhante,iacompanhante2, ipagantes, idia, imes, iano, itipo, istatus, edia, emes, eano, exame, especialidade, sala, medico, origemconsulta, urgencia, numeroagend) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($HTTP_POST_VARS['idpac'], "text"),
                       GetSQLValueString($valor, "text"),
                       GetSQLValueString($HTTP_POST_VARS['ivalorextenso'], "text"),
		       GetSQLValueString($HTTP_POST_VARS['icidade'], "text"),
                       GetSQLValueString($HTTP_POST_VARS['ihospital'], "text"),
                       GetSQLValueString($HTTP_POST_VARS['ihora'], "text"),
                       GetSQLValueString($HTTP_POST_VARS['iretorno'], "text"),
                       GetSQLValueString($HTTP_POST_VARS['iacompanhante'], "text"),
                       GetSQLValueString($HTTP_POST_VARS['iacompanhante2'], "text"),
                       GetSQLValueString($HTTP_POST_VARS['ipagantes'], "text"),					   
                       GetSQLValueString($HTTP_POST_VARS['idia'], "text"),
                       GetSQLValueString($HTTP_POST_VARS['imes'], "text"),
                       GetSQLValueString($HTTP_POST_VARS['iano'], "text"),
                       GetSQLValueString($HTTP_POST_VARS['itipo'], "text"),
                       GetSQLValueString($HTTP_POST_VARS['istatus'], "text"),
					   GetSQLValueString($HTTP_POST_VARS['edia'], "text"),
					   GetSQLValueString($HTTP_POST_VARS['emes'], "text"),
					   GetSQLValueString($HTTP_POST_VARS['eano'], "text"),
					   GetSQLValueString($HTTP_POST_VARS['exame'], "text"),
					   GetSQLValueString($HTTP_POST_VARS['especialidade'], "text"),
					   GetSQLValueString($HTTP_POST_VARS['sala'], "text"),
					   GetSQLValueString($HTTP_POST_VARS['medico'], "text"),
					   GetSQLValueString($HTTP_POST_VARS['origemconsulta'], "text"),
					   GetSQLValueString($HTTP_POST_VARS['urgencia'], "text"),
					   GetSQLValueString($HTTP_POST_VARS['numeroagend'], "text"));
  mysql_select_db($database_conSaude, $conSaude);
  $Result1 = mysql_query($insertSQL, $conSaude) or die(mysql_error());

  $insertGoTo = "paciente.php?id=$pac";
  if (isset($HTTP_SERVER_VARS['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $HTTP_SERVER_VARS['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}

//pesquisa de registros
mysql_select_db($database_conSaude, $conSaude);
$query_recPac = "SELECT * FROM paciente WHERE pnome='$id'";
$recPac = mysql_query($query_recPac, $conSaude) or die(mysql_error());
$row_recPac = mysql_fetch_assoc($recPac);
$totalRows_recPac = mysql_num_rows($recPac);

$query_recMedico = "SELECT * FROM medicos ORDER BY nome ASC";
$recMedico = mysql_query($query_recMedico, $conSaude) or die(mysql_error());
$row_recMedico = mysql_fetch_assoc($recMedico);
$totalRows_recMedico = mysql_num_rows($recMedico);

$query_rechospital = "SELECT * FROM hospital ORDER BY hospital ASC";
$rechospital = mysql_query($query_rechospital, $conSaude) or die(mysql_error());
$row_rechospital = mysql_fetch_assoc($rechospital);
$totalRows_rechospital = mysql_num_rows($rechospital);

$query_reccidade = "SELECT * FROM cidade ORDER BY nome ASC";
$reccidade = mysql_query($query_reccidade, $conSaude) or die(mysql_error());
$row_reccidade = mysql_fetch_assoc($reccidade);
$totalRows_reccidade = mysql_num_rows($reccidade);

$query_recEspecialidade = "SELECT * FROM especialidades ORDER BY especialidade ASC";
$recEspecialidade = mysql_query($query_recEspecialidade, $conSaude) or die(mysql_error());
$row_recEspecialidade = mysql_fetch_assoc($recEspecialidade);
$totalRows_recEspecialidade = mysql_num_rows($recEspecialidade);

$query_recExame = "SELECT * FROM exames ORDER BY exame ASC";
$recExame = mysql_query($query_recExame, $conSaude) or die(mysql_error());
$row_recExame = mysql_fetch_assoc($recExame);
$totalRows_recExame = mysql_num_rows($recExame);

?>
<html><!-- InstanceBegin template="/Templates/modelo.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<!-- InstanceBeginEditable name="doctitle" -->
<title>Documento sem t&iacute;tulo</title>
<!-- InstanceEndEditable --> 
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<script language="JavaScript" type="text/JavaScript">
<!--
function MM_reloadPage(init) {  //reloads the window if Nav4 resized
  if (init==true) with (navigator) {if ((appName=="Netscape")&&(parseInt(appVersion)==4)) {
    document.MM_pgW=innerWidth; document.MM_pgH=innerHeight; onresize=MM_reloadPage; }}
  else if (innerWidth!=document.MM_pgW || innerHeight!=document.MM_pgH) location.reload();
}
MM_reloadPage(true);
//-->
</script>
<!-- InstanceBeginEditable name="head" -->
<link href="exibicao.css" rel="stylesheet" type="text/css">
<!-- InstanceEndEditable -->
<style type="text/css" name="st">
fieldset {
border: 1px solid #1703D1;
}
</style>
<link href="exibicao.css" rel="stylesheet" type="text/css">
</head>

<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<table width="100%" border="0" cellpadding="0" cellspacing="0">
<?php require_once('cabec.php');?> <!-- InstanceBeginEditable name="Centro" --> 
  
	  <table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
        <!--DWLayoutTable-->
        <tr> 
          <td width="9" height="21">&nbsp;</td>
          <td width="311">&nbsp;</td>
          <td width="319" valign="top" class="usuario">Paciente <?php echo $row_recPac['pnome']; ?></td>
          <td width="270">&nbsp;</td>
          <td width="203">&nbsp;</td>
        </tr>
        <tr> 
          <td height="304">&nbsp;</td>
          <td colspan="3" valign="top"> <fieldset>
            <LEGEND ><font color="#000000"><strong>Inserindo Movimenta&ccedil;&atilde;o</strong></font></legend>
            <form method="post" name="form1" action="<?php echo $editFormAction; ?>">
			  <table width="100%" border="0" cellpadding="0" cellspacing="0">
                <!--DWLayoutTable-->
                <tr> 
                  <td width="13" height="9"></td>
                  <td width="345"></td>
                  <td width="8"></td>
                  <td width="406"></td>
                  <td width="122"></td>
                  <td width="26"></td>
                </tr>
                <tr> 
                  <td height="292">&nbsp;</td>
                  <td valign="top"> <fieldset>
                    <LEGEND ><font color="#000000"><strong>Entrada de Documentos</strong></font></legend>
                    <table width="345" border="0" cellpadding="0" cellspacing="0">
                      <!--DWLayoutTable-->
                      <tr> 
                        <td width="3" height="24"></td>
                        <td width="125" valign="top">Data</td>
                        <td colspan="7" valign="top"><select name="edia" id="edia">
                            <option value=""></option>
                            <option value="01">01</option>
                            <option value="02">02</option>
                            <option value="03">03</option>
                            <option value="04">04</option>
                            <option value="05">05</option>
                            <option value="06">06</option>
                            <option value="07">07</option>
                            <option value="08">08</option>
                            <option value="09">09</option>
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
                          </select> <select name="emes" id="emes">
                            <option value=""></option>
                            <option value="01">Janeiro</option>
                            <option value="02">Fevereiro</option>
                            <option value="03">Mar&ccedil;o</option>
                            <option value="04">Abril</option>
                            <option value="05">Maio</option>
                            <option value="06">Junho</option>
                            <option value="07">Julho</option>
                            <option value="08">Agosto</option>
                            <option value="09">Setembro</option>
                            <option value="10">Outubro</option>
                            <option value="11">Novembro</option>
                            <option value="12">Dezembro</option>
                          </select> <select name="eano" id="eano">
                            <option value=""></option>
                            <option value="2008">2008</option>
                            <option value="2009">2009</option>
                            <option value="2010">2010</option>
                            <option value="2011">2011</option>
                            <option value="2012">2012</option>
                            <option value="2013">2013</option>
                            <option value="2014">2014</option>
                            <option value="2015">2015</option>
                          </select></td>
                        <td width="9">&nbsp;</td>
                        <td width="5"></td>
                      </tr>
                      <tr> 
                        <td height="24"></td>
                        <td valign="top">Tipo </td>
                        <td colspan="4" valign="top"><select name="itipo" id="itipo">
                            <option value=""></option>
                            <option value="internacao">Interna&ccedil;&atilde;o</option>
                            <option value="exame">Exame</option>
                            <option value="consulta">Consulta</option>
                          </select></td>
                        <td width="4">&nbsp;</td>
                        <td width="4">&nbsp;</td>
                        <td width="23"></td>
                        <td></td>
                        <td></td>
                      </tr>
                      <tr> 
                        <td height="24"></td>
                        <td valign="top">Especialidade</td>
                        <td colspan="3" valign="top"><select name="especialidade" id="especialidade">
                            <option value=""></option>
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
                        <td width="3">&nbsp;</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                      </tr>
                      <tr> 
                        <td height="24"></td>
                        <td valign="top">Exame</td>
                        <td colspan="2" valign="top"> <select name="exame" id="exame">
                            <option value=""></option>
                            <?php
do {  
?>
                            <option value="<?php echo $row_recExame['exame']?>"><?php echo $row_recExame['exame']?></option>
                            <?php
} while ($row_recExame = mysql_fetch_assoc($recExame));
  $rows = mysql_num_rows($recExame);
  if($rows > 0) {
      mysql_data_seek($recExame, 0);
	  $row_recExame = mysql_fetch_assoc($recExame);
  }
?>
                          </select></td>
                        <td width="2"></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                      </tr>
                      <tr> 
                        <td height="24"></td>
                        <td valign="top">Cidade</td>
                        <td colspan="2" valign="top"> <select name="icidade" id="icidade">
                            <option value=""></option>
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
                          </select> </td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                      </tr>
                      <tr> 
                        <td height="1"></td>
                        <td></td>
                        <td width="60"></td>
                        <td width="107"></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                      </tr>
                      <tr> 
                        <td height="24" colspan="10" valign="top"><hr align="center"></td>
                        <td></td>
                      </tr>
                      <tr> 
                        <td height="24"></td>
                        <td valign="top">Status</td>
                        <td colspan="6" valign="top"><select name="istatus">
                            <option value="Pendente">Pendente</option>
                            <option value="Comiss&atilde;o de Sa&uacute;de">Comissão de Saúde</option>
                            <option value="Central">Central</option>
                            <option value="Conclu&iacute;do">Conclu&iacute;do</option>
                          </select></td>
                        <td></td>
                        <td></td>
                        <td></td>
                      </tr>
                      <tr> 
                        <td height="24"></td>
                        <td colspan="2" valign="top">Grau de Urg&ecirc;ncia </td>
                        <td colspan="4" valign="top"><select name="urgencia" id="urgencia">
                            <option value="normal">normal</option>
                            <option value="urgente">urgente</option>
                          </select></td>
                        <td>&nbsp;</td>
                        <td></td>
                        <td></td>
                        <td></td>
                      </tr>
                      <tr> 
                        <td height="22"></td>
                        <td colspan="2" valign="top">Posi&ccedil;&atilde;o de 
                          Aguardo </td>
                        <td colspan="4" valign="top"><!--DWLayoutEmptyCell-->&nbsp;</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                      </tr>
                      <tr> 
                        <td height="58"></td>
                        <td>&nbsp;</td>
                        <td></td>
                        <td>&nbsp;</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                      </tr>
                    </table>
                    </fieldset></td>
                  <td>&nbsp;</td>
                  <td colspan="2" valign="top"> <fieldset>
                    <LEGEND ><font color="#000000"><strong> para Viagem</strong></font></legend>
                    <table width="500" border="0" cellpadding="0" cellspacing="0">
                      <!--DWLayoutTable-->
                      <tr> 
                        <td width="177" height="24" valign="top">Data</td>
                        <td width="18">&nbsp;</td>
                        <td colspan="4" valign="top"><select name="idia">
                            <option value=""></option>
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
                          </select> <select name="imes">
                            <option value=""></option>
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
                          </select> <select name="iano">
                            <option value=""></option>
                            <option value="2008">2008</option>
                            <option value="2009">2009</option>
                            <option value="2010">2010</option>
                            <option value="2011">2011</option>
                            <option value="2012">2012</option>
                            <option value="2013">2013</option>
                            <option value="2014">2014</option>
                            <option value="2015">2015</option>
                          </select></td>
                      </tr>
                      <tr> 
                        <td height="24" valign="top">Hospital</td>
                        <td></td>
                        <td colspan="2" valign="top"> <select name="ihospital" id="ihospital">
                            <option value=""></option>
                            <?php
do {  
?>
                            <option value="<?php echo $row_rechospital['hospital']?>"><?php echo $row_rechospital['hospital']?></option>
                            <?php
} while ($row_rechospital = mysql_fetch_assoc($rechospital));
  $rows = mysql_num_rows($rechospital);
  if($rows > 0) {
      mysql_data_seek($rechospital, 0);
	  $row_rechospital = mysql_fetch_assoc($rechospital);
  }
?>
                          </select> </td>
                        <td width="77">&nbsp;</td>
                        <td width="22">&nbsp;</td>
                      </tr>
                      <tr> 
                        <td height="24" valign="top">Sala</td>
                        <td></td>
                        <td colspan="3" valign="top"><input name="sala" type="text" id="sala" size="10">
                          Hora 
                          <input name="ihora" type="text" id="ihora2" size="10"></td>
                        <td>&nbsp;</td>
                      </tr>
                      <tr> 
                        <td height="24" valign="top">Profissional</td>
                        <td></td>
                        <td colspan="3" valign="top"> <select name="medico" id="medico">
                            <option value=""></option>
                            <?php
do {  
?>
                            <option value="<?php echo $row_recMedico['nome']?>"><?php echo $row_recMedico['nome']?></option>
                            <?php
} while ($row_recMedico = mysql_fetch_assoc($recMedico));
  $rows = mysql_num_rows($recMedico);
  if($rows > 0) {
      mysql_data_seek($recMedico, 0);
	  $row_recMedico = mysql_fetch_assoc($recMedico);
  }
?>
                          </select> </td>
                        <td>&nbsp;</td>
                      </tr>
                      <tr> 
                        <td height="24" valign="top">Origem da Consulta</td>
                        <td></td>
                        <td colspan="3" valign="top"> <select name="origemconsulta" id="origemconsulta">
                            <option value=""></option>
                            <option value="Comiss&atilde;o de Sa&uacute;de">Comiss&atilde;o 
                            de Sa&uacute;de</option>
                            <option value="Central">Central</option>
                          </select> </td>
                        <td>&nbsp;</td>
                      </tr>
                      <tr> 
                        <td height="22" valign="top">N&deg; do Agendamento</td>
                        <td></td>
                        <td colspan="3" valign="top"><input name="numeroagend" type="text" id="numeroagend" size="20"></td>
                        <td></td>
                      </tr>
                      <tr> 
                        <td height="24" valign="top">Pagantes</td>
                        <td></td>
                        <td colspan="3" valign="top"> <input name="ipagantes" type="text" id="ipagantes" size="2">
                          Valor Passagem 
                          <input name="ivalor" type="text" id="ivalor2" size="10"></td>
                        <td></td>
                      </tr>
                      <tr> 
                        <td height="24" valign="top">Valor por Extenso</td>
                        <td>&nbsp;</td>
                        <td colspan="4" valign="top"> <input name="ivalorextenso" type="text" id="ivalorextenso" size="50"> 
                        </td>
                      </tr>
                      <tr> 
                        <td height="24" valign="top">Acompanhante 1</td>
                        <td></td>
                        <td colspan="4" valign="top"> <input name="iacompanhante" type="text" id="iacompanhante" size="50"> 
                        </td>
                      </tr>
                      <tr> 
                        <td height="24" valign="top">Acompanhante 2</td>
                        <td></td>
                        <td colspan="4" valign="top"> <input name="iacompanhante2" type="text" id="iacompanhante2" size="50"></td>
                      </tr>
                      <tr> 
                        <td height="24" valign="top">Retorno</td>
                        <td></td>
                        <td width="74" valign="top"> <input name="iretorno" type="text" id="iretorno" size="10"> 
                        </td>
                        <td width="132"></td>
                        <td></td>
                        <td></td>
                      </tr>
                      <tr> 
                        <td height="11"></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                      </tr>
                    </table>
                    </fieldset></td>
                  <td>&nbsp;</td>
                </tr>
                <tr> 
                  <td height="33"></td>
                  <td></td>
                  <td></td>
                  <td>&nbsp;</td>
                  <td valign="top"> <input type="hidden" name="idpac" value="<?php echo $row_recPac['idp']; ?>" size="32"> 
                    <input type="hidden" name="MM_insert" value="form1"> <a href="paciente.php?id=<?php echo $row_recPac['idp']; ?>" > 
                    <input type="image" name="Submit" src="img/salvar.gif" value="Enviar">
					<br><a href="paciente.php?id=<?php echo $row_recPac['idp']; ?>" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image2','','voltar2.gif',1)"><img src="img/voltar.gif" name="Image2" width="55" height="14" border="0"></a><a href="C" > 
                    </a></td>
                  <td></td>
                </tr>
              </table>
            </form>
            </fieldset>
			
			</td>
          <td>&nbsp;</td>
        </tr>
        <tr> 
          <td height="6"></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
        </tr>
      </table>
      <!-- InstanceEndEditable --></td>
  </tr>
</table>
</body>
<!-- InstanceEnd --></html>
<?php
mysql_free_result($recPac);

mysql_free_result($recMedico);

mysql_free_result($rechospital);

mysql_free_result($reccidade);

mysql_free_result($recEspecialidade);

mysql_free_result($recExame);

?>