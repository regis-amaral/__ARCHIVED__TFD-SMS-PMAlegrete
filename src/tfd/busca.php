<?php require_once('Connections/conSaude.php'); ?>
<?php session_start();?>
<?php
$pesq = $_GET["busca"];
$maxRows_recPesquisa = 10;
$pageNum_recPesquisa = 0;

if (isset($HTTP_GET_VARS['pageNum_recPesquisa'])) {
  $pageNum_recPesquisa = $HTTP_GET_VARS['pageNum_recPesquisa'];
}
$startRow_recPesquisa = $pageNum_recPesquisa * $maxRows_recPesquisa;
mysql_select_db($database_conSaude, $conSaude);
if ($pesq == true) {
$query_recPesquisa = "SELECT * FROM paciente where `pnome` LIKE '%$pesq%' ORDER BY `pnome` asc";
$recPesquisa = mysql_query($query_recPesquisa, $conSaude) or die(mysql_error());
$row_recPesquisa = mysql_fetch_assoc($recPesquisa);
$totalRows_recPesquisa = mysql_num_rows($recPesquisa);
if (isset($HTTP_GET_VARS['totalRows_recPesquisa'])) {
  $totalRows_recPesquisa = $HTTP_GET_VARS['totalRows_recPesquisa'];
} else {
  $all_recPesquisa = mysql_query($query_recPesquisa);
  $totalRows_recPesquisa = mysql_num_rows($all_recPesquisa);
}
$totalPages_recPesquisa = ceil($totalRows_recPesquisa/$maxRows_recPesquisa)-1;
}else{error_reporting(0);}
?>
<html>
<head>
<title>Busca</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<script language="JavaScript" type="text/JavaScript">
<!--
function MM_reloadPage(init) {  //reloads the window if Nav4 resized
  if (init==true) with (navigator) {if ((appName=="Netscape")&&(parseInt(appVersion)==4)) {
    document.MM_pgW=innerWidth; document.MM_pgH=innerHeight; onresize=MM_reloadPage; }}
  else if (innerWidth!=document.MM_pgW || innerHeight!=document.MM_pgH) location.reload();
}
MM_reloadPage(true);

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
td div {
width: 100%;
height: 230px;
overflow-y: scroll; /* overflow-x: scroll; = abaixo overflow-y: scroll; = direita e overflow: scroll; nas duas, depois tem hidden e auto*/
}
fieldset {
border: 1px solid #1703D1;
}
</style>
<link href="tabelas.css" rel="stylesheet" type="text/css">
<link href="tabelas.css" rel="stylesheet" type="text/css">
<link href="exibicao.css" rel="stylesheet" type="text/css">
<link href="estilo1.css" rel="stylesheet" type="text/css">
</head>
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" onLoad="MM_preloadImages('img/consultar2.gif')">
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr> 
    <td width="100%" height="162"><?php require_once('cabec.php');?></td>
  </tr>
  <tr>
    <td height="360" valign="top"> <table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
        <!--DWLayoutTable-->
        <tr> 
          <td width="1" height="8"></td>
          <td width="372"></td>
          <td width="619"></td>
        </tr>
        <tr> 
          <td height="43"></td>
          <td valign="top"> <form name="form1" method="get" action="busca.php" >
              <fieldset>
              <LEGEND ><font color="#000000"><strong>Busca por nome ou parte dele:</strong></font></legend>
              <input name="busca" type="text" value="" size="50">
              <input type="submit" name="Submit" value="Buscar">
              </fieldset>
            </form></td>
          <td></td>
        </tr>
        <tr> 
          <td height="2"></td>
          <td></td>
          <td></td>
        </tr>
        <tr> 
          <td height="306" colspan="3" valign="top"> 
            <?php if ($pesq == TRUE) { 
	  if ($row_recPesquisa['pnome'] == TRUE) {
	  ?>
            <fieldset>
            <LEGEND ><font color="#000000"><strong>Resultado da busca por "<?php echo $pesq;?>":</strong></font></legend>
            <table width="100%"  height="15" border="0" cellpadding="0" cellspacing="0" bgcolor="#E0E0E0" >
              <!--DWLayoutTable-->
              <tr> 
                <td width="8" height="21">&nbsp;</td>
                <td width="242" valign="top" bgcolor="#E0E0E0" class="cabectabelas" >&nbsp;&nbsp;Nome</td>
                <td width="3">&nbsp;</td>
                <td width="77" valign="top" class="cabectabelas">Cart&atilde;o 
                  Sus</td>
                <td width="3">&nbsp;</td>
                <td width="85" valign="top" class="cabectabelas">Identidade</td>
                <td width="209" valign="top" class="cabectabelas">Rua</td>
                <td width="72" valign="top" class="cabectabelas">N&ordm;</td>
                <td width="100" valign="top" class="cabectabelas">Bairro</td>
                <td width="178" valign="top" class="cabectabelas">Op&ccedil;&otilde;es</td>
            </table>
            <div> 
              <table width="100%" border="0" cellpadding="0" cellspacing="0"  bgcolor="#FFFFFF">
                <!--DWLayoutTable-->
                <?php do { ?>
                <tr> 
                  <td width="8" height="21">&nbsp;</td>
                  <td width="243" valign="top" class="tabelas"> 
                    <?php if ($row_recPesquisa['pnome'] == NULL) {echo "- - - - - - - - - -  - -";} else {echo $row_recPesquisa['pnome'];} ?>
                  </td>
                  <td width="79" valign="top" class="tabelas"> 
                    <?php if ($row_recPesquisa['pcartao'] == NULL) {echo "- - - - - - - - - -  - -";} else {echo $row_recPesquisa['pcartao'];} ?>
                  </td>
                  <td width="86" valign="top" class="tabelas"> 
                    <?php if ($row_recPesquisa['prg'] == NULL) {echo "- - - - - - - - - -  - -";} else {echo $row_recPesquisa['prg'];} ?>
                  </td>
                  <td width="213" valign="top" class="tabelas"> 
                    <?php if ($row_recPesquisa['prua'] == NULL) {echo "- - - - - - - - - -  - -";} else {echo $row_recPesquisa['prua'];} ?>
                  </td>
                  <td width="70" valign="top" class="tabelas"> 
                    <?php if ($row_recPesquisa['pnum'] == NULL) {echo "- - - - - - - - - -  - -";} else {echo $row_recPesquisa['pnum'];} ?>
                  </td>
                  <td width="99" valign="top" class="tabelas"> 
                    <?php if ($row_recPesquisa['pbairro'] == NULL) {echo "- - - - - - - - - -  - -";} else {echo $row_recPesquisa['pbairro'];} ?>
                  </td>
                  <td width="176" valign="top" class="tabboton" ><a href="paciente.php?id=<?php echo $row_recPesquisa['idp']; ?>" > 
                    </a><a href="paciente.php?id=<?php echo $row_recPesquisa['idp']; ?>" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image2','','img/consultar2.gif',1)"><img src="img/consultar.gif" name="Image2" width="65" height="14" border="0" align="bottom"></a><a href="paciente.php?id=<?php echo $row_recPesquisa['idp']; ?>" > 
                    </a></td>
                  </MM:DECORATION>
                  <MM:EndLock> 
                  <?php } while ($row_recPesquisa = mysql_fetch_assoc($recPesquisa)); ?>
              </table>
            </div>
            </fieldset>
            <?php } else { echo "-  Não foi localizado nenhum registro com a palavra <font color=`#FF0000`> <b>"."\""."$pesq"."\""."</b></font>, tente novamente usando parte do nome ou sobrenome!";}} ?>
          </td>
        </tr>
        <tr> 
          <td height="1"></td>
          <td></td>
          <td></td>
        </tr>
      </table></td>
  </tr>
  <tr> 
    <td height="1"></td>
  </tr>
</table>
</body>
</html>
