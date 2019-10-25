<?php
include ("ConectaUsuario.php");
include ("../admin/BancoAnuncio.php");
include ("BancoUsuario.php");

if(usuarioEstaLogado()){
include ("cabecalhoLogado.php");
}else{
    include ("./cabecalhoNaoLogado.php");
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

    <h1> Carros Chevrolet </h1>
    
     <table class="table table-striped table-bordered">
        <tr>
            <td>
                <form action="resultBusca.php" method="Post">
                    
                    <input type="text" name="nome" placeholder="Buscar por nome" value="">
                    <button class="btn btn-default">Buscar</button>
                    <!--<input type="image" src="imagens\lupa.jpg" alt="Submit" width="36" height="36" title="Filtrar">-->
                </form>
            </td>
            
            <td>
                <form action="resultBusca2.php" method="Post">
                    
                    <input type="text" name="nomecidade" placeholder="Buscar por cidade" value="">
                    <button class="btn btn-default">Buscar</button>
                    <!--<input type="image" src="imagens\lupa.jpg" alt="Submit" width="36" height="36" title="Filtrar">-->
                </form>
            </td>
            
        </tr>
    </table>

    

   <table class="table table-striped table-bordered">
    <tr>
        <th>
    <form action="chAnuncios.php" method="Post">
                <input type="hidden" name="ordem" value="imagem">
                <button class="btn btn-group-justified"> Foto </button>
            </form>
        </th>

        <th>
        <form action="chAnuncios.php" method="Post">
                <input type="hidden" name="ordem" value="nome">
                <button class="btn btn-group-justified"> Nome </button>
            </form>
        </th>
        
        <th>
        <form action="chAnuncios.php" method="Post">
                <input type="hidden" name="ordem" value="modelo">
                <button class="btn btn-group-justified"> Modelo </button>
            </form>
        </th>
        
        <th>
        <form action="chAnuncios.php" method="Post">
                <input type="hidden" name="ordem" value="placa">
                <button class="btn btn-group-justified"> Placa </button>
            </form>
        </th>
        
        <th>
        <form action="chAnuncios.php" method="Post">
                <input type="hidden" name="ordem" value="nomeuser">
                <button class="btn btn-group-justified"> Vendedor </button>
            </form>
        </th>
        
        <th>
        <form action="chAnuncios.php" method="Post">
                <input type="hidden" name="ordem" value="nomecidade">
                <button class="btn btn-group-justified"> Cidade </button>
            </form>
        </th>
        
        <th> </th>
        
        
        
    
    <?php
    
    $anuncios = chAnuncios($conexao, $ordem);
    foreach( $anuncios as $anuncio ){
    ?>    
        <tr>          
            <td><imagem><img src="../admin/imagemAnuncios/<?= $anuncio['imagem'] ?>" alt="Imagem" height="80" width="100"></imagem></td> 
            <td> <?= $anuncio['nome'] ?> </td>
            <td> <?= $anuncio['modelo'] ?> </td>
            <td> <?= $anuncio['placa']?> </td>
            <td> <?= $anuncio['nomeuser']?>  <?= $anuncio['sobrenome']?> </td>
            <td> <?= $anuncio['nomecidade']?> </td>
            
            
            
            <td>
                <form action="verAnuncio.php" method="GET">
                    <input type="hidden" name="id" value="<?= $anuncio['id'] ?>">
                    <button class="btn btn-primary">Ver</button>
                </form>
            </td>
            
            
            
        </tr>
        
        <?php
    
    }
    ?>
    </table>

<?php

include ("../Rodape.php");
