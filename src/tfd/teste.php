<?php require_once('Connections/conSaude.php'); ?>
<?php
mysql_select_db($database_conSaude, $conSaude);
$query_recpaciente = "SELECT idint, istatus, urgencia, edia, emes, eano FROM internacao WHERE `istatus` || `urgencia` || `edia` || `emes` || `eano` IS NOT NULL ORDER BY eano, emes, edia";
$recpaciente = mysql_query($query_recpaciente, $conSaude) or die(mysql_error());
$row_recpaciente = mysql_fetch_assoc($recpaciente);
$totalRows_recpaciente = mysql_num_rows($recpaciente);


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
</head>
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<table width="100%" border="0" cellpadding="0" cellspacing="0">
<?php require_once('cabec.php');?> 
    <td height="375" valign="top"> <table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
        <!--DWLayoutTable-->
        <tr> 
          <td width="101" height="66">&nbsp;</td>
          <td width="389">&nbsp;</td>
          <td width="510">&nbsp;</td>
        </tr>
        <tr> 
          <td height="30">&nbsp;</td>
          <td valign="top"><?php echo $totalRows_recpaciente;?></td>
          <td>&nbsp;</td>
        </tr>
        <tr> 
          <td height="264">&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
      </table></td>
  </tr>
</table>
</body>
</html>
