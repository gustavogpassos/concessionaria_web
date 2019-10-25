<?php
include ("ConectaAdmin.php");
include ("BancoCidade.php");
include ("BancoEstado.php");

//verifica qual menu apresenter ao usuário
if (adminEstaLogado()) {
    include ("CabecalhoAdmin.php");
} else {
    include ("headerUnlogado.php");
}
//verifica se o usuário pode ter acesso ao conteúdo
if (!adminEstaLogado()) {
    include ("naoLogadoAdmin.php");
} else {


    $id = $_POST['id'];
    $cidade = buscaCidade($conexao, $id);

    $estados = listaEstado($conexao);
    ?>

    <h1>Alteração de Cidade</h1>
    <form action="AlteraCidade.php" method="Post">
        <input type="hidden" name="id" value="<?= $cidade['id'] ?>" >
        <table class="table">
            <tr>
                <td>Nome:</td>
                <td><input class="form-control" type="texto" name="nome" required="required" value="<?= $cidade['nomecidade'] ?>" > </td>
            </tr>
            <tr>
                <td>UF:</td>
                <td>
                    <select class="form-control" name="uf">
                        <?php
                        foreach ($estados as $estado) {
                            $esseEhOEstado = $cidade['uf'] == $estado['id'];
                            $selecao = $esseEhOEstado ? "selected='selected'" : "";
                            ?>
                            <option value="<?= $estado['id'] ?>" <?= $selecao ?>>
                                <?= $estado['sigla'] ?>
                            </option>
                        <?php } ?>
                </td>
            </tr>
            <tr>
                <td> <input class="btn btn-primary" type="submit" value="Alterar"> 
                    <input class="btn" type="reset" value="Limpar"> </td>
            </tr>
        </table>
    </form>     

    <?php
}

include ("../Rodape.php");
