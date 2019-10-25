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


// Pegando os valores passados por parâmetro:
    $id = $_POST["id"];

    if (removeEstado($conexao, $id)) {
        header("Location: ListaEstados.php?removido=true");
        die();
    } else {
        $msg = mysqli_error($conexao);
        ?>
        <p class="text-danger">O estado <?= $id ?> não foi excluído: <?= $msg ?></p>
        <?php
    }
}
include ("../Rodape.php");
