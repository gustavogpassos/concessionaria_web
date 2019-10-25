<?php
include ("./ConectaAdmin.php");
include ("../usuario/BancoUsuario.php");
include ("BancoAnuncio.php");

if (adminEstaLogado()) {
    include ("./CabecalhoAdmin.php");
} else {
    include ("./headerUnlogado.php");
}

$id = $_POST['id'];

$user = buscaPerfil($conexao, $id);
?>

<h1><?=$user['nomeuser']?> <?=$user['sobrenome']?></h1>


<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <td colspan="2">
                <label>Informações</label>
            </td>
        </tr>
    </thead>
    <tbody>
        <tr>
        <td>
            <label>Gênero</label>
        </td>
        <td>
            <?=$user['genero']?>
        </td>
        
    </tr>
    <tr>
        <td>
            <label>E-mail</label>
        </td>
        <td>
            <?=$user['email']?>
        </td>
        
    </tr>
    <tr>
        <td>
            <label>Telefone</label>
        </td>
        <td>
            <?=$user['telefone']?>
        </td>
        
    </tr>
    <tr>
        <td>
            <label>Total de anúncios deste Vendedor</label>
        </td>
        <td>
            <?php
            
            
            $count = totalAnuncioUs($conexao, $id);
            
            echo $count['num'];
            ?>
        </td>
        
    </tr>
    </tbody>
</table>