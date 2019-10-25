<?php include("ConectaAdmin.php");
include("BancoAdmin.php");
//include("LogicaUsuario.php");

$usuario = buscaAdmin($conexao, $_POST["email"], $_POST["senha"]);
//var_dump($usuario);
if( $usuario == null){
    $_SESSION["danger"] = "Usuário ou senha inválida.";
    header( "Location: index.php" );
} else
{
    $_SESSION["success"] = "Usuário logado com sucesso!";
    logaAdmin( $usuario["email"] );
    header( "Location: index.php" );
}