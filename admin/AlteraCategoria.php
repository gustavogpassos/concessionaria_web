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

// Pegando os valores passados por parametro:
$id = $_POST["id"];
$nome = $_POST["nomecategoria"];

if (alteraCategoria( $conexao, $id, $nome ) ) {
    ?>
    <p class="text-success">A categoria <?= $nome ?> foi alterada.</p>
    <?php 
} else { 
    $msg = mysqli_error( $conexao );
    ?>
    <p class="text-danger">A categoria <?= $nome ?> não foi alterada: <?= $msg ?></p>
    <?php
}
}
include ("../Rodape.php"); 
