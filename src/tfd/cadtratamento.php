<?php require_once('Connections/conSaude.php'); ?>
<?php include_once('verifica.php');
session_start();
//if($_SESSION["login"]!="arthur"){$autorizacao="disabled";}else{$autorizacao=NULL;}
//if($_SESSION["login"]=="regis"){$autorizacao=NULL;}
$autorizacao=NULL;
?>
<?php
$id = $_GET[paciente];
$pac = $_POST[idpac];
$valor=$_POST[ivalor];
$valor=explode(",",$valor);
$valor=implode(".",$valor);
$cadastrador=$_SESSION["id"];
$teste=$_POST['idpac'];

//teste se concluido
if ($_POST[idia]==true or $_POST[imes]==true or	$_POST[iano]==true)
{$_POST[istatus]="Concluído";}
//

if($teste!=NULL){ 
	if($autorizacao==NULL){
	$insertSQL = "INSERT INTO internacao
								(idpac, 
								ivalor, 
								ivalorextenso, 
								icidade, 
								ihospital, 
								ihora, 
								iretorno, 
								iacompanhante,
								iacompanhante2, 
								ipagantes, 
								idia, 
								imes, 
								iano, 
								itipo, 
								istatus, 
								edia, 
								emes, 
								eano, 
								exame, 
								especialidade, 
								sala, 
								medico, 
								origemconsulta, 
								urgencia, 
								numeroagend,
								sequencia,
								cadastrador
								) 
						VALUES (
								'$_POST[idpac]', 
								'$valor',
								'$_POST[ivalorextenso]', 
								'$_POST[icidade]', 
								'$_POST[ihospital]', 
								'$_POST[ihora]', 
								'$_POST[iretorno]', 
								'$_POST[iacompanhante]', 
								'$_POST[iacompanhante2]', 
								'$_POST[ipagantes]', 
								'$_POST[idia]', 
								'$_POST[imes]', 
								'$_POST[iano]', 
								'$_POST[itipo]', 
								'$_POST[istatus]', 
								'$_POST[edia]', 
								'$_POST[emes]', 
								'$_POST[eano]', 
								'$_POST[exame]', 
								'$_POST[especialidade]', 
								'$_POST[sala]', 
								'$_POST[medico]', 
								'$_POST[origemconsulta]', 
								'$_POST[urgencia]', 
								'$_POST[numeroagend]',
								'$_POST[sequencia]',
								'$cadastrador'
								)"; } else {
									$insertSQL = "INSERT INTO internacao
								(idpac,
								icidade, 
								ihospital, 
								ihora, 
								iretorno, 
								iacompanhante,
								iacompanhante2, 
								ipagantes, 
								idia, 
								imes, 
								iano, 
								itipo, 
								istatus, 
								edia, 
								emes, 
								eano, 
								exame, 
								especialidade, 
								sala, 
								medico, 
								origemconsulta, 
								urgencia, 
								numeroagend,
								sequencias,
								cadastrador
								) 
						VALUES (
								'$_POST[idpac]',
								'$_POST[icidade]', 
								'$_POST[ihospital]', 
								'$_POST[ihora]', 
								'$_POST[iretorno]', 
								'$_POST[iacompanhante]', 
								'$_POST[iacompanhante2]', 
								'$_POST[ipagantes]', 
								'$_POST[idia]', 
								'$_POST[imes]', 
								'$_POST[iano]', 
								'$_POST[itipo]', 
								'$_POST[istatus]', 
								'$_POST[edia]', 
								'$_POST[emes]', 
								'$_POST[eano]', 
								'$_POST[exame]', 
								'$_POST[especialidade]', 
								'$_POST[sala]', 
								'$_POST[medico]', 
								'$_POST[origemconsulta]', 
								'$_POST[urgencia]', 
								'$_POST[numeroagend]',
								'$_POST[sequencia]',
								'$cadastrador'
								)";
								}
  mysql_select_db($database_conSaude, $conSaude);
  $Result1 = mysql_query($insertSQL, $conSaude) or die(mysql_error());
  
	$acomp1=$_POST['iacompanhante'];
	$acomp2=$_POST['iacompanhante2']; 
	$pagantes=$_POST['ipagantes'];
	
	$id=$_POST['idpac'];
	
	
	if ($acomp2==false && $acomp1!=false && $pagantes==1){ $mensagem ="Você adicionou um ACOMPANHANTE e não alterou o numero de pagantes! Se o acompanhante não é pagante ignore esta mensagem";}
	
	if ($acomp1==true && $acomp2!=false && $pagantes<=2){ $mensagem ="Você adicionou um SEGUNDO ACOMPANHANTE e não alterou o numero de pagantes! Se o 2º acompanhante não é pagante ignore esta mensagem";}
	
	if ($acomp1==false && $acomp2!=false && $pagantes<=2){ $mensagem ="ATENÇÃO! Você adicionou um 2º acompanhante e deixou o 1º em branco!";}
			header("Location:paciente.php?id=$id&mensagem=$mensagem");				  
}

//pesquisa de registros
mysql_select_db($database_conSaude, $conSaude);
$query_recPac = "SELECT * FROM paciente WHERE pnome='$id'";
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
return true;


}
</script>
<!-- fim do script -->
</head>
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<table width="100%" border="0" cellpadding="0" cellspacing="0">
 <!--exibir cabeçalho-->
  <tr> 
    <td width="100%" height="162"><?php require_once('cabec.php');?>
    </td>
  </tr>
  <tr>
    <!--exibir cabeçalho-->
    <td height="375" valign="top"> <table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
        <!--DWLayoutTable-->
        <tr> 
          <td width="5" height="8"></td>
          <td width="874"></td>
          <td width="113"></td>
        </tr>
        <tr> 
          <td height="366"></td>
          <td valign="top"> <fieldset>
            <LEGEND ><font color="#000000"><strong>Inserindo Movimenta&ccedil;&atilde;o 
            - Paciente <?php echo $row_recPac['pnome']; ?></strong></font></legend>
            <form method="post" name="form1" action="cadtratamento.php" onSubmit="return valida_dados(this)">
              <table width="100%" border="0" cellpadding="0" cellspacing="0">
                <!--DWLayoutTable-->
                <tr> 
                  <td width="4" height="9"></td>
                  <td width="345"></td>
                  <td width="3"></td>
                  <td width="124"></td>
                  <td width="185"></td>
                  <td width="201"></td>
                  <td width="12"></td>
                </tr>
                <tr> 
                  <td height="281"></td>
                  <td valign="top"> <fieldset>
                    <LEGEND ><font color="#000000"><strong>Entrada de Documentos</strong></font></legend>
                    <table width="345" border="0" cellpadding="0" cellspacing="0">
                      <!--DWLayoutTable-->
                      <tr> 
                        <td width="3" height="24"></td>
                        <td width="125" valign="top"><strong><font size="2"><font color="#FF0000">*</font></font></strong> 
                          Data</td>
                        <td colspan="7" valign="top"><select name="edia" id="edia">
                            <option value=""></option>
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
                          </select> <select name="emes" id="emes">
                            <option value=""></option>
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
                            <option value=""></option>
                            <option value="2008">2008</option>
                            <option value="2009">2009</option>
                            <option value="2010">2010</option>
                            <option value="2011">2011</option>
                            <option value="2012">2012</option>
                            <option value="2013">2013</option>
                            <option value="2014">2014</option>
                            <option value="2015">2015</option>
                          </select></td>
                        <td width="9">&nbsp;</td>
                        <td width="5"></td>
                      </tr>
                      <tr> 
                        <td height="24"></td>
                        <td valign="top"><strong><font size="2"><font color="#FF0000">*</font></font></strong> 
                          Tipo </td>
                        <td colspan="4" valign="top"><select name="itipo" id="itipo">
                            <option value=""></option>
                            <option value="internacao">Interna&ccedil;&atilde;o</option>
                            <option value="exame">Exame</option>
                            <option value="consulta">Consulta</option>
                          </select></td>
                        <td width="4">&nbsp;</td>
                        <td width="4">&nbsp;</td>
                        <td width="23"></td>
                        <td></td>
                        <td></td>
                      </tr>
                      <tr> 
                        <td height="24"></td>
                        <td valign="top"><strong><font size="2"><font color="#FF0000">*</font></font></strong> 
                          Especialidade</td>
                        <td colspan="3" valign="top"><select name="especialidade" id="especialidade">
                            <option value=""></option>
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
                        <td width="3">&nbsp;</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                      </tr>
                      <tr> 
                        <td height="24"></td>
                        <td valign="top">Exame</td>
                        <td colspan="2" valign="top"> <select name="exame" id="exame">
                            <option value=""></option>
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
                        <td width="2"></td>
                        <td></td>
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
                        <td colspan="2" valign="top"> <select name="icidade" id="icidade">
                            <option value=""></option>
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
                        <td></td>
                        <td></td>
                      </tr>
                      <tr> 
                        <td height="1"></td>
                        <td></td>
                        <td width="60"></td>
                        <td width="107"></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                      </tr>
                      <tr> 
                        <td height="24" colspan="10" valign="top"><hr align="center"></td>
                        <td></td>
                      </tr>
                      <tr> 
                        <td height="24"></td>
                        <td valign="top">Status</td>
                        <td colspan="6" valign="top"><select name="istatus">
                            <option value="Pendente">Pendente</option>
                            <option value="Aguardando Resposta">Aguardando Resposta</option>
                            <option value="Concluído">Conclu&iacute;do</option>
                          </select></td>
                        <td></td>
                        <td></td>
                        <td></td>
                      </tr>
                      <tr> 
                        <td height="24"></td>
                        <td colspan="2" valign="top">Grau de Urg&ecirc;ncia </td>
                        <td colspan="4" valign="top"><select name="urgencia" id="urgencia">
                            <option value="normal">normal</option>
                            <option value="urgente">urgente</option>
                          </select></td>
                        <td>&nbsp;</td>
                        <td></td>
                        <td></td>
                        <td></td>
                      </tr>
                      <tr> 
                        <td height="69"></td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                      </tr>
                    </table>
                    </fieldset></td>
                  <td>&nbsp;</td>
                  <td colspan="3" valign="top"> <fieldset>
                    <LEGEND ><font color="#000000"><strong> para Viagem</strong></font></legend>
                    <table width="500" border="0" cellpadding="0" cellspacing="0">
                      <!--DWLayoutTable-->
                      <tr> 
                        <td width="177" height="24" valign="top">Data</td>
                        <td width="18">&nbsp;</td>
                        <td colspan="6" valign="top"><select name="idia">
                            <option value=""></option>
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
                            <option value=""></option>
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
                            <option value=""></option>
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
                        <td height="24" valign="top">Hospital</td>
                        <td></td>
                        <td colspan="3" valign="top"> <select name="ihospital" id="ihospital">
                            <option value=""></option>
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
                        <td width="15">&nbsp;</td>
                        <td width="7">&nbsp;</td>
                      </tr>
                      <tr> 
                        <td height="24" valign="top">Sala</td>
                        <td></td>
                        <td colspan="4" valign="top"><input name="sala" type="text" id="sala" size="10">
                          Hora 
                          <input name="ihora" type="text" id="ihora2" size="10"></td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                      </tr>
                      <tr> 
                        <td height="24" valign="top">Profissional</td>
                        <td></td>
                        <td colspan="4" valign="top"> <select name="medico" id="medico">
                            <option value=""></option>
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
                        <td>&nbsp;</td>
                      </tr>
                      <tr> 
                        <td height="24" colspan="2" valign="top">Origem da Consulta</td>
                        <td colspan="4" valign="top"> <select name="origemconsulta" id="origemconsulta">
                            <option value=""></option>						
                            <option value="1">Em tratamento</option>
                            <option value="2">Comiss&atilde;o 
                            de Sa&uacute;de</option>
                            <option value="3">Central</option>
                            <option value="4">10&ordf; Coord. Reg. de Saude</option>
                          </select> </td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                      </tr>
                      <tr> 
                        <td height="22" colspan="2" valign="top">N&deg; Agendamento</td>
                        <td colspan="2" valign="top"><input name="numeroagend" type="text" id="numeroagend" size="20"></td>
                        <td colspan="3" valign="top">Sequ&ecirc;ncia 
                          <input name="sequencia" type="text" id="sequencia" size="5"<?php echo $autorizacao?>></td>
                        <td>&nbsp;</td>
                      </tr>
                      <tr> 
                        <td height="24" colspan="2" valign="top">Pagantes</td>
                        <td colspan="4" valign="top"> <input name="ipagantes" type="text" id="ipagantes" size="2" value="1"> 
                          <a <?php echo $autorizacao?>>Valor Passagem </a> <input name="ivalor" type="text" id="ivalor2" size="10"<?php echo $autorizacao?>></td>
                        <td></td>
                        <td></td>
                      </tr>
                      <tr> 
                        <td height="24" valign="top" <?php echo $autorizacao?>>Valor 
                          por Extenso</td>
                        <td>&nbsp;</td>
                        <td colspan="6" valign="top"> <input name="ivalorextenso" type="text" id="ivalorextenso" size="50"<?php echo $autorizacao?>> 
                        </td>
                      </tr>
                      <tr> 
                        <td height="24" valign="top">Acompanhante 1</td>
                        <td></td>
                        <td colspan="6" valign="top"> <input name="iacompanhante" type="text" id="iacompanhante" size="50"> 
                        </td>
                      </tr>
                      <tr> 
                        <td height="24" valign="top">Acompanhante 2</td>
                        <td></td>
                        <td colspan="6" valign="top"> <input name="iacompanhante2" type="text" id="iacompanhante2" size="50"></td>
                      </tr>
                      <tr> 
                        <td height="24" valign="top">Retorno</td>
                        <td></td>
                        <td width="74" valign="top"> <input name="iretorno" type="text" id="iretorno" size="10"> 
                        </td>
                        <td width="46"></td>
                        <td width="86"></td>
                        <td></td>
                        <td></td>
                        <td></td>
                      </tr>
                    </table>
                    </fieldset></td>
                  <td></td>
                </tr>
                <tr> 
                  <td height="19"></td>
                  <td colspan="3" valign="top"><strong><u><font size="2">Aten&ccedil;&atilde;o!</font></u> 
                    <font size="2"><u>O</u> <u>asterisco</u> <u>vermelho</u> &quot;<font color="#FF0000">*</font>&quot; 
                    <u>marca</u> <u>os</u> <u>Campos</u> <u>Obrigat&oacute;rios</u></font></strong> 
                  </td>
                  <td>&nbsp;</td>
                  <td valign="top"> <input type="hidden" name="idpac" value="<?php echo $row_recPac['idp']; ?>" size="32"> 
                    <input type="image" name="Submit" src="img/salvar.gif" value="Enviar"> 
                    <a href="paciente.php?id=<?php echo $row_recPac['idp']; ?>" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image2','','img/voltar2.gif',1)"><img src="img/voltar.gif" name="Image2" width="55" height="14" border="0"></a><a href="C" > 
                    </a></td>
                  <td></td>
                </tr>
              </table>
            </form>
            </fieldset></td>
          <td></td>
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