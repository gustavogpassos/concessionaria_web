<?php
include ("ConectaAdmin.php");
include ("BancoCidade.php");
include ("./BancoEstado.php");

if (adminEstaLogado()) {
    include ("CabecalhoAdmin.php");
} else {
    include ("headerUnlogado.php");
}

if (!adminEstaLogado()) {
    include ("naoLogadoAdmin.php");
} else {
    $estados = listaEstado($conexao);
    ?>

    <form action="ListaCidades.php" method="get">
        <table class="table table-bordered table-striped">
            <tr>
                <th>
                    <label>Selecione o estado</label>
                </th>
            </tr>
            <tr>
                <td>
                    <select class="form-control" name="estado">
                        <?php foreach ($estados as $estado) { ?>
                            <option value="<?= $estado['id'] ?>"><?= $estado['nomeestado'] ?></option>
                        <?php } ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td>
                    <input class="btn btn-info" type="submit" value="Ver Cidades">
                </td>
            </tr>
        </table>

    </form>







    <?php
}