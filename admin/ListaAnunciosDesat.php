<?php 
 
include ("ConectaAdmin.php"); 
include ("BancoAnuncio.php"); 


if (adminEstaLogado()) {
    include ("CabecalhoAdmin.php");
} else {
    include ("headerUnlogado.php");
}
//verifica se o usuário pode ter acesso ao conteúdo
if (!adminEstaLogado()) {
    include ("naoLogadoAdmin.php");
} else {

if ( array_key_exists("removido",$_GET) && $_GET["removido"]==true){
?>
    <p class="alert-success">Anúncio desativado com sucesso.</p>
<?php
}
?>
    
<?php
$filtro = "";
if ( array_key_exists("filtro",$_POST) ){
    $filtro = $_POST["filtro"];
}
?>

<?php
$ordem = "";
if ( array_key_exists("ordem",$_POST) ){
    $ordem = $_POST["ordem"];
}
?>

<h1>Lista de Anúncios Desativados</h1>

<table class="table table-striped table-bordered">
        <tr>
            <td>
                <form action="ListaAnunciosDesat.php" method="Post">
                    Filtrar:
                    <input type="text" name="filtro" value="">
                    <button class="btn btn-default">Filtrar</button>
                    <!--<input type="image" src="imagens\lupa.jpg" alt="Submit" width="36" height="36" title="Filtrar">-->
                </form>
            </td>
            
            <td>
                <a class="btn btn-primary" href="ListaAnunciosAdm.php">Anúncios Ativos</a>
            </td>
            
        </tr>
    </table>


<table class="table table-striped table-bordered">
    <tr>
        <th>
            <form action="ListaAnunciosDesat.php" method="Post">
                <input type="hidden" name="ordem" value="imagem">
                <button class="btn btn-group-justified"> Foto </button>
            </form>
        </th>

        <th>
            <form action="ListaAnunciosDesat.php" method="Post">
                <input type="hidden" name="ordem" value="nome">
                <button class="btn btn-group-justified"> Nome </button>
            </form>
        </th>
        
        <th>
            <form action="ListaAnunciosDesat.php" method="Post">
                <input type="hidden" name="ordem" value="modelo">
                <button class="btn btn-group-justified"> Modelo </button>
            </form>
        </th>
        
        <th>
        <form action="ListaAnunciosDesat.php" method="Post">
                <input type="hidden" name="ordem" value="placa">
                <button class="btn btn-group-justified"> Placa </button>
            </form>
        </th>
        
        <th>
            <form action="ListaAnunciosDesat.php" method="Post">
                <input type="hidden" name="ordem" value="nomeuser">
                <button class="btn btn-group-justified"> Vendedor </button>
            </form>
        </th>
        
        <th>
            <form action="ListaAnunciosDesat.php" method="Post">
                <input type="hidden" name="ordem" value="nomecidade">
                <button class="btn btn-group-justified"> Cidade </button>
            </form>
        </th>
        
        
        <th></th>
        
        
        
    
    <?php
    $anuncios = listaAnunciosDesativados($conexao, $filtro, $ordem);
    foreach( $anuncios as $anuncio ){
    ?>    
        <tr>          
            <td><img src="imagemAnuncios/<?= $anuncio['imagem'] ?>" height="80" width="100"></td> 
            <td> <?= $anuncio['nome'] ?> </td>
            <td> <?= $anuncio['modelo'] ?> </td>
            <td> <?= $anuncio['placa']?> </td>
            <td> <?= $anuncio['nomeuser']?>  <?= $anuncio['sobrenome']?> </td>
            <td> <?= $anuncio['nomecidade']?> </td>
            
            <td>
                <form action="verAnuncio.php" method="GET">
                    <input type="hidden" name="id" value="<?= $anuncio['id'] ?>">
                    <button class="btn btn-primary">Ver Anúncio</button>
                </form>
            </td>
    <?php    
    }
    ?>
</table>
<?php
}
include ("../Rodape.php");
