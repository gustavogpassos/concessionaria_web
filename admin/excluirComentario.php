<?php
include ("./ConectaAdmin.php");
include ("../usuario/BancoComentario.php");

if(adminEstaLogado()){
    include("./CabecalhoAdmin.php");
    
}else{
    include ("./headerUnlogado.php");
}

if(!adminEstaLogado()){
    include ("./naoLogadoAdmin.php");
}else{
    $id = $_POST['id'];
    $idcarro = $_POST['idcarro'];
    
    
    if(excluirComentario($conexao, $id)){
        header("Location: verAnuncio.php?id={$idcarro}");
        die();
    }else{
        ?>
<p class="text-danger">O comentário não foi excluído.</p>
<?php
    }
}

include ("../Rodape.php");