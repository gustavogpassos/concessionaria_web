<?php
include ("./ConectaUsuario.php");
include ("./BancoComentario.php");

if(usuarioEstaLogado()){
    include("./cabecalhoLogado.php");
    
}else{
    include ("./cabecalhoNaoLogado.php");
}

if(!usuarioEstaLogado()){
    include ("./naoLogado.php");
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