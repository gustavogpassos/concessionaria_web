<?php
include ("./ConectaUsuario.php");
include ("./BancoUsuario.php");


if (usuarioEstaLogado()) {
    include ("cabecalhoLogado.php");
} else {
    include ("cabecalhoNaoLogado.php");
}
//verifica se o usuário pode ter acesso ao conteúdo
if (!usuarioEstaLogado()) {
    include ("naoLogado.php");
} else {

    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $sobrenome = $_POST['sobrenome'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];
    
    $emailAntigo = usuarioLogado();
    
    

     
        if($email != $emailAntigo){
            if(emailUsado($conexao, $_POST['email'])){
           $_SESSION["danger"] = "Email já cadastrado!";
             header("Location: PerfilLogado.php");
    
             die();
}
            alteraUsuario($conexao, $id, $nome, $sobrenome, $email, $telefone);
            session_destroy();
            header("Location: FormularioLogin.php?email=true");
            die();
        }else{
            alteraUsuario($conexao, $id, $nome, $sobrenome, $email, $telefone);
        header("Location: PerfilLogado.php?dados=true");
        die();
        }
    
        $msg = mysqli_error($conexao);
        ?>
        <p class="alert-danger">Dados não alterados: <?= $msg ?></p>
    <?php
    }

include ("../Rodape.php");
