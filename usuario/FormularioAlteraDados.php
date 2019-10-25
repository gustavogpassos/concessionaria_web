<?php

include ("./ConectaUsuario.php");
include ("./BancoUsuario.php");


if (usuarioEstaLogado()) {
    include ("cabecalhoLogado.php");
} else {
    include ("cabecalhoNaoLogado.php");
}
//verifica se o usuário pode ter acesso ao conteúdo
if (!usuarioEstaLogado()) {
   include ("naoLogado.php");
} else {
    
    $id = $_POST['id'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];
    $nome = $_POST['nome'];
    $sobrenome = $_POST['sobrenome'];
    
    ?>

<script type="text/javascript">

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
<form action="AlteraDados.php" name="cad_usuario" method="post">
    <table class="table table-bordered table-hover">
        <tr>
            <th colspan="2">
                Dados do usuário
            </th>
        </tr>
        <tr>
            <td>Nome:</td>
            <td><input class="form-control" type="text" name="nome" required value="<?=$nome?>"></td>
        </tr>
        <tr>
            <td>Sobrenome:</td>
            <td><input class="form-control" type="text" name="sobrenome" required value="<?=$sobrenome?>"></td>
        </tr>
        <tr>
            <td>Email:</td>
            <td><input class="form-control" type="text" name="email" required value="<?=$email?>"></td>
        </tr>
        <tr>
            <td>Telefone:</td>
            <td><input class="form-control" type="text" name="telefone" required onkeypress="javascript: mascara_telefone()" value="<?=$telefone?>"></td>
        </tr>
        <tr>
            <td colspan="2">
                <input type="hidden" name="id" value="<?=$id?>">
                <input type="submit" class="btn btn-primary" value="Editar">
                <a class="btn btn-danger" href="PerfilLogado.php">Cancelar</a>
                
            </td>
        </tr>
    </table>
</form>
    
    
    
    
    
    
    
    <?php
}
include ("../Rodape.php");