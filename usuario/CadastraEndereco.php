<?php
include ("ConectaUsuario.php");
include ("BancoEndereco.php");
include ("BancoUsuario.php");

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
    $titulo = $_POST["titulo"];
    $logradouro = $_POST["logradouro"];
    $numero = $_POST["numero"];
    $bairro = $_POST["bairro"];
    $complemento = $_POST["complemento"];
    $cidade = $_POST["idcidade"];
    
    $ident = usuarioLogado();
    $email = buscaidUsuario($conexao, $ident);
    $usuario = $email["id"];
    

    if (insereEndereco($conexao, $titulo, $logradouro, $numero, $bairro, $complemento, $cidade, $usuario)) {
        header("Location: ListaEnderecos.php?add=true");
        die();
    } else {
        $msg = mysqli_error($conexao);
        ?>
        <p class="text-danger">O endereco <?= $logradouro ?> não foi adicionado: <?= $msg ?></p>
        <?php
    }
}


include ("../Rodape.php");
