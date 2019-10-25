<?php include("ConectaUsuario.php");
include("BancoUsuario.php");
//include("LogicaUsuario.php");
$senhaMd5 = md5($_POST['senha']);
$usuario = buscaUsuario($conexao, $_POST["email"], $senhaMd5);
//echo $usuario['senha'];
//echo $senhaMd5;
//var_dump($usuario);

if( $usuario == null){
    $_SESSION["danger"] = "Usuário ou senha inválida.";
    header( "Location: FormularioLogin.php" );
} else
{
    $_SESSION["success"] = "Usuário logado com sucesso!";
    logaUsuario( $usuario["email"]);
    header( "Location: index.php" );
}