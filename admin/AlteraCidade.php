<?php
include ("ConectaAdmin.php");
include ("BancoCidade.php");

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
    $uf = $_POST["uf"];

    if (alteraCidade($conexao, $id, $nome, $uf)) {
        ?>
        <p class="text-success">A cidade <?= $nome ?> foi alterada.</p>
        <?php
    } else {
        $msg = mysqli_error($conexao);
        ?>
        <p class="text-danger">A cidade <?= $nome ?> não foi alterada: <?= $msg ?></p>
        <?php
    }
}
    include ("../Rodape.php");
    