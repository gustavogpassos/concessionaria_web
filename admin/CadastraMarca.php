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
    $nome = $_POST["nomemarca"];

    if (insereMarca($conexao, $nome)) {
        ?>
        <p class="text-success">A Marca <?= $nome ?> foi adicionada.</p>
        <?php
    } else {
        $msg = mysqli_error($conexao);
        ?>
        <p class="text-danger">A marca <?= $nome ?> não foi adicionada: <?= $msg ?></p>
        <?php
        
    }
}
// A linha abaixo foi isolada porque, ao finalizar a execução da página, a conexão é encerrada automaticamente.
// mysqli_close($conexao);
header("Location: ListaMarcas.php");
include ("../Rodape.php");
