<?php
include ("ConectaAdmin.php");
include ("BancoCidade.php");

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
        <p class="alert-success">Cidade excluída com sucesso.</p>
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
    $uf = $_GET['estado'];
    ?>

    <h1>Lista de Cidades </h1>

    <table class="table table-striped table-bordered">
        <tr>
            <td>
                <form action="ListaCidades.php?estado=<?=$uf?>" method="Post">
                    Filtrar:
                    <input type="text" name="filtro" value="">
                    <button class="btn btn-default">Filtrar</button>
                    <!--<input type="image" src="imagens\lupa.jpg" alt="Submit" width="36" height="36" title="Filtrar">-->
                </form>
            </td>
            <td>
                <a class="btn btn-success" href="FormularioCidade.php">Novo</a>
            </td>
        </tr>
    </table>

    <table class="table table-striped table-bordered">
        <tr>
            <th>
        <form action="ListaCidades.php?estado=<?=$uf?>" method="Post">
            <input type="hidden" name="ordem" value="id">
            <button class="btn btn-group-justified"> ID </button>
        </form>
    </th>

    <th>
    <form action="ListaCidades.php?estado=<?=$uf?>" method="Post">
        <input type="hidden" name="ordem" value="nomecidade">
        <button class="btn btn-group-justified"> Nome da Cidade </button>
    </form>
    </th>

    <th>
    <form action="ListaCidades.php?estado=<?=$uf?>" method="Post">
        <input type="hidden" name="ordem" value="sigla">
        <button class="btn btn-group-justified"> UF </button>
    </form>
    </th>

    <th> </th>

    <th> </th>
    <?php
    
    $cidades = listaCidadesEstado($conexao, $filtro, $ordem, $uf);
    foreach ($cidades as $cidade) {
        ?>    
        <tr>
            <td> <?= $cidade['id'] ?> </td>
            <td> <?= $cidade['nomecidade'] ?> </td>
            <td> <?= $cidade['uf'] ?> </td>

            <td>
                <form action="FormularioAlteraCidade.php" method="Post">
                    <input type="hidden" name="id" value="<?= $cidade['id'] ?>">
                    <button class="btn btn-primary">Alterar</button>
                </form>
            </td>
            <td>
                <form action="RemoveCidade.php" method="Post">
                    <input type="hidden" name="id" value="<?= $cidade['id'] ?>">
                    <input type="hidden" name="uf" value="<?=$uf?>">
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
