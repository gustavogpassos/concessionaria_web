<!DOCTYPE html>
<html>

    <head>
        <meta charset="utf-8">
        <title>Sistema de cadastro</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">
        <link href="../css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="../css/Loja.css" type="text/css"/>
        <link rel="stylesheet" href="../css/lightbox.css" type="text/css"/>
        <script type="text/javascript" src="../js/jquery-1.10.2.min.js"></script>
        <script type="text/javascript" src="../js/lightbox-2.6.min.js"></script>
        <script type="text/javascript" src="../js/modernizr.custom.js"></script>
        <script type="text/javascript" src="../js/jquery-1.11.3.js"></script>
        <script type="text/javascript" src="../js/bootstrap.min.js"></script>



    </head>

    <body>
        <div class="navbar navbar-default navbar-fixed-top navbar-inverse">
            <div class="container">
                <div class="navbar-header">
                    <a type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse"></a>
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <a class="navbar-brand" href="index.php">Inicio</a>
                    
                    
                    <a class="navbar-brand" href="vwAnuncios.php">Volkswagen</a>
                    <a class="navbar-brand" href="tyAnuncios.php">Toyota</a>
                    <a class="navbar-brand" href="auAnuncios.php">Audi</a>
                    <a class="navbar-brand" href="ftAnuncios.php">Fiat</a>
                    <a class="navbar-brand" href="chAnuncios.php">Chevrolet</a>
                    <a class="navbar-brand" href="FormularioAnuncio.php">Anuncie</a>

                </div>

                <div class="collapse navbar-collapse navbar-ex1-collapse">
                    <div class="btn-group nav navbar-right">
                       
                        <a class="btn navbar-brand btn-link dropdown-toggle" data-toggle="dropdown"><?= usuarioLogado() ?><span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="PerfilLogado.php">Meu Perfil</a></li>
                            <li><a href="ListaMeusAnuncios.php">Meus Anúncios</a></li>
                            <li><a href="ListaEnderecos.php">Meus Endereços</a></li>
                            <li><a href="logoutUsuario.php">Sair</a></li>
                        </ul>
                    </div>
                </div>

            </div>
        </div>
        <div class="container">
            <div class="principal">