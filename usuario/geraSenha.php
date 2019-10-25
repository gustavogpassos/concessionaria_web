<?php
include ("./ConectaUsuario.php");
include ("./BancoUsuario.php");

/*if(emailUsado($conexao, $_POST['email'])){
    $_SESSION["danger"] = "Email já cadastrado!";
    header("Location: FormularioUsuario.php");
    
    die();
}
*/

$email = $_POST["email"];

$busca = buscaidUsuariooo($conexao, $email);
$result = $busca["id"];

$novasenha = geraSenha(6, false, true);


//echo $novasenha;


$senhaMd5 = md5($novasenha);

$usuario = alteraSenhaEsq($conexao, $senhaMd5, $result);


//var_dump($usuario);
if( $usuario == null){
    $_SESSION["danger"] = "Essa conta de e-mail não está cadastrada!!";
    header( "Location: esqueciMinhaSenha.php" );
} else
{
    $_SESSION["success"] = "Uma nova senha foi enviada ao endereço de e-mail";
    header( "Location: http://upf.br/~126793/enviar.php?email=$email&novasenha=$novasenha" );
}

