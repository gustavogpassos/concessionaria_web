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

// Pegando os valores passados por parametro:
$id = $_POST["id"];
$nome = $_POST["nomecor"];

if ( alteraCor( $conexao, $id, $nome ) ) {
    ?>
    <p class="text-success">A cor <?= $nome ?> foi alterada.</p>
    <?php 
} else { 
    $msg = mysqli_error( $conexao );
    ?>
    <p class="text-danger">A cor <?= $nome ?> não foi alterada: <?= $msg ?></p>
    <?php
}
}
include ("../Rodape.php"); 
