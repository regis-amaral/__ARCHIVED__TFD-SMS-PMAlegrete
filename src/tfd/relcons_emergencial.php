<?php require_once('Connections/conSaude.php'); ?>
<?php
$data = $_POST['data'];

if(isset($_POST["id"]))
{

// Faz loop pelo array dos numeros
foreach($_POST["id"] as $modulo)
{
$pesquisa .=	"idp=".$modulo . "||";
$pesqInternacao .=	"idpac=".$modulo . "||";  
}
}
else
{
echo "Você precisa escolher algum paciente";
}
$pesquisa2 = $pesquisa."idp=1";
$pesqInternacao2 = $pesqInternacao."idpac=1";
mysql_select_db($database_conSaude, $conSaude);
$query_recPaciente = "SELECT idp, pnome FROM paciente WHERE $pesquisa2 ORDER BY pnome ASC";
$recPaciente = mysql_query($query_recPaciente, $conSaude) or die(mysql_error());
$row_recPaciente = mysql_fetch_assoc($recPaciente);
$totalRows_recPaciente = mysql_num_rows($recPaciente);
// começo do relatorio
require_once("fpdf.php");
define('FPDF_FONTPATH','font/');
$pdf= new FPDF("P","mm","A4");
$pdf->SetFont("times", "b", 12);
$pdf->SetY(-1);
$pdf->SetTopMargin(18);
$pdf->SetMargins(1.0,20, 1.0); // margens: esquerda, superior e direita
$pdf->SetAutoPageBreak(true,30); // margem inferior
$pdf->Cell(0,4, "PREFEITURA MUNICIPAL DE ALEGRETE",0,2,'C');
$pdf->Cell(0,4, "ESTADO DO RIOGRANDE DO SUL",0,2,'C');
$pdf->Cell(0,4, "SECRETARIA DA SAÚDE",0,2,'C');
$pdf->Cell(0,4, "SETOR DE TRATAMENTO FORA DOMICÍLIO",0,2,'C');
$pdf->Cell(0,4, "FONE/FAX:(0**55)3422-5900",0,2,'C');
$pdf->Image("logo.jpg",35,18,18,20);
$pdf->SetMargins(15,'',15);
$pdf->Ln(5);
$pdf->SetFont("times", "bu", 16);
$pdf->Cell(0,6,"COMISSÃO DE SAÚDE",0,2,'C');
$pdf->Ln(5);
$pdf->SetFont("times", "", 14);
$pdf->Cell(0,6,"RELAÇÃO DE PACIENTES QUE NECESSITAM CONSULTAS DE EMERGÊNCIA",0,2,'C');
$pdf->Ln(5);
$pdf->SetFont("times", "b", 14);
$pdf->Cell(90,6,"Pacientes",1,0);
$pdf->Cell(90,6,"Especialidade",1,1);
$pdf->SetFont("times", "", 14);
$inicio = 0;
$fim = $totalRows_recPaciente;
for($i=$inicio; $i<$fim; $i++) {
$paciente= mysql_result($recPaciente, $i, "pnome");
$id= mysql_result($recPaciente, $i, "idp");
$query_recInternacao = "SELECT especialidade FROM internacao WHERE urgencia='urgente'and idpac='$id' ";
$recInternacao = mysql_query($query_recInternacao, $conSaude) or die(mysql_error());
$row_recInternacao = mysql_fetch_assoc($recInternacao);
$totalRows_recInternacao = mysql_num_rows($recInternacao);
$especialidade= $row_recInternacao['especialidade'];
$pdf->Cell(90,6,$paciente,1,0);
$pdf->Cell(90,6,$especialidade,1,1);
} while ($row_recPaciente = mysql_fetch_assoc($recPaciente));
session_start();
$pdf->Ln(2);
$pdf->SetFont("times", "b", 12);
$pdf->Cell(1,6,"Enviado por ".$_SESSION["nome"]." / Setor de Tratamento Fora Domicílio em ".$data,0,1);
$pdf->Ln();
$pdf->SetFont("times", "bu", 14);
$pdf->Cell(90,6,"Observações:",0,1);
$pdf->ln(3);
$inicio = 0;
$quebra = 3;
$fim = $totalRows_recPaciente;
for($i=$inicio; $i<$fim; $i++) 
{
$paciente= mysql_result($recPaciente, $i, "pnome");
$id= mysql_result($recPaciente, $i, "idp");
if($i==3){$pdf->ln(50);}
$query_recInternacao2 = "SELECT especialidade, observacao FROM internacao WHERE urgencia='urgente'and idpac='$id' ";
$recInternacao2 = mysql_query($query_recInternacao2, $conSaude) or die(mysql_error());
$row_recInternacao2 = mysql_fetch_assoc($recInternacao2);
$totalRows_recInternacao2 = mysql_num_rows($recInternacao2);
$obs = $row_recInternacao2['observacao'];
if ($obs==true){
$pdf->SetFont("times", "bu", 14);
$pdf->Cell(80,5,"Paciente: ".$paciente,0,1);
$pdf->SetFont("times", "b", 12);
$pdf->Cell(80,5,"Especialidade: ".$row_recInternacao2['especialidade'],0,1);
$pdf->MultiCell(180,5,"- ".$obs,0,1);
$pdf->ln(3);
$pdf->SetTopMargin(18);
$pdf->SetMargins(15,20, 15); // margens: esquerda, superior e direita
$pdf->SetAutoPageBreak(true,30);
}
}while ($row_recPaciente = mysql_fetch_assoc($recPaciente));
$pdf->Output("teste.php", "I");
?>
<?php
mysql_free_result($recPaciente);
mysql_free_result($recInternacao);
mysql_free_result($recInternacao2);
?>
