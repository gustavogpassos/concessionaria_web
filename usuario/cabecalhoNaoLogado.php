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
    <script name="Funcao" type="text/javascript">

function valida()
    {  
         if (document.cad_usuario.senha.value.length < 6)  
       {
        alert("ERRO! senha muito curta!");
        return false;
       }
       if (document.cad_usuario.senha.value === document.cad_usuario.senha2.value)  
       {
           return true;
       }
	   else   
       {
        alert("ERRO! Confirmação de senha não confere!");
        return false;
       
       }
    }
    
    function valida_form (email){
		var filter = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
		if(!filter.test(document.getElementById("email").value)){
			alert('Por favor, digite o email corretamente');
			document.getElementById("email").focus();
		return false
		}
	}
        

</script>
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
                    <a class="btn navbar-brand btn-link dropdown-toggle" data-toggle="dropdown">Login<span class="caret"></span></a>
                    <ul class="dropdown-menu" style="width: 350px" role="">
                        <li>
                            <form action="loginUsuario.php" method="POST">
                                <ul>
                                    <input type="submit" class="btn btn-primary" value="Entrar"><br><br>
                                    Não tem uma conta?<br>
                                    <a href="FormularioUsuario.php">Cadastre-se</a>
                                </ul>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="principal">