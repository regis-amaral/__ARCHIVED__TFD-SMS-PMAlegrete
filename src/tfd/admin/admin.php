<?php 
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
                <td valign="top"><a href="hospitais.php" target="_parent" <?php if($_SESSION["nome"]!="Administrador")	
					{
                echo "onClick=\"alert('Desculpe! Apenas o administrador do sistema pode acessar e alterar os hospitais e cidades.'); return false;\"";}?>>Hospitais 
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
            <legend ><font color="#000000"><strong>Opções</strong></font></legend>
            <table width="100%" border="0" cellpadding="0" cellspacing="0">
              <!--DWLayoutTable-->
              <tr> 
                <td width="573" height="288">&nbsp;</td>
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
