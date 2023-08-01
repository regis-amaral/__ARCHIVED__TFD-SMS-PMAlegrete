<?php require_once('../Connections/conSaude.php'); ?>
<?php
		session_start();
		if($_SESSION["nome"]=="regis" || $_SESSION["senha"]=="regis" )	
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
</head>

<body>
<form method="post" name="form1" action="<?php echo $editFormAction; ?>">
  <table width="353" border="0" cellpadding="0" cellspacing="0">
    <!--DWLayoutTable-->
    <tr> 
      <td width="41" height="21">&nbsp;</td>
      <td colspan="2" valign="top"><div align="center">Cadastro de novo Novo Usu&aacute;rio</div></td>
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
</form>
</body>
</html>
<?php } else {echo "Você precisa estar logado como Administrador";
echo "<meta http-equiv='refresh' content='3;URL=login.php?pagina=newuser.php&id=&idint='>";
} ?>