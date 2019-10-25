<?php
include ("ConectaUsuario.php");
include ("../admin/BancoAnuncio.php");
include ("../admin/BancoCor.php");
include ("../admin/BancoCategoria.php");
include ("BancoUsuario.php");
include ("../admin/BancoCidade.php");
include ("../admin/BancoMarca.php");

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


// Pegando os valores passados por parâmetro:
    $nome = $_POST["nome"];
    $placa = $_POST["placa"];
    $modelo = $_POST["modelo"];
    $quilometragem = $_POST["quilometragem"];
    $preco = $_POST["preco"];
    $ano = $_POST["ano"];
    $combustivel = $_POST["combustivel"];
    $opcionais = $_POST["opcionais"];
    $observacoes = $_POST["observacoes"];
    $foto = $_FILES["imagem"];
    $foto2 = $_FILES["imagem2"];
    $foto3 = $_FILES["imagem3"];
    $cor = $_POST["cor"];
    $idmarca = $_POST["idmarca"];
    $idcategoria = $_POST["idcategoria"];
    $idcidade = $_POST["idcidade"];
    $data = $_POST["data"];

    $ident = usuarioLogado();
    $email = buscaidUsuarioo($conexao, $ident);
    $usuario = $email["id"];

    if (!empty($foto["name"])) {

        if (!preg_match("/^image\/(pjpeg|jpeg|png|gif|bmp)$/", $foto["type"])) {
            $error[1] = "Isso não é uma imagem.";
        }

        if (count($error) == 0) {

            // Pega extensão da imagem
            preg_match("/\.(gif|bmp|png|jpg|jpeg){1}$/i", $foto["name"], $ext);

            // Gera um nome único para a imagem
            $nome_imagem1 = md5(uniqid(time())) . "." . $ext[1];

            // Caminho de onde ficará a imagem
            $caminho_imagem = "../admin/imagemAnuncios/" . $nome_imagem1;

            // Faz o upload da imagem para seu respectivo caminho
            move_uploaded_file($foto["tmp_name"], $caminho_imagem);
        }
    }
    
    if (!empty($foto2["name"])) {

        if (!preg_match("/^image\/(pjpeg|jpeg|png|gif|bmp)$/", $foto2["type"])) {
            $error[1] = "Isso não é uma imagem.";
        }

        if (count($error) == 0) {

            // Pega extensão da imagem
            preg_match("/\.(gif|bmp|png|jpg|jpeg){1}$/i", $foto2["name"], $ext);

            // Gera um nome único para a imagem
            $nome_imagem2 = md5(uniqid(time())) . "." . $ext[1];

            // Caminho de onde ficará a imagem
            $caminho_imagem = "../admin/imagemAnuncios/" . $nome_imagem2;

            // Faz o upload da imagem para seu respectivo caminho
            move_uploaded_file($foto2["tmp_name"], $caminho_imagem);
        }
    }
    
    if (!empty($foto3["name"])) {

        if (!preg_match("/^image\/(pjpeg|jpeg|png|gif|bmp)$/", $foto3["type"])) {
            $error[1] = "Isso não é uma imagem.";
        }

        if (count($error) == 0) {

            // Pega extensão da imagem
            preg_match("/\.(gif|bmp|png|jpg|jpeg){1}$/i", $foto3["name"], $ext);

            // Gera um nome único para a imagem
            $nome_imagem3 = md5(uniqid(time())) . "." . $ext[1];

            // Caminho de onde ficará a imagem
            $caminho_imagem = "../admin/imagemAnuncios/" . $nome_imagem3;

            // Faz o upload da imagem para seu respectivo caminho
            move_uploaded_file($foto3["tmp_name"], $caminho_imagem);
        }
    }

    if (insereAnuncio($conexao, $nome, $placa, $modelo, $cor, $quilometragem, $preco, $ano, $combustivel, $opcionais, $observacoes
                    , $nome_imagem1, $nome_imagem2, $nome_imagem3, $idmarca, $idcategoria, $usuario, $idcidade, $data)) {
        header("Location: ListaMeusAnuncios.php?add=true");
        die();
    } else {
        $msg = mysqli_error($conexao);
        ?>
        <p class="text-danger">O anúncio <?= $nome ?> não foi adicionado: <?= $msg ?></p>
        <?php
    }
}


include ("../Rodape.php");
