<?php require_once('Connections/conSaude.php');

$internacao = $_GET['internacao'];





//atualizacao
if($_GET[excluir] == true){$obs = NULL; $grav = $_GET[exidint]; $_POST[idint] = $_GET[exidint];}
						else
						{$obs = $_POST[observacao]; $grav = $_POST[idint];}

		$updateSQL = "UPDATE internacao SET iloc_saida='$obs' WHERE idint='$grav'";
	 	mysql_select_db($database_conSaude, $conSaude);
  		$Result1 = mysql_query($updateSQL, $conSaude) or die(mysql_error());
		$internacao2 = $_POST['idint'];
		if($_POST['idint']==true){$id2=$_POST['idpac'];}
		if($_GET['exidint']==true){$id2=$_GET['exid'];}
if($grav==true){echo "<script> window.opener.location.href='alterartratamento.php?idint=".$internacao2."&id=".$id2."'; window.close();
		</script>";}
if($internacao == true){$idint=$internacao;}else{$idint = $_POST[idint];}
$query_recInternacao = "SELECT * FROM internacao WHERE idint='$idint'";
$recInternacao = mysql_query($query_recInternacao, $conSaude) or die(mysql_error());
$row_recInternacao = mysql_fetch_assoc($recInternacao);
$totalRows_recInternacao = mysql_num_rows($recInternacao);


?>
<html>
<head>
<title>Documento sem t&iacute;tulo</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
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
</head>

<body onLoad="MM_preloadImages('img/excluir2.gif')">
<form name="form1" method="post" action="loc_saida.php">
  <table width="580" border="0" cellpadding="0" cellspacing="0">
    <!--DWLayoutTable-->
    <tr> 
      <td width="15" height="25">&nbsp;</td>
      <td width="23">&nbsp;</td>
      <td width="176" valign="top"><strong>Local de Sa&iacute;da:</strong></td>
      <td width="136">&nbsp;</td>
      <td width="57">&nbsp;</td>
      <td width="89">&nbsp;</td>
      <td width="84">&nbsp;</td>
    </tr>
    <tr> 
      <td height="5"></td>
      <td></td>
      <td colspan="2" rowspan="3" valign="top"><input name="observacao" type="text" id="observacao" value="<?php echo $row_recInternacao['iloc_saida']; ?>" size="45" /></td>
      <td></td>
      <td></td>
      <td></td>
    </tr>
    <tr> 
      <td height="14"></td>
      <td></td>
      <td valign="top"><input name="submit" type="image" id="submit" src="img/salvar.gif" width="55" height="14" border="0"></td>
      <td rowspan="3" valign="top"><a href="loc_saida.php?excluir=excluir&exidint=<?php echo $row_recInternacao['idint']; ?>&exid=<?php echo $row_recInternacao['idpac'];?>" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image2','','img/excluir2.gif',1)"><img src="img/excluir.gif" name="image2" width="55" height="14" border="0" id="image2"></a> 
        <input name="idint" type="hidden" id="idint" value="<?php echo $row_recInternacao['idint']; ?>"> 
        <input name="idpac" type="hidden" id="idint" value="<?php echo $row_recInternacao['idpac']; ?>"> 
        </td>
      <td></td>
    </tr>
    <tr> 
      <td height="22"></td>
      <td colspan="6" valign="top"><?php echo $mensagem;?></td>
    </tr>
  </table>
</form>
</body>
</html>
<?php
mysql_free_result($recInternacao);
?>

