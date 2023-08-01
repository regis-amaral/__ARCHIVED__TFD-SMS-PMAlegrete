<?php require_once('Connections/conSaude.php'); ?>
<?php session_start();?>
<?php
$int = $_GET[idint];
$id = $HTTP_POST_VARS['idpac'];
mysql_select_db($database_conSaude, $conSaude);
$query_recInternacao = "SELECT * FROM internacao WHERE `idint` LIKE '$int'";
$recInternacao = mysql_query($query_recInternacao, $conSaude) or die(mysql_error());
$row_recInternacao = mysql_fetch_assoc($recInternacao);
$totalRows_recInternacao = mysql_num_rows($recInternacao);

//pesquisa de registros
mysql_select_db($database_conSaude, $conSaude);
$query_recPac = "SELECT * FROM paciente WHERE `pnome` LIKE '$id'";
$recPac = mysql_query($query_recPac, $conSaude) or die(mysql_error());
$row_recPac = mysql_fetch_assoc($recPac);
$totalRows_recPac = mysql_num_rows($recPac);

$query_recMedico = "SELECT * FROM medicos ORDER BY nome ASC";
$recMedico = mysql_query($query_recMedico, $conSaude) or die(mysql_error());
$row_recMedico = mysql_fetch_assoc($recMedico);
$totalRows_recMedico = mysql_num_rows($recMedico);

$query_rechospital = "SELECT * FROM hospital ORDER BY hospital ASC";
$rechospital = mysql_query($query_rechospital, $conSaude) or die(mysql_error());
$row_rechospital = mysql_fetch_assoc($rechospital);
$totalRows_rechospital = mysql_num_rows($rechospital);

$query_reccidade = "SELECT * FROM cidade ORDER BY nome ASC";
$reccidade = mysql_query($query_reccidade, $conSaude) or die(mysql_error());
$row_reccidade = mysql_fetch_assoc($reccidade);
$totalRows_reccidade = mysql_num_rows($reccidade);

$query_recEspecialidade = "SELECT * FROM especialidades ORDER BY especialidade ASC";
$recEspecialidade = mysql_query($query_recEspecialidade, $conSaude) or die(mysql_error());
$row_recEspecialidade = mysql_fetch_assoc($recEspecialidade);
$totalRows_recEspecialidade = mysql_num_rows($recEspecialidade);

$query_recExame = "SELECT * FROM exames ORDER BY exame ASC";
$recExame = mysql_query($query_recExame, $conSaude) or die(mysql_error());
$row_recExame = mysql_fetch_assoc($recExame);
$totalRows_recExame = mysql_num_rows($recExame);

// posição do aguardo por especialidade
if($row_recInternacao[especialidade]=="! Não Especificada !"){$esp=NULL;}else{$esp=$row_recInternacao[especialidade];}
$query_recColocacao = "SELECT * FROM internacao WHERE istatus = 'pendente' and especialidade='$esp' ORDER BY 'eano', 'emes', 'edia', 'idint'";
$recColocacao = mysql_query($query_recColocacao, $conSaude) or die(mysql_error());
$row_recColocacao = mysql_fetch_assoc($recColocacao);
$totalRows_recColocacao = mysql_num_rows($recColocacao);
  $row = mysql_num_rows($recColocacao); 
  $inicio = 0;
  $fim = $row;
  $idint2=$row_recInternacao[idint];//id da internacao do usuario selecionado
		for ($i=$inicio; $i<$fim; $i++){
		$idint = mysql_result($recColocacao, $i, "idint");
		if ($idint==$idint2) {$id=$i+1;}
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
    <td height="375" valign="top"> <table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">

    <!--DWLayoutTable-->
    <tr> 
      <td width="10" height="21">&nbsp;</td>
      <td width="871">&nbsp;</td>
      <td width="432">&nbsp;</td>
    </tr>
    <tr> 
      <td height="382">&nbsp;</td>
      <td valign="top"> <fieldset>
        <LEGEND ><font color="#000000"><strong>Visualizando Movimenta&ccedil;&atilde;o</strong></font></legend>
        <form method="post" name="form1" action="<?php echo $editFormAction; ?>">
          <table width="100%" border="0" cellpadding="0" cellspacing="0">
            <!--DWLayoutTable-->
            <tr> 
              <td width="9" height="294">&nbsp;</td>
              <td width="355" valign="top"> <fieldset>
                <LEGEND ><font color="#000000"><strong>Entrada de Documentos</strong></font></legend>
                    <table width="355" border="0" cellpadding="0" cellspacing="0">
                      <!--DWLayoutTable-->
                      <tr> 
                        <td width="6" height="24">&nbsp;</td>
                        <td width="86" valign="top">Data</td>
                        <td colspan="7" valign="top"><input name="textfield42" type="text" value="<?php echo $row_recInternacao['edia']; ?>" size="2" readonly="true"> 
                          <input name="textfield52" type="text" value="<?php echo $row_recInternacao['emes']; ?>" size="8" readonly="true"> 
                          <input name="textfield62" type="text" value="<?php echo $row_recInternacao['eano']; ?>" size="3" readonly="true"></td>
                        <td width="23">&nbsp;</td>
                      </tr>
                      <tr> 
                        <td height="24"></td>
                        <td valign="top">Tipo </td>
                        <td colspan="4" valign="top"><input name="textfield12" type="text" value="<?php echo $row_recInternacao['itipo']; ?>" readonly="true"></td>
                        <td width="6">&nbsp;</td>
                        <td width="2"></td>
                        <td width="13"></td>
                        <td></td>
                      </tr>
                      <tr> 
                        <td height="24"></td>
                        <td valign="top">Especialidade</td>
                        <td colspan="7" valign="top"><input name="textfield11" type="text" value="<?php echo $row_recInternacao['especialidade']; ?>" size="40" readonly="true"></td>
                        <td>&nbsp;</td>
                      </tr>
                      <tr> 
                        <td height="24"></td>
                        <td valign="top">Exame</td>
                        <td colspan="7" valign="top"> <input name="textfield10" type="text" value="<?php echo $row_recInternacao['exame']; ?>" size="40" readonly="true"></td>
                        <td></td>
                      </tr>
                      <tr> 
                        <td height="24"></td>
                        <td valign="top">Cidade</td>
                        <td colspan="7" valign="top"> <input name="textfield9" type="text" value="<?php echo $row_recInternacao['icidade']; ?>" size="40" readonly="true"></td>
                        <td>&nbsp;</td>
                      </tr>
                      <tr> 
                        <td height="1"></td>
                        <td></td>
                        <td width="1"></td>
                        <td width="50"></td>
                        <td width="2"></td>
                        <td width="166"></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                      </tr>
                      <tr> 
                        <td height="24" colspan="10" valign="top"><hr align="center"></td>
                      </tr>
                      <tr> 
                        <td height="24"></td>
                        <td valign="top">Status</td>
                        <td>&nbsp;</td>
                        <td colspan="5" valign="top"><input name="textfield8" type="text" value="<?php echo $row_recInternacao['istatus']; ?>" readonly="true"></td>
                        <td></td>
                        <td></td>
                      </tr>
                      <tr> 
                        <td height="24"></td>
                        <td colspan="3" valign="top">Grau de Urg&ecirc;ncia </td>
                        <td>&nbsp;</td>
                        <td colspan="3" valign="top"><input name="textfield7" type="text" value="<?php echo $row_recInternacao['urgencia']; ?>" readonly="true"></td>
                        <td>&nbsp;</td>
                        <td></td>
                      </tr>
                      <tr> 
                        <td height="22"></td>
                        <?php if ($id==true) { ?>
                        <td colspan="3" valign="top">Posi&ccedil;&atilde;o de 
                          Aguardo </td>
                        <td colspan="3" valign="top"><?php echo $id;?>º</td>
                        <?php } ?>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td></td>
                      </tr>
                      <tr> 
                        <td height="19"></td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td></td>
                        <td></td>
                        <td></td>
                      </tr>
                      <tr>
                        <td height="21"></td>
                        <td colspan="6" valign="top"><?php if ($row_recInternacao['observacao'] == true) {echo "1 - Observação";} else {echo "Não há observação!";}?></td>
                        <td></td>
                        <td></td>
                        <td></td>
                      </tr>
                      <tr>
                        <td height="20"></td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td></td>
                        <td></td>
                        <td></td>
                      </tr>
                    </table>
                </fieldset></td>
              <td width="5">&nbsp;</td>
              <td colspan="3" valign="top"> <fieldset>
                <LEGEND ><font color="#000000"><strong>Saída para Viagem</strong></font></legend>
                    <table width="480" border="0" cellpadding="0" cellspacing="0">
                      <!--DWLayoutTable-->
                      <tr> 
                        <td width="4" height="24">&nbsp;</td>
                        <td width="164" valign="top">Data</td>
                        <td width="19">&nbsp;</td>
                        <td colspan="3" valign="top"><input name="textfield4" type="text" value="<?php echo $row_recInternacao['idia']; ?>" size="5" readonly="true"> 
                          <input name="textfield5" type="text" value="<?php echo $row_recInternacao['imes']; ?>" size="15" readonly="true"> 
                          <input name="textfield6" type="text" value="<?php echo $row_recInternacao['iano']; ?>" size="10" readonly="true"> 
                        </td>
                        <td width="3">&nbsp;</td>
                        <td width="9">&nbsp;</td>
                      </tr>
                      <tr> 
                        <td height="24">&nbsp;</td>
                        <td valign="top">Hospital</td>
                        <td></td>
                        <td colspan="4" valign="top"> <input name="textfield3" type="text" value="<?php echo $row_recInternacao['ihospital']; ?>" size="50" readonly="true"> 
                        </td>
                        <td>&nbsp;</td>
                      </tr>
                      <tr> 
                        <td height="24">&nbsp;</td>
                        <td valign="top">Sala</td>
                        <td></td>
                        <td colspan="4" valign="top"><input name="sala" type="text" id="sala" value="<?php echo $row_recInternacao['sala']; ?>" size="10" readonly="true">
                          Hora 
                          <input name="ihora" type="text" id="ihora" value="<?php echo $row_recInternacao['ihora']; ?>" size="15" readonly="true"></td>
                        <td>&nbsp;</td>
                      </tr>
                      <tr> 
                        <td height="24">&nbsp;</td>
                        <td valign="top">Profissional</td>
                        <td></td>
                        <td colspan="4" valign="top"> <input name="textfield2" type="text" value="<?php echo $row_recInternacao['medico']; ?>" size="50" readonly="true"> 
                        </td>
                        <td>&nbsp;</td>
                      </tr>
                      <tr> 
                        <td height="24">&nbsp;</td>
                        <td valign="top">Origem da Consulta</td>
                        <td></td>
                        <td colspan="4" valign="top"> <input name="textfield" type="text" value="<?php echo $row_recInternacao['origemconsulta']; ?>" size="50" readonly="true"></td>
                        <td>&nbsp;</td>
                      </tr>
                      <tr> 
                        <td height="22">&nbsp;</td>
                        <td valign="top">N&deg; Agendamento</td>
                        <td></td>
                        <td colspan="2" valign="top"><input name="numeroagend" type="text" id="numeroagend" value="<?php echo $row_recInternacao['numeroagend']; ?>" size="20" readonly="true"></td>
                        <td colspan="2" valign="top">Sequ&ecirc;ncia 
                          <input name="sequencia" type="text" id="sequencia2" value="<?php echo $row_recInternacao['sequencia']; ?>" size="5" readonly="true"<?php echo $autorizacao?>></td>
                        <td></td>
                      </tr>
                      <tr> 
                        <td height="24">&nbsp;</td>
                        <td valign="top">Pagantes</td>
                        <td></td>
                        <?php 
			$valor=$row_recInternacao['ivalor'];
			$valor=explode(".",$valor);
			$valor=implode(",",$valor);
			
			?>
                        <td colspan="4" valign="top"> <input name="ipagantes" type="text" value="<?php echo $row_recInternacao['ipagantes']; ?>" size="2" readonly="true">
                          Valor Passagem 
                          <input name="ivalor" type="text" id="ivalor" value="<?php echo $valor; ?>" size="15" readonly="true"></td>
                        <td></td>
                      </tr>
                      <tr> 
                        <td height="24">&nbsp;</td>
                        <td valign="top">Valor por Extenso</td>
                        <td>&nbsp;</td>
                        <td colspan="4" valign="top"><input name="ivalorextenso2" type="text" id="ivalorextenso4" value="<?php echo $row_recInternacao['ivalorextenso']; ?>" size="50" readonly="true"> 
                        </td>
                        <td>&nbsp;</td>
                      </tr>
                      <tr> 
                        <td height="24">&nbsp;</td>
                        <td valign="top">Acompanhante 1</td>
                        <td></td>
                        <td colspan="4" valign="top"><input name="ivalorextenso" type="text" id="ivalorextenso3" value="<?php echo $row_recInternacao['iacompanhante']; ?>" size="50" readonly="true"> 
                        </td>
                        <td>&nbsp;</td>
                      </tr>
                      <tr> 
                        <td height="24">&nbsp;</td>
                        <td valign="top">Acompanhante 2</td>
                        <td></td>
                        <td colspan="4" valign="top"> <input name="iacompanhante22" type="text" id="iacompanhante223" value="<?php echo $row_recInternacao['iacompanhante2']; ?>" size="50" maxlength="50" readonly="true"></td>
                        <td>&nbsp;</td>
                      </tr>
                      <tr> 
                        <td height="24">&nbsp;</td>
                        <td valign="top">Retorno</td>
                        <td></td>
                        <td width="93" valign="top"> <input name="iretorno" type="text" id="iretorno2" value="<?php echo $row_recInternacao['iretorno']; ?>" size="15" readonly="true"> 
                        </td>
                        <td width="32">&nbsp;</td>
                        <td width="175"></td>
                        <td></td>
                        <td></td>
                      </tr>
                      <tr> 
                        <td height="11"></td>
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
              <td width="24">&nbsp;</td>
            </tr>
            <tr> 
              <td height="8"></td>
              <td></td>
              <td></td>
              <td width="236"></td>
              <td width="62"></td>
              <td width="182"></td>
              <td></td>
            </tr>
            <tr> 
              <td height="14"></td>
              <td></td>
              <td></td>
              <td></td>
              <td valign="top"> <a href="paciente.php?id=<?php echo $row_recInternacao['idpac']; ?>" > 
                </a><a href="paciente.php?id=<?php echo $row_recInternacao['idpac']; ?>" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image3','','img/voltar2.gif',1)"><img src="img/voltar.gif" name="Image3" width="55" height="14" border="0" align="top"></a><a href="delinternacao.php?inter=<?php echo $row_recInternacao['idint']; ?>&pac=<?php echo $row_recInternacao['idpac']; ?>" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image4','','img/excluir2.gif',1)"> 
                </a> </td>
              <td></td>
              <td></td>
            </tr>
            <tr> 
              <td height="11"></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
            </tr>
          </table>
          <input type="hidden" name="MM_update" value="form1">
          <input type="hidden" name="idint" value="<?php echo $row_recInternacao['idint']; ?>">
        </form>
        </fieldset></td>
      <td>&nbsp;</td>
    </tr>
    <tr> 
      <td height="39">&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
  </table></td></tr>
</table>
</body>
</html>
<?php
mysql_free_result($recPac);

mysql_free_result($recMedico);

mysql_free_result($rechospital);

mysql_free_result($reccidade);

mysql_free_result($recEspecialidade);

mysql_free_result($recExame);

?>