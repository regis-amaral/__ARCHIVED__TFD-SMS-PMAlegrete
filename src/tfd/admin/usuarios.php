<?php require_once('../Connections/conSaude.php'); ?>
<?php
$maxRows_recUsuarios = 10;
$pageNum_recUsuarios = 0;
if (isset($HTTP_GET_VARS['pageNum_recUsuarios'])) {
  $pageNum_recUsuarios = $HTTP_GET_VARS['pageNum_recUsuarios'];
}
$startRow_recUsuarios = $pageNum_recUsuarios * $maxRows_recUsuarios;

mysql_select_db($database_conSaude, $conSaude);
$query_recUsuarios = "SELECT id, nome FROM usuarios";
$query_limit_recUsuarios = sprintf("%s LIMIT %d, %d", $query_recUsuarios, $startRow_recUsuarios, $maxRows_recUsuarios);
$recUsuarios = mysql_query($query_limit_recUsuarios, $conSaude) or die(mysql_error());
$row_recUsuarios = mysql_fetch_assoc($recUsuarios);

if (isset($HTTP_GET_VARS['totalRows_recUsuarios'])) {
  $totalRows_recUsuarios = $HTTP_GET_VARS['totalRows_recUsuarios'];
} else {
  $all_recUsuarios = mysql_query($query_recUsuarios);
  $totalRows_recUsuarios = mysql_num_rows($all_recUsuarios);
}
$totalPages_recUsuarios = ceil($totalRows_recUsuarios/$maxRows_recUsuarios)-1;
 
$pagina = "admin.php";
include_once('../admin/verifica.php');?>

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
            <legend ><font color="#000000"><strong>Usuários</strong></font></legend>
            <table width="100%" border="0" cellpadding="0" cellspacing="0">
              <!--DWLayoutTable-->
              <tr> 
                <td width="422" height="28">&nbsp;</td>
                <td width="151">&nbsp;</td>
              </tr>
              <tr> 
                <td height="44" colspan="2" valign="top"> <table width="100%" border="0" cellpadding="0" cellspacing="0">
                    <!--DWLayoutTable-->
                    <tr> 
                      <td width="34" height="21"></td>
                      <td width="107" valign="top" class="exibicao">ID</td>
                      <td width="22"></td>
                      <td width="185" valign="top" class="exibicao">NOME</td>
                      <td width="225"></td>
                    </tr>
                    <?php do { ?>
                    <tr> 
                      <td height="23"></td>
                      <td valign="top" class="usuario"><?php echo $row_recUsuarios['id']; ?></td>
                      <td></td>
                      <td valign="top" class="usuario"><?php echo $row_recUsuarios['nome']; ?> 
                      </td>
                      <td></td>
                    </tr>
                    <tr> 
                      <td height="0"></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                    </tr>
                    <?php } while ($row_recUsuarios = mysql_fetch_assoc($recUsuarios)); ?>
                  </table></td>
              </tr>
              <tr> 
                <td height="74">&nbsp;</td>
                <td>&nbsp;</td>
              </tr>
              <tr> 
                <td height="25">&nbsp;</td>
                <td valign="top"><a href="novousuario.php">Inserir Novo Usu&aacute;rio</a></td>
              </tr>
              <tr> 
                <td height="20"></td>
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
<?php
mysql_free_result($recUsuarios);
?>

