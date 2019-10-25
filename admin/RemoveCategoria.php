<?php
include ("ConectaAdmin.php");
include ("BancoCategoria.php");

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

    if (removeCategoria($conexao, $id)) {
        header("Location: ListaCategorias.php?removido=true");
        die();
    } else {
        $msg = mysqli_error($conexao);
        ?>
        <p class="text-danger">A categoria <?= $id ?> não foi excluída: <?= $msg ?></p>
        <?php
    }

}
    include ("../Rodape.php");
    