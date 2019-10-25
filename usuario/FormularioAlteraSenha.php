<?php
include ("./ConectaUsuario.php");
include ("./BancoUsuario.php");
include ("./cabecalhoLogado.php");

$id = $_POST['id'];



if (array_key_exists("altera", $_GET) && $_GET["altera"] == true) {
    ?>
    <p class="alert-success">Endereco alterado com sucesso.</p>
    <?php
}

if (isset($_SESSION["danger"])) {
    ?>
    <p class="alert-danger"><?= $_SESSION["danger"] ?></p>

    <?php
    unset($_SESSION["danger"]);
}
?>
<form action="AlteraSenha.php" method="post">
    <table class="table table-bordered table-hover table-responsive">
        <tr>
            <th class="active" colspan="2">
        <h3>&nbsp; Alteração de senha</h3>
        </th>
        </tr>
        <tr>
            <td><label>Senha antiga</label></td>
            <td>
                <input class="form-control" size="20" type="password" name="senhaAntiga" required>
            </td>
        </tr>
        <tr>
            <td><label>Nova senha</label></td>
            <td>
                <input class="form-control" size="20" type="password" name="senhaNova" required>
            </td>
        </tr>
        <tr>
            <td><label>Confime a nova senha</label></td>
            <td>
                <input class="form-control" size="20" type="password" name="confirmacao" required>
                <input type="hidden" name="id" value="<?= $id ?>">
            </td>
        </tr>
        <tr>
            <td colspan="2"><input type="submit" class="btn btn-primary" value="Alterar senha"></td>

        </tr>


    </table>
</form>
