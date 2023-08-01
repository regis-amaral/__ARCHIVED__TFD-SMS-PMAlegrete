<?php require_once('Connections/conSaude.php'); ?>
<?php session_start(); ?>
<?php

$id = $_GET[id];
$maxRows_recPaciente = 1;
$pageNum_recPaciente = 0;
if (isset($HTTP_GET_VARS['pageNum_recPaciente'])) {
  $pageNum_recPaciente = $HTTP_GET_VARS['pageNum_recPaciente'];
}
$startRow_recPaciente = $pageNum_recPaciente * $maxRows_recPaciente;

mysql_select_db($database_conSaude, $conSaude);
$query_recPaciente = "SELECT * FROM paciente WHERE idp LIKE '$id'";
$query_limit_recPaciente = sprintf("%s LIMIT %d, %d", $query_recPaciente, $startRow_recPaciente, $maxRows_recPaciente);
$recPaciente = mysql_query($query_limit_recPaciente, $conSaude) or die(mysql_error());
$row_recPaciente = mysql_fetch_assoc($recPaciente);

if (isset($HTTP_GET_VARS['totalRows_recPaciente'])) {
  $totalRows_recPaciente = $HTTP_GET_VARS['totalRows_recPaciente'];
} else {
  $all_recPaciente = mysql_query($query_recPaciente);
  $totalRows_recPaciente = mysql_num_rows($all_recPaciente);
}
$totalPages_recPaciente = ceil($totalRows_recPaciente/$maxRows_recPaciente)-1;

$maxRows_recInternacao = 50;
$pageNum_recInternacao = 0;
if (isset($HTTP_GET_VARS['pageNum_recInternacao'])) {
  $pageNum_recInternacao = $HTTP_GET_VARS['pageNum_recInternacao'];
}
$startRow_recInternacao = $pageNum_recInternacao * $maxRows_recInternacao;

mysql_select_db($database_conSaude, $conSaude);
$query_recInternacao = "SELECT * FROM internacao WHERE `idpac` LIKE '$id' order by `iano` DESC";
$query_limit_recInternacao = sprintf("%s LIMIT %d, %d", $query_recInternacao, $startRow_recInternacao, $maxRows_recInternacao);
$recInternacao = mysql_query($query_limit_recInternacao, $conSaude) or die(mysql_error());
$row_recInternacao = mysql_fetch_assoc($recInternacao);

if (isset($HTTP_GET_VARS['totalRows_recInternacao'])) {
  $totalRows_recInternacao = $HTTP_GET_VARS['totalRows_recInternacao'];
} else {
  $all_recInternacao = mysql_query($query_recInternacao);
  $totalRows_recInternacao = mysql_num_rows($all_recInternacao);
}
$totalPages_recInternacao = ceil($totalRows_recInternacao/$maxRows_recInternacao)-1;

mysql_select_db($database_conSaude, $conSaude);
$query_rechospital = "SELECT * FROM hospital";
$rechospital = mysql_query($query_rechospital, $conSaude) or die(mysql_error());
$row_rechospital = mysql_fetch_assoc($rechospital);
$totalRows_rechospital = mysql_num_rows($rechospital);


## alteração: obriga a digitacao dos dados obrigatorios em pacientes com cadastro antigo

if($row_recPaciente['pnome']!='' 
&& $row_recPaciente['prua']!='' 
&& $row_recPaciente['pnum']!='' 
&& $row_recPaciente['pbairro']!=''
&& $row_recPaciente['pcartao']!=''
&& $row_recPaciente['pnasc']!='' 
&& $row_recPaciente['psexo']!='' 
&& $row_recPaciente['pmae']!=''){$completarCadastro=0;}else{$completarCadastro=1;}
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


function completarCadastro(){
if(confirm("Para prosseguir complete os dados do paciente com os campos obrigatórios! \n \nDeseja Prosseguir?")){
window.location="alterar.php?id=<?php echo $row_recPaciente['idp']; ?>";
return false;
}else{
return false;
}
}
</script>
<link href="exibicao.css" rel="stylesheet" type="text/css">
<link href="tabelas.css" rel="stylesheet" type="text/css">
<style type="text/css" name="st">
td div {
height: 180px;
overflow-y: scroll /* overflow-x: scroll; = abaixo overflow-y: scroll; = direita e overflow: scroll; nas duas, depois tem hidden e auto*/
}
</style>
<style type="text/css" name="st">
fieldset {
border: 1px solid #1703D1;
}
</style>
<link href="exibicao.css" rel="stylesheet" type="text/css">
</head>
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" onLoad="MM_preloadImages('img/alterar2.gif','img/imprimirdeclaracao2.gif','img/inserirtratamento2.gif','img/imprimiragendamento2.gif')">
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr> 
    <td width="100%" height="162"><?php require_once('cabec.php');?></td>
  </tr>
  <tr> 
    <td height="375" valign="top"> <fieldset>
      <LEGEND ><font color="#000000"><strong><?php echo $row_recPaciente['idp']; ?> 
      - <?php echo $row_recPaciente['pnome']; ?></strong></font></legend>
      <table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
        <!--DWLayoutTable-->
        <tr> 
          <td height="117" colspan="3" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0">
              <!--DWLayoutTable-->
              <tr> 
                <td width="4" height="9"></td>
                <td width="370"></td>
                <td width="8"></td>
                <td width="394"></td>
                <td width="13"></td>
                <td width="55"></td>
                <td width="148"></td>
              </tr>
              <tr> 
                <td height="80"></td>
                <td rowspan="4" valign="top"> <fieldset>
                  <LEGEND ><font color="#000000"><strong>Endereço</strong></font></legend>
                  <table width="367" border="0" cellpadding="0" cellspacing="0">
                    <!--DWLayoutTable-->
                    <tr> 
                      <td width="9" height="21">&nbsp;</td>
                      <td colspan="2" valign="top" class="usuario"> 
                        <?php if ($row_recPaciente['prua'] == NULL) {echo "- - - - - - - - - -  - -";} else {echo $row_recPaciente['prua'];} ?>
                        N&deg; 
                        <?php if ($row_recPaciente['pnum'] == NULL) {echo "- - - - - - - - - -  - -";} else {echo $row_recPaciente['pnum'];} ?>
                      </td>
                    </tr>
                    <tr> 
                      <td height="21"></td>
                      <td colspan="2" valign="top" class="usuario"> 
                        <?php if ($row_recPaciente['pbairro'] == NULL) {echo "- - - - - - - - - -  - -";} else {echo $row_recPaciente['pbairro'];} ?>
                        Cep: 
                        <?php if ($row_recPaciente['pcep'] == NULL) {echo "- - - - - - - - - -  - -";} else {echo $row_recPaciente['pcep'];} ?>
                      </td>
                    </tr>
                    <tr> 
                      <td height="21"></td>
                      <td width="151" valign="top" class="usuario">Tel 1: 
                        <?php if ($row_recPaciente['ptel'] == NULL) {echo "- - - - - - - - - -  - -";} else {echo $row_recPaciente['ptel'];} ?>
                      </td>
                      <td width="207"></td>
                    </tr>
                    <tr> 
                      <td height="21"></td>
                      <td valign="top" class="usuario">Tel 2: 
                        <?php if ($row_recPaciente['ptel2'] == NULL) {echo "- - - - - - - - - -  - -";} else {echo $row_recPaciente['ptel2'];} ?>
                      </td>
                      <td></td>
                    </tr>
                    <tr> 
                      <td height="1"></td>
                      <td></td>
                      <td></td>
                    </tr>
                  </table>
                  </fieldset></td>
                <td>&nbsp;</td>
                <td rowspan="3" valign="top"> <fieldset>
                  <LEGEND ><font color="#000000"><strong>Dados Pessoais</strong></font></legend>
                  <table width="100%" border="0" cellpadding="0" cellspacing="0">
                    <!--DWLayoutTable-->
                    <tr> 
                      <td width="5" height="21">&nbsp;</td>
                      <td colspan="2" valign="top" class="usuario">Cart&atilde;o 
                        SUS: 
                        <?php if ($row_recPaciente['pcartao'] == NULL) {echo "-  - - - - - - - -  - -";} else {echo $row_recPaciente['pcartao'];} ?>
                      </td>
                      <td colspan="3" valign="top" class="usuario">Identidade: 
                        <?php if ($row_recPaciente['prg'] == NULL) {echo "- - - - - - - - - -  - -";} else {echo $row_recPaciente['prg'];} ?>
                      </td>
                    </tr>
                    <tr> 
                      <td height="21"></td>
                      <td width="140" valign="top" class="usuario">Data Nasc: 
                        <?php if ($row_recPaciente['pnasc'] == NULL) {echo "- - - - - ";} else {echo $row_recPaciente['pnasc'];} ?>
                      </td>
                      <td colspan="3" valign="top" class="usuario">Naturalidade: 
                        <?php if ($row_recPaciente['pnatur'] == NULL) {echo "- - - - - - - ";} else {echo $row_recPaciente['pnatur'];} ?>
                      </td>
                      <td width="74" valign="top" class="usuario">Sexo: 
                        <?php if ($row_recPaciente['psexo'] == NULL) {echo "- - ";} else {echo $row_recPaciente['psexo'];} ?>
                      </td>
                    </tr>
                    <tr> 
                      <td height="21"></td>
                      <td colspan="3" valign="top" class="usuario">M&atilde;e: 
                        <?php if ($row_recPaciente['pmae'] == NULL) {echo "- - - - - - - - - -  - -";} else {echo $row_recPaciente['pmae'];} ?>
                      </td>
                      <td width="46"></td>
                      <td></td>
                    </tr>
                    <tr> 
                      <td height="21"></td>
                      <td colspan="3" valign="top" class="usuario">Pai: 
                        <?php if ($row_recPaciente['ppai'] == NULL) {echo "- - - - - - - - - -  - -";} else {echo $row_recPaciente['ppai'];} ?>
                      </td>
                      <td></td>
                      <td></td>
                    </tr>
                    <tr> 
                      <td height="1"></td>
                      <td></td>
                      <td width="61"></td>
                      <td width="63"></td>
                      <td></td>
                      <td></td>
                    </tr>
                  </table>
                  </fieldset></td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
              </tr>
              <tr> 
                <td height="14"></td>
                <td></td>
                <td></td>
                <td valign="top"><a href="alterar.php?id=<?php echo $row_recPaciente['idp']; ?>" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image7','','img/alterar2.gif',1)"><img src="img/alterar.gif" name="Image7" width="55" height="14" border="0"></a></td>
                <td></td>
              </tr>
              <tr> 
                <td height="11"></td>
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
              </tr>
            </table></td>
        </tr>
        <tr> 
          <td width="5" height="6"></td>
          <td width="977"></td>
          <td width="10"></td>
        </tr>
        <tr> 
          <td height="150"></td>
          <td valign="top"> <fieldset>
            <LEGEND ><font color="#000000"><strong>Tratamentos</strong></font></legend>
            <table width="100%"  height="15" border="0" cellpadding="0" cellspacing="0" bgcolor="#E0E0E0" >
              <!--DWLayoutTable-->
              <tr> 
                <td width="6" height="21">&nbsp;</td>
                <td width="55" valign="top" bgcolor="#E0E0E0" class="cabectabelas" > 
                  Data Entrada</td>
                <td width="55" valign="top" bgcolor="#E0E0E0" class="cabectabelas">Data 
                  Saida.</td>
                <td width="87" valign="top" bgcolor="#E0E0E0" class="cabectabelas" >&nbsp;&nbsp;Tipo</td>
                <td width="170" valign="top" bgcolor="#E0E0E0" class="cabectabelas" >&nbsp;&nbsp;Hospital</td>
                <td width="9" >&nbsp;</td>
                <td width="109" valign="top" bgcolor="#E0E0E0" class="cabectabelas" >&nbsp;&nbsp;Cidade</td>
                <td width="9" >&nbsp;</td>
                <td width="189" valign="top" bgcolor="#E0E0E0" class="cabectabelas" >&nbsp;&nbsp;Status</td>
                <td width="92" valign="top" bgcolor="#E0E0E0" class="cabectabelas" >&nbsp;&nbsp;Opções 
                  <br> </td>
                <td width="18" >&nbsp;</td>
                <td width="149" valign="top" class="cabectabelas"><a href="cadtratamento.php?paciente=<?php echo $row_recPaciente['pnome']; ?>" <?php if($completarCadastro==1){echo "onClick=\"return completarCadastro()\"";}?> onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image8','','img/inserirtratamento2.gif',1)"><img src="img/inserirtratamento.gif" name="Image8" width="130" height="14" border="0" align="bottom"></a> 
                </td>
                <td width="20">&nbsp;</td>
            </table>
            <div> 
              <?php if($row_recInternacao==true){?>
              <table width="100%" border="0" cellpadding="0" cellspacing="0"  bgcolor="#FFFFFF">
                <!--DWLayoutTable-->
                <?php do { ?>
                <tr> 
                  <td width="55" height="21" align="center" valign="top" class="tabelas"><?php echo $row_recInternacao['edia']; ?>/ 
                    <?php echo $row_recInternacao['emes'];?> /<?php echo $row_recInternacao['eano']; ?></td>
                  <td width="55" valign="top" class="tabelas"><?php echo $row_recInternacao['idia']; ?>/ 
                    <?php
				switch($row_recInternacao['imes']){ 
				case "Janeiro": $mes3 = "01";     break;
              	case "Fevereiro": $mes3 = "02";   break;
              	case "Março": $mes3 = "03";       break;
              	case "Abril": $mes3 = "04";       break;
              	case "Maio": $mes3 = "05";        break;
             	case "Junho": $mes3 = "06";       break;
              	case "Julho": $mes3 = "07";       break;
              	case "Agosto": $mes3 = "08";      break;
              	case "Setembro": $mes3 = "09";    break;
              	case "Outubro": $mes3 = "10";     break;
             	case "Novembro": $mes3 = "11";    break;
             	case "Dezembro": $mes3 = "12";    break;
	    		}
				 echo $mes3?>
                    /<?php echo $row_recInternacao['iano']; ?> </td>
                  <td width="58" valign="top" class="tabelas"> 
                    <?php if ($row_recInternacao['itipo'] == NULL) {echo "- - - -  - -";} else {echo $row_recInternacao['itipo'];} ?>
                  </td>
                  <td width="206" valign="top" class="tabelas"> 
                    <?php if ($row_recInternacao['ihospital'] == NULL) {echo "- - - - - - - - - -  - -";} else {echo $row_recInternacao['ihospital'];} ?>
                  </td>
                  <td width="112" valign="top" class="tabelas"> 
                    <?php 
				  	$hospital = $row_recInternacao['ihospital'];
				  	$query_recCid = "SELECT * FROM hospital WHERE `hospital`='$hospital'";
					$recCid = mysql_query($query_recCid, $conSaude) or die(mysql_error());
					$row_recCid = mysql_fetch_assoc($recCid);
					if ($row_recCid['cidade']==true){echo  $row_recCid['cidade'];}
					if ($hospital==true){$hospital;}else{echo "----------------------";}

					 ?>
                  </td>
                  <td width="188" valign="top" class="tabelas"> 
                    <?php if ($row_recInternacao['istatus'] == NULL) {echo "- - - - - - - - - -  - -";} else {echo $row_recInternacao['istatus'];} ?>
                  </td>
                  <td width="303" valign="top" class="tabboton" > <a href="consulta.php?idint=<?php echo $row_recInternacao['idint']; ?>"><img src="img/consultar.gif" border="0" align="absmiddle"></a>
                    <a href="alterartratamento.php?idint=<?php echo $row_recInternacao['idint'];?>&id=<?php echo $row_recPaciente['idp']; ?>"><img src="img/alterar.gif" name="Image1" border="0" align="absmiddle"></a>
                    <a href="" onClick="window.open('declaracao.php?id=<?php echo $row_recInternacao['idpac']; ?>&idint=<?php echo $row_recInternacao['idint']; ?>&valortotal=<?php echo $row_recInternacao['ivalor']; ?>','Janela','toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=no,left=120,top=25'); return false;"><img src="img/imprimirdeclaracao.gif" name="Image6" border="0" align="absmiddle"></a>
                    <a href="" onClick="window.open('agendamento.php?paciente=<?php echo $row_recPaciente['idp']; ?>&internacao=<?php echo $row_recInternacao['idint']; ?>','Janela','toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=no,width=900,height=900,left=120,top=25'); return false;"><img src="img/imprimiragendamento.gif" name="Image9" border="0" align="absmiddle"></a> 
                  </td>
                  <?php } while ($row_recInternacao = mysql_fetch_assoc($recInternacao)); ?>
              </table>
              <?php } else { ?>
              <table width="100%" border="0" cellpadding="0" cellspacing="0"  bgcolor="#FFFFFF">
                <tr> 
                  <td width="100%" height="21" align="center" valign="top" class="tabelas"> 
                    O paciente não tem nenhum registro de tratamento, para inserir 
                    um novo tratamento clique em <strong><a href="cadtratamento.php?paciente=<?php echo $row_recPaciente['pnome']; ?>">inserir 
                    tratamento</a></strong></td>
              </table>
              <?php } ?>
            </div>
            </fieldset></td>
          <td></td>
        </tr>
      </table>
      </fieldset></td>
  </tr>
</table>
</body>
</html>
<?php
mysql_free_result($recPaciente);

mysql_free_result($recInternacao);

mysql_free_result($rechospital);
?>