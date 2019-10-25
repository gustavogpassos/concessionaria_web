<?php
include ("ConectaUsuario.php");
include ("BancoComentario.php");
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
    $mensagem = $_POST["mensagem"];
    $data = $_POST["datacoment"];
    $ident = usuarioLogado();
    $email = buscaidUsuario($conexao, $ident);
    $usuario = $email["id"];
    $id =$_POST["idcarro"];

    if (insereComentario($conexao, $mensagem, $data, $usuario, $id)) {
        header("Location: verAnuncio.php?id={$id}");
        
        
        die();
        
       
        
       
    } else {
        $msg = mysqli_error($conexao);
        ?>
        <p class="text-danger">O comentário <?= $mensagem ?> não foi postado: <?= $msg ?></p>
        <?php
    }
}


include ("../Rodape.php");
