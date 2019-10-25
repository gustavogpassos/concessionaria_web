<?php 
 
include ("ConectaAdmin.php");
include ("BancoAnuncio.php");

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


if (desativaAnuncio( $conexao, $id  ) ) {
    ?>
    <p class="text-success">O Anúncio foi desativado.</p>
    <?php 
} else { 
    $msg = mysqli_error( $conexao );
    ?>
    <p class="text-danger">O anúncio não foi desativado: <?= $msg ?></p>
    <?php
}
}
include ("../Rodape.php"); 
