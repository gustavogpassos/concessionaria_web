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



// Pegando os valores passados por parametro:
    $id = $_POST["id"];
    $titulo = $_POST["titulo"];
    $logradouro = $_POST["logradouro"];
    $numero = $_POST["numero"];
    $bairro = $_POST["bairro"];
    $complemento = $_POST["complemento"];
    $idcidade = $_POST["idcidade"];

    if (alteraEndereco($conexao, $id, $titulo, $logradouro, $numero, $bairro, $complemento, $idcidade)) {
       header("Location: ListaEnderecos.php?altera=true");
        die();
    } else {
        $msg = mysqli_error($conexao);
        ?>
        <p class="text-danger">O endereco <?= $logradouro ?> não foi alterado: <?= $msg ?></p>
        <?php
    }
}
    include ("../Rodape.php");
    