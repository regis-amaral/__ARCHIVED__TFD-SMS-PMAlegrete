 <style type="text/css" name="st">
fieldset {
border: 1px solid #1703D1;
}
</style>
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
</head>
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" onLoad="MM_preloadImages(/tfd/img/pesquisa2.gif','/tfd/img/cadastrar2.gif','/tfd/img/relatorios2.gif','/tfd/img/administracao2.gif')">
<table width="100%" border="0" cellpadding="0" cellspacing="0">
<script>
function click() {
if (event.button==2||event.button==3) {
oncontextmenu='return false';
  }
}
document.onmousedown=click
document.oncontextmenu = new Function("return false;")
</script>

  <tr> 
    <td width="100%" height="132" valign="top"><img src="/tfd/img/banner.gif" width="100%" height="132"></td>
  </tr>
  <tr> 
    <td height="30" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#CCCCCC">
        <!--DWLayoutTable-->
        <tr> 
          <td width="1" height="2"></td>
          <td width="423" rowspan="3" valign="top">
		    <a href="/tfd/busca.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image2','','/tfd/img/pesquisa2.gif',1)"><img name="Image2" border="0" src="/tfd/img/pesquisa.gif"></a> 
            <a href="/tfd/cadastrar.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image3','','/tfd/img/cadastrar2.gif',1)"><img name="Image3" border="0" src="/tfd/img/cadastrar.gif"></a> 
            <a href="/tfd/relatorios.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image4','','/tfd/img/relatorios2.gif',1)"><img name="Image4" border="0" src="/tfd/img/relatorios.gif"></a> 
            <a href="/tfd/admin/admin.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image5','','/tfd/img/administracao2.gif',1)"><img name="Image5" border="0" src="/tfd/img/administracao.gif"></a> 
          </td>
          <td width="235"></td>
          <td width="329" rowspan="3" align="right" valign="top"><font size="1" face="Arial, Helvetica, sans-serif"><strong><font face="Times New Roman, Times, serif">Cadastro 
            de Pacientes P/Setor de Tratamento Fora Domicilio - Vs 2.0<br>
            Desenvolvido em Php e MySql - R&eacute;gis Amaral</font><br>
            </strong> </font></td>
          <td width="4"></td>
        </tr>
        <tr> 
          <td height="26"></td>
          <td valign="top" class="logou"> 
            <?php if ($_SESSION["nome"] == true) {echo "Logado como"." ".$_SESSION["nome"]." - "."<a href='/tfd/destroy.php'>Sair</a>";} else {echo "Você não esta logado!"." - "."<a href='/tfd/login.php?pagina=busca.php'>Entrar</a>";} ?>
          </td>
          <td></td>
        </tr>
        <tr> 
          <td height="4"></td>
          <td></td>
          <td></td>
        </tr>
      </table></td>
  </tr>
</table>
