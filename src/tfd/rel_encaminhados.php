<?php require_once('Connections/conSaude.php'); ?>
<?php
// ####################### VARIAVEIS RECEBIDAS #################################
$esp = $_GET['especialidade'];
if($esp=="all"){$esp=false;}else{$esp = "and especialidade='$esp'";}
$cidade = $_GET['cidade'];
if($cidade=="all"){$cidade=false;}else{$cidade = "and icidade='$cidade'";}
$ano = $_GET['ano'];
$ano = "and iano='$ano'";

$m[1] = $_GET['janeiro'];
$m[2] = $_GET['fevereiro'];
$m[3] = $_GET['marco'];
$m[4] = $_GET['abril'];
$m[5] = $_GET['maio'];
$m[6] = $_GET['junho'];
$m[7] = $_GET[julho];
$m[8] = $_GET[agosto];
$m[9] = $_GET[setembro];
$m[10] = $_GET[outubro];
$m[11] = $_GET[novembro];
$m[12] = $_GET[dezembro];

$cid_poa = 1100;
$cid_rg = 1100;
$cid_sm = 560;
$cid_urug = 300;
$cid_ros = 220;
$cid_sg = 350;
$cid_pf = 1350;
$cid_liv = 450;
$cid_bg = 660;
$cid_laj = 1100;
$cid_stang = 780;
$cid_bentg = 1250;
$cid_mv = 90;
$cid_ita = 610;
// ############################################################################

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
$pdf->Cell(0,2, "Totais em Viajens",0,2,'C');
$pdf->Ln(15);
$pdf->SetFont("arial","b", 8);
// ######################### TOTAIS DO RELATÓRIO #############################
$pdf->cell(15,5,"Valores Gastos em Viajens",0,0);
$pdf->Ln(10);
// ######################### TOTAIS POR MES ##################################
$pdf->cell(40,5,"Mês",0,0);
$pdf->cell(18,5,"Valor Total",0,0,'R');
$pdf->SetFont("arial","", 8);
$pdf->Ln(7);
$i_mes=1;
$f_mes=13;
	for($tm=$i_mes; $tm<$f_mes; $tm++)
		{
	if($m[$tm]==true){$tmes=$m[$tm];}else{$tmes="Dezembro";}
	/*
	switch($m[$tm]){ 
	      case "janeiro": $tmes = "Janeiro";    break;
              case "fevereiro": $tmes = "Fevereiro";   break;
              case "marco": $tmes = "Março";       break;
              case "abril": $tmes = "Abril";       break;
              case "maio": $tmes = "Maio";        break;
              case "junho": $tmes = "Junho";       break;
              case "julho": $tmes = "Julho";       break;
              case "agosto": $tmes = "Agosto";      break;
              case "setembro": $tmes = "Setembro";    break;
              case "outubro": $tmes = "Outubro";     break;
              case "novembro": $tmes = "Novembro";    break;
              case "dezembro": $tmes = "Dezembro";    break;
              default : $tmes = "Dezembro";
	    }
	    */
		if($m[$tm]==true)
			{
			$t_mes = "and imes='".$tmes."'";
			mysql_select_db($database_conSaude, $conSaude);
			$query_rectotal1 = "SELECT imes, especialidade, sum(ivalor)as totalmes FROM internacao 
			WHERE  istatus='Concluído' $t_mes $esp $cidade $ano GROUP BY imes";
			$rectotal1 = mysql_query($query_rectotal1, $conSaude) or die(mysql_error());
			$row_rectotal1 = mysql_fetch_assoc($rectotal1);	
			$valor = $row_rectotal1[totalmes];
			$valor=explode(".",$valor);
			$valor=implode(",",$valor);
			$tmes = $row_rectotal1[imes];
			$pdf->cell(40,5,$tmes,0,0);
			$pdf->cell(18,5,$valor,0,1,'R');
			$tvalor = $row_rectotal1[totalmes];
			$m_total = $m_total + $tvalor;			
			}	
		}
$m_total = number_format($m_total, 2, ",", ".");
$pdf->Ln(2);				
$pdf->cell(40,5,"Total",0,0);
$pdf->cell(18,5,$m_total,0,0,'R');
$pdf->ln(10);
$pdf->SetFont("arial","b", 8);
$pdf->cell(40,5,"Usuários do Sistema",0,1);
$pdf->SetFont("arial","", 8);

$QUERY_USUARIOS="SELECT * FROM usuarios;";
$REC_USUARIOS=mysql_query($QUERY_USUARIOS, $conSaude) or die(mysql_error());
$TOTAL_USUARIOS=mysql_num_rows($REC_USUARIOS);
for($u=0;$u<$TOTAL_USUARIOS;$u++){
$pdf->cell(40,5,mysql_result($REC_USUARIOS,$u,"id")." - ".mysql_result($REC_USUARIOS,$u,"nome"),0,1);
}
// ######################### TOTAIS POR ESPECIALIDADE ########################
/* 

$pdf->SetFont("arial","b", 8);
$pdf->cell(15,5,"Totais por Especialidade no Periodo",0,0);
$pdf->Ln(10);
$pdf->SetFont("arial","", 8);
$pdf->cell(40,5,"Especialidade",0,0);
$pdf->cell(40,5,"Valor Total",0,0);
$pdf->Ln(5);

$i_esp=1;
$f_esp=12;
	for($te=$i_esp; $te<$f_esp; $te++)
		{
		switch($m[$te]){ 
			  case "janeiro": $mesp = "Janeiro";    break;
              case "fevereiro": $mesp = "Fevereiro";   break;
              case "marco": $mesp = "Março";       break;
              case "abril": $mesp = "Abril";       break;
              case "maio": $mesp = "Maio";        break;
              case "junho": $mesp = "Junho";       break;
              case "julho": $mesp = "Julho";       break;
              case "agosto": $mesp = "Agosto";      break;
              case "setembro": $mesp = "Setembro";    break;
              case "outubro": $mesp = "Outubro";     break;
              case "novembro": $mesp = "Novembro";    break;
              case "dezembro": $mesp = "Dezembro";    break;
	    }
		if($m[$te]==true)
			{
			$t_esp = "and imes='$m[$te]'";
			mysql_select_db($database_conSaude, $conSaude);
			$query_rectotal3 = "SELECT imes, especialidade, sum(ivalor)as totalmes FROM internacao WHERE  istatus='Concluído' $t_esp $ano GROUP BY especialidade";
			$rectotal3 = mysql_query($query_rectotal3, $conSaude) or die(mysql_error());
			$row_rectotal3 = mysql_fetch_assoc($rectotal3);	
			$row_i=0;
			$row_f=10;
			for($rw=$row_i; $rw<$row_f; $rw++)
				{
				$valor3 = mysql_result($rectotal3, $rw, "totalmes");
				$valor3=explode(".",$valor3);
				$valor3=implode(",",$valor3);
				$tespecialidade = mysql_result($rectotal3, $rw, "especialidade");
				$pdf->cell(40,5,$tespecialidade,0,0);
				$pdf->cell(18,5,$valor3,0,1,'R');
				}
			}	
		}*/
// ######################### TOTAIS POR CIDADE ###############################
/* $pdf->Ln(10);
$pdf->SetFont("arial","b", 8);
$pdf->cell(40,4,"Tabela Kilometragem por cidade",0,2);
$pdf->Ln(1);
$pdf->SetFont("arial","", 8);
$pdf->cell(30,4,"Porto Alegre",0,0);
$pdf->cell(10,4,$cid_poa,0,0,'R');
$pdf->cell(10,4,"Km",0,1);
$pdf->cell(30,4,"Rio Grande",0,0);
$pdf->cell(10,4,$cid_rg,0,0,'R');
$pdf->cell(10,4,"Km",0,1);
$pdf->cell(30,4,"Santa Maria",0,0);
$pdf->cell(10,4,$cid_sm,0,0,'R');
$pdf->cell(10,4,"Km",0,1);
$pdf->cell(30,4,"Uruguaiana",0,0);
$pdf->cell(10,4,$cid_urug,0,0,'R');
$pdf->cell(10,4,"Km",0,1);
$pdf->cell(30,4,"Rosário",0,0);
$pdf->cell(10,4,$cid_ros,0,0,'R');
$pdf->cell(10,4,"Km",0,1);
$pdf->cell(30,4,"São Gabriel",0,0);
$pdf->cell(10,4,$cid_sg,0,0,'R');
$pdf->cell(10,4,"Km",0,1);
$pdf->cell(30,4,"Passo Fundo",0,0);
$pdf->cell(10,4,$cid_pf,0,0,'R');
$pdf->cell(10,4,"Km",0,1);
$pdf->cell(30,4,"Livramento",0,0);
$pdf->cell(10,4,$cid_liv,0,0,'R');
$pdf->cell(10,4,"Km",0,1);
$pdf->cell(30,4,"Bagé",0,0);
$pdf->cell(10,4,$cid_bg,0,0,'R');
$pdf->cell(10,4,"Km",0,1);
$pdf->cell(30,4,"Lajeado",0,0);
$pdf->cell(10,4,$cid_laj,0,0,'R');
$pdf->cell(10,4,"Km",0,1);
$pdf->cell(30,4,"Santo Angelo",0,0);
$pdf->cell(10,4,$cid_stang,0,0,'R');
$pdf->cell(10,4,"Km",0,1);
$pdf->cell(30,4,"Bento Gonçalves",0,0);
$pdf->cell(10,4,$cid_bentg,0,0,'R');
$pdf->cell(10,4,"Km",0,1);
$pdf->cell(30,4,"Manoel Viana",0,0);
$pdf->cell(10,4,$cid_mv,0,0,'R');
$pdf->cell(10,4,"Km",0,1);
$pdf->cell(30,4,"Itaara",0,0);
$pdf->cell(10,4,$cid_ita,0,0,'R');
$pdf->cell(10,4,"Km",0,1);
*/
$pdf->Ln(5);
// ######################### INICIO DO LOOP ##################################
$inicio=1;
$fim=13;
	for($i=$inicio; $i<$fim; $i++){
		if($m[$i]==true){
		$pdf->addpage();
		$mes = "and imes='$m[$i]'";
		mysql_select_db($database_conSaude, $conSaude);
		$query_recTratamentos = "SELECT * FROM internacao WHERE istatus='Concluído' $mes $esp $cidade $ano ORDER BY 'idia' ASC";
		$recTratamentos = mysql_query($query_recTratamentos, $conSaude) or die(mysql_error());
		$row_recTratamentos = mysql_fetch_assoc($recTratamentos);
		$totalRows_recTratamentos = mysql_num_rows($recTratamentos);
		$row = mysql_num_rows($recTratamentos);
		switch($m[$i]){ 
			  case "janeiro": $text_mes = "Janeiro";    break;
              case "fevereiro": $text_mes = "Fevereiro";   break;
              case "marco": $text_mes = "Março";       break;
              case "abril": $text_mes = "Abril";       break;
              case "maio": $text_mes = "Maio";        break;
              case "junho": $text_mes = "Junho";       break;
              case "julho": $text_mes = "Julho";       break;
              case "agosto": $text_mes = "Agosto";      break;
              case "setembro": $text_mes = "Setembro";    break;
              case "outubro": $text_mes = "Outubro";     break;
              case "novembro": $text_mes = "Novembro";    break;
              case "dezembro": $text_mes = "Dezembro";    break;
	    }
	
		$pdf->SetFont("arial", "b", 10);
		$pdf->cell(16,5,$text_mes." de ".$_GET['ano'],0,2,'1');
		$pdf->Ln(5);
		$pdf->SetFont("arial","b", 7);
		$pdf->cell(6,5,"Dia",1,0,'l');
		$pdf->cell(50,5,"Nome",1,0,'l');
		$pdf->cell(15,5,"Nasc.",1,0,'1');
		$pdf->cell(25,5,"Cartão SUS",1,0,'l'); 
		$pdf->cell(5,5,"Op",1,0,'l');
		$pdf->cell(40,5,"Especialidade",1,0,'l');
		$pdf->cell(20,5,"Cidade",1,0,'l'); 
		$pdf->cell(10,5,"KM Perc.",1,0,'l'); 
		$pdf->cell(15,5,"Valor Gasto",1,2,'C');
		$pdf->Ln(0);
		$inicio2 = 0;
		$fim2 = $row; 
		for($i2=$inicio2; $i2<$fim2; $i2++) {
			$idpac = mysql_result($recTratamentos, $i2, "idpac");
			mysql_select_db($database_conSaude, $conSaude);
			$query_recPaciente = "SELECT * FROM paciente WHERE idp='$idpac'";
			$recPaciente = mysql_query($query_recPaciente, $conSaude) or die(mysql_error());
			$row_recPaciente = mysql_fetch_assoc($recPaciente);
			$totalRows_recPaciente = mysql_num_rows($recPaciente);
			
			$tnome = $row_recPaciente['pnome'];
			$tespecialidade = mysql_result($recTratamentos, $i2, "especialidade");
			$tdata = mysql_result($recTratamentos, $i2, "idia");
			$tcidade = mysql_result($recTratamentos, $i2, "icidade");
			$tvalor = mysql_result($recTratamentos, $i2, "ivalor");
			$operador=mysql_result($recTratamentos, $i2, "cadastrador");
			switch($tcidade)
			{ 
			case "Porto Alegre": $kmp = $cid_poa;    break;
			case "Rio Grande": $kmp = $cid_rg;    break;
			case "Santa Maria": $kmp = $cid_sm;    break;
			case "Uruguaiana": $kmp = $cid_urug;    break;
			case "Rosário do Sul": $kmp = $cid_ros;		break;
			case "São Gabriel": $kmp = $cid_sg;		break;
			case "Passo Fundo": $kmp = $cid_pf;		break;
			case "Livramento": $kmp = $cid_liv;		break;
			case "Bagé": $kmp = $cid_bg;		break;
			case "lajeado": $kmp = $cid_laj;		break;
			case "Santo Angelo": $kmp = $cid_poa;    break;
			case "Bento Gonçalves": $kmp = $cid_poa;    break;
			case "Manoel Viana": $kmp = $cid_poa;    break;						
			case "Itaara": $kmp = $cid_ita;    break;						
	    	default : $kmp = "--";
			}

			if($row_recPaciente['pnome']==false){$nome=$idpac;}else{$nome=$row_recPaciente['pnome'];}
			if($tespecialidade=="! Não Especificada !"){$especialidade="Não especificada";}else{$especialidade=$tespecialidade;}
			$cartao_sus=$row_recPaciente['pcartao'];
			$nasc=$row_recPaciente["pnasc"];
			$pdf->SetFont("arial","", 7);
			$pdf->cell(6,3,$tdata,1,0,'R');
			$pdf->cell(50,3,$nome,1,0,'l');
			$pdf->cell(15,3,$nasc,1,0,'1');
			$pdf->cell(25,3,$cartao_sus,1,0,'l');
			$pdf->cell(5,3,$operador,1,0,'l');
			$pdf->cell(40,3,$especialidade,1,0,'l');
			$pdf->cell(20,3,$tcidade,1,0,'l');
			$pdf->cell(10,3,$kmp,1,0,'l'); 
			$pdf->cell(15,3,$tvalor,1,2,0);
			$pdf->Ln(0);
			}
		$pdf->Ln(1);
		}//fim if($m[$i]==true)
	}//fim comando 'for'
#mysql_free_result($recTratamentos);

$pdf->Output("rel_encaminhados.php", "I");
?>