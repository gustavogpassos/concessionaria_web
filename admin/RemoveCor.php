<?php
include ("ConectaAdmin.php");
include ("BancoCor.php");

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

    if (removeCor($conexao, $id)) {
        header("Location: ListaCores.php?removido=true");
        die();
    } else {
        $msg = mysqli_error($conexao);
        ?>
        <p class="text-danger">A cor <?= $id ?> não foi excluída: <?= $msg ?></p>
        <?php
    }

}
    include ("../Rodape.php");
    