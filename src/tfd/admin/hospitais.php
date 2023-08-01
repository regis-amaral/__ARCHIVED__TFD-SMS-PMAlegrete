<?php 
$pagina = "admin.php";
include_once('verifica.php');?>
<?php require_once('../Connections/conSaude.php'); ?>
<?php
//inserção dos registros
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
  $insertSQL = sprintf("INSERT INTO hospital (`hospital`, `abreviatura`, `cidade`) VALUES (%s, %s, %s)",
                       GetSQLValueString($HTTP_POST_VARS['hospital'], "text"),
                       GetSQLValueString($HTTP_POST_VARS['abreviatura'], "text"),
                       GetSQLValueString($HTTP_POST_VARS['cidade'], "text"));

  mysql_select_db($database_conSaude, $conSaude);
  $Result1 = mysql_query($insertSQL, $conSaude) or die(mysql_error());
}

if ((isset($HTTP_POST_VARS["MM_insert"])) && ($HTTP_POST_VARS["MM_insert"] == "form2")) {
  $insertSQL = sprintf("INSERT INTO cidade (nome, sigla) VALUES (%s, %s)",
                       GetSQLValueString($HTTP_POST_VARS['nome'], "text"),
                       GetSQLValueString($HTTP_POST_VARS['sigla'], "text"));

  mysql_select_db($database_conSaude, $conSaude);
  $Result1 = mysql_query($insertSQL, $conSaude) or die(mysql_error());
}

//pesquisa de registros
mysql_select_db($database_conSaude, $conSaude);
$query_rechospital = "SELECT * FROM hospital ORDER BY hospital ASC";
$rechospital = mysql_query($query_rechospital, $conSaude) or die(mysql_error());
$row_rechospital = mysql_fetch_assoc($rechospital);
$totalRows_rechospital = mysql_num_rows($rechospital);

mysql_select_db($database_conSaude, $conSaude);
$query_reccidade = "SELECT * FROM cidade ORDER BY nome ASC";
$reccidade = mysql_query($query_reccidade, $conSaude) or die(mysql_error());
$row_reccidade = mysql_fetch_assoc($reccidade);
$totalRows_reccidade = mysql_num_rows($reccidade);
//exclusão de registros
$exchospital = $_POST[exchospital];
 if ((isset($HTTP_POST_VARS['exchospital'])) && ($HTTP_POST_VARS['exchospital'] != "")) {
  $deleteSQL = sprintf("DELETE FROM `hospital` WHERE `id`='$exchospital'",
                       GetSQLValueString($HTTP_POST_VARS['exchospital'], "int"));

  mysql_select_db($database_conSaude, $conSaude);
  $Result1 = mysql_query($deleteSQL, $conSaude) or die(mysql_error());
  
  $deleteGoTo = "hospitais.php";
  if (isset($HTTP_SERVER_VARS['QUERY_STRING'])) {
    $deleteGoTo .= (strpos($deleteGoTo, '?')) ? "&" : "?";
    $deleteGoTo .= $HTTP_SERVER_VARS['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $deleteGoTo));
}

$exccidade = $_POST[exccidade];
 if ((isset($HTTP_POST_VARS['exccidade'])) && ($HTTP_POST_VARS['exccidade'] != "")) {
  $deleteSQL = sprintf("DELETE FROM `cidade` WHERE `id`='$exccidade'",
                       GetSQLValueString($HTTP_POST_VARS['exccidade'], "int"));

  mysql_select_db($database_conSaude, $conSaude);
  $Result1 = mysql_query($deleteSQL, $conSaude) or die(mysql_error());
  
  $deleteGoTo = "hospitais.php";
  if (isset($HTTP_SERVER_VARS['QUERY_STRING'])) {
    $deleteGoTo .= (strpos($deleteGoTo, '?')) ? "&" : "?";
    $deleteGoTo .= $HTTP_SERVER_VARS['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $deleteGoTo));
}
?>

<html>
<head>
<title>Documento sem t&iacute;tulo</title>
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
<style type="text/css" name="st">
fieldset {
border: 1px solid #1703D1;
}
</style>
<link href="../exibicao.css" rel="stylesheet" type="text/css">
</head>
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr> 
    <td width="100%" height="162"><?php require_once('../cabec.php');?></td>
  </tr>
  <tr>
    <td height="375" valign="top"> <table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
        <!--DWLayoutTable-->
        <tr> 
          <td width="16" height="22">&nbsp;</td>
          <td width="192">&nbsp;</td>
          <td width="20">&nbsp;</td>
          <td width="573">&nbsp;</td>
          <td width="311">&nbsp;</td>
        </tr>
        <tr> 
          <td height="307">&nbsp;</td>
          <td valign="top"> <fieldset>
            <LEGEND ><font color="#000000"><strong>Tabelas</strong></font></legend>
            <table width="192" border="0" cellpadding="0" cellspacing="0">
              <!--DWLayoutTable-->
              <tr> 
                <td width="12" height="13"></td>
                <td width="180"></td>
                <td width="9"></td>
              </tr>
              <tr> 
                <td height="22"></td>
                <td valign="top"><a href="hospitais.php" target="_parent">Hospitais 
                  e Cidades</a></td>
                <td></td>
              </tr>
              <tr> 
                <td height="9"></td>
                <td></td>
                <td></td>
              </tr>
              <tr> 
                <td height="22"></td>
                <td valign="top"><a href="especialidades.php" target="_parent">Especialidades</a></td>
                <td></td>
              </tr>
              <tr> 
                <td height="9"></td>
                <td></td>
                <td></td>
              </tr>
              <tr> 
                <td height="22"></td>
                <td valign="top"><a href="exames.php" target="_parent">Tipos de 
                  Exames</a></td>
                <td></td>
              </tr>
              <tr> 
                <td height="10"></td>
                <td></td>
                <td></td>
              </tr>
              <tr> 
                <td height="22"></td>
                <td valign="top"><a href="medicos.php" target="_parent">M&eacute;dicos</a></td>
                <td></td>
              </tr>
              <tr> 
                <td height="10"></td>
                <td></td>
                <td></td>
              </tr>
              <tr> 
                <td height="22"></td>
                <td valign="top"><a href="usuarios.php" target="_parent">Usu&aacute;rios 
                  do Sistema</a></td>
                <td></td>
              </tr>
              <tr> 
                <td height="127"></td>
                <td></td>
                <td></td>
              </tr>
            </table>
            </fieldset></td>
          <td>&nbsp;</td>
          <td valign="top"> <fieldset>
            <legend ><font color="#000000"><strong>Hospitais e Cidades</strong></font></legend>
            <table width="100%" border="0" cellpadding="0" cellspacing="0">
              <!--DWLayoutTable-->
              <tr> 
                <td width="6" height="8"></td>
                <td width="276"></td>
                <td width="7"></td>
                <td width="276"></td>
                <td width="8"></td>
              </tr>
              <tr> 
                <td height="71">&nbsp;</td>
                <td valign="top"> <form name="form1" method="post" action="hospitais.php">
                    <fieldset>
                    <legend ><font color="#000000"><strong>Inserir Hospital</strong></font></legend>
                    <table width="100%" border="0" cellpadding="0" cellspacing="0">
                      <!--DWLayoutTable-->
                      <tr> 
                        <td width="80" height="1"></td>
                        <td width="194"></td>
                        <td width="2"></td>
                      </tr>
                      <tr> 
                        <td height="22" valign="top">Hospital</td>
                        <td valign="top"> <input name="hospital" type="text" id="hospital"> 
                        </td>
                        <td></td>
                      </tr>
                      <tr> 
                        <td height="22" valign="top">Abreviatura</td>
                        <td valign="top"> <input name="abreviatura" type="text" id="abreviatura"> 
                        </td>
                        <td></td>
                      </tr>
                      <tr> 
                        <td height="26" valign="top">Cidade</td>
                        <td valign="top"> <select name="cidade">
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
                          </select> <input type="submit" name="Submit" value="Inserir"> 
                          <input type="hidden" name="MM_insert" value="form1"> 
                        </td>
                        <td></td>
                      </tr>
                    </table>
                    </fieldset>
                  </form></td>
                <td>&nbsp;</td>
                <td valign="top"> <form name="form2" method="post" action="hospitais.php">
                    <fieldset>
                    <legend ><font color="#000000"><strong>Inserir Cidade</strong></font></legend>
                    <table width="100%" border="0" cellpadding="0" cellspacing="0">
                      <!--DWLayoutTable-->
                      <tr> 
                        <td width="76" height="1"></td>
                        <td width="198"></td>
                        <td width="2"></td>
                      </tr>
                      <tr> 
                        <td height="22" valign="top">Cidade</td>
                        <td valign="top"> <input name="nome" type="text" id="nome"> 
                        </td>
                        <td></td>
                      </tr>
                      <tr> 
                        <td height="46" valign="top">Sigla</td>
                        <td colspan="2" valign="top"> <input name="sigla" type="text" id="sigla"> 
                          <br> <input type="submit" name="Submit5" value="Inserir"> 
                          <input type="hidden" name="MM_insert" value="form2"> 
                        </td>
                      </tr>
                      <tr> 
                        <td height="2"></td>
                        <td></td>
                        <td></td>
                      </tr>
                    </table>
                    </fieldset>
                  </form></td>
                <td>&nbsp;</td>
              </tr>
              <tr> 
                <td height="19">&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
              </tr>
              <tr> 
                <td height="71">&nbsp;</td>
                <td valign="top"><form name="form5" method="post" action="hospitais.php">
                    <fieldset>
                    <legend ><font color="#000000"><strong>Excluir Hospital</strong></font></legend>
                    <table width="100%" border="0" cellpadding="0" cellspacing="0">
                      <!--DWLayoutTable-->
                      <tr> 
                        <td height="4"></td>
                      </tr>
                      <!--DWLayoutTable-->
                      <tr> 
                        <td width="276" height="24" valign="top"> <select name="exchospital" id="exchospital" >
                            <option value=""></option>
                            <?php
do {  
?>
                            <option value="<?php echo $row_rechospital['id']?>"><?php echo $row_rechospital['hospital']?></option>
                            <?php
} while ($row_rechospital = mysql_fetch_assoc($rechospital));
  $rows = mysql_num_rows($rechospital);
  if($rows > 0) {
      mysql_data_seek($rechospital, 0);
	  $row_rechospital = mysql_fetch_assoc($rechospital);
  }
?>
                          </select> <br> <input type="submit" name="Submit3" value="Excluir"> 
                        </td>
                      </tr>
                    </table>
                    </fieldset>
                  </form></td>
                <td>&nbsp;</td>
                <td valign="top"> <form name="form6" method="post" action="hospitais.php">
                    <fieldset>
                    <legend ><font color="#000000"><strong>Excluir Cidade</strong></font></legend>
                    <table width="100%" border="0" cellpadding="0" cellspacing="0">
                      <!--DWLayoutTable-->
                      <tr> 
                        <td width="276" height="24" valign="top"> <select name="exccidade" id="exccidade">
                            <option value=""></option>
                            <?php
do {  
?>
                            <option value="<?php echo $row_reccidade['id']?>"><?php echo $row_reccidade['nome']?></option>
                            <?php
} while ($row_reccidade = mysql_fetch_assoc($reccidade));
  $rows = mysql_num_rows($reccidade);
  if($rows > 0) {
      mysql_data_seek($reccidade, 0);
	  $row_reccidade = mysql_fetch_assoc($reccidade);
  }
?>
                          </select> <br> <input type="submit" name="Submit4" value="Excluir"> 
                        </td>
                      </tr>
                    </table>
                    </fieldset>
                  </form></td>
                <td>&nbsp;</td>
              </tr>
              <tr> 
                <td height="49">&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
              </tr>
            </table>
            </fieldset></td>
          <td>&nbsp;</td>
        </tr>
        <tr> 
          <td height="50">&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
      </table></td>
  </tr>
</table>
</body>
</html>
