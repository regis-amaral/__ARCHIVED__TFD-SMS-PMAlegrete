<?php require_once('Connections/conSaude.php'); ?>
<?php $pagina = "alterartratamento.php"?>
<?php 
$idint = $_GET[idint];
$id2 = $_GET[id];
$id = $_GET[id];
include_once('verifica.php');
session_start();
switch($_SESSION["login"])
  {case "arthur": $autorizacao=''; break;
  case "regis": $autorizacao=''; break;
  case "catia": $autorizacao=''; break;
  default : $autorizacao="disabled";
  }
//$autorizacao=NULL;
?>
<?php

//teste se concluido
if ($_POST[idia]==true or $_POST[imes]==true or	$_POST[iano]==true)
{$_POST[istatus]="Concluído";}
//
$int = $_GET['idint'];
$id = $_POST['idpac'];

$valorgrav=$_POST['ivalor'];
$valorgrav=explode(",",$valorgrav);
$valorgrav=implode(".",$valorgrav);
$teste=$_POST['idpac'];
$cadastrador=$_SESSION["id"];

if($teste!=NULL){if($autorizacao==NULL){	
								$updateSQL = "UPDATE internacao SET 
								ivalor=$valorgrav,
								ivalorextenso='$_POST[ivalorextenso]', 
								icidade='$_POST[icidade]', 
								ihospital='$_POST[ihospital]', 
								ihora='$_POST[ihora]', 
								iretorno='$_POST[iretorno]', 
								iacompanhante='$_POST[iacompanhante]', 
								iacompanhante2='$_POST[iacompanhante2]', 
								ipagantes='$_POST[ipagantes]', 
								idia='$_POST[idia]', 
								imes='$_POST[imes]', 
								iano='$_POST[iano]', 
								itipo='$_POST[itipo]', 
								istatus='$_POST[istatus]', 
								edia='$_POST[edia]', 
								emes='$_POST[emes]', 
								eano='$_POST[eano]', 
								exame='$_POST[exame]', 
								especialidade='$_POST[especialidade]', 
								sala='$_POST[sala]', 
								medico='$_POST[medico]', 
								origemconsulta='$_POST[origemconsulta]', 
								urgencia='$_POST[urgencia]', 
								numeroagend='$_POST[numeroagend]', 
								sequencia='$_POST[sequencia]',
								cadastrador='$cadastrador'
								WHERE idint=$_POST[idint]";
							} else {
								$updateSQL = "UPDATE internacao SET 
								icidade='$_POST[icidade]', 
								ihospital='$_POST[ihospital]', 
								ihora='$_POST[ihora]', 
								iretorno='$_POST[iretorno]', 
								iacompanhante='$_POST[iacompanhante]', 
								iacompanhante2='$_POST[iacompanhante2]', 
								ipagantes='$_POST[ipagantes]', 
								idia='$_POST[idia]', 
								imes='$_POST[imes]', 
								iano='$_POST[iano]', 
								itipo='$_POST[itipo]', 
								istatus='$_POST[istatus]', 
								edia='$_POST[edia]', 
								emes='$_POST[emes]', 
								eano='$_POST[eano]', 
								exame='$_POST[exame]', 
								especialidade='$_POST[especialidade]', 
								sala='$_POST[sala]', 
								medico='$_POST[medico]', 
								origemconsulta='$_POST[origemconsulta]', 
								urgencia='$_POST[urgencia]', 
								numeroagend='$_POST[numeroagend]', 
								sequencia='$_POST[sequencia]',
								cadastrador='$cadastrador'
								WHERE idint=$_POST[idint]";
								}
	 	mysql_select_db($database_conSaude, $conSaude);
  		$Result1 = mysql_query($updateSQL, $conSaude) or die(mysql_error());

		$acomp1=$_POST['iacompanhante'];
		$acomp2=$_POST['iacompanhante2']; 
		$pagantes=$_POST['ipagantes'];

		$id=$_POST['idpac'];

		header("Location:paciente.php?id=$id");
		}
//pesquisa de registros
mysql_select_db($database_conSaude, $conSaude);
$query_recInternacao = "SELECT * FROM internacao WHERE `idint`='$int'";
$recInternacao = mysql_query($query_recInternacao, $conSaude) or die(mysql_error());
$row_recInternacao = mysql_fetch_assoc($recInternacao);
$totalRows_recInternacao = mysql_num_rows($recInternacao);


mysql_select_db($database_conSaude, $conSaude);
$query_recPac = "SELECT * FROM paciente WHERE `idp`='$id2'";
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
		if($id==""){$id=NULL;}else {$id="Posição de Aguardo: ".$id."º";}
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
    if (nomeform.edia.value=="", nomeform.emes.value=="", nomeform.eano.value=="")
    {
        alert ("Informe o Corretamente a DATA de ENTRADA dos Documentos.");
        return false;
    }
    if (nomeform.itipo.value=="")
    {
        alert ("Informe o TIPO do tratamento.");
        return false;
    }					
    if (nomeform.especialidade.value=="")
    {
        alert ("Informe o ESPECIALIDADE do tratamento.");
        return false;
    }
    if (nomeform.icidade.value=="")
    {
        alert ("Informe a CIDADE do tratamento.");
        return false;
    }
	    if (nomeform.idia.value==true)
   		 {   
				if (nomeform.imes.value=="", nomeform.iano.value=="")
				    {
       				 alert ("Informe corretamente a DATA de SAÍDA para a VIAGEM.");
       				 return false;
   					 }
				if (nomeform.ihospital.value=="")
				    {
       				 alert ("Informe corretamente o HOSPITAL da VIAGEM.");
       				 return false;
   					 } 
				if (nomeform.ihora.value=="")
				    {
       				 alert ("Informe corretamente a HORA.");
       				 return false;
   					 }					 
				if (nomeform.origemconsulta.value=="")
				    {
       				 alert ("Informe corretamente a ORIGEM da CONSULTA.");
       				 return false;
   					 }
			}
    if (nomeform.ipagantes.value>=2)
	{      if (nomeform.iacompanhante.value==""){
       				 alert ("Informe o ACOMPANHANTE 1.");
       				 return false;
				}
    }
    if (nomeform.ipagantes.value>=3)
	{      if ( nomeform.iacompanhante2.value==""){
       				 alert ("Informe o 2º ACOMPANHANTE 2.");
       				 return false;
				}
    }

    if (nomeform.iacompanhante.value!="")
	{
				if (nomeform.ipagantes.value!=2)
				    {
       				 alert ("Você adicionou um acompanhante mas não alterou o nº de pagantes.");
   					 }
    }	
				
return true;


}
</script>
<!-- fim do script -->
</head>
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
 <!--exibir cabeçalho-->
  <tr> 
    <td width="100%" height="162"><?php require_once('cabec.php');?></td>
  </tr>
  <tr>
    <td height="375" valign="top"> <table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
      <!--exibir cabeçalho-->
      <!--DWLayoutTable-->
      <tr> 
        <td width="3" height="7"></td>
        <td width="984"></td>
        <td width="5"></td>
      </tr>
      <tr>
        <td height="379"></td>
        <td valign="top"> <fieldset>
          <LEGEND ><font color="#000000"><strong>Alterando Movimenta&ccedil;&atilde;o 
          - Paciente <?php echo $row_recPac['pnome'];?> </strong></font></legend>
          <form method="post" name="form1" action="alterartratamento.php" onSubmit="return valida_dados(this)">
            <table width="100%" border="0" cellpadding="0" cellspacing="0">
              <!--DWLayoutTable-->
              <tr> 
                <td width="2" height="281">&nbsp;</td>
                <td width="392" valign="top"> <fieldset>
                  <LEGEND ><font color="#000000"><strong>Entrada de Documentos</strong></font></legend>
                  <table width="345" border="0" cellpadding="0" cellspacing="0">
                    <!--DWLayoutTable-->
                    <tr> 
                      <td width="1" height="24"></td>
                      <td width="86" valign="top"><strong><font size="2"><font color="#FF0000">*</font></font></strong> 
                        Data</td>
                      <td colspan="8" valign="top"><select name="edia" id="edia">
                          <option value="<?php echo $row_recInternacao['edia']; ?>"><?php echo $row_recInternacao['edia']; ?></option>
                          <option value="<?php echo $row_recInternacao['edia']; ?>">==</option>
                          <option value="01">01</option>
                          <option value="02">02</option>
                          <option value="03">03</option>
                          <option value="04">04</option>
                          <option value="05">05</option>
                          <option value="06">06</option>
                          <option value="07">07</option>
                          <option value="08">08</option>
                          <option value="09">09</option>
                          <option value="10">10</option>
                          <option value="11">11</option>
                          <option value="12">12</option>
                          <option value="13">13</option>
                          <option value="14">14</option>
                          <option value="15">15</option>
                          <option value="16">16</option>
                          <option value="17">17</option>
                          <option value="18">18</option>
                          <option value="19">19</option>
                          <option value="20">20</option>
                          <option value="21">21</option>
                          <option value="22">22</option>
                          <option value="23">23</option>
                          <option value="24">24</option>
                          <option value="25">25</option>
                          <option value="26">26</option>
                          <option value="27">27</option>
                          <option value="28">28</option>
                          <option value="29">29</option>
                          <option value="30">30</option>
                          <option value="31">31</option>
                        </select> 
                        <?php switch($row_recInternacao['emes']){ 
						  	case "01": $mes = "Janeiro";     break;
						  	case "02": $mes = "Fevereiro";   break;
             				case "03": $mes = "Março";       break;
              				case "04": $mes = "Abril";       break;
              				case "05": $mes = "Maio";        break;
              				case "06": $mes = "Junho";       break;
              				case "07": $mes = "Julho";       break;
              				case "08": $mes = "Agosto";      break;
              				case "09": $mes = "Setembro";    break;
              				case "10": $mes = "Outubro";     break;
              				case "11": $mes = "Novembro";    break;
              				case "12": $mes = "Dezembro";    break;
			  				}
			  				?>
                        <select name="emes" id="emes">
                          <option value="<?php echo $row_recInternacao['emes']; ?>"><?php echo $mes; ?></option>
                          <option value="<?php echo $row_recInternacao['emes']; ?>">=====</option>
                          <option value="01">Janeiro</option>
                          <option value="02">Fevereiro</option>
                          <option value="03">Mar&ccedil;o</option>
                          <option value="04">Abril</option>
                          <option value="05">Maio</option>
                          <option value="06">Junho</option>
                          <option value="07">Julho</option>
                          <option value="08">Agosto</option>
                          <option value="09">Setembro</option>
                          <option value="10">Outubro</option>
                          <option value="11">Novembro</option>
                          <option value="12">Dezembro</option>
                        </select> <select name="eano" id="eano">
                          <option value="<?php echo $row_recInternacao['eano']; ?>"><?php echo $row_recInternacao['eano']; ?></option>
                          <option value="<?php echo $row_recInternacao['eano']; ?>">=====</option>
                          <option value="2008">2008</option>
                          <option value="2009">2009</option>
                          <option value="2010">2010</option>
                          <option value="2011">2011</option>
                          <option value="2012">2012</option>
                          <option value="2013">2013</option>
                          <option value="2014">2014</option>
                          <option value="2015">2015</option>
                        </select></td>
                      <td width="2">&nbsp;</td>
                      <td width="2">&nbsp;</td>
                    </tr>
                    <tr> 
                      <td height="24"></td>
                      <td valign="top"><strong><font size="2"><font color="#FF0000">*</font></font></strong> 
                        Tipo </td>
                      <td width="14">&nbsp;</td>
                      <td colspan="6" valign="top"><select name="itipo">
                          <option value="<?php echo $row_recInternacao['itipo']; ?>"><?php echo $row_recInternacao['itipo']; ?></option>
                          <option value="<?php echo $row_recInternacao['itipo']; ?>">========================</option>
                          <option value="internacao">Internação</option>
                          <option value="exame">Exame</option>
                          <option value="consulta">Consulta</option>
                        </select></td>
                      <td width="5">&nbsp;</td>
                      <td></td>
                      <td></td>
                    </tr>
                    <tr> 
                      <td height="24"></td>
                      <td colspan="2" valign="top"><strong><font size="2"><font color="#FF0000">*</font></font></strong> 
                        Especialidade</td>
                      <td colspan="4" valign="top"><select name="especialidade" id="especialidade">
                          <option value="<?php echo $row_recInternacao['especialidade']; ?>"><?php echo $row_recInternacao['especialidade']; ?></option>
                          <option value="<?php echo $row_recInternacao['especialidade']; ?>">========================</option>
                          <?php
do {  
?>
                          <option value="<?php echo $row_recEspecialidade['especialidade']?>"><?php echo $row_recEspecialidade['especialidade']?></option>
                          <?php
} while ($row_recEspecialidade = mysql_fetch_assoc($recEspecialidade));
  $rows = mysql_num_rows($recEspecialidade);
  if($rows > 0) {
      mysql_data_seek($recEspecialidade, 0);
	  $row_recEspecialidade = mysql_fetch_assoc($recEspecialidade);
  }
?>
                        </select></td>
                      <td width="2">&nbsp;</td>
                      <td width="5">&nbsp;</td>
                      <td>&nbsp;</td>
                      <td></td>
                      <td></td>
                    </tr>
                    <tr> 
                      <td height="24"></td>
                      <td valign="top">Exame</td>
                      <td>&nbsp;</td>
                      <td colspan="4" valign="top"> <select name="exame" id="exame">
                          <option value="<?php echo $row_recInternacao['exame']; ?>"><?php echo $row_recInternacao['exame']; ?></option>
                          <option value="<?php echo $row_recInternacao['exame']; ?>">========================</option>
                          <?php
do {  
?>
                          <option value="<?php echo $row_recExame['exame']?>"><?php echo $row_recExame['exame']?></option>
                          <?php
} while ($row_recExame = mysql_fetch_assoc($recExame));
  $rows = mysql_num_rows($recExame);
  if($rows > 0) {
      mysql_data_seek($recExame, 0);
	  $row_recExame = mysql_fetch_assoc($recExame);
  }
?>
                        </select></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                    </tr>
                    <tr> 
                      <td height="24"></td>
                      <td valign="top"><strong><font size="2"><font color="#FF0000">*</font></font></strong> 
                        Cidade</td>
                      <td>&nbsp;</td>
                      <td colspan="4" valign="top"> <select name="icidade" id="icidade">
                          <option value="<?php echo $row_recInternacao['icidade']; ?>"><?php echo $row_recInternacao['icidade']; ?></option>
                          <option value="<?php echo $row_recInternacao['icidade']; ?>">==========</option>
                          <?php
do {  
?>
                          <option value="<?php echo $row_reccidade['nome']?>"><?php echo $row_reccidade['nome']?></option>
                          <?php
} while ($row_reccidade = mysql_fetch_assoc($reccidade));
  $rows = mysql_num_rows($reccidade);
  if($rows > 0) {
      mysql_data_seek($reccidade, 0);
	  $row_reccidade = mysql_fetch_assoc($reccidade);
  }
?>
                        </select> </td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                    </tr>
                    <tr> 
                      <td height="24"></td>
                      <td colspan="10" valign="top"><hr align="center"></td>
                      <td>&nbsp;</td>
                    </tr>
                    <tr> 
                      <td height="24"></td>
                      <td valign="top">Status</td>
                      <td colspan="6" valign="top"><select name="istatus">
                          <option value="<?php echo $row_recInternacao['istatus']; ?>"> 
                          <?php 
                            echo $row_recInternacao['istatus']; ?>
                          </option>
                          <option value="<?php echo $row_recInternacao['istatus']; ?>">========================</option>
                          <option value="Pendente">Pendente</option>
                          <option value="Aguardando Resposta">Aguardando Resposta</option>
                          <option value="Concluído">Conclu&iacute;do</option>
                        </select></td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td></td>
                      <td></td>
                    </tr>
                    <tr> 
                      <td height="24"></td>
                      <td colspan="3" valign="top">Grau de Urg&ecirc;ncia </td>
                      <td colspan="2" valign="top"><select name="urgencia" id="urgencia">
                          <option value="<?php echo $row_recInternacao['urgencia']; ?>"><?php echo $row_recInternacao['urgencia']; ?></option>
                          <option value="<?php echo $row_recInternacao['urgencia']; ?>">==========</option>
                          <option value="normal">normal</option>
                          <option value="urgente">urgente</option>
                        </select></td>
                      <td width="2"></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                    </tr>
                    <tr> 
                      <td height="22" colspan="6" valign="top"><?php echo $id;?></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                    </tr>
                    <tr> 
                      <td height="20"></td>
                      <td colspan="4" valign="top"> <a href="" onClick="window.open('observacoes.php?internacao=<?php echo $row_recInternacao['idint']; ?>&id=<?php echo $row_recInternacao['idpac']; ?>','Janela_inform','toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=no,width=600,height=300,left=25,top=25'); return false;"> 
                        <?php if ($row_recInternacao['observacao'] == true) {echo "1 - Observação";} else {echo "Inserir Observação";}?>
                        </a></td>
                      <td width="32">&nbsp;</td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                    </tr>
                    <tr> 
                      <td height="28"></td>
                      <td>&nbsp;</td>
                      <td></td>
                      <td width="68"></td>
                      <td width="126"></td>
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
                <td width="1">&nbsp;</td>
                <td colspan="7" valign="top"> <fieldset>
                  <LEGEND ><font color="#000000"><strong>Saída para Viagem</strong></font></legend>
                  <table width="500" border="0" cellpadding="0" cellspacing="0">
                    <!--DWLayoutTable-->
                    <tr> 
                      <td width="4" height="24">&nbsp;</td>
                      <td width="164" valign="top"><strong><font size="2"><font color="#FF0000">*</font></font></strong> 
                        Data</td>
                      <td width="10">&nbsp;</td>
                      <td colspan="5" valign="top"><select name="idia" >
                          <option value="<?php echo $row_recInternacao['idia']; ?>" selected><?php echo $row_recInternacao['idia']; ?></option>
                          <option value="">====</option>
                          <option value="1">1</option>
                          <option value="2">2</option>
                          <option value="3">3</option>
                          <option value="4">4</option>
                          <option value="5">5</option>
                          <option value="6">6</option>
                          <option value="7">7</option>
                          <option value="8">8</option>
                          <option value="9">9</option>
                          <option value="10">10</option>
                          <option value="11">11</option>
                          <option value="12">12</option>
                          <option value="13">13</option>
                          <option value="14">14</option>
                          <option value="15">15</option>
                          <option value="16">16</option>
                          <option value="17">17</option>
                          <option value="18">18</option>
                          <option value="19">19</option>
                          <option value="20">20</option>
                          <option value="21">21</option>
                          <option value="22">22</option>
                          <option value="23">23</option>
                          <option value="24">24</option>
                          <option value="25">25</option>
                          <option value="26">26</option>
                          <option value="27">27</option>
                          <option value="28">28</option>
                          <option value="29">29</option>
                          <option value="30">30</option>
                          <option value="31">31</option>
                        </select> <select name="imes">
                          <option value="<?php echo $row_recInternacao['imes']; ?>" selected><?php echo $row_recInternacao['imes']; ?></option>
                          <option value="">====</option>
                          <option value="Janeiro">Janeiro</option>
                          <option value="Fevereiro">Fevereiro</option>
                          <option value="Mar&ccedil;o">Mar&ccedil;o</option>
                          <option value="Abril">Abril</option>
                          <option value="Maio">Maio</option>
                          <option value="Junho">Junho</option>
                          <option value="Julho">Julho</option>
                          <option value="Agosto">Agosto</option>
                          <option value="Setembro">Setembro</option>
                          <option value="Outubro">Outubro</option>
                          <option value="Novembro">Novembro</option>
                          <option value="Dezembro">Dezembro</option>
                        </select> <select name="iano">
                          <option value="<?php echo $row_recInternacao['iano']; ?>" selected><?php echo $row_recInternacao['iano']; ?></option>
                          <option value="">====</option>
                          <option value="2008">2008</option>
                          <option value="2009">2009</option>
                          <option value="2010">2010</option>
                          <option value="2011">2011</option>
                          <option value="2012">2012</option>
                          <option value="2013">2013</option>
                          <option value="2014">2014</option>
                          <option value="2015">2015</option>
                        </select></td>
                    </tr>
                    <tr> 
                      <td height="24">&nbsp;</td>
                      <td valign="top"><strong><font size="2"><font color="#FF0000">*</font></font></strong> 
                        Hospital</td>
                      <td></td>
                      <td colspan="3" valign="top"> <select name="ihospital">
                          <option value="<?php echo $row_recInternacao['ihospital']; ?>"><?php echo $row_recInternacao['ihospital']; ?></option>
                          <option value="">================</option>
                          <?php
do {  
?>
                          <option value="<?php echo $row_rechospital['hospital']?>"><?php echo $row_rechospital['hospital']?></option>
                          <?php
} while ($row_rechospital = mysql_fetch_assoc($rechospital));
  $rows = mysql_num_rows($rechospital);
  if($rows > 0) {
      mysql_data_seek($rechospital, 0);
	  $row_rechospital = mysql_fetch_assoc($rechospital);
  }
?>
                        </select> </td>
                      <td width="77">&nbsp;</td>
                      <td width="23">&nbsp;</td>
                    </tr>
                    <tr> 
                      <td height="24">&nbsp;</td>
                      <td valign="top">Sala</td>
                      <td></td>
                      <td colspan="4" valign="top"><input name="sala" type="text" id="sala" value="<?php echo $row_recInternacao['sala']; ?>" size="10">
                        <strong><font size="2"><font color="#FF0000">*</font></font></strong> 
                        Hora 
                        <input name="ihora" type="text" id="ihora"  value="<?php echo $row_recInternacao['ihora']; ?>" size="15"></td>
                      <td>&nbsp;</td>
                    </tr>
                    <tr> 
                      <td height="24">&nbsp;</td>
                      <td valign="top">Profissional</td>
                      <td></td>
                      <td colspan="4" valign="top"> <select name="medico" id="medico" >
                          <option value="<?php echo $row_recInternacao['medico']; ?>"><?php echo $row_recInternacao['medico']; ?></option>
                          <option value="<?php echo $row_recInternacao['medico']; ?>">==========</option>
                          <?php
do {  
?>
                          <option value="<?php echo $row_recMedico['nome']?>"><?php echo $row_recMedico['nome']?></option>
                          <?php
} while ($row_recMedico = mysql_fetch_assoc($recMedico));
  $rows = mysql_num_rows($recMedico);
  if($rows > 0) {
      mysql_data_seek($recMedico, 0);
	  $row_recMedico = mysql_fetch_assoc($recMedico);
  }
?>
                        </select> </td>
                      <td>&nbsp;</td>
                    </tr>
                    <tr> 
                      <td height="24">&nbsp;</td>
                      <td valign="top"><strong><font size="2"><font color="#FF0000">*</font></font></strong> 
                        Origem da Consulta</td>
                      <td></td>
                      <td colspan="4" valign="top"> <select name="origemconsulta" id="origemconsulta" >
                          <option value="<?php echo $row_recInternacao['origemconsulta']; ?>">
		<?php
	switch($row_recInternacao['origemconsulta'])
		{
		case "1" : $origem_consulta = "Em tratamento"; break;
		case "2" : $origem_consulta = "Comissão de Saúde"; break;
		case "3" : $origem_consulta = "Central"; break;
		case "4" : $origem_consulta = "10ª Coord. Reg. de Saúde"; break;
		}
		echo $origem_consulta; ?> 
			</option>
                          <option value="<?php echo $row_recInternacao['origemconsulta']; ?>">==========</option>
                            <option value="1">Em tratamento</option>
                          <option value="2">Comiss&atilde;o 
                          de Sa&uacute;de</option>
                          <option value="3">Central</option>
                          <option value="4">10&ordf; Coord. Reg. de Saude</option>
                         </select> </td>
                      <td>&nbsp;</td>
                    </tr>
                    <tr> 
                      <td height="22">&nbsp;</td>
                      <td valign="top">N&deg; Agendamento</td>
                      <td></td>
                      <td colspan="2" valign="top"><input name="numeroagend" type="text" id="numeroagend" value="<?php echo $row_recInternacao['numeroagend']; ?>" size="20"></td>
                      <td colspan="2" valign="top">Sequ&ecirc;ncia 
                        <input name="sequencia" type="text" id="sequencia2" value="<?php echo $row_recInternacao['sequencia']; ?>" size="5"<?php echo $autorizacao?>></td>
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
                      <td colspan="4" valign="top"> <input name="ipagantes" type="text" value="<?php echo $row_recInternacao['ipagantes']; ?>" size="2"> 
                        <a <?php echo $autorizacao?>>Valor Passagem</a> <input name="ivalor" <?php echo $autorizacao?> type="text" id="ivalor" value="<?php echo $valor; ?>" size="15"></td>
                      <td></td>
                    </tr>
                    <tr> 
                      <td height="24">&nbsp;</td>
                      <td valign="top"<?php echo $autorizacao?>>Valor por Extenso</td>
                      <td>&nbsp;</td>
                      <td colspan="5" valign="top"><input name="ivalorextenso" <?php echo $autorizacao?> type="text" id="ivalorextenso" value="<?php echo $row_recInternacao['ivalorextenso']; ?>" size="40"> 
                      </td>
                    </tr>
                    <tr> 
                      <td height="24">&nbsp;</td>
                      <td valign="top">Acompanhante 1</td>
                      <td></td>
                      <td colspan="5" valign="top"><input name="iacompanhante" type="text" id="iacompanhante" value="<?php echo $row_recInternacao['iacompanhante']; ?>" size="50"> 
                      </td>
                    </tr>
                    <tr> 
                      <td height="24">&nbsp;</td>
                      <td valign="top">Acompanhante 2</td>
                      <td></td>
                      <td colspan="5" valign="top"> <input name="iacompanhante2"  type="text" id="iacompanhante2" value="<?php echo $row_recInternacao['iacompanhante2']; ?>" size="50"></td>
                    </tr>
                    <tr> 
                      <td height="24">&nbsp;</td>
                      <td valign="top">Retorno</td>
                      <td></td>
                      <td width="50" valign="top"> <input name="iretorno" type="text" id="iretorno" value="<?php echo $row_recInternacao['iretorno']; ?>" size="15"> 
                      </td>
                      <td width="5"></td>
                      <td width="97"><a href="" onClick="window.open('loc_saida.php?internacao=<?php echo $row_recInternacao['idint']; ?>&id=<?php echo $row_recInternacao['idpac']; ?>','Janela_loc_saida','toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=no,width=600,height=100,left=250,top=90'); return false;"><?php if ($row_recInternacao['iloc_saida'] == true) {echo "1 - Local de Saída";} else {echo "Local de Saída";}?></a></td>
                      <td></td>
                      <td></td>
                    </tr>
                  </table>
                  </fieldset></td>
              </tr>
              <tr> 
                <td height="2"></td>
                <td colspan="3" rowspan="2" valign="top"><strong><u><font size="2">Aten&ccedil;&atilde;o!</font></u> 
                  <font size="2"><u>O</u> <u>asterisco</u> <u>vermelho</u> &quot;<font color="#FF0000">*</font>&quot; 
                  <u>marca</u> <u>os</u> <u>Campos</u> <u>Obrigat&oacute;rios</u></font></strong> 
                </td>
                <td width="253"></td>
                <td width="59"></td>
                <td width="55"></td>
                <td width="3"></td>
                <td width="96"></td>
                <td width="61"></td>
              </tr>
              <tr> 
                <td height="19"></td>
                <td></td>
                <td valign="top"> <a href="paciente.php?id=<?php echo $row_recInternacao['idpac']; ?>" > 
                  </a><a href="paciente.php?id=<?php echo $row_recInternacao['idpac']; ?>" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image3','','img/voltar2.gif',1)"><img src="img/voltar.gif" name="Image3" width="55" height="14" border="0" align="top"></a><a href="delinternacao.php?inter=<?php echo $row_recInternacao['idint']; ?>&pac=<?php echo $row_recInternacao['idpac']; ?>" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image4','','img/excluir2.gif',1)"> 
                  </a> </td>
                <td valign="top"><a href="delinternacao.php?inter=<?php echo $row_recInternacao['idint']; ?>&pac=<?php echo $row_recInternacao['idpac']; ?>" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image4','','img/excluir2.gif',1)"><img src="img/excluir.gif" name="Image4" width="55" height="14" border="0"></a></td>
                <td colspan="2" valign="top"><input type="image" name="Submit"  src="img/salvar.gif"> 
                  <input type="hidden" name="idpac" value="<?php echo $row_recInternacao['idpac']; ?>" size="32"> 
                </td>
                <td></td>
              </tr>
              <tr> 
                <td height="1"></td>
                <td></td>
                <td></td>
                <td width="22"></td>
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
        <td></td>
      </tr>
      <tr>
        <td height="16"></td>
        <td></td>
        <td></td>
      </tr>
    </table></td></tr>
</body>
</html>
<?php
mysql_free_result($recPac);

mysql_free_result($recMedico);

mysql_free_result($rechospital);

mysql_free_result($reccidade);

mysql_free_result($recEspecialidade);

mysql_free_result($recExame);

mysql_free_result($recColocacao);

mysql_free_result($recInternacao);
?>
