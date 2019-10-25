<?php
include ("ConectaUsuario.php");
include ("../admin/BancoAnuncio.php");
include ("../admin/BancoCor.php");
include ("../admin/BancoCategoria.php");
include ("BancoUsuario.php");
include ("../admin/BancoCidade.php");
include ("../admin/BancoMarca.php");


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
    $anuncio = buscaAnuncio($conexao, $id);

    $cidades = listaCidade($conexao);
    $categorias = listaCategoria($conexao);
    $marcas = listaMarca($conexao);
    $cores = listaCor($conexao);
    ?>

    <h1>Alteração de Anúncio</h1>
    <form action="AlteraAnuncio.php" method="Post" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?= $anuncio['id'] ?>" >
        <table class="table">
            <tr>
                <td>Nome:</td>
                <td><input class="form-control" type="texto" name="nome" required="required" value="<?= $anuncio['nome'] ?>" > </td>
            </tr>
             <tr>
                <td>Placa:</td>
                <td><input class="form-control" type="texto" name="placa" required="required" value="<?= $anuncio['placa'] ?>" > </td>
            </tr>
            <tr>
                <td>Modelo:</td>
                <td><input class="form-control" type="texto" name="modelo" required="required" value="<?= $anuncio['modelo'] ?>" > </td>
            </tr>
            <tr>
                
            <tr>
                <td>Km:</td>
                <td><input class="form-control" type="texto" name="quilometragem" required="required" value="<?= $anuncio['quilometragem'] ?>" > </td>
            </tr>
            <tr>
                <td>Preço:</td>
                <td><input class="form-control" type="texto" name="preco" required="required" value="<?= $anuncio['preco'] ?>" > </td>
            </tr>
            <tr>
                <td>Ano:</td>
                <td><input class="form-control" type="texto" name="ano" required="required" value="<?= $anuncio['ano'] ?>" > </td>
            </tr>
            <tr>
                <td>Combustível:</td>
                <td><input class="form-control" type="texto" name="combustivel" required="required" value="<?= $anuncio['combustivel'] ?>" > </td>
            </tr>
            <tr>
                <td>Opcionais:</td>
                <td><input class="form-control" type="texto" name="opcionais"  value="<?= $anuncio['opcionais'] ?>" > </td>
            </tr>
            <tr>
                <td>Observações:</td>
                <td><input class="form-control" type="texto" name="observacoes" value="<?= $anuncio['observacoes'] ?>" > </td>
            </tr>
            <tr>
                <td>Imagem 1:</td>
                <td><input class="form-control" name="imagem" required type="file" value="<?= $anuncio['imagem'] ?>"></td>
            </tr>
            <tr>
                <td>Imagem 2:</td>
                <td><input class="form-control" name="imagem2"  type="file" value="<?= $anuncio['imagem2'] ?>"></td>
            </tr>
            <tr>
                <td>Imagem 3:</td>
                <td><input class="form-control" name="imagem3"  type="file" value="<?= $anuncio['imagem3'] ?>"> </td>
            </tr>
            <td>Cor:</td>
                
                <td>
                    <select class="form-control" name="cor">
                        <?php
                        foreach ($cores as $cor) {
                            $esseEhACor = $anuncio['cor'] == $cor['id'];
                            $selecao = $esseEhACor ? "selected='selected'" : "";
                            ?>
                            <option value="<?= $cor['id'] ?>" <?= $selecao ?>>
                                <?= $cor['nomecor'] ?>
                            </option>
                        <?php } ?>
                </td>
            </tr>
            <tr>
                <td>Marca:</td>
                
                <td>
                    <select class="form-control" name="idmarca">
                        <?php
                        foreach ($marcas as $marca) {
                            $esseEhAMarca = $anuncio['idmarca'] == $marca['id'];
                            $selecao = $esseEhAMarca ? "selected='selected'" : "";
                            ?>
                            <option value="<?= $marca['id'] ?>" <?= $selecao ?>>
                                <?= $marca['nomemarca'] ?>
                            </option>
                        <?php } ?>
                </td>
            </tr>
            <td>Categoria:</td>
                
                <td>
                    <select class="form-control" name="idcategoria">
                        <?php
                        foreach ($categorias as $categoria) {
                            $esseEhACategoria = $anuncio['idcategoria'] == $categoria['id'];
                            $selecao = $esseEhACategoria ? "selected='selected'" : "";
                            ?>
                            <option value="<?= $categoria['id'] ?>" <?= $selecao ?>>
                                <?= $categoria['nomecategoria'] ?>
                            </option>
                        <?php } ?>
                </td>
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
                
                            <input type="hidden" name="data"
                               value="<?= $data=date("Y-m-d") ?>" />
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
    