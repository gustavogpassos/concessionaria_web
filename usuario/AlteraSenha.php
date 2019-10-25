<?php
include ("./ConectaUsuario.php");
include ("./BancoUsuario.php");


if (usuarioEstaLogado()) {
    include ("cabecalhoLogado.php");
} else {
    include ("cabecalhoNaoLogado.php");
}
//verifica se o usuário pode ter acesso ao conteúdo
if (!usuarioEstaLogado()) {
   include ("naoLogado.php");
} else {


$id = $_POST['id'];

$senhaAntiga = md5($_POST['senhaAntiga']);
$senhaNova = md5($_POST['senhaNova']);
$confirmacao = md5($_POST['confirmacao']);

$antiga = buscaSenha($conexao, $id);

if($senhaAntiga != $antiga['senha']){
    
    header("Location: PerfilLogado.php?inc=true");
    die();
}

if($senhaNova != $confirmacao){
   
    header("Location: PerfilLogado.php?con=true");
    die();    
}

//$antiga = buscaSenha($conexao, $id);
/*echo $antiga['senha'] . "<br>";
echo $senhaAntiga . "<br>";
echo $id . "<br>";
echo $senhaNova . "<br>";
echo $confirmacao . "<br>";*/




if (alteraSenha($conexao, $id, $senhaAntiga, $senhaNova)) {
    $_SESSION["senha"] = "Senha alterada com sucesso!";
       header("Location: PerfilLogado.php");
        die();
    } else {
        $msg = mysqli_error($conexao);
        ?>
        <p class="text-danger">A senha nao foi alterada <?=$msg?></p>
        <a class="btn btn-success" href="PerfilLogado.php">Voltar para meu perfil.</a>
        <?php
    }
}
    include ("../Rodape.php");



