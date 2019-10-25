<?php  
include ("ConectaAdmin.php");
include ("BancoEstado.php");

//verifica qual menu apresenter ao usuário
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
$nome = $_POST["nomeestado"];
$sigla = $_POST["sigla"];

if ( insereEstado( $conexao, $nome, $sigla) ) {
    ?>
    <p class="text-success">O Estado <?= $nome ?> foi adicionado.</p>
    <?php 
} else { 
    $msg = mysqli_error( $conexao );
    ?>
    <p class="text-danger">O Estado <?= $nome ?> não foi adicionado: <?= $msg ?></p>
    <?php
}

// A linha abaixo foi isolada porque, ao finalizar a execução da página, a conexão é encerrada automaticamente.
// mysqli_close($conexao);
}
include ("../Rodape.php"); 
