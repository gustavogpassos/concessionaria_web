<?php
include ("ConectaAdmin.php");
include ("BancoMarca.php");

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
    $marca = buscaMarca($conexao, $id);

    $marcas = listaMarca($conexao);
    ?>

    <h1>Alteração de Marca</h1>
    <form action="AlteraMarca.php" method="Post">
        <input type="hidden" name="id" value="<?= $marca['id'] ?>" >
        <table class="table">
            <tr>
                <td>Nome:</td>
                <td><input class="form-control" type="texto" name="nome" required="required" value="<?= $marca['nomemarca'] ?>" > </td>
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
