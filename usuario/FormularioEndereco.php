<?php
include ("ConectaUsuario.php");
include ("../admin/BancoCidade.php");
include ("BancoEndereco.php");
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


    $cidades = listaCidade($conexao);
    ?>
    <script type="text/javascript">
        $(document).ready(function () {
            $('#estado').change(function () {
                $('#cidade').load('listaCidades.php?estado=' + $('#estado').val());
            });
        });
    </script>

    <h1>Dados do Cadastro de Endereço</h1>
    <form action="CadastraEndereco.php" method="Post">
        <table class="table">
            <tr>
                <td>Título:</td>
                <td><input class="form-control" type="texto" name="titulo" required="required" value="" > </td>
            </tr>
            <tr>
                <td>Logradouro:</td>
                <td><input class="form-control" type="texto" name="logradouro" required="required" value="" > </td>
            </tr>
            <tr>
                <td>Número:</td>
                <td><input class="form-control" type="texto" name="numero" required="required" value="" > </td>
            </tr>
            <tr>
                <td>Bairro:</td>
                <td><input class="form-control" type="texto" name="bairro" required="required" value="" > </td>
            </tr>
            <tr>
                <td>Complemento:</td>
                <td><input class="form-control" type="texto" name="complemento" value="" > </td>
            </tr>
            <tr>
                <td>Estado:</td>
                <td>
                    <select class="form-control" name="estado" id="estado">
                        <option>Selecione</option>
                        <option></option>
                        <?php
                        $estado = listaEstado($conexao);
                        foreach ($estado as $est){ ?>
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
                <td> <input class="btn btn-primary" type="submit" value="Cadastrar"> 
                    <input class="btn" type="reset" value="Limpar"> </td>
            </tr>
        </table>
    </form>     

    <?php
}
include ("../Rodape.php");
