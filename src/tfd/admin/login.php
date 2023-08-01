<?php 
$pagina = $_GET[pagina];
$id = $_GET[id];
$idint = $_GET[idint];
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
<link href="exibicao.css" rel="stylesheet" type="text/css">
<link href="/tfd/admin/exibicao.css" rel="stylesheet" type="text/css">
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
          <td width="39" height="32"></td>
          <td colspan="2" valign="top" class="usuario">Voc&ecirc; precisa estar 
            logado no sistema para executar altera&ccedil;&otilde;es</td>
          <td width="280">&nbsp;</td>
        </tr>
        <tr> 
          <td height="14"></td>
          <td width="299"></td>
          <td width="165"></td>
          <td></td>
        </tr>
        <tr> 
          <td height="291">&nbsp;</td>
          <td valign="top"> <form action="auth.php" name="autenticacao" method="post">
              <table width="100%" border="0" cellpadding="0" cellspacing="0">
                <!--DWLayoutTable-->
                <tr> 
                  <td width="54" height="35"></td>
                  <td width="58"></td>
                  <td width="122"></td>
                  <td width="32"></td>
                  <td width="16"></td>
                </tr>
                <tr> 
                  <td height="22">&nbsp;</td>
                  <td valign="top"><strong>Usu&aacute;rio</strong></td>
                  <td colspan="2" valign="top"> <input name="login" type="text" id="login" value="admin"> 
                  </td>
                  <td>&nbsp;</td>
                </tr>
                <tr> 
                  <td height="24">&nbsp;</td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                </tr>
                <tr> 
                  <td height="22">&nbsp;</td>
                  <td valign="top"><strong>Senha</strong></td>
                  <td colspan="2" valign="top"><input name="senha" type="password" id="senha" value="123"></td>
                  <td>&nbsp;</td>
                </tr>
                <tr> 
                  <td height="38">&nbsp;</td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                </tr>
                <tr> 
                  <td height="24">&nbsp;</td>
                  <td>&nbsp;</td>
                  <td valign="top"><input type="submit" name="Submit" value="Validar"></td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                </tr>
                <tr> 
                  <td height="107">&nbsp;</td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                </tr>
              </table>
              <input type="hidden" name="pagina" value="<?php echo $pagina ?>">
              <input type="hidden" name="pac" value="<?php echo $id ?>">
              <input type="hidden" name="idint" value="<?php echo $idint ?>">
            </form></td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr> 
          <td height="44">&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
      </table></td>
  </tr>
</table>
</body>
</html>
