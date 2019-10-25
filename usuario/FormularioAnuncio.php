<?php
include ("ConectaUsuario.php");
include ("../admin/BancoAnuncio.php");
include ("../admin/BancoCor.php");
include ("../admin/BancoCategoria.php");
include ("BancoUsuario.php");
include ("../admin/BancoCidade.php");
include ("../admin/BancoMarca.php");
include ("../admin/BancoEstado.php");


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



    $usuario = usuarioLogado();
    if (array_key_exists("usuario", $_POST)) {
        $usuario = $_POST["usuario"];
    }

    $marcas = listaMarca($conexao);
    $categorias = listaCategoria($conexao);
    $cores = listaCor($conexao);
    $cidades = listaCidade($conexao);
    ?>
    <script type="text/javascript">
        $(document).ready(function () {
            $('#estado').change(function () {
                $('#cidade').load('listaCidades.php?estado=' + $('#estado').val());
            });
        });
    </script>

    <h1>Dados do Anúncio</h1>
    <form action="CadastraAnuncio.php" method="Post" enctype="multipart/form-data">
        <table class="table">
            <tr>
                <td>Nome:</td>
                <td><input class="form-control" type="texto" name="nome" required="required" value="" > </td>
            </tr>
            <tr>
                <td>Placa:</td>
                <td><input class="form-control" type="texto" name="placa" required="required" value="" > </td>
            </tr>
            <tr>
                <td>Modelo:</td>
                <td><input class="form-control" type="texto" name="modelo" required="required" value="" > </td>
            </tr>
            <tr>

            <tr>
                <td>Km:</td>
                <td><input class="form-control" type="texto" name="quilometragem" required="required" value="" > </td>
            </tr>
            <tr>
                <td>Preço:</td>
                <td><input class="form-control" type="texto" name="preco" required="required" value="" > </td>
            </tr>
            <tr>
                <td>Ano:</td>
                <td><input class="form-control" type="texto" name="ano" required="required" value="" > </td>
            </tr>
            <tr>
                <td>Combustível:</td>
                <td><input class="form-control" type="texto" name="combustivel" required="required" value="" > </td>
            </tr>
            <tr>
                <td>Opcionais:</td>
                <td><input class="form-control" type="texto" name="opcionais"  value="" > </td>
            </tr>
            <tr>
                <td>Observações:</td>
                <td><input class="form-control" type="texto" name="observacoes" value="" > </td>
            </tr>
            <tr>
                <td>Imagem 1:</td>
                <td><input class="form-control" name="imagem" required type="file" value=""></td>
            </tr>
            <tr>
                <td>Imagem 2:</td>
                <td><input class="form-control" name="imagem2"  type="file" value=""></td>
            </tr>
            <tr>
                <td>Imagem 3:</td>
                <td><input class="form-control" name="imagem3"  type="file" value=""> </td>
            </tr>
            <td>Cor:</td>
            <td>
                <select class="form-control" name="cor" required="">
                    
                    
                    <option></option>
                    <?php
                    foreach ($cores as $cor) {
                        $esseEhACor = $anuncio['cor'] == $cor['id'];
                        $selecao = $esseEhACor ? "selected='selected'" : "";
                        ?>
                        <option value="<?= $cor['id'] ?>" <?= $selecao ?>>
                            <?= $cor['nomecor'] ?>
                        </option>
                    <?php } ?>
                </select>
            </td>
            </tr>
            <tr>
                <td>Marca:</td>
                <td>
                    <select class="form-control" name="idmarca" required="">
                        
                        <option></option>
                        <?php
                        foreach ($marcas as $marca) {
                            $esseEhAMarca = $anuncio['idmarca'] == $marca['id'];
                            $selecao = $esseEhAMarca ? "selected='selected'" : "";
                            ?>
                            <option value="<?= $marca['id'] ?>" <?= $selecao ?>>
                                <?= $marca['nomemarca'] ?>
                            </option>
                        <?php } ?>
                    </select>
                </td>
            </tr>
            <tr>
            <td>Categoria:</td>
            <td>
                <select class="form-control" name="idcategoria" required="">
                    
                    <option></option>
                    <?php
                    foreach ($categorias as $categoria) {
                        $esseEhACategoria = $anuncio['idcategoria'] == $categoria['id'];
                        $selecao = $esseEhACategoria ? "selected='selected'" : "";
                        ?>
                        <option value="<?= $categoria['id'] ?>" <?= $selecao ?>>
                            <?= $categoria['nomecategoria'] ?>
                        </option>
                    <?php } 
                    
                    $estado = listaEstado($conexao);
                    
                    ?>
                </select>
            </td>
            </tr>
            <tr>
                <td>Estado:</td>
                <td>
                    <select class="form-control" name="estado" id="estado" required="">
                        
                        <option></option>
                        <?php foreach ($estado as $est){ ?>
                        <option value="<?= $est['id'] ?>"><?= $est['nomeestado'] ?></option>
                        <?php } ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Cidade:</td>
                <td id="cidade">
                    
                    <!--<select class="form-control" name="idcidade" id="cidade">
                        <option>Selecione</option>
                        <option></option>
                        <?php
                        //foreach ($cidades as $cidade) {
                          //  $esseEhACidade = $endereco['idcidade'] == $cidade['id'];
                            //$selecao = $esseEhACidade ? "selected='selected'" : "";
                            ?>
                            <option value="">
                                
                            </option>
                        <?php //} ?>-->
                    
                        
                </td>
            </tr>
            <tr>
                <td>
                    <?php date_default_timezone_set('America/Sao_Paulo');  ?>
                    <input type="hidden" name="data"
                               value="<?= $data = date("Y-m-d") ?>" />
                    <input class="btn btn-primary" type="submit" value="Cadastrar"> 
                    <input class="btn" type="reset" value="Limpar"> </td>
            </tr>
        </table>
    </form>     

    <?php
}
include ("../Rodape.php");
