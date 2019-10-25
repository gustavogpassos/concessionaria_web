<?php
include ("ConectaAdmin.php");
include ("BancoEstado.php");


if (adminEstaLogado()) {
    include ("CabecalhoAdmin.php");
} else {
    include ("headerUnlogado.php");
}



if (!adminEstaLogado()) {
    include ("naoLogadoAdmin.php");
} else {




    if (array_key_exists("removido", $_GET) && $_GET["removido"] == true) {
        ?>
        <p class="alert-success">Estado excluido com sucesso.</p>
        <?php
    }
    ?>
    <?php
    $filtro = "";
    if (array_key_exists("filtro", $_POST)) {
        $filtro = $_POST["filtro"];
    }
    ?>

    <?php
    $ordem = "";
    if (array_key_exists("ordem", $_POST)) {
        $ordem = $_POST["ordem"];
    }
    ?>

    <h1>Lista de Estados </h1>



    <table class="table table-striped table-bordered">
        <tr>
            <td>
                <form action="ListaEstados.php" method="Post">
                    Filtrar:
                    <input type="text" name="filtro" value="">
                    <button class="btn btn-default">Filtrar</button>
                    <!--<input type="image" src="imagens\lupa.jpg" alt="Submit" width="36" height="36" title="Filtrar">-->
                </form>
            </td>
            <td>
                <a class="btn btn-success" href="FormularioEstado.php">Novo</a>
            </td>
        </tr>
    </table>

    <table class="table table-striped table-bordered">

        <tr>
            <th>
        <form action="ListaEstados.php" method="Post">
            <input type="hidden" name="ordem" value="id">
            <button class="btn btn-group-justified"> ID </button>
        </form>
    </th>

    <th>
    <form action="ListaEstados.php" method="Post">
        <input type="hidden" name="ordem" value="nomeestado">
        <button class="btn btn-group-justified"> Nome do Estado </button>
    </form>
    </th>

    <th>
    <form action="ListaEstados.php" method="Post">
        <input type="hidden" name="ordem" value="sigla">
        <button class="btn btn-group-justified"> Sigla </button>
    </form>
    </th>

    <th> </th>

    <th> </th>
    <?php
    $estados = listaEstados($conexao, $filtro, $ordem);
    foreach ($estados as $estado) {
        ?>    
        <tr>
            <td> <?= $estado['id'] ?> </td>
            <td> <?= $estado['nomeestado'] ?> </td>
            <td> <?= $estado['sigla'] ?> </td>
            <td>
                <form action="FormularioAlteraEstado.php" method="Post">
                    <input type="hidden" name="id" value="<?= $estado['id'] ?>">
                    <button class="btn btn-primary">Alterar</button>
                </form>
            </td>
            <td>
                <form action="RemoveEstado.php" method="Post">
                    <input type="hidden" name="id" value="<?= $estado['id'] ?>">
                    <button class="btn btn-danger">Remover</button>
                </form>
            </td>
        </tr>
        <?php
    }
    ?>
    </table>
    <?php
}
include ("../Rodape.php");
