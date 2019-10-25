<?php
include ("ConectaAdmin.php");
include ("BancoMarca.php");

if (adminEstaLogado()) {
    include ("CabecalhoAdmin.php");
} else {
    include ("headerUnlogado.php");
}

if (!adminEstaLogado()) {
    include ("naoLogadoAdmin.php");
} else {

// Pegando os valores passados por parametro:
    $id = $_POST["id"];
    $nome = $_POST["nome"];

    if (alteraMarca($conexao, $id, $nome)) {
        ?>
        <p class="text-success">A marca <?= $nome ?> foi alterada.</p>
        <?php
    } else {
        $msg = mysqli_error($conexao);
        ?>
        <p class="text-danger">A marca <?= $nome ?> n�o foi alterada: <?= $msg ?></p>
        <?php
    }
}
include ("../Rodape.php");
