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

    $id = $_POST['id'];
    $estado = buscaEstado($conexao, $id);

    $estados = listaEstado($conexao);
    ?>

    <h1>Alteração de Estado</h1>
    <form action="AlteraEstado.php" method="Post">
        <input type="hidden" name="id" value="<?= $estado['id'] ?>" >
        <table class="table">
            <tr>
                <td>Nome:</td>
                <td><input class="form-control" type="texto" name="nome" required="required" value="<?= $estado['nomeestado'] ?>" > </td>
            </tr>
            <tr>
                <td>UF:</td>
                <td><input class="form-control" type="texto" name="sigla" maxlength="2" required="required" value="<?= $estado['sigla'] ?>" > </td>
            </tr>
            <tr>
                <td> <input class="btn btn-primary" type="submit" value="Alterar"> 
                    <input class="btn" type="reset" value="Limpar"> </td>
            </tr>
        </table>
    </form>     

    <?php
}

include ("../Rodape.php");
