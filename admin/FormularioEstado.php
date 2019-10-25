<?php
include ("ConectaAdmin.php");
include ("BancoEstado.php");

//verifica qual menu apresenter ao usuário
if (adminEstaLogado()) {
    include ("CabecalhoAdmin.php");
} else {
    include ("headerUnlogado.php");
}
//verifica se o usuário pode ter acesso ao conteúdo
if (!adminEstaLogado()) {
    include ("naoLogadoAdmin.php");
} else {


    $estados = listaEstado($conexao);
    ?>

    <h1>Dados do Cadastro de Estados</h1>
    <form action="CadastraEstado.php" method="Post">
        <table class="table">
            <tr>
                <td>Nome:</td>
                <td><input class="form-control" type="texto" name="nomeestado" required="required" value="" > </td>
            </tr>
            <tr>
                <td>UF:</td>
                <td><input class="form-control" type="texto" name="sigla" maxlength="2" required="required" value="" > </td>
            </tr>
            <tr>
                <td> <input class="btn btn-primary" type="submit" value="Cadastrar"> 
                    <input class="btn" type="reset" value="Limpar"> </td>
            </tr>
        </table>
    </form>     

    <?php
}
include ("../Rodape.php");
