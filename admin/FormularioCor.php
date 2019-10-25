<?php
include ("ConectaAdmin.php");
include ("BancoCor.php");

$cores = listaCor($conexao);

if (adminEstaLogado()) {
    include ("CabecalhoAdmin.php");
} else {
    include ("headerUnlogado.php");
}
//verifica se o usuário pode ter acesso ao conteúdo
if (!adminEstaLogado()) {
    include ("naoLogadoAdmin.php");
} else {

    ?>

    <h1>Dados do Cadastro de Cores</h1>
    <form action="CadastraCor.php" method="Post">
        <table class="table">
            <tr>
                <td>Nome:</td>
                <td><input class="form-control" type="texto" name="nomecor" required="required" value="" > </td>
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
