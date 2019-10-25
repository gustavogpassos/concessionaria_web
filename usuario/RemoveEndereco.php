<?php
include ("ConectaUsuario.php");
include ("BancoEndereco.php");


//verifica qual menu apresenter ao usuário
if (usuarioEstaLogado()) {
    include ("cabecalhoLogado.php");
} else {
    include ("cabecalhoNaoLogado.php");
}
//verifica se o usuário pode ter acesso ao conteúdo
if (!usuarioEstaLogado()) {
   include ("naoLogado.php");
} else {


// Pegando os valores passados por parâmetro:
    $id = $_POST["id"];


    if (removeEndereco($conexao, $id)) {
        header("Location: ListaEnderecos.php?removido=true");
        die();
    } else {
        $msg = mysqli_error($conexao);
        ?>
        <p class="text-danger">O endereco <?= $id ?> não foi excluído: <?= $msg ?></p>
        <?php
    }
}

include ("../Rodape.php");
