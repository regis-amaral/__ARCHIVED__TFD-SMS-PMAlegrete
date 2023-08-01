<?php require_once('Connections/conSaude.php'); ?>
<?php include_once('verifica.php');?>
<?php
$ide = $_GET[inter];
$del = $_POST[idint];
$pac = $_GET[pac];
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

if ((isset($HTTP_POST_VARS['idint'])) && ($HTTP_POST_VARS['idint'] != "")) {
  $deleteSQL = sprintf("DELETE FROM `internacao` WHERE `idint`='$del'",
                       GetSQLValueString($HTTP_POST_VARS['idint'], "int"));

  mysql_select_db($database_conSaude, $conSaude);
  $Result1 = mysql_query($deleteSQL, $conSaude) or die(mysql_error());

  $deleteGoTo = "paciente.php?id=$pac";
  if (isset($HTTP_SERVER_VARS['QUERY_STRING'])) {
    $deleteGoTo .= (strpos($deleteGoTo, '?')) ? "&" : "?";
    $deleteGoTo .= $HTTP_SERVER_VARS['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $deleteGoTo));
}

mysql_select_db($database_conSaude, $conSaude);
$query_recDeleta = "SELECT * FROM internacao WHERE `idint` LIKE '$ide'";
$recDeleta = mysql_query($query_recDeleta, $conSaude) or die(mysql_error());
$row_recDeleta = mysql_fetch_assoc($recDeleta);
$totalRows_recDeleta = mysql_num_rows($recDeleta);
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
<style type="text/css" name="st">
fieldset {
border: 1px solid #1703D1;
}
</style>
<link href="exibicao.css" rel="stylesheet" type="text/css">
</head>
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr> 
    <td width="100%" height="162"><?php require_once('cabec.php');?></td>
  </tr>
  <tr> 
  <table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
    <!--DWLayoutTable-->
    <tr> 
      <td width="13" height="42">&nbsp;</td>
      <td width="495">&nbsp;</td>
      <td width="484">&nbsp;</td>
    </tr>
    <tr> 
      <td height="130">&nbsp;</td>
      <td valign="top"> <fieldset>
        <LEGEND ><font color="#000000"><strong>Excluir Registro de internação?</strong></font></legend>
        <table width="100%" border="0" cellpadding="0" cellspacing="0">
          <!--DWLayoutTable-->
          <tr> 
            <td width="488" height="108" align="center" valign="top"> <br> <a href="alterartratamento.php?idint=<?php echo $ide; ?>" > 
              </a><a href="alterartratamento.php?idint=<?php echo $ide; ?>" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image2','','img/voltar2.gif',1)"><img src="img/voltar.gif" name="Image2" width="55" height="14" border="0"></a><a href="alterartratamento.php?idint=<?php echo $ide; ?>" > 
              </a> <br> <br> <form name="form1" method="post" action="">
                <input type="hidden" name="idint" value="<?php echo $row_recDeleta['idint']; ?>">
                <input type="hidden" name="pac" value="<?php echo $row_recDeleta['idp']; ?>">
                <input type="image" src="img/excluir.gif" name="Submit" >
              </form></td>
          </tr>
          <tr> 
            <td height="1"></td>
          </tr>
        </table>
        </fieldset></td>
      <td>&nbsp;</td>
    </tr>
    <tr> 
      <td height="188">&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
  </table></td></tr>
</table>
</body>
</html>
