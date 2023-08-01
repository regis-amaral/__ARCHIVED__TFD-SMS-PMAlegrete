<?php require_once('Connections/conSaude.php'); ?>
<?php $pagina = "cadastrar.php"?>
<?php include_once('verifica.php');?>
<?php
session_start();

$nomepac = $_POST[pnome];

//teste se o paciente ja existe
$nome = $POST['pnome'];
mysql_select_db($database_conSaude, $conSaude);
$query_recPac = "SELECT * FROM paciente WHERE `pnome` LIKE '$nome'";
$recPac = mysql_query($query_recPac, $conSaude) or die(mysql_error());
$row_recPac = mysql_fetch_assoc($recPac);
$totalRows_recPac = mysql_num_rows($recPac);
$nome = $row_recPac['pnome'];

if ($nome == true)
{echo "<b><script>alert('O registro não foi gravado! Já existe um paciente cadastrado com esse nome!');</script></b>";
$salvo = "O registro não foi gravado, pois já existe um paciente cadastrado com esse nome, tente as seguintes opções:<br>
 - Vá no menu Pesquisa e veja se o paciente ja esta cadastrado<br>- Use o nome completo para o cadastro!";}
else {
if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = "INSERT INTO paciente (
									pnome, prg, ptel, ptel2, prua, pnum, 
									pbairro, pcartao, pnasc, pnatur, psexo, 
									ppai, pmae, pcomp, pcep, pcadastrador
									) VALUES (
                       				'$_POST[pnome]',
                       				'$_POST[prg]',
                       				'$_POST[ptel]',
                       				'$_POST[ptel2]',
                       				'$_POST[prua]',
                       				'$_POST[pnum]',
                       				'$_POST[pbairro]',
                       				'$_POST[pcartao]',
                       				'$_POST[pnasc]',
                      				'$_POST[pnatur]',
                       				'$_POST[psexo]',
								   	'$_POST[ppai]',
								   	'$_POST[pmae]',					   					   
								   	'$_POST[pcomp]',
								   	'$_POST[pcep]',
								   	'$_SESSION[id]')"; 

  mysql_select_db($database_conSaude, $conSaude);
  $Result1 = mysql_query($insertSQL, $conSaude) or die(mysql_error());

  header("Location: cadtratamento.php?paciente=$nomepac");
}
}
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
	 <form method="post" name="form1" action="cadastrar.php" onSubmit="return valida_dados(this)">
        <table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
          <!--DWLayoutTable-->
          <tr> 
            <td width="5" height="6"></td>
            <td width="2"></td>
            <td width="73"></td>
            <td width="20"></td>
            <td width="216"></td>
            <td width="143"></td>
            <td width="4"></td>
            <td width="207"></td>
            <td width="43"></td>
            <td width="196"></td>
            <td width="83"></td>
          </tr>
          <tr> 
            <td height="19"></td>
            <td></td>
            <td colspan="3" valign="top" class="exibicao"><!-- ATENÇÃO, AVISAMOS QUE O SISTEMA ANTIGO SERÁ DESABILITADO PARA CADASTRO NO DIA 05 DE JUNHO DE 2013. <BR> A PARTIR DESSA DATA DEVERÁ SER UTILIZADO O SISTEMA DA PREFEITURA E O ANTIGO SERVIRÁ APENAS PARA CONSULTAS! (SETOR DE INFORMÁTICA) --></td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td></td>
          </tr>
          <tr> 
            <td height="7"></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
          </tr>
          <tr> 
            <td height="187"></td>
            <td colspan="5" valign="top"> <fieldset>
              <LEGEND ><font color="#000000"><strong>Nome e Endereço</strong></font></legend>
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
                  <td valign="top" class="usuario"><strong> <font color="#FF0000"><strong>*</strong></font></strong> 
                    Nome:</td>
                  <td colspan="7" valign="top" class="usuario"> <input name="pnome" type="text" value="<?php echo $HTTP_POST_VARS['pnome'] ?>" size="55" maxlength="50"> 
                  </td>
                </tr>
                <tr> 
                  <td height="22"></td>
                  <td valign="top" class="usuario"><strong> <font color="#FF0000"><strong>* 
                    </strong></font></strong>Rua:</td>
                  <td colspan="7" valign="top" class="usuario"> <input name="prua" type="text" id="prua" value="<?php echo $HTTP_POST_VARS['prua'] ?>" size="55" maxlength="50"></td>
                </tr>
                <tr> 
                  <td height="22"></td>
                  <td valign="top" class="usuario"><strong> <font color="#FF0000"><strong>* 
                    </strong></font></strong>N&deg;:</td>
                  <td valign="top" class="usuario"> <input name="pnum" type="text" id="pnum" value="<?php echo $HTTP_POST_VARS['pnum'] ?>" size="8" maxlength="8"> 
                  </td>
                  <td>&nbsp;</td>
                  <td colspan="2" valign="top" class="usuario">Complemento:</td>
                  <td>&nbsp;</td>
                  <td valign="top" class="usuario"> <input name="pcomp" type="text" id="pcomp" value="<?php echo $HTTP_POST_VARS['pcomp'] ?>"size="15" maxlength="8"></td>
                  <td>&nbsp;</td>
                </tr>
                <tr> 
                  <td height="22"></td>
                  <td valign="top" class="usuario"><strong> <font color="#FF0000"><strong>* 
                    </strong></font></strong>Bairro:</td>
                  <td colspan="3" valign="top" class="usuario"> <input name="pbairro" type="text" id="pbairro" value="<?php echo $HTTP_POST_VARS['pbairro'] ?>" size="25"></td>
                  <td>&nbsp;</td>
                  <td></td>
                  <td></td>
                  <td></td>
                </tr>
                <tr> 
                  <td height="22"></td>
                  <td valign="top" class="usuario">Cep:</td>
                  <td colspan="3" valign="top" class="usuario"> <input name="pcep" type="text" id="pcep" value="<?php echo $HTTP_POST_VARS['pcep'] ?>" size="25" maxlength="9"></td>
                  <td>&nbsp;</td>
                  <td></td>
                  <td></td>
                  <td></td>
                </tr>
                <tr> 
                  <td height="22"></td>
                  <td valign="top" class="usuario">Tel 1:</td>
                  <td colspan="4" valign="top" class="usuario"> <input name="ptel" type="text" id="ptel" value="<?php echo $HTTP_POST_VARS['ptel'] ?>" size="25"></td>
                  <td></td>
                  <td></td>
                  <td></td>
                </tr>
                <tr> 
                  <td height="22"></td>
                  <td valign="top" class="usuario">Tel 2:</td>
                  <td colspan="4" valign="top" class="usuario"> <input name="ptel2" type="text" id="ptel2" value="<?php echo $HTTP_POST_VARS['ptel2'] ?>" size="25"></td>
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
            <td colspan="3" rowspan="2" valign="top"> <fieldset>
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
                  <td valign="top" class="usuario"><strong> <font color="#FF0000"><strong>*</strong></font></strong> 
                    Cart&atilde;o SUS:</td>
                  <td>&nbsp;</td>
                  <td colspan="2" valign="top" class="usuario"> <input name="pcartao" type="text" id="pcartao" value="<?php echo $HTTP_POST_VARS['pcartao'] ?>"></td>
                  <td></td>
                  <td></td>
                </tr>
                <tr> 
                  <td height="22"></td>
                  <td valign="top" class="usuario"><strong> <font color="#FF0000"><strong>*</strong></font></strong> 
                    Identidade:</td>
                  <td>&nbsp;</td>
                  <td colspan="2" valign="top" class="usuario"> <input name="prg" type="text" id="prg" value="<?php echo $HTTP_POST_VARS['prg'] ?>"></td>
                  <td></td>
                  <td></td>
                </tr>
                <tr> 
                  <td height="22"></td>
                  <td valign="top" class="usuario"><strong> <font color="#FF0000"><strong>*</strong></font></strong> 
                    Data Nasc:</td>
                  <td>&nbsp;</td>
                  <td valign="top" class="usuario"> <input name="pnasc" type="text" id="pnasc" value="<?php echo $HTTP_POST_VARS['pnasc'] ?>" size="15"></td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                </tr>
                <tr> 
                  <td height="22"></td>
                  <td valign="top" class="usuario">Naturalidade:</td>
                  <td>&nbsp;</td>
                  <td colspan="2" valign="top" class="usuario"> <input name="pnatur" type="text" id="pnatur" value="<?php echo $HTTP_POST_VARS['pnatur'] ?>"></td>
                  <td>&nbsp;</td>
                  <td></td>
                </tr>
                <tr> 
                  <td height="22"></td>
                  <td valign="top" class="usuario"><font color="#FF0000"><strong>*</strong></font> 
                    Sexo:</td>
                  <td>&nbsp;</td>
                  <td valign="top" class="usuario"><select name="psexo" size="1" >
                      <option value="<?php echo $HTTP_POST_VARS['psexo'] ?>"> 
                      <?php 
                      echo $HTTP_POST_VARS['psexo'] ?>
                      </option>
                      <option value="M">M</option>
                      <option value="F">F</option>
                    </select> </td>
                  <td>&nbsp;</td>
                  <td></td>
                  <td></td>
                </tr>
                <tr> 
                  <td height="22"></td>
                  <td valign="top" class="usuario"><font color="#FF0000"><strong>*</strong></font> 
                    M&atilde;e:</td>
                  <td>&nbsp;</td>
                  <td colspan="3" valign="top" class="usuario"> <input name="pmae" type="text" id="pmae" value="<?php echo $HTTP_POST_VARS['pmae'] ?>" size="45" maxlength="50"></td>
                  <td>&nbsp;</td>
                </tr>
                <tr> 
                  <td height="22"></td>
                  <td valign="top" class="usuario">Pai:</td>
                  <td>&nbsp;</td>
                  <td colspan="3" valign="top" class="usuario"> <input name="ppai" type="text" id="ppai" value="<?php echo $HTTP_POST_VARS['ppai'] ?>" size="45" maxlength="50"></td>
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
            <td></td>
            <td></td>
          </tr>
          <tr> 
            <td height="15"></td>
            <td></td>
            <td colspan="6" valign="top"><strong><u><font size="2">Aten&ccedil;&atilde;o!</font></u> 
              <font size="2"><u>O</u> <u>asterisco</u> <u>vermelho</u> &quot;<font color="#FF0000">*</font>&quot; 
              <u>marca</u> <u>os</u> <u>Campos</u> <u>Obrigat&oacute;rios</u></font></strong></td>
            <td></td>
            <td></td>
            <td></td>
          </tr>
          <tr> 
            <td height="7"></td>
            <td></td>
            <td></td>
            <td></td>
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
            <td colspan="2" valign="top"><a href="busca.php" ><img src="img/voltar.gif" width="55" height="14" border="0" align="absmiddle"></a></td>
            <td></td>
            <td colspan="5" rowspan="4" valign="top" class="usuario"><?php echo $salvo;?></td>
            <td></td>
            <td></td>
          </tr>
          <tr> 
            <td height="13"></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
          </tr>
          <tr> 
            <td height="14"></td>
            <td colspan="2" valign="top"> <input name="Submit" type="image" src="img/salvar.gif" width="55" height="14"></td>
            <td></td>
            <td></td>
            <td></td>
          </tr>
          <tr> 
            <td height="15"></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
          </tr>
          <tr> 
            <td height="33"></td>
            <td></td>
            <td></td>
            <td></td>
            <td>&nbsp;</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
          </tr>
        </table>
        <input type="hidden" name="MM_insert" value="form1">
      </form></td>
  </tr>
</table>
</body>
</html>
