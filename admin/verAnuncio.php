<?php
include ("ConectaAdmin.php");
include ("BancoAnuncio.php");
include ("../usuario/BancoComentario.php");
include ("../usuario/BancoUsuario.php");


if (adminEstaLogado()) {
    include ("CabecalhoAdmin.php");
} else {
    include ("headerUnlogado.php");
}
//verifica se o usuário pode ter acesso ao conteúdo
if (!adminEstaLogado()) {
    include ("naoLogadoAdmin.php");
} else {

    //$id = $_POST["id"];


    $id = "";
    if (array_key_exists("id", $_GET)) {
        $id = $_GET["id"];
    }

    if (array_key_exists("removido", $_GET) && $_GET["removido"] == true) {
        ?>
        <p class="alert-success">Comentário excluído com sucesso.</p>
        <?php
    }
    ?>




    <h1>Anúncio</h1>



    <table class="table table-striped table-bordered">
        <tr>

            <td colspan="6">   
                <button class="btn btn-group-justified"> Fotos </button>
            </td>






            <?php
            $anuncio = verAnuncio($conexao, $id);
            foreach ($anuncio as $anuncio) {
                ?>  


            <tr>          
                <td colspan="3" rowspan="2"><a href="../admin/imagemAnuncios/<?= $anuncio['imagem'] ?>" rel="lightbox[group]" title="Imagem 1"><img src="../admin/imagemAnuncios/<?= $anuncio['imagem'] ?>" width="600" height="400" border="0" class="borderimage"/></a></td> 

                <?php if ($anuncio['imagem2']) { ?>
                    <td colspan="2"><a href="../admin/imagemAnuncios/<?= $anuncio['imagem2'] ?>" rel="lightbox[group]" title="Imagem 1"><img src="../admin/imagemAnuncios/<?= $anuncio['imagem2'] ?>" width="300" height="200" border="0" class="borderimage"/></a></td>
                <?php } ?>
            </tr>
            <tr>
                <?php if ($anuncio['imagem2']) { ?>
                    <td colspan="2"><a href="../admin/imagemAnuncios/<?= $anuncio['imagem3'] ?>" rel="lightbox[group]" title="Imagem 1"><img src="../admin/imagemAnuncios/<?= $anuncio['imagem3'] ?>" width="300" height="200" border="0" class="borderimage"/></a></td>
                <?php } ?>
            </tr>

            <tr>
                <td colspan="6">   
                    <button class="btn btn-group-justified"> Descrição </button>
                </td>
            </tr>

            <tr>
                <td>   
                    Nome: <?= $anuncio['nome'] ?> 
                </td> 
                <td>   
                    Modelo: <?= $anuncio['modelo'] ?>
                <td>   
                    Placa: <?= $anuncio['placa'] ?>
                </td>
                <td>   
                    Cidade: <?= $anuncio['nomecidade'] ?>
                </td> 
                <td>   
                    
                </td> 
            </tr>


            <tr>
                <td>   
                    Cor: <?= $anuncio['nomecor'] ?>
                </td> 
                <td>   
                    Km: <?= $anuncio['quilometragem'] ?>
                </td>
                <td>   
                    Ano: <?= $anuncio['ano'] ?>
                </td>
                <td>   
                    Combustivel: <?= $anuncio['combustivel'] ?>
                </td> 
                <td>   
                    Preço: <?= $anuncio['preco'] ?>
                </td> 
            </tr>

            <tr>
                <td>   
                    Marca: <?= $anuncio['nomemarca'] ?>
                </td> 
                <td colspan="2">   
                    Opcionais: <?= $anuncio['opcionais'] ?>
                </td>
                <td colspan="2">   
                    Observações: <?= $anuncio['observacoes'] ?>
                </td>

            </tr>


            <?php
            $user = $anuncio['idusuario'];
            $idanun = $anuncio['id'];
        }

        $anunciante = perfilUsuario($conexao, $user);
        ?>
    </table>
    <table class="table table-striped table-bordered">
        <tr>
            <td colspan="2">
                <button class="btn btn-group-justified">Anunciante</button>
            </td>
        </tr>
        <tr>
            <td>
                <?= $anunciante['nomeuser'] ?> <?= $anunciante['sobrenome'] ?> 
            </td>
            <td>
                <form action="PerfilUsuario.php" method="post">
                    <input type="hidden" name="id" value="<?= $anunciante['id'] ?>">
                    <input class="btn btn-success" type="submit" value="Ver perfil">
                </form>
            </td>
        </tr>

    </table>

    <table class="table table-striped table-bordered">
        <tr>

            <td colspan="6">   
                <button class="btn btn-group-justified"> Comentários </button>
            </td>

            <?php
            $comentarios = verComentarios($conexao, $id);
            foreach ($comentarios as $comentario) {
                ?>

            <tr>
                <td>   
                    <?= $comentario['nomeuser'] ?> <?= $comentario['sobrenome'] ?> :
                    <?= $comentario['mensagem'] ?> - <?= $comentario['datacoment'] ?>
                    
                </td>
                <td>

                    <form action="excluirComentario.php" method="POST">
                        <input type="hidden" name="id" value="<?= $comentario['id']?>">
                        <input type="hidden" name="idcarro" value="<?=$comentario['idcarro']?>">
                        <input class="btn btn-danger" type="submit" value="Excluir">
                    </form>

                </td> 


            </tr>
            <?php
        }
        ?>  
        <?php
    }
    include ("../Rodape.php");
    