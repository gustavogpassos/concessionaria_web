<?php
include ("./cabecalhoNaoLogado.php");
include ("./ConectaUsuario.php");

if (isset($_SESSION["danger"])) {
    ?>
    <p class="alert-danger"> <?= $_SESSION["danger"] ?> </p>
    <?php
    unset($_SESSION["danger"]);
}

if (isset($_SESSION["danger2"])) {
    ?>
    <p class="alert-danger"> <?= $_SESSION["danger2"] ?> </p>
    <?php
    unset($_SESSION["danger2"]);
}
?>


<script type="text/javascript">
    function validarCPF(cad_cpf) {
        var filtro = /^\d{3}.\d{3}.\d{3}-\d{2}$/i;
        if (!filtro.test(cad_cpf))
        {
            //window.alert("CPF inválido. Tente novamente.");
            document.cad_usuario.cad_cpf.value = "";
            //document.cad_usuario.cad_cpf.focus();
            document.cad_usuario.cad_cpf.className = "form-control alert-danger";
            return false;
        }
        cad_cpf = remove(cad_cpf, ".");
        cad_cpf = remove(cad_cpf, "-");
        if (cad_cpf.length !== 11 || cad_cpf === "00000000000" || cad_cpf === "11111111111" ||
                cad_cpf === "22222222222" || cad_cpf === "33333333333" || cad_cpf === "44444444444" ||
                cad_cpf === "55555555555" || cad_cpf === "66666666666" || cad_cpf === "77777777777" ||
                cad_cpf === "88888888888" || cad_cpf === "99999999999")
        {
            //window.alert("CPF inválido. Tente novamente.");
            document.cad_usuario.cad_cpf.value = "";
            //document.cad_usuario.cad_cpf.focus();
            document.cad_usuario.cad_cpf.className = "form-control alert-danger";
            return false;
        }
        soma = 0;
        for (i = 0; i < 9; i++)
        {
            soma += parseInt(cad_cpf.charAt(i)) * (10 - i);
        }
        resto = 11 - (soma % 11);
        if (resto === 10 || resto === 11)
        {
            resto = 0;
        } else if (resto !== parseInt(cad_cpf.charAt(9))) {
            //window.alert("CPF inválido. Tente novamente.");
            document.cad_usuario.cad_cpf.value = "";
            //document.cad_usuario.cad_cpf.focus();
            document.cad_usuario.cad_cpf.className = "form-control alert-danger";
            return false;
        }
        soma = 0;
        for (i = 0; i < 10; i++)
        {
            soma += parseInt(cad_cpf.charAt(i)) * (11 - i);
        }
        resto = 11 - (soma % 11);
        if (resto === 10 || resto === 11)
        {
            resto = 0;
        } else if (resto !== parseInt(cad_cpf.charAt(10))) {
            //window.alert("CPF inválido. Tente novamente.");
            //document.cad_usuario.cad_cpf.focus();
            document.cad_usuario.cad_cpf.className = "form-control alert-danger";
            return false;
        }
        document.cad_usuario.cad_cpf.className = "form-control";
        return true;
    }

    function remove(str, sub) {
        i = str.indexOf(sub);
        r = "";
        if (i === -1)
            return str;
        {
            r += str.substring(0, i) + remove(str.substring(i + sub.length), sub);
        }
        return r;
    }

    function mascara_cpf() {
        if (document.cad_usuario.cad_cpf.value.length === 3) {
            document.cad_usuario.cad_cpf.value += ".";
        }
        if (document.cad_usuario.cad_cpf.value.length === 7) {
            document.cad_usuario.cad_cpf.value += ".";
        }
        if (document.cad_usuario.cad_cpf.value.length === 11) {
            document.cad_usuario.cad_cpf.value += "-";
        }
    }
    
    function mascara_telefone() {
        if (document.cad_usuario.telefone.value.length === 0) {
            document.cad_usuario.telefone.value += "(";
        }
        if (document.cad_usuario.telefone.value.length === 3) {
            document.cad_usuario.telefone.value += ")";
        }
        if (document.cad_usuario.telefone.value.length === 8) {
            document.cad_usuario.telefone.value += "-";
        }
    }
</script>



<h1>Crie já sua conta</h1><br><br>

<form action="cadastraUsuario.php" name="cad_usuario" id="cad_usuario" onsubmit="return valida();" method="POST">
    <center>
        <table class="table table-hover" style="width: 750px">
            <tr><td><input class="form-control" type="text" name="cad_cpf" id="cad_cpf" placeholder="CPF" required="" maxlength="14" onblur="javascript: validarCPF(this.value);" onkeypress="javascript: mascara_cpf()"></td></tr> 
            <tr><td><input class="form-control" type="text" name="nome" placeholder="Nome" required=""></td></tr>
            <tr><td><input class="form-control" type="text" name="sobrenome" placeholder="Sobrenome" required=""></td></tr>
            <tr><td><input class="form-control" type="text" name="telefone" id="telefone" placeholder="Telefone" required="" maxlength="14" onkeypress="javascript: mascara_telefone()"></td></tr>
            <tr><td><select class="form-control" name="genero">
                        <option value="">Selecione seu Gênero</option>
                        <option value="Masculino">Masculino</option>
                        <option value="Feminino">Feminino</option>
                    </select></td></tr>
            <tr><td><input class="form-control" type="email" name="email" placeholder="E-mail" onblur="javascript: valida_form(this.value);" required=""></td></tr>
            <tr><td><input class="form-control" type="password" name="senha" placeholder="Senha" required=""></td></tr>         
            <tr><td><input class="form-control" type="password" name="senha2" placeholder="Confirme sua senha" required="">
                    <?php date_default_timezone_set('America/Sao_Paulo'); ?>
                    <input type="hidden" name="datacad"
                           value="<?= $data = date("Y-m-d") ?>" /></td></tr>
            <tr>
                <td>
                    <input type="checkbox" name="termos" required="">Concordo com os <a href="#">Termos de Uso</a>
                    e com a <a href="#">Política de Privacidade</a> do site.
                </td>
            </tr>
            <tr>
                <td>
                    <input class="btn btn-primary" type="submit" value="Cadastrar">
                    <input class="btn" type="reset" value="Limpar">
                </td>
            </tr>
        </table>
    </center>
</form>