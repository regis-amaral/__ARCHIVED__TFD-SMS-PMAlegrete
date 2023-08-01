<?php require_once('Connections/conSaude.php'); ?>
<?php
$id = $_POST[id];
$idint = $_POST[idint];
$retirante = $_POST[retirante];
$rgoucpf = $_POST[rgoucpf];
$dataext = $_POST[data];
$ida = $_POST[ida];
$pida = $_POST[pida];

$volta = $_POST[volta];
$pvolta = $_POST[pvolta];

$alimentacao = $_POST[alimentacao];
$palimentacao = $_POST[palimentacao];

$deslocamento = $_POST[deslocamento];
$pdeslocamento = $_POST[pdeslocamento];


mysql_select_db($database_conSaude, $conSaude);
$query_recpaciente = "SELECT * FROM paciente, internacao WHERE idp='$id' and idpac='$id' and idint='$idint'";
$recpaciente = mysql_query($query_recpaciente, $conSaude) or die(mysql_error());
$row_recpaciente = mysql_fetch_assoc($recpaciente);
$totalRows_recpaciente = mysql_num_rows($recpaciente);

require_once("fpdf.php");
define('FPDF_FONTPATH','font/');
$pdf= new FPDF("P","mm","A4");
$pdf->SetFont("times", "b", 12);
$pdf->SetY(-1);
$pdf->SetTopMargin(20);
$pdf->Cell(0,4, "PREFEITURA MUNICIPAL DE ALEGRETE",0,2,'C');
$pdf->Cell(0,4, "ESTADO DO RIOGRANDE DO SUL",0,2,'C');
$pdf->Cell(0,4, "Secretaria da Saúde",0,2,'C');
$pdf->Cell(0,4, "Setor de Tratamento Fora Domicílio",0,2,'C');
$pdf->Image("logo.jpg",35,18,18,20);
$pdf->SetMargins(30,'',30);
$pdf->Ln(25);
$pdf->SetFont("times", "bu", 12);
$pdf->Cell(0,4,"DECLARAÇÃO",0,2,'C');
$pdf->Ln(25);
$pdf->SetFont("times",'b', 12);
$pdf->Cell(0,4,"Declaro para os devidos fins que recebi da Prefeitura Municipal de Alegrete,",0,2,'C');
$pdf->Cell(0,6,"através da Secretaria Municipal de Saúde, a importância de:",0,2,'C');
$valor= $row_recpaciente['ivalor'];
$valor=explode(".",$valor);
$valor=implode(",",$valor);
$pdf->SetFont("times",'bu', 12);
$pdf->Cell(0,5,"R$ ".$valor." ( ".$row_recpaciente['ivalorextenso']." )",0,2,'C');
$pdf->SetFont("times",'b', 12);
$pdf->Cell(0,6,"referente ao pagamento de passagens, da cidade de ".$row_recpaciente['icidade']." (anexo",0,2,'C');
$pdf->Cell(0,4,"documento comprobatório).",0,2,'C');

//descrição dos valores

$pdf->Ln(10);

if ($pida != NULL)
{
$pdf->Cell(0,6,"Descriminação dos Valores:",0,2);
{$pdf->Cell(0,6,$pida." "."passagem(s) de ida no valor de R$".$ida,0,2);}
}
if ($pvolta != NULL)
{
{$pdf->Cell(0,6,$pvolta." "."passagem(s) de volta no valor de R$".$volta,0,2);}
}
if ($palimentacao != NULL)
{
{$pdf->Cell(0,6,$palimentacao." "."vale(s) alimentacao no valor de R$".$alimentacao,0,2);}
}
if ($pdeslocamento != NULL)
{
{$pdf->Cell(0,6,$pdeslocamento." "."vale(s) deslocamento no valor de R$".$deslocamento,0,2);}
}
//final da descrição

$pdf->Ln(10);

if ($row_recpaciente['iacompanhante'] != NULL){
$pdf->Cell(0,4,"Foram beneficiados os seguintes usuários:",0,2);
} else {$pdf->Cell(0,4,"Foi beneficiado o seguinte usuário:",0,2);}

$pdf->Ln(10);
$pdf->Cell(90,4,"Paciente: ",0,0);

if ($row_recpaciente['iacompanhante'] != NULL)
{
	if ($row_recpaciente['iacompanhante2'] != NULL){
	$pdf->Cell(0,4,"Acompanhantes: ",0,1);
	} else {
	$pdf->Cell(0,4,"Acompanhante: ",0,1);
	} 
} else {
$pdf->Cell(0,4," ",0,1);
}
$pdf->Ln();
$pdf->Cell(90,4,$row_recpaciente['pnome'],0,0);
$pdf->Cell(0,4,$row_recpaciente['iacompanhante'],0,1);
$pdf->SetFont("times", "b", 9);
$pdf->Cell(90,4,"RG: ".$row_recpaciente['prg'],0,0); 
$pdf->SetFont("times", "b", 12);
$pdf->Cell(0,4,$row_recpaciente['iacompanhante2'],0,1);
$pdf->SetFont("times", "b", 9);
$pdf->Cell(90,4,"Telefone: ".$row_recpaciente['ptel'],0,2);
$pdf->Cell(0,4,"Bairro: ".$row_recpaciente['pbairro'],0,2);
$pdf->Cell(0,4,"Rua: ".$row_recpaciente['prua']." Nº: ".$row_recpaciente['pnum'],0,2);
$pdf->Cell(0,4,"Alegrete - RS",0,2);
$pdf->SetFont("times", "b", 12); 
$pdf->Ln(30);
$dia = date("d");
$mes = date("M");
$ano = date("Y");

$mes = date("M"); //mes no sistema
switch($mes){ case "Jan": $mes = "Janeiro";     break;
              case "Feb": $mes = "Fevereiro";   break;
              case "Mar": $mes = "Março";       break;
              case "Apr": $mes = "Abril";       break;
              case "May": $mes = "Maio";        break;
              case "Jun": $mes = "Junho";       break;
              case "Jul": $mes = "Julho";       break;
              case "Aug": $mes = "Agosto";      break;
              case "Sep": $mes = "Setembro";    break;
              case "Oct": $mes = "Outubro";     break;
              case "Nov": $mes = "Novembro";    break;
              case "Dec": $mes = "Dezembro";    break;
			  }
if($dataext == true)
{$pdf->Cell(0,4,$dataext,0,2,'C');
}
else
{$pdf->Cell(0,4,"Alegrete, ".$dia." de ".$mes." de ".$ano,0,2,'C');}
$pdf->Ln(12);
$pdf->Cell(0,4,"_________________________________________________________",0,2,'C');
$pdf->Ln();
if ($retirante != NULL){
$pdf->Cell(0,4,$retirante,0,2,'C');
$pdf->Cell(0,4,$rgoucpf,0,2,'C');
} else {
$pdf->Cell(0,4,$row_recpaciente['pnome'],0,2,'C');
}
$pdf->Output("teste.php", "I");
?>
<?php
mysql_free_result($recpaciente);
?>
