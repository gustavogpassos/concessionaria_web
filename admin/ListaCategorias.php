<?php  
include ("ConectaAdmin.php"); 
include ("BancoCategoria.php"); 

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
    <p class="alert-success">Categoria excluida com sucesso.</p>
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

<h1>Lista de Categorias </h1>


<table class="table table-striped table-bordered">
    <tr>
            <td>
                <form action="ListaCategorias.php" method="Post">
                    Filtrar:
                    <input type="text" name="filtro" value="">
                    <button class="btn btn-default">Filtrar</button>
                    <!--<input type="image" src="imagens\lupa.jpg" alt="Submit" width="36" height="36" title="Filtrar">-->
                </form>
            </td>
            <td>
                <a class="btn btn-success" href="FormularioCategoria.php">Novo</a>
            </td>
        </tr>
    </table>

    <table class="table table-striped table-bordered">
        
    
    <tr>
        <th>
            <form action="ListaCategorias.php" method="Post">
                <input type="hidden" name="ordem" value="id">
                <button class="btn btn-group-justified"> ID </button>
            </form>
        </th>

        <th>
            <form action="ListaCategorias.php" method="Post">
                <input type="hidden" name="ordem" value="nomecategoria">
                <button class="btn btn-group-justified"> Nome da Categoria </button>
            </form>
        </th>
        
        <th></th>
        
        <th></th>
    
    <?php
    $categorias = listaCategorias($conexao, $filtro, $ordem);
    foreach( $categorias as $categoria ){
    ?>    
        <tr>
            <td> <?= $categoria['id'] ?> </td>
            <td> <?= $categoria['nomecategoria'] ?> </td>
            <td>
                <form action="FormularioAlteraCategoria.php" method="Post">
                    <input type="hidden" name="id" value="<?= $categoria['id'] ?>">
                    <button class="btn btn-primary">Alterar</button>
                </form>
            </td>
            <td>
                <form action="RemoveCategoria.php" method="Post">
                    <input type="hidden" name="id" value="<?= $categoria['id'] ?>">
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
