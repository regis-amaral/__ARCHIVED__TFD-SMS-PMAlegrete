<?php 
$dia=$_GET['dia'];
$mes=$_GET['mes'];
$ano=$_GET['ano'];

if($_GET['$dia']==true||$_GET['mes']==true||$_GET['ano']==true)
{echo "<script>window.open('rel5.php?dia=".$dia."&mes=".$mes."&ano=".$ano."','Janela','toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=no,width=900,height=900,left=120,top=25');</script>";}


?>
<table width="291" border="0" cellpadding="0" cellspacing="0">
  <!--DWLayoutTable-->
  <tr> <br>
    <td width="46" height="21">&nbsp;</td>
    <td width="194">&nbsp;</td>
    <td width="51">&nbsp;</td>
  </tr>
  <tr>
    <td height="206">&nbsp;</td>
    <td valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0">
        <!--DWLayoutTable-->
        <tr> 
          <td width="189" height="109"> <form name="form1" method="get" action="diarioviagens.php">
              <p> 
              <fieldset>
              <legend>Informe a Data:</legend>
              Dia:<br>
              <input name="dia" type="text" size="11" maxlength="5">
              <br>
              Mês: <br>
              <select name="mes">
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
              </select>
              <br>
              Ano: <br>
              <input name="ano" type="text" size="11">
              <br>
              <br>
              <input type="submit" name="Submit" value="Imprimir"></p>
              </fieldset>
            </form></td>
          <td width="5"></td>
        </tr>
      </table></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="75">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
