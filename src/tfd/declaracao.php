<?php
$id = $_GET[id];
$idint = $_GET[idint];
$valortotal = $_GET[valortotal];
?>
<?php session_start();?>
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
</head>
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr> 
    <td width="100%" height="162"><?php require_once('cabec.php');?></td>
  </tr>
  <tr>  
    <td height="375" valign="top"> <form name="form1" method="post" action="reldeclaracao.php" target="parent">
        <table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
          <!--DWLayoutTable-->
          <tr> 
            <td width="14" height="15"></td>
            <td width="594"></td>
            <td width="15"></td>
            <td width="147"></td>
            <td width="222"></td>
          </tr>
          <tr> 
            <td height="79"></td>
            <td valign="top"><fieldset>
              <LEGEND ><font color="#000000"><strong>Expecifique quem esta retirando 
              ou deixe o campo como esta preenchido:</strong></font></legend>
              <table width="100%" border="0" cellpadding="0" cellspacing="0">
                <!--DWLayoutTable-->
                <tr> 
                  <td width="24" height="25">&nbsp;</td>
                  <td width="84" valign="top" class="usuario">Nome:</td>
                  <td width="308" valign="top" class="usuario"> <input name="retirante" type="text" id="retirante" value="Respons&aacute;vel pela retirada" size="50"> 
                  </td>
                  <td width="173">&nbsp;</td>
                </tr>
                <tr> 
                  <td height="32">&nbsp;</td>
                  <td valign="top" class="usuario">RG ou CPF:</td>
                  <td valign="top"> <input name="rgoucpf" type="text" id="rgoucpf"> 
                  </td>
                  <td>&nbsp;</td>
                </tr>
                <tr> 
                  <td height="32">&nbsp;</td>
                  <td valign="top" class="usuario">Data por extenso:</td>
                  <td valign="top"> <input name="data" type="text" id="data" size="30"> 
                  </td>
                  <td>&nbsp;</td>
                </tr
              </table>
              </fieldset></td>
            <td></td>
            <td></td>
            <td></td>
          </tr>
          <tr> 
            <td height="25"></td>
            <td>&nbsp;</td>
            <td></td>
            <td></td>
            <td></td>
          </tr>
          <tr> 
            <td height="251"></td>
            <?php $valor= $valortotal;
			$valor=explode(".",$valor);
			$valor=implode(",",$valor);
           ?>
            <td rowspan="2" valign="top"> <fieldset>
              <LEGEND ><font color="#000000"><strong><font color="#990000">O valor 
              total do beneficio é <?php echo $valor; ?> discrimine a abaixo este 
              valor:</font></strong></font></legend>
              <table width="100%" border="0" cellpadding="0" cellspacing="0" class="usuario">
                <!--DWLayoutTable-->
                <tr> 
                  <td width="10" height="17"></td>
                  <td width="482"></td>
                  <td width="13"></td>
                </tr>
                <tr> 
                  <td height="30"></td>
                  <td valign="top"> <fieldset>
                    <LEGEND ><font color="#000000"><strong>Valores da Ida</strong></font></legend>
                    <table width="100%" border="0" cellpadding="0" cellspacing="0">
                      <!--DWLayoutTable-->
                      <tr> 
                        <td width="81" height="30">&nbsp;</td>
                        <td width="57" valign="top" class="usuario">N&ordm; Pass</td>
                        <td width="35" valign="top" class="usuario"> <input name="pida" type="text" id="pida" size="5"> 
                        </td>
                        <td width="10">&nbsp;</td>
                        <td width="53" valign="top" class="usuario">Valor</td>
                        <td width="149" valign="top" class="usuario"> <input name="ida" type="text" id="ida"> 
                        </td>
                        <td width="97">&nbsp;</td>
                      </tr>
                    </table>
                    </fieldset></td>
                  <td></td>
                </tr>
                <tr> 
                  <td height="13"></td>
                  <td></td>
                  <td></td>
                </tr>
                <tr> 
                  <td height="38"></td>
                  <td valign="top"><fieldset>
                    <LEGEND ><font color="#000000"><strong>Valores da Volta</strong></font></legend>
                    <table width="100%" border="0" cellpadding="0" cellspacing="0">
                      <!--DWLayoutTable-->
                      <tr> 
                        <td width="81" height="30">&nbsp;</td>
                        <td width="57" valign="top" class="usuario">N&ordm; Pass</td>
                        <td width="35" valign="top" class="usuario"> <input name="pvolta" type="text" id="pvolta" size="5"> 
                        </td>
                        <td width="10">&nbsp;</td>
                        <td width="53" valign="top" class="usuario">Valor</td>
                        <td width="149" valign="top" class="usuario"> <input name="volta" type="text" id="volta"> 
                        </td>
                        <td width="97">&nbsp;</td>
                      </tr>
                    </table>
                    </fieldset></td>
                  <td></td>
                </tr>
                <tr> 
                  <td height="17"></td>
                  <td></td>
                  <td></td>
                </tr>
                <tr> 
                  <td height="40"></td>
                  <td valign="top"><fieldset>
                    <LEGEND ><font color="#000000"><strong>Valor Alimentação</strong></font></legend>
                    <table width="100%" border="0" cellpadding="0" cellspacing="0">
                      <!--DWLayoutTable-->
                      <tr> 
                        <td width="81" height="30">&nbsp;</td>
                        <td width="57" valign="top" class="usuario">N&ordm; Pass</td>
                        <td width="35" valign="top" class="usuario"> <input name="palimentacao" type="text" id="palimentacao" size="5"> 
                        </td>
                        <td width="10">&nbsp;</td>
                        <td width="53" valign="top" class="usuario">Valor</td>
                        <td width="149" valign="top" class="usuario"> <input name="alimentacao" type="text" id="alimentacao"> 
                        </td>
                        <td width="97">&nbsp;</td>
                      </tr>
                    </table>
                    </fieldset></td>
                  <td></td>
                </tr>
                <tr> 
                  <td height="14"></td>
                  <td></td>
                  <td></td>
                </tr>
                <tr> 
                  <td height="40"></td>
                  <td valign="top"><fieldset>
                    <LEGEND ><font color="#000000"><strong>Valor Deslocamento</strong></font></legend>
                    <table width="100%" border="0" cellpadding="0" cellspacing="0">
                      <!--DWLayoutTable-->
                      <tr> 
                        <td width="81" height="30">&nbsp;</td>
                        <td width="57" valign="top" class="usuario">N&ordm; Pass</td>
                        <td width="35" valign="top" class="usuario"> <input name="pdeslocamento" type="text" id="pdeslocamento" size="5"> 
                        </td>
                        <td width="10">&nbsp;</td>
                        <td width="53" valign="top" class="usuario">Valor</td>
                        <td width="149" valign="top" class="usuario"> <input name="deslocamento" type="text" id="deslocamento"> 
                        </td>
                        <td width="97">&nbsp;</td>
                      </tr>
                    </table>
                    </fieldset></td>
                  <td></td>
                </tr>
                <tr> 
                  <td height="20"></td>
                  <td>&nbsp;</td>
                  <td></td>
                </tr>
              </table>
              </fieldset></td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr> 
            <td height="29"></td>
            <td>&nbsp;</td>
            <td valign="top"> <input type="hidden" name="id" value="<?php echo $id ?>"> 
              <input type="hidden" name="idint" value="<?php echo $idint ?>"> 
              <input type="submit" name="Submit" value="Prosseguir"> </td>
            <td>&nbsp;</td>
          </tr>
          <tr> 
            <td height="42"></td>
            <td>&nbsp;</td>
            <td></td>
            <td></td>
            <td></td>
          </tr>
        </table>
      </form></td>
  </tr>
</table>
</body>
</html>
