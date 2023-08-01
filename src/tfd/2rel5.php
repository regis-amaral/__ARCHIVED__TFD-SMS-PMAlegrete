<?php require_once('Connections/conSaude.php'); ?>
<?php
$dia = $_GET[dia];
$mes = $_GET[mes];
$ano = $_GET[ano];
mysql_select_db($database_conSaude, $conSaude);
$query_recpaciente = "select * from paciente, internacao where idp=idpac  and idia=$dia and iano=$ano and imes='$mes'";
$recpaciente = mysql_query($query_recpaciente, $conSaude) or die(mysql_error());
$row_recpaciente = mysql_fetch_assoc($recpaciente);
$totalRows_recpaciente = mysql_num_rows($recpaciente);

$query_rectotal = "SELECT icidade, sum(ivalor)as totalcidade, sum(ipagantes)as pagantes FROM internacao WHERE  idia=$dia group by icidade";
$rectotal = mysql_query($query_rectotal, $conSaude) or die(mysql_error());
$row_rectotal = mysql_fetch_assoc($rectotal);
$totalRows_rectotal = mysql_num_rows($rectotal);
$row = mysql_num_rows($rectotal);

mysql_select_db($database_conSaude, $conSaude);
$query_reccidade = "SELECT * FROM cidade";
$reccidade = mysql_query($query_reccidade, $conSaude) or die(mysql_error());
$row_reccidade = mysql_fetch_assoc($reccidade);
$totalRows_reccidade = mysql_num_rows($reccidade);

//*aqui pego o numero de registros pesquisados
$row = mysql_num_rows($recpaciente); 
$rowtotal = mysql_num_rows($rectotal); 
//*fim
require_once("fpdf.php");
define('FPDF_FONTPATH','font/');
$pdf= new FPDF("P","mm","A4");
$pdf->SetFont("arial", "bu", 12);
$pdf->SetY(-1);
$pdf->Cell(0, 0, "RELATÓRIO DIÁRIO DE VIAGENS",0,0,'1');
$pdf->SetX(20);
$pdf->SetY(15);
$pdf->SetFont("arial", "", 8);
$pdf->Cell(130, 0, "DATA: ".$dia." de ".$mes." de ".$ano,0,0,1);
$pdf->cell(0,0,"(AC) ACOMPANHANTE",0,0,1);
$pdf->SetFont("arial", "b", 8);
$pdf->SetX(20);
$pdf->SetY(25);
$pdf->cell(66,5,"PACIENTES",1,0,'l');
$pdf->cell(12,5,"PAGAM",1,0,'l');
$pdf->cell(18,5,"CIDADE",1,0,'l');
$pdf->cell(38,5,"HOSPITAL",1,0,'l');
$pdf->cell(17,5,"DATA",1,0,'l');
$pdf->cell(10,5,"HORA",1,0,'l');
$pdf->cell(16,5,"RETORNO", 1,0,'l');
$pdf->cell(15,5,"VALOR",1,1,'l');
//COMEÇO INSERÇÃO DE DADOS
$pdf->SetFont("arial", "", 8);
$inicio = 0;
$fim = $row; //REGISTROS POR PAGINAS DETERMINADO PELO TOTAL DE REGISTROS ENCONTRADOS

for($i=$inicio; $i<$fim; $i++) {
$nome = mysql_result($recpaciente, $i, "pnome");
$pagantes = mysql_result($recpaciente, $i, "ipagantes");

$cidadeselec = mysql_result($recpaciente, $i, "icidade");
//
$query_recsigla = "SELECT * FROM cidade WHERE nome='$cidadeselec'";
$recsigla = mysql_query($query_recsigla, $conSaude) or die(mysql_error());
$row_recsigla = mysql_fetch_assoc($recsigla);
$totalRows_recsigla = mysql_num_rows($recsigla);
$siglacidade = $row_recsigla[sigla];
//
$hospitalselec = mysql_result($recpaciente, $i, "ihospital");
//
$query_rechospital = "SELECT * FROM hospital WHERE hospital='$hospitalselec'";
$rechospital = mysql_query($query_rechospital, $conSaude) or die(mysql_error());
$row_rechospital = mysql_fetch_assoc($rechospital);
$totalRows_rechospital = mysql_num_rows($rechospital);
$siglahospital = $row_rechospital[abreviatura];
//
$dia = mysql_result($recpaciente, $i, "idia");
$mes = mysql_result($recpaciente, $i, "imes");
//conversão do mes para numero
if ($mes="janeiro"){$mes2="01";} if ($mes="fevereiro"){$mes2="02";} if ($mes="março"){$mes2="03";}if ($mes="abril"){$mes2="04";}
if ($mes="maio"){$mes2="05";}if ($mes="junho"){$mes2="06";}if ($mes="julho"){$mes2="07";}if ($mes="agosto"){$mes2="08";}
if ($mes="setembro"){$mes2="09";}if ($mes="outubro"){$mes2="10";}if ($mes="novembro"){$mes2="11";}if ($mes="dezembro"){$mes2="12";}
//fim
$ano = mysql_result($recpaciente, $i, "iano");
$hora = mysql_result($recpaciente, $i, "ihora");
$retorno = mysql_result($recpaciente, $i, "iretorno");
$valor = mysql_result($recpaciente, $i, "ivalor");
if ($pagantes != 1) {$acomp='+AC';} else {$acomp = NULL;}
$pdf->cell(58,5,$nome,LTB,0,'l');
$pdf->cell(8,5,$acomp,TRB,0,'l');
$pdf->cell(12,5,$pagantes,1,0,'l');
$pdf->cell(18,5,$siglacidade,1,0,'l');
$pdf->cell(38,5,$siglahospital,1,0,'l');
$pdf->cell(17,5,$dia."/".$mes2."/".$ano,1,0,'l');
$pdf->cell(10,5,$hora,1,0,'l');
$pdf->cell(16,5,$retorno,1,0,'l');
$valor=explode(".",$valor);
$valor=implode(",",$valor);
$pdf->cell(15,5,$valor,1,1,'R');

}
$pdf-> ln();
$inicio = 0;
$fim = $rowtotal;
$pdf->cell(30,5,"Cidade",0,0,'1');
$pdf->cell(20,5,"Quantidade",0,0,'1');
$pdf->cell(10,5,"Valor Total",0,1,'1');
for($c=$inicio; $c<$fim; $c++) {
$cidade = mysql_result($rectotal, $c, "icidade");
$valor = mysql_result($rectotal, $c, "totalcidade");
$consultas = mysql_result($rectotal, $c, "pagantes");

$pdf->cell(30,5,$cidade,0,0,'1');
$pdf->cell(20,5,$consultas,0,0,'C');
$valor=explode(".",$valor);
$valor=implode(",",$valor);
$pdf->cell(15,5,$valor,0,1,'R');
}
$query_recgeral = "SELECT sum(ivalor)as totalcidade, sum(ipagantes)as pagantes FROM internacao WHERE  idia=$dia";
$recgeral = mysql_query($query_recgeral, $conSaude) or die(mysql_error());
$totalgeral = mysql_result($recgeral, "totalcidade");
$pdf-> ln();
$totalgeral=explode(".",$totalgeral);
$totalgeral=implode(",",$totalgeral);
$pdf->cell(65,5,"Total Geral ".$totalgeral,0,1,'R');
mysql_free_result($recpaciente);

mysql_free_result($reccidade);

$pdf->Output("teste.php", "I");
?>