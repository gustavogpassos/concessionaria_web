<?php
include ("ConectaUsuario.php");
include ("BancoEndereco.php");
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
        <p class="alert-success">Endereco inserido com sucesso.</p>
        <?php
    }
    
    if (array_key_exists("altera", $_GET) && $_GET["altera"] == true) {
        ?>
        <p class="alert-success">Endereco alterado com sucesso.</p>
        <?php
    }

    if (array_key_exists("removido", $_GET) && $_GET["removido"] == true) {
        ?>
        <p class="alert-success">Endereco excluído com sucesso.</p>
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
        
    <?php   
    $ident = usuarioLogado();
    $email = buscaidUsuario($conexao, $ident);
    $usuario2 = $email["id"];
    $testa = verificaEndereco($conexao, $ident);
    $usuario3 = $testa;
    

    ?>
    <h1>Meus Endereços </h1>

    <table class="table table-striped table-bordered">
        <tr>
            <td>
                <form action="ListaEnderecos.php" method="Post">
                    Filtrar:
                    <input type="text" name="filtro" value="">
                    <button class="btn btn-default">Filtrar</button>
                    <!--<input type="image" src="imagens\lupa.jpg" alt="Submit" width="36" height="36" title="Filtrar">-->
                </form>
            </td>
            <td>                
                    <a class="btn btn-success" href="FormularioEndereco.php">Novo</a>
            </td>
        </tr>
    </table>

    <table class="table table-striped table-bordered">
        <tr>
            <th>
        <form action="ListaEnderecos.php" method="Post">
            <input type="hidden" name="ordem" value="id">
            <button class="btn btn-group-justified"> ID </button>
        </form>
    </th>

    <th>
    <form action="ListaEnderecos.php" method="Post">
        <input type="hidden" name="ordem" value="titulo">
        <button class="btn btn-group-justified"> Título </button>
    </form>
    </th>

    <th>
    <form action="ListaEnderecos.php" method="Post">
        <input type="hidden" name="ordem" value="logradouro">
        <button class="btn btn-group-justified"> Logradouro </button>
    </form>
    </th>

    <th>
    <form action="ListaEnderecos.php" method="Post">
        <input type="hidden" name="ordem" value="numero">
        <button class="btn btn-group-justified"> Número </button>
    </form>
    </th>

    <th>
    <form action="ListaEnderecos.php" method="Post">
        <input type="hidden" name="ordem" value="bairro">
        <button class="btn btn-group-justified"> Bairro </button>
    </form>
    </th>
    
    <th>
    <form action="ListaEnderecos.php" method="Post">
        <input type="hidden" name="ordem" value="complemento">
        <button class="btn btn-group-justified"> Complemento </button>
    </form>
    </th>
    
    <th>
    <form action="ListaEnderecos.php" method="Post">
        <input type="hidden" name="ordem" value="nomecidade">
        <button class="btn btn-group-justified"> Cidade </button>
    </form>
    </th>
    
    <th></th>
    
    <th></th>
    
    <?php
    $enderecos = listaEnderecos($conexao, $usuario, $filtro, $ordem);
    foreach ($enderecos as $endereco) {
        ?>    
        <tr>
            <td> <?= $endereco['id'] ?> </td>
            <td> <?= $endereco['titulo'] ?> </td>
            <td> <?= $endereco['logradouro'] ?> </td>
            <td> <?= $endereco['numero'] ?> </td>
            <td> <?= $endereco['bairro'] ?> </td>
            <td> <?= $endereco['complemento'] ?> </td>
            <td> <?= $endereco['idcidade'] ?> </td>

            <td>
                <form action="FormularioAlteraEndereco.php" method="Post">
                    <input type="hidden" name="id" value="<?= $endereco['id'] ?>">
                    <button class="btn btn-primary">Alterar</button>
                </form>
            </td>
            <td>
                <form action="RemoveEndereco.php" method="Post">
                    <input type="hidden" name="id" value="<?= $endereco['id'] ?>">
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
