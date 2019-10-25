<?php
include ("./cabecalhoNaoLogado.php");
include ("./ConectaUsuario.php");
include ("./BancoUsuario.php");

if (isset($_SESSION["danger"])) {
    ?>
    <p class="alert-danger"> <?= $_SESSION["danger"] ?> </p>
    <?php
    unset($_SESSION["danger"]);
}

if (isset($_SESSION["danger2"])) {
    ?>
    <p class="alert-danger"> <?= $_SESSION["danger2"] ?> </p>
    <?php
    unset($_SESSION["danger2"]);
}
?>






<h1>Esqueci Minha Senha</h1><br><br>

    <form action="geraSenha.php" method="Post">
        <table class="table">
            <tr>
                <td>Informe seu e-mail:</td>
                <td><input class="form-control" type="texto" name="email" required="required" value="" > 
                </td>
            </tr>
            
            <tr>
                <td> <input class="btn btn-primary" type="submit" value="Enviar"> 
                    <input class="btn" type="reset" value="Limpar"> </td>
            </tr>
        </table>
    </form>     

    