<?php

include("LogicaAdmin.php");

if (adminEstaLogado()) {
    include ("CabecalhoAdmin.php");
} else {
    include ("headerUnlogado.php");
}


if (isset($_SESSION["danger"])) {
    ?>
    <p class="alert-danger"> <?= $_SESSION["danger"] ?> </p>
    <?php
    unset($_SESSION["danger"]);
}

if (isset($_SESSION["success"])) {
    ?>
    <p class="alert-success"> <?= $_SESSION["success"] ?> </p>
    <?php
    unset($_SESSION["success"]);
}
?>

<h1>Bem vindo!</h1>

    <?php if (adminEstaLogado()) { ?>
    <p class="alert-success">Você está logado como <?= adminLogado()
        ?> .  <a href="logoutAdmin.php">Deslogar</a> </p>

<?php } else { ?>

    <h2>Login</h2>
    <form action="loginAdmin.php" method="post">
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
            </tr>
        </table>
    </form>        
<?php } ?>

<?php include ("../Rodape.php"); ?>