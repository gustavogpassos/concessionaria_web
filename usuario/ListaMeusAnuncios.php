<?php
include ("ConectaUsuario.php");
include ("../admin/BancoAnuncio.php");
include ("BancoUsuario.php");

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

    if (array_key_exists("add", $_GET) && $_GET["add"] == true) {
        ?>
        <p class="alert-success">Anúncio criado com sucesso.</p>
        <?php
    }
    
    if (array_key_exists("desativado", $_GET) && $_GET["desativado"] == true) {
        ?>
        <p class="alert-success">Anúncio desativado com sucesso.</p>
        <?php
    }

    if (array_key_exists("removido", $_GET) && $_GET["removido"] == true) {
        ?>
        <p class="alert-success">Anúncio excluído com sucesso.</p>
        <?php
    }
    ?>
        
    <?php
    $usuario = usuarioLogado();
    if (array_key_exists("usuario", $_POST)) {
        $usuario = $_POST["usuario"];
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

    <h1>Meus Anúncios Ativos </h1>

    <table class="table table-striped table-bordered">
        <tr>
            <td>
                <form action="ListaMeusAnuncios.php" method="Post">
                    Filtrar:
                    <input type="text" name="filtro" value="">
                    <button class="btn btn-default">Filtrar</button>
                    <!--<input type="image" src="imagens\lupa.jpg" alt="Submit" width="36" height="36" title="Filtrar">-->
                </form>
            </td>
            <td>
                <a class="btn btn-success" href="FormularioAnuncio.php">Criar Anúncio</a>
            </td>
            <td>
                <a class="btn btn-primary" href="ListaMeusAnDesat.php">Meus Anúncio Desativados</a>
            </td>
        </tr>
    </table>

   <table class="table table-striped table-bordered">
    <tr>
        <th>
            <form action="ListaMeusAnuncios.php" method="Post">
                <input type="hidden" name="ordem" value="imagem">
                <button class="btn btn-group-justified"> Foto </button>
            </form>
        </th>

        <th>
            <form action="ListaMeusAnuncios.php" method="Post">
                <input type="hidden" name="ordem" value="nome">
                <button class="btn btn-group-justified"> Nome </button>
            </form>
        </th>
        
        <th>
            <form action="ListaMeusAnuncios.php" method="Post">
                <input type="hidden" name="ordem" value="modelo">
                <button class="btn btn-group-justified"> Modelo </button>
            </form>
        </th>
        
        <th>
            <form action="ListaMeusAnuncios.php" method="Post">
                <input type="hidden" name="ordem" value="placa">
                <button class="btn btn-group-justified"> Placa </button>
            </form>
        </th>
        
        <th>
            <form action="ListaMeusAnuncios.php" method="Post">
                <input type="hidden" name="ordem" value="ano">
                <button class="btn btn-group-justified"> Ano </button>
            </form>
        </th>
        
        <th>
            <form action="ListaMeusAnuncios.php" method="Post">
                <input type="hidden" name="ordem" value="preco">
                <button class="btn btn-group-justified"> Preço </button>
            </form>
        </th>
        
        <th> </th>
        <th> </th>
        <th> </th>
        
        
    
    <?php
    $anuncios = listaAnunciosAtivosUsu($conexao, $usuario, $filtro, $ordem);
    foreach( $anuncios as $anuncio ){
    ?>    
        <tr>          
            <td><imagem><img src="../admin/imagemAnuncios/<?= $anuncio['imagem'] ?>" alt="Imagem" height="80" width="100"></imagem></td> 
            <td> <?= $anuncio['nome'] ?> </td>
            <td> <?= $anuncio['modelo'] ?> </td>
            <td> <?= $anuncio['placa']?> </td>
            <td> <?= $anuncio['ano']?> </td>
            <td> <?= $anuncio['preco']?> </td>
            
            
            <td>
                <form action="verAnuncio.php" method="GET">
                    <input type="hidden" name="id" value="<?= $anuncio['id'] ?>">
                    <button class="btn btn-primary">Ver</button>
                </form>
            </td>
            <td>
                <form action="FormularioAlteraAnuncio.php" method="Post">
                    <input type="hidden" name="id" value="<?= $anuncio['id'] ?>">
                    <button class="btn btn-primary">Alterar</button>
                </form>
            </td>
            
            <td>
                <form action="DesativaAnuncio.php" method="Post">
                    <input type="hidden" name="id" value="<?= $anuncio['id'] ?>">
                    <button class="btn btn-danger">Desativar</button>
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
