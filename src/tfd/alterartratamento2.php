<?php require_once('Connections/conSaude.php'); ?>
<?php $pagina = "alterartratamento.php"?>
<?php 
$idint = $_GET[idint];
$id = $_GET[id];
?>
<?php include_once('verifica.php');?>
<?php
$int = $_GET[idint];
$id = $HTTP_POST_VARS['idpac'];
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
$valorgrav=$_POST['ivalor'];
$valorgrav=explode(",",$valorgrav);
$valorgrav=implode(".",$valorgrav);
if ((isset($HTTP_POST_VARS["MM_update"])) && ($HTTP_POST_VARS["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE internacao SET idpac=%s, ivalor=%s, ivalorextenso=%s, icidade=%s, ihospital=%s, ihora=%s, iretorno=%s, iacompanhante=%s, iacompanhante2=%s, ipagantes=%s, idia=%s, imes=%s, iano=%s, itipo=%s, istatus=%s, edia=%s, emes=%s, eano=%s, exame=%s, especialidade=%s, sala=%s, medico=%s, origemconsulta=%s, urgencia=%s, numeroagend=%s WHERE idint=%s",
                       GetSQLValueString($HTTP_POST_VARS['idpac'], "text"),
                       GetSQLValueString($valorgrav, "text"),
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
                       GetSQLValueString($HTTP_POST_VARS['numeroagend'], "text"),
                       GetSQLValueString($HTTP_POST_VARS['idint'], "int"));

  mysql_select_db($database_conSaude, $conSaude);
  $Result1 = mysql_query($updateSQL, $conSaude) or die(mysql_error());

  $updateGoTo = "paciente.php?id=$id";
  if (isset($HTTP_SERVER_VARS['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $HTTP_SERVER_VARS['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

mysql_select_db($database_conSaude, $conSaude);
$query_recInternacao = "SELECT * FROM internacao WHERE `idint` LIKE '$int'";
$recInternacao = mysql_query($query_recInternacao, $conSaude) or die(mysql_error());
$row_recInternacao = mysql_fetch_assoc($recInternacao);
$totalRows_recInternacao = mysql_num_rows($recInternacao);

//pesquisa de registros
mysql_select_db($database_conSaude, $conSaude);
$query_recPac = "SELECT * FROM paciente WHERE `pnome` LIKE '$id'";
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
<script language="JavaScript" type="text/JavaScript">
<!--
function MM_swapImgRestore() { //v3.0
  var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
}

function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}

function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}

function MM_swapImage() { //v3.0
  var i,j=0,x,a=MM_swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)
   if ((x=MM_findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}
}
//-->
</script>
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
          <td width="10" height="21">&nbsp;</td>
          <td width="871">&nbsp;</td>
          <td width="432">&nbsp;</td>
        </tr>
        <tr>
          <td height="382">&nbsp;</td>
          <td valign="top"> <fieldset>
            <LEGEND ><font color="#000000"><strong>Alterando Movimenta&ccedil;&atilde;o</strong></font></legend>
            <form method="post" name="form1" action="<?php echo $editFormAction; ?>">
              <table width="100%" border="0" cellpadding="0" cellspacing="0">
                <!--DWLayoutTable-->
                <tr> 
                  <td width="6" height="294">&nbsp;</td>
                  <td width="346" valign="top"> <fieldset>
                    <LEGEND ><font color="#000000"><strong>Entrada de Documentos</strong></font></legend>
                    <table width="345" border="0" cellpadding="0" cellspacing="0">
                      <!--DWLayoutTable-->
                      <tr> 
                        <td width="3" height="24"></td>
                        <td width="125" valign="top">Data</td>
                        <td colspan="7" valign="top"><select name="edia" id="edia">
                            <option value="<?php echo $row_recInternacao['edia']; ?>"><?php echo $row_recInternacao['edia']; ?></option>
                            <option value="<?php echo $row_recInternacao['edia']; ?>">==</option>
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
                            <option value="<?php echo $row_recInternacao['emes']; ?>"><?php echo $row_recInternacao['emes']; ?></option>
                            <option value="<?php echo $row_recInternacao['emes']; ?>">=====</option>
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
                            <option value="<?php echo $row_recInternacao['eano']; ?>"><?php echo $row_recInternacao['eano']; ?></option>
                            <option value="<?php echo $row_recInternacao['eano']; ?>">=====</option>
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
                        <td colspan="4" valign="top"><select name="itipo">
                            <option value="<?php echo $row_recInternacao['itipo']; ?>"><?php echo $row_recInternacao['itipo']; ?></option>
                            <option value="<?php echo $row_recInternacao['itipo']; ?>">========================</option>
                            <option value="internacao">Internação</option>
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
                            <option value="<?php echo $row_recInternacao['especialidade']; ?>"><?php echo $row_recInternacao['especialidade']; ?></option>
                            <option value="<?php echo $row_recInternacao['especialidade']; ?>">========================</option>
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
                            <option value="<?php echo $row_recInternacao['exame']; ?>"><?php echo $row_recInternacao['exame']; ?></option>
                            <option value="<?php echo $row_recInternacao['exame']; ?>">========================</option>
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
                            <option value="<?php echo $row_recInternacao['icidade']; ?>"><?php echo $row_recInternacao['icidade']; ?></option>
                            <option value="<?php echo $row_recInternacao['icidade']; ?>">==========</option>
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
                            <option value="<?php echo $row_recInternacao['istatus']; ?>"><?php 
                            echo $row_recInternacao['istatus']; ?></option>
                            <option value="<?php echo $row_recInternacao['istatus']; ?>">========================</option>
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
                            <option value="<?php echo $row_recInternacao['urgencia']; ?>"><?php echo $row_recInternacao['urgencia']; ?></option>
                            <option value="<?php echo $row_recInternacao['urgencia']; ?>">==========</option>
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
                        <td height="60"></td>
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
                  <td width="5">&nbsp;</td>
                  <td colspan="6" valign="top"> <fieldset>
                    <LEGEND ><font color="#000000"><strong>Saída para Viagem</strong></font></legend>
                    <table width="500" border="0" cellpadding="0" cellspacing="0">
                      <!--DWLayoutTable-->
                      <tr> 
                        <td width="4" height="24">&nbsp;</td>
                        <td width="164" valign="top">Data</td>
                        <td width="10">&nbsp;</td>
                        <td colspan="4" valign="top"><select name="idia">
                            <option value="<?php echo $row_recInternacao['idia']; ?>" selected><?php echo $row_recInternacao['idia']; ?></option>
                            <option value="">====</option>
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
                            <option value="<?php echo $row_recInternacao['imes']; ?>" selected><?php echo $row_recInternacao['imes']; ?></option>
                            <option value="">====</option>
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
                            <option value="<?php echo $row_recInternacao['iano']; ?>" selected><?php echo $row_recInternacao['iano']; ?></option>
                            <option value="">====</option>
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
                        <td height="24">&nbsp;</td>
                        <td valign="top">Hospital</td>
                        <td></td>
                        <td colspan="2" valign="top"> <select name="ihospital">
                            <option value="<?php echo $row_recInternacao['ihospital']; ?>"><?php echo $row_recInternacao['ihospital']; ?></option>
                            <option value="">================</option>
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
                        <td height="24">&nbsp;</td>
                        <td valign="top">Sala</td>
                        <td></td>
                        <td colspan="3" valign="top"><input name="sala" type="text" id="sala" value="<?php echo $row_recInternacao['sala']; ?>" size="10">
                          Hora 
                          <input name="ihora" type="text" id="ihora" value="<?php echo $row_recInternacao['ihora']; ?>" size="15"></td>
                        <td>&nbsp;</td>
                      </tr>
                      <tr> 
                        <td height="24">&nbsp;</td>
                        <td valign="top">Profissional</td>
                        <td></td>
                        <td colspan="3" valign="top"> <select name="medico" id="medico">
                            <option value="<?php echo $row_recInternacao['medico']; ?>"><?php echo $row_recInternacao['medico']; ?></option>
                            <option value="<?php echo $row_recInternacao['medico']; ?>">==========</option>
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
                        <td height="24">&nbsp;</td>
                        <td valign="top">Origem da Consulta</td>
                        <td></td>
                        <td colspan="3" valign="top"> <select name="origemconsulta" id="origemconsulta">
                            <option value="<?php echo $row_recInternacao['origemconsulta']; ?>"><?php echo $row_recInternacao['origemconsulta']; ?></option>
                            <option value="<?php echo $row_recInternacao['origemconsulta']; ?>">==========</option>
                            <option value="Comiss&atilde;o de Sa&uacute;de">Comiss&atilde;o 
                            de Sa&uacute;de</option>
                            <option value="Central">Central</option>
                          </select> </td>
                        <td>&nbsp;</td>
                      </tr>
                      <tr> 
                        <td height="22">&nbsp;</td>
                        <td valign="top">N&deg; Agendamento</td>
                        <td></td>
                        <td colspan="3" valign="top"><input name="numeroagend" type="text" id="numeroagend" value="<?php echo $row_recInternacao['numeroagend']; ?>" size="20"></td>
                        <td></td>
                      </tr>
                      <tr> 
                        <td height="24">&nbsp;</td>
                        <td valign="top">Pagantes</td>
                        <td></td>
                        <?php 
			$valor=$row_recInternacao['ivalor'];
			$valor=explode(".",$valor);
			$valor=implode(",",$valor);
			
			?>
                        <td colspan="3" valign="top"> <input name="ipagantes" type="text" value="<?php echo $row_recInternacao['ipagantes']; ?>" size="2">
                          Valor Passagem 
                          <input name="ivalor" type="text" id="ivalor" value="<?php echo $valor; ?>" size="15"></td>
                        <td></td>
                      </tr>
                      <tr> 
                        <td height="24">&nbsp;</td>
                        <td valign="top">Valor por Extenso</td>
                        <td>&nbsp;</td>
                        <td colspan="4" valign="top"><input name="ivalorextenso" type="text" id="ivalorextenso4" value="<?php echo $row_recInternacao['ivalorextenso']; ?>" size="40"> 
                        </td>
                      </tr>
                      <tr> 
                        <td height="24">&nbsp;</td>
                        <td valign="top">Acompanhante 1</td>
                        <td></td>
                        <td colspan="4" valign="top"><input name="iacompanhante" type="text" id="ivalorextenso3" value="<?php echo $row_recInternacao['iacompanhante']; ?>" size="50"> 
                        </td>
                      </tr>
                      <tr> 
                        <td height="24">&nbsp;</td>
                        <td valign="top">Acompanhante 2</td>
                        <td></td>
                        <td colspan="4" valign="top"> <input name="iacompanhante2" type="text" id="iacompanhante223" value="<?php echo $row_recInternacao['iacompanhante2']; ?>" size="50"></td>
                      </tr>
                      <tr> 
                        <td height="24">&nbsp;</td>
                        <td valign="top">Retorno</td>
                        <td></td>
                        <td width="74" valign="top"> <input name="iretorno" type="text" id="iretorno2" value="<?php echo $row_recInternacao['iretorno']; ?>" size="15"> 
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
                        <td></td>
                      </tr>
                    </table>
                    </fieldset></td>
                </tr>
                <tr> 
                  <td height="7"></td>
                  <td></td>
                  <td></td>
                  <td width="246"></td>
                  <td width="61"></td>
                  <td width="57"></td>
                  <td width="3"></td>
                  <td width="99"></td>
                  <td width="49"></td>
                </tr>
                <tr>
                  <td height="1"></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td rowspan="3" valign="top"><input type="image" name="Submit"  src="img/salvar.gif"> 
                    <input type="hidden" name="idpac" value="<?php echo $row_recInternacao['idpac']; ?>" size="32"> 
                    <br> </td>
                  <td></td>
                </tr>
                <tr> 
                  <td height="14"></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td valign="top"> <a href="paciente.php?id=<?php echo $row_recInternacao['idpac']; ?>" > 
                    </a><a href="paciente.php?id=<?php echo $row_recInternacao['idpac']; ?>" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image3','','img/voltar2.gif',1)"><img src="img/voltar.gif" name="Image3" width="55" height="14" border="0" align="top"></a><a href="delinternacao.php?inter=<?php echo $row_recInternacao['idint']; ?>&pac=<?php echo $row_recInternacao['idpac']; ?>" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image4','','img/excluir2.gif',1)"> 
                    </a> </td>
                  <td valign="top"><a href="delinternacao.php?inter=<?php echo $row_recInternacao['idint']; ?>&pac=<?php echo $row_recInternacao['idpac']; ?>" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image4','','img/excluir2.gif',1)"><img src="img/excluir.gif" name="Image4" width="55" height="14" border="0"></a></td>
                  <td></td>
                  <td></td>
                </tr>
                <tr> 
                  <td height="4"></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                </tr>
                <tr>
                  <td height="7"></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                </tr>
              </table>
  <input type="hidden" name="MM_update" value="form1">
  <input type="hidden" name="idint" value="<?php echo $row_recInternacao['idint']; ?>">
</form>
            </fieldset></td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td height="39">&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
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