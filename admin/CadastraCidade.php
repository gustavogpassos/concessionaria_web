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
    $nome = $_POST["nome"];
    $uf = $_POST["uf"];

    if (insereCidade($conexao, $nome, $uf)) {
        ?>
        <p class="text-success">A cidade <?= $nome ?> foi adicionada.</p>
        <?php
    } else {
        $msg = mysqli_error($conexao);
        ?>
        <p class="text-danger">A cidade <?= $nome ?> não foi adicionada: <?= $msg ?></p>
        <?php
    }
}


include ("../Rodape.php");
