<html>
<head>
<title>Cadastro</title>
<!-- É aqui que o javascript controlará a digitação de campos obrigatórios -->
<script language="javascript">
<!-- chama a função (nomeform) -->
function valida_dados (nomeform)
{
    if (nomeform.nome.value=="")
    {
        alert ("Por favor digite o nome.");
        return false;
    }

    if (nomeform.cpf.value=="")
    {
        alert ("Por favor digite o cpf ou cnpj.");
        return false;
    }

    if (nomeform.rg_ie.value=="")
    {
        alert ("Por favor digite o RG ou Inscricao Estadual.");
        return false;
    }

    if (nomeform.endereco.value=="")
    {
        alert ("Por favor digite o endereco.");
        return false;
    }

    if (nomeform.bairro.value=="")
    {
        alert ("Por favor digite o bairro.");
        return false;
    }


    if (nomeform.cidade.value=="")
    {
        alert ("Por favor digite a cidade.");
        return false;
    }
    if (nomeform.uf.selectedIndex ==0)
    {
        alert ("Por favor selecione o estado.");
        return false;
    }
    if (nomeform.cep.value=="")
    {
        alert ("Por favor digite o cep.");
        return false;
    }

    if (nomeform.telefone.value=="")
    {
        alert ("Por favor digite o telefone.");
        return false;
    }

    if (nomeform.banco.value=="")
    {
        alert ("Por favor digite o banco.");
        return false;
    }


    if (nomeform.ag.value=="")
    {
        alert ("Por favor digite a agencia bancaria.");
        return false;
    }

    if (nomeform.conta.value=="")
    {
        alert ("Por favor digite a conta.");
        return false;
    }



    if (nomeform.email.value=="" || nomeform.email.value.indexOf('@', 0) == -1 || nomeform.email.value.indexOf('.', 0) == -1)
    {
        alert ("E-mail invalido.");
        return false;
    }
    
return true;
}
</script>


</head>
<body>
<h3 align="center">Cadastro de Colaborador</h3>

<!-- aqui começa o formulario -->

<form method="POST" action="colaborador.php" onSubmit="return valida_dados(this)">
<table border="0" align="center">
<tr><td><b>Dados Pessoais</b></td></tr>
<tr><td></td></tr>
  <tr><td align="right">Nome: </td><td><input type="text" name="nome" size="20"></td><td align="right">Tipo:</td><td><select size="1" name="tipo">
<option value="interno">Interno</option>
<option value="externo">Externo</option></td></tr>
<tr><td align="right">CPF/CNPJ:</td><td><input type="text" name="cpf" size="13" maxlength="14"></td><td align="right">RG/IE:</td><td><input type="text" name="rg_ie" size="13" maxlength = "13"></td></tr>
<tr><td align="right">Endereço:</td><td><input type="text" name="endereco" maxlength="30" size="20"></td><td align="right">Bairro:</td><td><input type="text" name="bairro" size="15" maxlength="15"></td></tr>
<tr><td align="right">Cidade:</td><td><input type="text" name="cidade" maxlength="15" size="15"></td><td align="right">UF:</td><td><select size="1" name="uf">
         <option>Escolha aqui</option>
                        <option value="AC">AC</option>
                        <option value="AL">AL</option>
                        <option value="AM">AM</option>
                        <option value="AP">AP</option>
                        <option value="BA">BA</option>
                        <option value="CE">CE</option>
                        <option value="DF">DF</option>
                        <option value="ES">ES</option>
                        <option value="GO">GO</option>
                        <option value="MA">MA</option>
                        <option value="MG">MG</option>
                        <option value="MS">MS</option>
                        <option value="MT">MT</option>
                        <option value="PA">PA</option>
                        <option value="PB">PB</option>
                        <option value="PE">PE</option>
                        <option value="PI">PI</option>
                        <option value="PR">PR</option>
                        <option value="RJ">RJ</option>
                        <option value="RN">RN</option>
                        <option value="RO">RO</option>
                        <option value="RR">RR</option>
                        <option value="RS">RS</option>
                        <option value="SC">SC</option>
                        <option value="SE">SE</option>
                        <option value="SP">SP</option>
                        <option value="TO">TO</option>
</select></td></tr>

<tr><td align="right">CEP:</td><td><input type="text" name="cep" size="10" maxlength="8"></td><td align="right">E-mail:</td><td><input type="text" name="email" size="20" maxlength = "40"></td></tr>

<tr><td align="right">Telefone:</td><td><input type="text" name="telefone" size="12" maxlength="10"></td><td align="right">Celular:</td><td><input type="text" name="celular" size="12" maxlength = "10"></td></tr>
<tr><td></td></tr>
<tr><td></td></tr>
<tr><td><b>Dados Bancários</b></td></tr>
<tr><td></td></tr>
<tr><td></td></tr>
<tr><td align="right">Banco:</td><td><input type="text" name="banco" size="12" maxlength="15"></td><td align="right">Agência:</td><td><input type="text" name="ag" size="10" maxlength = "10"></td></tr>

<tr><td align="right">Conta:</td><td><input type="text" name="conta" size="12" maxlength="10"></td><td align="right">Tipo de conta:</td><td><select name="tp_conta" size="1" >
<option value="poupanca">poupança</option>
<option value="corrente">corrente</option>
</td></tr>

</table><br><br>
<table align="center">
  <tr><td align="center"><input type="submit" value="Enviar" name="enviar"></td>
<td align="center"><input type="reset" value="Limpar" name="enviar"></td></tr>
</table>
</form>
</body>
</html> 