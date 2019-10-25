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


$id = $_POST['id'];
$categoria = BuscaCategoria($conexao, $id);

$categorias = listaCategoria($conexao);

    
?>

<h1>Alteração de Categoria</h1>
<form action="AlteraCategoria.php" method="Post">
    <input type="hidden" name="id" value="<?= $categoria['id'] ?>" >
    <table class="table">
        <tr>
            <td>Nome:</td>
            <td><input class="form-control" type="texto" name="nomecategoria" required="required" value="<?= $categoria['nomecategoria'] ?>" > </td>
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
