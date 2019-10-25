<?php
include ("ConectaUsuario.php");
include ("BancoEndereco.php");
include ("../admin/BancoCidade.php");


//verifica qual menu apresenter ao usuário
if (usuarioEstaLogado()) {
    include ("cabecalhoLogado.php");
} else {
    include ("cabecalhoNaoLogado.php");
}
//verifica se o usuário pode ter acesso ao conteúdo
if (!usuarioEstaLogado()) {
   include ("naoLogado.php");
} else {


    $id = $_POST['id'];
    $endereco = buscaEndereco($conexao, $id);

    $cidades = listaCidade($conexao);
    ?>

    <h1>Alteração de Endereço</h1>
    <form action="AlteraEndereco.php" method="Post">
        <input type="hidden" name="id" value="<?= $endereco['id'] ?>" >
        <table class="table">
            <tr>
                <td>Título:</td>
                <td><input class="form-control" type="texto" name="titulo" required="required" value="<?= $endereco['titulo'] ?>" > </td>
            </tr>
            <tr>
                <td>Logradouro:</td>
                <td><input class="form-control" type="texto" name="logradouro" required="required" value="<?= $endereco['logradouro'] ?>" > </td>
            </tr>
            <tr>
                <td>Número:</td>
                <td><input class="form-control" type="texto" name="numero" required="required" value="<?= $endereco['numero'] ?>" > </td>
            </tr>
            <tr>
                <td>Bairro:</td>
                <td><input class="form-control" type="texto" name="bairro" required="required" value="<?= $endereco['bairro'] ?>" > </td>
            </tr>
            <tr>
                <td>Complemento:</td>
                <td><input class="form-control" type="texto" name="complemento" value="<?= $endereco['complemento'] ?>" > </td>
            </tr>
            <tr>
                <td>Cidade:</td>
                <td>
                    <select class="form-control" name="idcidade">
                        <?php
                        foreach ($cidades as $cidade) {
                            $esseEhACidade = $endereco['idcidade'] == $cidade['id'];
                            $selecao = $esseEhACidade ? "selected='selected'" : "";
                            ?>
                            <option value="<?= $cidade['id'] ?>" <?= $selecao ?>>
                                <?= $cidade['nomecidade'] ?>
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
