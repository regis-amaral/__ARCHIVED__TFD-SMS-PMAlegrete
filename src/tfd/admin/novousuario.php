<?php require_once('../Connections/conSaude.php'); ?>
<?php
		session_start();
		if($_SESSION["nome"]=="Administrador" || $_SESSION["senha"]=="218501" )	
		{
?>
<?php
$senha = $_POST[senha];
$senha2 = $_POST[senha2];

if ($_POST[nome]=true) {
if ($senha==$senha2){

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
  $insertSQL = sprintf("INSERT INTO usuarios (id, nome, login, senha) VALUES (%s, %s, %s, %s)",
                       GetSQLValueString($HTTP_POST_VARS['id'], "int"),
                       GetSQLValueString($HTTP_POST_VARS['nome'], "text"),
                       GetSQLValueString($HTTP_POST_VARS['login'], "text"),
                       GetSQLValueString($senha, "text"));

  mysql_select_db($database_conSaude, $conSaude);
  $Result1 = mysql_query($insertSQL, $conSaude) or die(mysql_error());

  $insertGoTo = "admin.php";
  if (isset($HTTP_SERVER_VARS['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $HTTP_SERVER_VARS['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}
} else {
	echo "<b>Erro nos dados inseridos! tente novamente!</b>";
}
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
  <table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
    <!--DWLayoutTable-->
    <tr> 
      <td width="19" height="21">&nbsp;</td>
      <td width="305">&nbsp;</td>
      <td width="783">&nbsp;</td>
    </tr>
    <tr> 
      <td height="316">&nbsp;</td>
      <td valign="top"><form method="post" name="form1" action="<?php echo $editFormAction; ?>">
          <table width="353" border="0" cellpadding="0" cellspacing="0">
            <!--DWLayoutTable-->
            <tr> 
              <td width="41" height="21">&nbsp;</td>
              <td colspan="2" valign="top"><div align="center">Cadastro de novo 
                  Novo Usu&aacute;rio</div></td>
              <td width="54">&nbsp;</td>
            </tr>
            <tr> 
              <td height="21">&nbsp;</td>
              <td width="92">&nbsp;</td>
              <td width="166"></td>
              <td></td>
            </tr>
            <tr> 
              <td height="25" colspan="2" valign="top">Nome</td>
              <td colspan="2" valign="top"> <input name="nome" type="text" id="nome"> 
              </td>
            </tr>
            <tr> 
              <td height="8"></td>
              <td></td>
              <td></td>
              <td></td>
            </tr>
            <tr> 
              <td height="25" colspan="2" valign="top">Usu&aacute;rio</td>
              <td colspan="2" valign="top"><input name="login" type="text" id="login"></td>
            </tr>
            <tr> 
              <td height="8"></td>
              <td></td>
              <td></td>
              <td></td>
            </tr>
            <tr> 
              <td height="27" colspan="2" valign="top">Senha</td>
              <td colspan="2" valign="top"> <input name="senha" type="password" id="senha"> 
              </td>
            </tr>
            <tr> 
              <td height="9"></td>
              <td></td>
              <td></td>
              <td></td>
            </tr>
            <tr> 
              <td height="25" colspan="2" valign="top">Senha</td>
              <td colspan="2" valign="top"><input name="senha2" type="password" id="senha2"></td>
            </tr>
            <tr> 
              <td height="21"></td>
              <td></td>
              <td></td>
              <td></td>
            </tr>
            <tr> 
              <td height="35">&nbsp;</td>
              <td>&nbsp;</td>
              <td colspan="2" valign="top"> <input type="submit" name="Submit" value="Validar"> 
              </td>
            </tr>
            <tr> 
              <td height="177">&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td></td>
            </tr>
          </table>
          <input type="hidden" name="MM_insert" value="form1">
        </form></td>
      <td>&nbsp;</td>
    </tr>
    <tr> 
      <td height="23">&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
  </table></td></tr>
</table>
</body>
</html>
<?php } else {echo "Você precisa estar logado como Administrador";
echo "<meta http-equiv='refresh' content='3;URL=usuarios.php'>";
} ?>