<?php
include ("ConectaUsuario.php");
include ("../admin/BancoAnuncio.php");
include ("./BancoComentario.php");

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


    if (removeComentariosCarro($conexao, $id)) {
        removeAnuncio($conexao, $id);
        echo "Anuncio removido <br> ";
        echo "<a href='ListaMeusAnuncios.php' class='btn btn-success'>Voltar para meus anuncios</a>";
        die();
    } else {
        $msg = mysqli_error($conexao);
        ?>
        <p class="text-danger">O endereco <?= $id ?> não foi excluído: <?= $msg ?></p>
        <?php
    }
}

include ("../Rodape.php");


/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

