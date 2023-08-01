<?php require_once('Connections/conSaude.php'); ?>
<?php $pagina = "alterar.php"?>
<?php $id = $_GET[id];?>
<?php include_once('verifica.php');?>
<?php
$id = $_GET['id'];

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = "UPDATE paciente SET 
  pnome='$_POST[pnome]', 
  prg='$_POST[prg]', 
  ptel='$_POST[ptel]', 
  ptel2='$_POST[ptel2]', 
  prua='$_POST[prua]', 
  pnum='$_POST[pnum]', 
  pbairro='$_POST[pbairro]', 
  pcartao='$_POST[pcartao]', 
  pnasc='$_POST[pnasc]', 
  pnatur='$_POST[pnatur]', 
  psexo='$_POST[psexo]', 
  ppai='$_POST[ppai]', 
  pmae='$_POST[pmae]', 
  pcomp='$_POST[pcomp]', 
  pcep='$_POST[pcep]',
  pcadastrador='$_SESSION[id]' WHERE idp='$_POST[idp]'"; 

mysql_select_db($database_conSaude, $conSaude);
  $Result1 = mysql_query($updateSQL, $conSaude) or die(mysql_error());

  header("Location: paciente.php?id=$_POST[idp]");
}

mysql_select_db($database_conSaude, $conSaude);
$query_recAlterar = "SELECT * FROM paciente WHERE idp LIKE '$id'";
$recAlterar = mysql_query($query_recAlterar, $conSaude) or die(mysql_error());
$row_recAlterar = mysql_fetch_assoc($recAlterar);
$totalRows_recAlterar = mysql_num_rows($recAlterar);
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
<link href="exibicao.css" rel="stylesheet" type="text/css">
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
<!-- obriga digitacao em determinados campos-->
<script language="javascript">
<!-- chama a função (nomeform) -->
function valida_dados (nomeform)
{
    if (nomeform.pnome.value=="")
    {
        alert ("Informe o NOME do paciente.");
        return false;
    }
    if (nomeform.prua.value=="")
    {
        alert ("Informe a RUA do endereço.");
        return false;
    } 
	    if (nomeform.pnum.value=="")
    {
        alert ("Informe o NÚMERO do endereço.");
        return false;
    }   
	    if (nomeform.pbairro.value=="")
    {
        alert ("Informe o BAIRRO do endereço.");
        return false;
    } 
	    if (nomeform.pcartao.value=="")
    {
        alert ("Informe o número do Cartão SUS.");
        return false;
    } 
	    if (nomeform.prg.value=="")
    {
        alert ("Informe o número da IDENTIDADE.");
        return false;
    }	
		    if (nomeform.pnasc.value=="")
    {
        alert ("Informe a DATA de NASCIMENTO.");
        return false;
    }	
		    if (nomeform.psexo.value=="")
    {
        alert ("Informe o SEXO.");
        return false;
    }
		    if (nomeform.psexo.value=="")
    {
        alert ("Informe o SEXO.");
        return false;
    }
		    if (nomeform.pmae.value=="")
    {
        alert ("Informe o NOME da MÃE.");
        return false;
    }					
return true;
}
</script>
<!-- fim do script -->
</head>
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <!--DWLayoutTable-->
  <tr> 
    <td width="100%" height="162"><?php require_once('cabec.php');?></td>
  </tr>
  <tr> 
    <td height="375" valign="top">
  <form method="post" name="form1" action="alterar.php"onSubmit="return valida_dados(this)">
        <table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
          <!--DWLayoutTable-->
          <tr> 
            <td width="1" height="31">&nbsp;</td>
            <td width="1">&nbsp;</td>
            <td width="71">&nbsp;</td>
            <td width="312">&nbsp;</td>
            <td width="1">&nbsp;</td>
            <td width="24">&nbsp;</td>
            <td width="359">&nbsp;</td>
            <td width="16">&nbsp;</td>
          </tr>
          <tr> 
            <td height="206"></td>
            <td colspan="3" valign="top"><fieldset>
              <LEGEND ><font color="#000000"><strong>Endereço</strong></font></legend>
              <table width="100%" border="0" cellpadding="0" cellspacing="0">
                <!--DWLayoutTable-->
                <tr> 
                  <td width="8" height="10"></td>
                  <td width="61"></td>
                  <td width="51"></td>
                  <td width="6"></td>
                  <td width="99"></td>
                  <td width="1"></td>
                  <td width="6"></td>
                  <td width="160"></td>
                  <td width="11"></td>
                </tr>
                <tr> 
                  <td height="22"></td>
                  <td valign="top" class="usuario"><strong><font size="2"><font color="#FF0000">*</font></font></strong> 
                    Nome:</td>
                  <td colspan="7" valign="top" class="usuario"> <input name="pnome" type="text" value="<?php echo $row_recAlterar['pnome']; ?>" size="55" maxlength="50"> 
                  </td>
                </tr>
                <tr> 
                  <td height="22"></td>
                  <td valign="top" class="usuario"><strong><font size="2"><font color="#FF0000">*</font></font></strong> 
                    Rua:</td>
                  <td colspan="7" valign="top" class="usuario"> <input name="prua" type="text" id="prua" value="<?php echo $row_recAlterar['prua']; ?>" size="55" maxlength="50"></td>
                </tr>
                <tr> 
                  <td height="22"></td>
                  <td valign="top" class="usuario"><strong><font size="2"><font color="#FF0000">*</font></font></strong> 
                    N&deg;:</td>
                  <td valign="top" class="usuario"> <input name="pnum" type="text" id="pnum" value="<?php echo $row_recAlterar['pnum']; ?>" size="8" maxlength="8"> 
                  </td>
                  <td>&nbsp;</td>
                  <td colspan="2" valign="top" class="usuario">Complemento:</td>
                  <td>&nbsp;</td>
                  <td valign="top" class="usuario"> <input name="pcomp" type="text" id="pcomp" value="<?php echo $row_recAlterar['pcomp']; ?>"size="15" maxlength="8"></td>
                  <td>&nbsp;</td>
                </tr>
                <tr> 
                  <td height="22"></td>
                  <td valign="top" class="usuario"><strong><font size="2"><font color="#FF0000">*</font></font></strong>Bairro:</td>
                  <td colspan="3" valign="top" class="usuario"> <input name="pbairro" type="text" id="pbairro" value="<?php echo $row_recAlterar['pbairro']; ?>" size="25"></td>
                  <td>&nbsp;</td>
                  <td></td>
                  <td></td>
                  <td></td>
                </tr>
                <tr> 
                  <td height="22"></td>
                  <td valign="top" class="usuario">Cep:</td>
                  <td colspan="3" valign="top" class="usuario"> <input name="pcep" type="text" id="pcep" value="<?php echo $row_recAlterar['pcep']; ?>" size="25" maxlength="8"></td>
                  <td>&nbsp;</td>
                  <td></td>
                  <td></td>
                  <td></td>
                </tr>
                <tr> 
                  <td height="22"></td>
                  <td valign="top" class="usuario">Tel 1:</td>
                  <td colspan="4" valign="top" class="usuario"> <input name="ptel" type="text" id="ptel" value="<?php echo $row_recAlterar['ptel']; ?>" size="25" maxlength="11"></td>
                  <td></td>
                  <td></td>
                  <td></td>
                </tr>
                <tr> 
                  <td height="22"></td>
                  <td valign="top" class="usuario">Tel 2:</td>
                  <td colspan="4" valign="top" class="usuario"> <input name="ptel2" type="text" id="ptel2" value="<?php echo $row_recAlterar['ptel2']; ?>" size="25" maxlength="11"></td>
                  <td></td>
                  <td></td>
                  <td></td>
                </tr>
                <tr> 
                  <td height="4"></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                </tr>
              </table>
              </fieldset></td>
            <td>&nbsp;</td>
            <td colspan="2" rowspan="2" valign="top"> <fieldset>
              <LEGEND ><font color="#000000"><strong>Dados Pessoais</strong></font></legend>
              <table width="100%" border="0" cellpadding="0" cellspacing="0">
                <!--DWLayoutTable-->
                <tr> 
                  <td width="22" height="10"></td>
                  <td width="112"></td>
                  <td width="9"></td>
                  <td width="127"></td>
                  <td width="94"></td>
                  <td width="49"></td>
                  <td width="49"></td>
                </tr>
                <tr> 
                  <td height="22"></td>
                  <td valign="top" class="usuario"><strong><font size="2"><font color="#FF0000">* 
                    </font></font></strong>Cart&atilde;o SUS:</td>
                  <td>&nbsp;</td>
                  <td colspan="2" valign="top" class="usuario"> <input name="pcartao" type="text" id="pcartao" value="<?php echo $row_recAlterar['pcartao']; ?>"></td>
                  <td></td>
                  <td></td>
                </tr>
                <tr> 
                  <td height="22"></td>
                  <td valign="top" class="usuario"><strong><font size="2"><font color="#FF0000">* 
                    </font></font></strong>Identidade:</td>
                  <td>&nbsp;</td>
                  <td colspan="2" valign="top" class="usuario"> <input name="prg" type="text" id="prg" value="<?php echo $row_recAlterar['prg']; ?>"></td>
                  <td></td>
                  <td></td>
                </tr>
                <tr> 
                  <td height="22"></td>
                  <td valign="top" class="usuario"><strong><font size="2"><font color="#FF0000">*</font></font></strong> 
                    Data Nasc:</td>
                  <td>&nbsp;</td>
                  <td valign="top" class="usuario"> <input name="pnasc" type="text" id="pnasc" value="<?php echo $row_recAlterar['pnasc']; ?>" size="15"></td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                </tr>
                <tr> 
                  <td height="22"></td>
                  <td valign="top" class="usuario">Naturalidade:</td>
                  <td>&nbsp;</td>
                  <td colspan="2" valign="top" class="usuario"> <input name="pnatur" type="text" id="pnatur" value="<?php echo $row_recAlterar['pnatur']; ?>"></td>
                  <td>&nbsp;</td>
                  <td></td>
                </tr>
                <tr> 
                  <td height="22"></td>
                  <td valign="top" class="usuario"><strong><font size="2"><font color="#FF0000">*</font></font></strong> 
                    Sexo:</td>
                  <td>&nbsp;</td>
                  <td valign="top" class="usuario"><select name="psexo" size="1" >
                      <option value="<?php echo $row_recAlterar['psexo']; ?>"><?php echo $row_recAlterar['psexo']; ?></option>
                      <option value="<?php echo $row_recAlterar['psexo']; ?>">==</option>
                      <option value="M">M</option>
                      <option value="F">F</option>
                    </select> </td>
                  <td>&nbsp;</td>
                  <td></td>
                  <td></td>
                </tr>
                <tr> 
                  <td height="22"></td>
                  <td valign="top" class="usuario"><strong><font size="2"><font color="#FF0000">*</font></font></strong> 
                    M&atilde;e:</td>
                  <td>&nbsp;</td>
                  <td colspan="3" valign="top" class="usuario"> <input name="pmae" type="text" id="pmae" value="<?php echo $row_recAlterar['pmae']; ?>" size="45" maxlength="50"></td>
                  <td>&nbsp;</td>
                </tr>
                <tr> 
                  <td height="22"></td>
                  <td valign="top" class="usuario">Pai:</td>
                  <td>&nbsp;</td>
                  <td colspan="3" valign="top" class="usuario"> <input name="ppai" type="text" id="ppai" value="<?php echo $row_recAlterar['ppai']; ?>" size="45" maxlength="50"></td>
                  <td>&nbsp;</td>
                </tr>
                <tr> 
                  <td height="4"></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                </tr>
              </table>
              </fieldset></td>
            <td>&nbsp;</td>
          </tr>
          <tr> 
            <td height="2"></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
          </tr>
          <tr> 
            <td height="3"></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
          </tr>
          <tr> 
            <td height="15"></td>
            <td></td>
            <td colspan="4" valign="top"><strong><u><font size="2">Aten&ccedil;&atilde;o!</font></u> 
              <font size="2"><u>O</u> <u>asterisco</u> <u>vermelho</u> &quot;<font color="#FF0000">*</font>&quot; 
              <u>marca</u> <u>os</u> <u>Campos</u> <u>Obrigat&oacute;rios</u></font></strong></td>
            <td></td>
            <td></td>
          </tr>
          <tr> 
            <td height="3"></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
          </tr>
          <tr> 
            <td height="14"></td>
            <td colspan="2" valign="top"><a href="paciente.php?id=<?php echo $row_recAlterar['idp']; ?>" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image4','','img/voltar2.gif',1)"><img src="img/voltar.gif" name="Image4" width="55" height="14" border="0"></a></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
          </tr>
          <tr> 
            <td height="6"></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
          </tr>
          <tr> 
            <td height="14"></td>
            <td colspan="2" valign="top"><a href="delpaciente.php?id=<?php echo $row_recAlterar['idp']; ?>" > 
              </a><a href="delpaciente.php?id=<?php echo $row_recAlterar['idp']; ?>" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image3','','img/excluir2.gif',1)"><img src="img/excluir.gif" name="Image3" width="55" height="14" border="0"></a><a href="delpaciente.php?id=<?php echo $row_recAlterar['idp']; ?>" > 
              </a></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
          </tr>
          <tr> 
            <td height="6"></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
          </tr>
          <tr>
            <td height="14"></td>
            <td colspan="2" valign="top"> <input name="Image5" type="image" value="Salvar " src="img/salvar.gif" width="55" height="14"> 
            </td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
          </tr>
          <tr>
            <td height="96"></td>
            <td>&nbsp;</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
          </tr>
        </table>
    <input type="hidden" name="MM_update" value="form1">
    <input type="hidden" name="idp" value="<?php echo $row_recAlterar['idp']; ?>">
  </form></td></tr>
</table>
</body>
</html>
<script>
alert('Atenção Cadastrador! \n\nOs seus dados estarão sendo registrados para eventuais verificações! \n\nO cadastro do paciente no SUS é obrigátorio, \n\né sua responsabilidade encaminhá-lo a retirada do cartão SUS. \n\nSetor de Informática');
</script>