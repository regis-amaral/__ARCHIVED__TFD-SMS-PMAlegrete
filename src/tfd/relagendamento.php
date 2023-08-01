<?php require_once('Connections/conSaude.php'); ?>
<?php
$paciente = $_GET[id];
$internacao = $_GET[internacao];
$tipo = $_GET[tipo];


mysql_select_db($database_conSaude, $conSaude);
$query_recpaciente = "SELECT * FROM paciente, internacao WHERE idp='$paciente' and idint='$internacao'";
$recpaciente = mysql_query($query_recpaciente, $conSaude) or die(mysql_error());
$row_recpaciente = mysql_fetch_assoc($recpaciente);
$totalRows_recpaciente = mysql_num_rows($recpaciente);

$hospital = $row_recpaciente['ihospital'];
$query_rechospital = "SELECT * FROM hospital WHERE hospital = '$hospital'";
$rechospital = mysql_query($query_rechospital, $conSaude) or die(mysql_error());
$row_rechospital = mysql_fetch_assoc($rechospital);
$totalRows_rechospital = mysql_num_rows($rechospital);

require_once("fpdf.php");
define('FPDF_FONTPATH','font/');
$pdf= new FPDF("P","mm","A4");
$pdf->SetFont("times", "b", 12);
$pdf->SetY(-1);
$pdf->SetTopMargin(18);
$pdf->Cell(0,4, "PREFEITURA MUNICIPAL DE ALEGRETE",0,2,'C');
$pdf->Cell(0,4, "ESTADO DO RIOGRANDE DO SUL",0,2,'C');
$pdf->Cell(0,4, "SECRETARIA DA SAÚDE",0,2,'C');
$pdf->Cell(0,4, "SETOR DE TRATAMENTO FORA DOMICÍLIO",0,2,'C');
$pdf->Cell(0,4, "FONE/FAX:(0**55)3422-5900",0,2,'C');
$pdf->Image("logo.jpg",35,18,18,20);
$pdf->SetMargins(15,'',15);
$pdf->Ln(25);
$pdf->SetFont("times", "bu", 16);
$pdf->Cell(0,6,"Agendado pela",0,2,'C');
switch($tipo){ case "3": $pdf->Cell(0,6,"Central",0,2,'C');     break;
              case "2": $pdf->Cell(0,6,"Comissão de Saúde",0,2,'C');   break;
              case "4": $pdf->Cell(0,6,"10ª Coordenadoria Regional de Saúde",0,2,'C');		  			  
              }
$pdf->Ln(20);
$pdf->SetFont("times",'b', 12);
$pdf->Cell(0,4,"PACIENTE: ".$row_recpaciente['pnome'],0,2);
$pdf->Cell(0,6,"DATA DE NASCIMENTO: ".$row_recpaciente['pnasc'],0,2);
if ($row_recpaciente['pmae']==true){$pdf->Cell(0,6,"MÃE: ".$row_recpaciente['pmae'],0,2);}
if ($row_recpaciente['ppai']==true){$pdf->Cell(0,6,"PAI: ".$row_recpaciente['ppai'],0,2);}
$pdf->Ln(10);
$tel2 = " / ".$row_recpaciente['ptel2'];
if ($row_recpaciente['ptel']==true){$pdf->Cell(0,6,"TEL: ".$row_recpaciente['ptel'].$tel2,0,2);}
$pdf->Cell(0,6,"ENDEREÇO: ".$row_recpaciente['prua'].", ".$row_recpaciente['pnum']." Bairro ".$row_recpaciente['pbairro'],0,2);
$pdf->Ln(15);
$pdf->SetFont("times",'bu', 12);
$pdf->Cell(0,6,"AGENDAMENTO:",0,2);
$pdf->Ln(10);
$pdf->SetFont("times",'b', 12);
$pdf->Cell(0,6,"CIDADE: ".$row_rechospital['cidade'],0,2);
switch($row_recpaciente['imes']){ case "Janeiro": $mes2 = "01";     break;
              case "Fevereiro": $mes2 = "02";   break;
              case "Março": $mes2 = "03";       break;
              case "Abril": $mes2 = "04";       break;
              case "Maio": $mes2 = "05";        break;
              case "Junho": $mes2 = "06";       break;
              case "Julho": $mes2 = "07";       break;
              case "Agosto": $mes2 = "08";      break;
              case "Setembro": $mes2 = "09";    break;
              case "Outubro": $mes2 = "10";     break;
              case "Novembro": $mes2 = "11";    break;
              case "Dezembro": $mes2 = "12";    break;
	    }
$pdf->Cell(120,6,"DATA: ".$row_recpaciente['idia']."/".$mes2."/".$row_recpaciente['iano'],0);
$pdf->Cell(0,6,"HORÁRIO: ".$row_recpaciente['ihora'],0,1);
$pdf->Cell(120,6,"HOSPITAL: ".$row_recpaciente['ihospital'],0);
$pdf->Cell(0,6,"SEQUÊNCIA: ",0,1);
$pdf->Cell(120,6,"ESPECIALIDADE: ".$row_recpaciente['especialidade'],0);
$pdf->Cell(0,6,"SALA: ".$row_recpaciente['sala'],0,1);
$pdf->Cell(120,6,"PROFISSIONAL: ".$row_recpaciente['medico'],0);
$pdf->Cell(0,6,"AGENDAMENTO: ".$row_recpaciente['numeroagend'],0,1);
$pdf->Ln(35);
session_start();
$pdf->Cell(0,4,"RESPONSÁVEL PELO AGENDAMENTO:",0,2,'R');
$pdf->Cell(0,4,$_SESSION["nome"],0,2,'R');
$pdf->Output("teste.php", "I");
?>
<?php
mysql_free_result($recpaciente);
?>
