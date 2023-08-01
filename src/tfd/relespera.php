<?php require_once('Connections/conSaude.php'); ?>
<?php
$esp=$_GET[especialidade];
mysql_select_db($database_conSaude, $conSaude);
if ($esp=="todos"){$compl = "istatus = 'pendente'";} else {$compl="istatus = 'pendente' and especialidade='$esp'";}
$query_recColocacao = "SELECT idint, idpac, istatus, especialidade, edia, emes, eano
FROM internacao
WHERE $compl
ORDER BY 'eano', 'emes', 'edia', 'idint'";
$recColocacao = mysql_query($query_recColocacao, $conSaude) or die(mysql_error());
$row_recColocacao = mysql_fetch_assoc($recColocacao);
$totalRows_recColocacao = mysql_num_rows($recColocacao);

require_once("fpdf.php");
define('FPDF_FONTPATH','font/');
$pdf= new FPDF("P","mm","A4");
$pdf->SetFont("arial", "b", 6);
$pdf->SetY(-1);
$pdf->Cell(0,2, "PREFEITURA MUNICIPAL DE ALEGRETE",0,2,'C');
$pdf->Cell(0,3, "ESTADO DO RIOGRANDE DO SUL",0,2,'C');
$pdf->Cell(0,4, "Secretaria da Saúde",0,2,'C');
$pdf->Cell(0,2, "Setor de Tratamento Fora Domicílio",0,2,'C');
$pdf->Image("logo.jpg",65,9,10,12);
$pdf->Ln(10);
$pdf->SetFont("arial", "b", 10);
if ($esp=="todos"){
$pdf->Cell(0, 0, "Pacientes na fila de espera (com status pendente)",0,0);
}else{
if ($totalRows_recColocacao==0){
$pdf->Cell(0, 0, "Não há registros para a especialidade selecionada! ",0,0);
}else {
$pdf->Cell(0, 0, "Pacientes na fila de espera para ".$esp,0,0);
}}
$pdf->Ln(7);
if ($esp!="todos"){$pdf->cell(6,5,"",1,0,'l');}
$pdf->cell(16,5,"Entrada",1,0,'l');
if ($esp=="todos"){
$pdf->cell(50,5,"Nome",1,0,'l'); 
$pdf->cell(60,5,"Especialidade",1,1,'0');
}
else {
$pdf->cell(50,5,"Nome",1,0,'l');
$pdf->cell(14,5,"Nasc.",1,0,'l');
$pdf->cell(60,5,"Endereço",1,0,'l');
$pdf->cell(48,5,"Nome da Mãe",1,1,'l');
}
//paginação
$row = mysql_num_rows($recColocacao); 
$inicio = 0;
$fim = $row; 
for($i=$inicio; $i<$fim; $i++) {
	//declarar variaveis
	$colocacao = $i+1;
	$dia = mysql_result($recColocacao, $i, "edia");
	$mes = mysql_result($recColocacao, $i, "emes");
	$ano = mysql_result($recColocacao, $i, "eano");
	$entrada = $dia."/".$mes."/".$ano;
	$especialidade = mysql_result($recColocacao, $i, "especialidade");
	//fim declaracao de variaveis
$pdf->SetFont("arial", "b", 7);	
if ($esp!="todos"){$pdf->cell(6,5,$colocacao."º",1,0,'C');}
$pdf->cell(16,5,$entrada,1,0,'l');
$idpac = mysql_result($recColocacao, $i, "idpac");
	$query_recPaciente = "SELECT * FROM paciente WHERE idp='$idpac'";
	$recPaciente = mysql_query($query_recPaciente, $conSaude) or die(mysql_error());
	$row_recPaciente = mysql_fetch_assoc($recPaciente);
	$nome = $row_recPaciente['pnome'];
	$nasc = $row_recPaciente['pnasc'];
	if ($row_recPaciente['prua']==true){
	$endereco = $row_recPaciente['prua'].", Nº ".$row_recPaciente['pnum']." ".$row_recPaciente['pbairro'];
	}else{$endereco = "";}
	$mae = $row_recPaciente['pmae'];
if($esp=="todos"){
$pdf->cell(50,5,$nome,1,0,'l');
$pdf->cell(60,5,$especialidade,1,1,'l');
} else {
$pdf->cell(50,5,$nome,1,0,'l');
$pdf->cell(14,5,$nasc,1,0,'l');
$pdf->cell(60,5,$endereco,1,0,'l');
$pdf->cell(48,5,$mae,1,1,'l');
}
} while ($row_recColocacao = mysql_fetch_assoc($recColocacao));
//fim registros
$pdf->ln();
if ($esp=="todos"){
$pdf->cell(40,5,"Total de ".$totalRows_recColocacao." pacientes na fila de espera",0,1,'1');
	//total por especialidade
	$query_recTotal = "SELECT COUNT(*) AS Colunas, especialidade FROM internacao WHERE istatus='pendente' GROUP BY especialidade ORDER BY especialidade";
	$recTotal = mysql_query($query_recTotal, $conSaude) or die(mysql_error());
	$row_recTotal = mysql_fetch_assoc($recTotal);		
	$inicio = 0;
	$fim = mysql_num_rows($recTotal); 
	for($c=$inicio; $c<$fim; $c++) {
	$totalcol = mysql_result($recTotal,$c,"Colunas");
	$totalesp = mysql_result($recTotal,$c,"especialidade");
	$pdf->cell(40,5,$totalcol." para ".$totalesp,0,1,'1');
	}
	//fim total por especialidade
}else{
$pdf->cell(40,5,"Total de ".$totalRows_recColocacao." pacientes na fila de espera para ".$esp,0,0,'1');}
$pdf->Output("relespera.php", "I");
?>