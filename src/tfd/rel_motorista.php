<?php require_once('Connections/conSaude.php'); ?>
<?php
$dia = $_GET['dia'];
$mes = $_GET['mes'];
$ano = $_GET['ano'];

if(isset($_GET["id"]))
{

// Faz loop pelo array dos numeros
foreach($_GET["id"] as $modulo)
{
$pesquisa .=	"idp=".$modulo . "||";
$pesqInternacao .=	"idpac=".$modulo . "||";  
}
}
else
{
echo "Você precisa escolher algum paciente";
}
$pesquisa2 = $pesqInternacao."idpac=1";

$query_recPaciente = "SELECT * FROM paciente WHERE $pesquisa idp=1 ";
$recPaciente = mysql_query($query_recPaciente, $conSaude) or die(mysql_error());
$row_recPaciente = mysql_fetch_assoc($recPaciente);
$totalRows_recPaciente = mysql_num_rows($recPaciente);

$query_rectotal = "SELECT cidade, ihospital, hospital, sum(ivalor)as totalcidade, sum(ipagantes)as pagantes  FROM internacao, hospital WHERE  ihospital=hospital and idia=$dia and iano=$ano and imes='$mes' group by cidade";
$rectotal = mysql_query($query_rectotal, $conSaude) or die(mysql_error());
$row_rectotal = mysql_fetch_assoc($rectotal);
$totalRows_rectotal = mysql_num_rows($rectotal);
$row = mysql_num_rows($rectotal);

$query_reccidade = "SELECT * FROM cidade";
$reccidade = mysql_query($query_reccidade, $conSaude) or die(mysql_error());
$row_reccidade = mysql_fetch_assoc($reccidade);
$totalRows_reccidade = mysql_num_rows($reccidade);


require_once("fpdf.php");
define('FPDF_FONTPATH','font/');
$pdf= new FPDF("L","mm","A4");
$pdf->SetFont("arial", "b", 6);
$pdf->SetY(-1);
$pdf->Cell(0,2, "PREFEITURA MUNICIPAL DE ALEGRETE",0,2,'C');
$pdf->Cell(0,3, "ESTADO DO RIOGRANDE DO SUL",0,2,'C');
$pdf->Cell(0,4, "Secretaria da Saúde",0,2,'C');
$pdf->Cell(0,2, "Setor de Tratamento Fora Domicílio",0,2,'C');
$pdf->Image("logo.jpg",65,9,10,12);
$pdf->Ln(7);
$pdf->SetFont("arial", "b", 10);
$pdf->Cell(0, 5, "CONFORME A PORTARIA /SAS/Nº055 DE 24 DE FEVEREIRO DE 1999. ",0,1,1);
$pdf->Cell(0, 5, "* ART. 5º",0,1,1);
$pdf->Cell(0, 5, "CIDADE",0,1,1);
$pdf->Cell(0, 8, "MOTORISTA:____________________________________",0,1,1);
$pdf->Cell(0, 8, "CARRO:________________________________________",0,1,1);
$pdf->Cell(150, 10, "DATA: ".$dia." de ".$mes." de ".$ano."   HORA:  ______:______         (D)DESISTENTE         (NC) NÃO COMPARECEU",0,1,1);
$pdf->SetFont("arial", "b", 9);

$pdf->cell(75,5,"PASSAGEIROS",1,0,'l');
$pdf->cell(14,5,"CIDADE",1,0,'l');
$pdf->cell(30,5,"HOSPITAL",1,0,'l');
$pdf->cell(19,5,"DATA",1,0,'l');
$pdf->cell(11,5,"HORA",1,0,'l');
$pdf->cell(75,5,"LOCAL DA SAÍDA",1,0,'l');
$pdf->cell(50,5,"TELEFONE",1,1,'l');

//*aqui pego o numero de registros pesquisados
$row = mysql_num_rows($recPaciente); 
$rowtotal = mysql_num_rows($recPaciente); 
//*fim

//COMEÇO INSERÇÃO DE DADOS
$pdf->SetFont("arial", "", 9);
$inicio = 0;
$fim = $row; //REGISTROS POR PAGINAS DETERMINADO PELO TOTAL DE REGISTROS ENCONTRADOS

for($i=$inicio; $i<$fim; $i++) {
$nome = mysql_result($recPaciente, $i, "pnome");
$pac = mysql_result($recPaciente, $i, "idp");
$telefone = mysql_result($recPaciente, $i, "ptel")."  ".mysql_result($recPaciente, $i, "ptel2");
$query_recInternacao = "select * from internacao where idpac='$pac' and idia='$dia' and iano='$ano' and imes='$mes'";
$recInternacao = mysql_query($query_recInternacao, $conSaude) or die(mysql_error());
$row_recInternacao = mysql_fetch_assoc($recInternacao);
$totalRows_recInternacao = mysql_num_rows($recInternacao);

$pagantes = $row_recInternacao['ipagantes'];
//
$hospitalselec =  $row_recInternacao['ihospital'];

$query_rechospital = "SELECT * FROM hospital WHERE hospital='$hospitalselec'";
$rechospital = mysql_query($query_rechospital, $conSaude) or die(mysql_error());
$row_rechospital = mysql_fetch_assoc($rechospital);
$totalRows_rechospital = mysql_num_rows($rechospital);

if($row_rechospital[cidade]==true){$cidade = $row_rechospital[cidade];} 
else {$cidade= $row_recInternacao['icidade'];}

$query_recsigla = "SELECT * FROM cidade WHERE nome='$cidade'";
$recsigla = mysql_query($query_recsigla, $conSaude) or die(mysql_error());
$row_recsigla = mysql_fetch_assoc($recsigla);
$totalRows_recsigla = mysql_num_rows($recsigla);
//
$siglahospital = $row_rechospital[abreviatura];
$siglacidade = $row_recsigla[sigla];
//

$dia = $row_recInternacao['idia'];
$mes = $row_recInternacao['imes'];
//conversão do mes para numero
switch($mes){ case "Janeiro": $mes2 = "01";     break;
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


// if ($mes="janeiro"){$mes2="01";} if ($mes="fevereiro"){$mes2="02";} if ($mes="março"){$mes2="03";}if ($mes="abril"){$mes2="04";}
// if ($mes="maio"){$mes2="05";}if ($mes="junho"){$mes2="06";}if ($mes="julho"){$mes2="07";}if ($mes="agosto"){$mes2="08";}
// if ($mes="setembro"){$mes2="09";}if ($mes="outubro"){$mes2="10";}if ($mes="novembro"){$mes2="11";}if ($mes="dezembro"){$mes2="12";}
//fim
$ano = $row_recInternacao['iano'];
$hora = $row_recInternacao['ihora'];
$retorno = $row_recInternacao['iretorno'];
$valor = $row_recInternacao['ivalor'];
$pdf->SetFont("arial", "b", 9);
$pdf->cell(75,8,$nome,LTB,0,'l');
$pdf->cell(14,8,$siglacidade,1,0,'l');
$pdf->cell(30,8,$siglahospital,1,0,'l');
$pdf->cell(19,8,$dia."/".$mes2."/".$ano,1,0,'l');
$pdf->cell(11,8,$hora,1,0,'l');
$pdf->cell(75,8,$row_recInternacao['iloc_saida'],1,0,'1');
$pdf->SetFont("arial", "", 9);
if($row_recInternacao['iacompanhante']==true){
$pdf->cell(50,8,$telefone,1,1,'l');
$pdf->cell(274,8,"           Acompanhante - ".$row_recInternacao['iacompanhante'],1,0,'l');
$pdf->ln();
if($row_recInternacao['iacompanhante2']==true){
$pdf->cell(274,8,"           Acompanhante 2 - ".$row_recInternacao['iacompanhante2'],1,0,'l');
$pdf->ln();
}
}else{$pdf->cell(50,8,$telefone,1,1,'l');}
}
$query_recTotal = "SELECT * FROM `internacao` WHERE ($pesquisa2)and(iacompanhante!='' AND idia='$dia' AND imes='$mes' AND iano='$ano')";
$recTotal = mysql_query($query_recTotal, $conSaude) or die(mysql_error());
$row_recTotal = mysql_fetch_assoc($recTotal);
$totalRows_recTotal = mysql_num_rows($recTotal);

$query_recTotal2 = "SELECT * FROM `internacao` WHERE ($pesquisa2)and(iacompanhante2!='' AND idia='$dia' AND imes='$mes' AND iano='$ano')";
$recTotal2 = mysql_query($query_recTotal2, $conSaude) or die(mysql_error());
$row_recTotal2 = mysql_fetch_assoc($recTotal2);
$totalRows_recTotal2 = mysql_num_rows($recTotal2);

$totpac = $totalRows_recPaciente; //ok
$totacomp = $totalRows_recTotal;
$totacomp2 = $totalRows_recTotal2;

$total=$totacomp+$totpac+$totacomp2;
$pdf->cell(50,8,"TOTAL DE PASSAGEIROS: ".$total,1,1,'l');
$pdf-> ln();
mysql_free_result($recPaciente);
mysql_free_result($recInternacao);
mysql_free_result($reccidade);

$pdf->Output("teste.php", "I");
?>