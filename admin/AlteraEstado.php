<?php 
 
include ("ConectaAdmin.php");
include ("BancoEstado.php");

if (adminEstaLogado()) {
    include ("CabecalhoAdmin.php");
} else {
    include ("headerUnlogado.php");
}
 



if(!adminEstaLogado()){
    include ("naoLogadoAdmin.php");
    
}else{


      
// Pegando os valores passados por parametro:
$id = $_POST["id"];
$nome = $_POST["nome"];
$sigla = $_POST["sigla"];

if ( alteraEstado( $conexao, $id, $nome, $sigla ) ) {
    ?>
    <p class="text-success">O Estado <?= $nome ?> foi alterado.</p>
    <?php 
} else { 
    $msg = mysqli_error( $conexao );
    ?>
    <p class="text-danger">O estado <?= $nome ?> não foi alterado: <?= $msg ?></p>
    <?php
}
}

include ("../Rodape.php"); 
