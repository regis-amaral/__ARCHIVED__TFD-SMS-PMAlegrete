<?php require_once('../Connections/conSaude.php'); ?>
<?php
$especialidade = $HTTP_POST_VARS['excespecialidade'];
 if ((isset($HTTP_POST_VARS['excespecialidade'])) && ($HTTP_POST_VARS['excespecialidade'] != "")) {
  $deleteSQL = sprintf("DELETE FROM `especialidades` WHERE `id`='$especialidade'",
                       GetSQLValueString($HTTP_POST_VARS['excespecialidade'], "int"));

  mysql_select_db($database_conSaude, $conSaude);
  $Result1 = mysql_query($deleteSQL, $conSaude) or die(mysql_error());

  $deleteGoTo = "especialidades.php";
  if (isset($HTTP_SERVER_VARS['QUERY_STRING'])) {
    $deleteGoTo .= (strpos($deleteGoTo, '?')) ? "&" : "?";
    $deleteGoTo .= $HTTP_SERVER_VARS['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $deleteGoTo));
}

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

if ((isset($HTTP_POST_VARS["MM_insert"])) && ($HTTP_POST_VARS["MM_insert"] == "form3")) {
  $insertSQL = sprintf("INSERT INTO especialidades (`especialidade`) VALUES (%s)",
                       GetSQLValueString($HTTP_POST_VARS['insespecialidade'], "text"));

  mysql_select_db($database_conSaude, $conSaude);
  $Result1 = mysql_query($insertSQL, $conSaude) or die(mysql_error());

  $insertGoTo = "especialidades.php";
  if (isset($HTTP_SERVER_VARS['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $HTTP_SERVER_VARS['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}

if ((isset($HTTP_POST_VARS["MM_update"])) && ($HTTP_POST_VARS["MM_update"] == "form2")) {
  $updateSQL = sprintf("UPDATE especialidades SET especialidade=%s WHERE id=%s",
                       GetSQLValueString($HTTP_POST_VARS['altespecialidade'], "text"),
                       GetSQLValueString($HTTP_POST_VARS['especialidade'], "int"));

  mysql_select_db($database_conSaude, $conSaude);
  $Result1 = mysql_query($updateSQL, $conSaude) or die(mysql_error());

  $updateGoTo = "especialidades.php";
  if (isset($HTTP_SERVER_VARS['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $HTTP_SERVER_VARS['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

mysql_select_db($database_conSaude, $conSaude);
$query_recEspecialidade = "SELECT * FROM especialidades ORDER BY especialidade ASC";
$recEspecialidade = mysql_query($query_recEspecialidade, $conSaude) or die(mysql_error());
$row_recEspecialidade = mysql_fetch_assoc($recEspecialidade);
$totalRows_recEspecialidade = mysql_num_rows($recEspecialidade);
 
$pagina = "admin.php";
include_once('verifica.php');?>
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
            <legend ><font color="#000000"><strong>Especialidades</strong></font></legend>
            <table width="600" border="0" cellpadding="0" cellspacing="0">
              <!--DWLayoutTable-->
              <tr> 
                <td width="67" height="7"></td>
                <td width="501"></td>
                <td width="30"></td>
              </tr>
              <tr> 
                <td height="89"></td>
                <td valign="top"> <fieldset>
                  <legend ><font color="#000000"><strong>Alterar</strong></font></legend>
                  <table width="500" border="0" cellpadding="0" cellspacing="0">
                    <!--DWLayoutTable-->
                    <tr> 
                      <td width="14" height="3"></td>
                      <td width="438"></td>
                      <td width="48"></td>
                    </tr>
                    <tr> 
                      <td height="67"></td>
                      <td valign="top"> <form method="post" name="form2" action="<?php echo $editFormAction; ?>">
                          De 
                          <select name="especialidade" id="especialidade">
                            <option value=""></option>
                            <?php
do {  
?>
                            <option value="<?php echo $row_recEspecialidade['id']?>"><?php echo $row_recEspecialidade['especialidade']?></option>
                            <?php
} while ($row_recEspecialidade = mysql_fetch_assoc($recEspecialidade));
  $rows = mysql_num_rows($recEspecialidade);
  if($rows > 0) {
      mysql_data_seek($recEspecialidade, 0);
	  $row_recEspecialidade = mysql_fetch_assoc($recEspecialidade);
  }
?>
                          </select>
                          <br>
                          para 
                          <input name="altespecialidade" type="text" id="altespecialidade" size="30">
                          <input type="submit" name="Submit2" value="Enviar">
                          <br>
                          <input type="hidden" name="MM_update" value="form2">
                        </form></td>
                      <td></td>
                    </tr>
                  </table>
                  </fieldset></td>
                <td>&nbsp;</td>
              </tr>
              <tr> 
                <td height="1"></td>
                <td></td>
                <td></td>
              </tr>
              <tr> 
                <td height="71"></td>
                <td valign="top"> <fieldset>
                  <legend ><font color="#000000"><strong>Inserir</strong></font></legend>
                  <table width="500" border="0" cellpadding="0" cellspacing="0">
                    <!--DWLayoutTable-->
                    <tr> 
                      <td width="15" height="11"></td>
                      <td width="315"></td>
                      <td width="170"></td>
                    </tr>
                    <tr> 
                      <td height="24"></td>
                      <td valign="top"> <form method="post" name="form3" action="<?php echo $editFormAction; ?>">
                          <input name="insespecialidade" type="text" id="insespecialidade" size="30">
                          <input type="submit" name="Submit" value="Enviar">
                          <input type="hidden" name="MM_insert" value="form3">
                        </form></td>
                      <td></td>
                    </tr>
                    <tr> 
                      <td height="11"></td>
                      <td></td>
                      <td></td>
                    </tr>
                  </table>
                  </fieldset></td>
                <td></td>
              </tr>
              <tr> 
                <td height="5"></td>
                <td></td>
                <td></td>
              </tr>
              <tr> 
                <td height="73"></td>
                <td valign="top"> <fieldset>
                  <legend ><font color="#000000"><strong>Excluir</strong></font></legend>
                  <table width="500" border="0" cellpadding="0" cellspacing="0">
                    <!--DWLayoutTable-->
                    <tr> 
                      <td width="15" height="12"></td>
                      <td width="371"></td>
                      <td width="114"></td>
                    </tr>
                    <tr> 
                      <td height="33"></td>
                      <td valign="top"><form name="form1" method="post" action="especialidades.php">
                          <select name="excespecialidade" id="excespecialidade">
                            <option value=""></option>
                            <?php
do {  
?>
                            <option value="<?php echo $row_recEspecialidade['id']?>"><?php echo $row_recEspecialidade['especialidade']?></option>
                            <?php
} while ($row_recEspecialidade = mysql_fetch_assoc($recEspecialidade));
  $rows = mysql_num_rows($recEspecialidade);
  if($rows > 0) {
      mysql_data_seek($recEspecialidade, 0);
	  $row_recEspecialidade = mysql_fetch_assoc($recEspecialidade);
  }
?>
                          </select>
                          <input type="submit" name="Submit3" value="Excluir">
                        </form></td>
                      <td></td>
                    </tr>
                  </table>
                  </fieldset></td>
                <td></td>
              </tr>
              <tr> 
                <td height="24"></td>
                <td></td>
                <td></td>
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
