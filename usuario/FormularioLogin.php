<?php include ("./cabecalhoNaoLogado.php");
include("LogicaUsuario.php");

if( isset( $_SESSION["danger"])) { ?>
    <p class="alert-danger"> <?= $_SESSION["danger"]?> </p>
<?php 
    unset( $_SESSION["danger"] );
} 

if( isset( $_SESSION["success"])) { ?>
    <p class="alert-success"> <?= $_SESSION["success"]?> </p>
<?php 
    unset( $_SESSION["success"] );
}

if (array_key_exists("email", $_GET) && $_GET["email"] == true) {
        ?>
        <p class="alert-success">Email alterado! Faça login novamente.</p>
        <?php
    }

?>

<h1>Bem vindo!</h1>

<?php if( usuarioEstaLogado() ) { ?>
    <p class="alert-success">Você está logado como <?= usuarioLogado() 
    ?> .  <a href="logout.php">Deslogar</a> </p>

<?php } else { ?>

    <h2>Login</h2>
    <form action="loginUsuario.php" method="post">
        <table class="table">
            <tr>
                <td>e-mail</td>
                <td><input class="form-control" type="email" name="email"></td>
            </tr>
            <tr>
                <td>senha</td>
                <td><input class="form-control" type="password" name="senha"></td>
            </tr>
            <tr>
                <td><button class="btn btn-primary">Login</button></td>
                <td><a href="esqueciMinhaSenha.php">Esqueci minha senha</a></td>
            </tr>
        </table>
    </form>        
<?php } ?>

<?php include ("../Rodape.php"); ?>