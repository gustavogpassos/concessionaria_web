<?php
include ("ConectaAdmin.php");
include ("BancoCor.php");

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
$cor = BuscaCor($conexao, $id);

$cores = listaCor($conexao);

    
?>

<h1>Alteração de Cor</h1>
<form action="AlteraCor.php" method="Post">
    <input type="hidden" name="id" value="<?= $cor['id'] ?>" >
    <table class="table">
        <tr>
            <td>Nome:</td>
            <td><input class="form-control" type="texto" name="nomecor" required="required" value="<?= $cor['nomecor'] ?>" > </td>
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
