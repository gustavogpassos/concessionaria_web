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


// Pegando os valores passados por parâmetro:
    $id = $_POST["id"];

    if (removeMarca($conexao, $id)) {
        header("Location: ListaMarcas.php?removido=true");
        die();
    } else {
        $msg = mysqli_error($conexao);
        ?>
        <p class="text-danger">A marca <?= $id ?> n�o foi exclu�da: <?= $msg ?></p>
        <?php
    }
}
include ("../Rodape.php");
