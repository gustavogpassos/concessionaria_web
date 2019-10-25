<?php
include ("./ConectaUsuario.php");
include ("./BancoUsuario.php");

if(emailUsado($conexao, $_POST['email'])){
    $_SESSION["danger"] = "Email já cadastrado!";
    header("Location: FormularioUsuario.php");
    
    die();
}

if(cpfUsado($conexao, $_POST['cad_cpf'])){
    $_SESSION["danger2"] = "CPF já cadastrado!";
    header("Location: FormularioUsuario.php");
    
    die();
}

if(cpfUsado($conexao, $_POST['cad_cpf'])){
    $_SESSION['danger'] = "Erro! o cpf informado já está cadastrado!";
    header("Location: FormularioUsuario.php?add=falsee");
    die();
}

$senhaMd5 = md5($_POST['senha']);

$usuario = insereUsuario($conexao, $_POST["cad_cpf"], $_POST["nome"], $_POST["sobrenome"], $_POST["telefone"], $_POST["genero"], $_POST["email"], $senhaMd5, $_POST["datacad"]);

//var_dump($usuario);
if( $usuario == null){
    $_SESSION["danger"] = "Não cadastrado";
    header( "Location: FormularioLogin.php" );
} else
{
    header( "Location: FormularioLogin.php" );
}

