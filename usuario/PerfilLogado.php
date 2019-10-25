<?php
include ("./ConectaUsuario.php");
include ("./BancoUsuario.php");
include ("../admin/BancoAnuncio.php");
include ("./BancoEndereco.php");

if (usuarioEstaLogado()) {
    include ("./cabecalhoLogado.php");
} else {
    include ("./cabecalhoNaoLogado.php");
}


if (!usuarioEstaLogado()) {
    include ("./naoLogado.php");
} else {
    if (isset($_SESSION["danger"])) {
    ?>
    <p class="alert-danger"> <?= $_SESSION["danger"] ?> </p>
    <?php
    unset($_SESSION["danger"]);
}
    
    if (array_key_exists("inc", $_GET) && $_GET["inc"] == true) {
        ?>
        <p class="alert-danger">Senha antiga incorreta</p>
        <?php
    }
    
    if (array_key_exists("con", $_GET) && $_GET["con"] == true) {
        ?>
        <p class="alert-danger">Nova senha e confirmação não conferem</p>
        <?php
    }
    
    if (array_key_exists("dados", $_GET) && $_GET["dados"] == true) {
        ?>
        <p class="alert-success">Dados alterados com sucesso.</p>
        <?php
    }

    if (isset($_SESSION["senha"])) {
        ?>
        <p class="alert-success"><?= $_SESSION["senha"] ?></p>
        <?php
        unset($_SESSION["senha"]);
    }

    $email = usuarioLogado();



    $idperfil = buscaidUsuarioo($conexao, $email);

    $perfil = buscaPerfil($conexao, $idperfil['id']);

    $totalanun = totalAnuncioUs($conexao, $idperfil['id'])
    ?>

    <h1><?= $perfil['nomeuser'] ?> <?= $perfil['sobrenome'] ?></h1>
    <form action="FormularioAlteraDados.php" method="post">
        <table class="table table-bordered table-hover">
            <tr>
                <th colspan="2" class="active">
                    <label>Informações:</label>
                </th>
            </tr>
            <tr>
                <td>
                    <b>Email</b>
                </td>
                <td>
                    <?= $perfil['email'] ?>
                    <input type="hidden" value="<?= $perfil['email'] ?>" name="email">
                </td>
            </tr>
            <tr>
                <td>
                    <b>Telefone</b>
                </td>
                <td>
                    <?= $perfil['telefone'] ?>
                    <input type="hidden" value="<?= $perfil['telefone'] ?>" name="telefone">
                </td>
            </tr>
            <tr>
                <td>
                    <b>Gênero</b>
                </td>
                <td>
                    <?= $perfil['genero'] ?>
                    <input type="hidden" value="<?= $perfil['genero'] ?>" name="genero">
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <input type="hidden" value="<?=$idperfil['id']?>" name="id">
                    <input type="hidden" value="<?=$perfil['nomeuser']?>" name="nome">
                    <input type="hidden" value="<?=$perfil['sobrenome']?>" name="sobrenome">
                    
                    <input class="btn btn-primary" type="submit" value="Editar">
                </td>
            </tr>
        </table>
    </form>
    <br><br>

    <table class="table table-bordered table-hover">
        <tr>
            <th class="active">
                <label>Segurança</label>
            </th>
        </tr>
        <tr>

            <td>
                <form action="FormularioAlteraSenha.php" method="POST">
                    <input type="hidden" name="id" value="<?= $idperfil['id'] ?>">
                    <input type="submit" class="btn btn-primary" value="Alterar Senha">
                </form>
            </td>
        </tr>

    </table>
    <br><br>

    <?php
    $endereco = BuscaEnderecoUser($conexao, $perfil['id'])
    ?>

    <table class="table table-bordered table-hover">
        <tr>
            <th colspan="2" class="active">
                <label>Endereço</label>
            </th>
        </tr>
        <tr>
            <td>
                <label>Meus endereços</label>
            </td>
            <td>
                <a href="ListaEnderecos.php" class="btn btn-success">Ver</a>
            </td>
        </tr>

    </table>

   

<?php } ?>