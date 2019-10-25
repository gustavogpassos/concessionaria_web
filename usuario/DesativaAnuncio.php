<?php 
 
include ("ConectaUsuario.php");
include ("../admin/BancoAnuncio.php");

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


if (desativaAnuncio( $conexao, $id  ) ) {
    header("Location: ListaMeusAnuncios.php?desativado=true");
        die();
} else { 
    $msg = mysqli_error( $conexao );
    ?>
    <p class="text-danger">O anúncio não foi desativado: <?= $msg ?></p>
    <?php
}
}
include ("../Rodape.php"); 
