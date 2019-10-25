<?php
include ("ConectaAdmin.php");
include ("BancoCidade.php");


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
    $uf = $_POST["uf"];


    if (removeCidade($conexao, $id)) {
        header("Location: ListaCidades.php?removido=true&estado={$uf}");
        die();
    } else {
        $msg = mysqli_error($conexao);
        ?>
        <p class="text-danger">A cidade <?= $id ?> não foi excluída: <?= $msg ?></p>
        <?php
    }
}

include ("../Rodape.php");
