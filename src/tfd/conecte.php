<?php
$bd= "saude";
$servidor = "localhost"; 
$usuario = "root"; 
$senha = "";
$conn = mysql_connect($servidor, $usuario, $senha);
$db = mysql_select_db($bd, $conn); 
$sql = mysql_query("SELECT pnome FROM paciente", $conn);
$row = mysql_num_rows($sql); 
if(!$row) { echo "Não retornou nenhum registro"; die; } 
?>