<?php

session_start();

function verificaAdmin() {
    if( !adminEstaLogado() ) { 
        $_SESSION["danger"] = "Você não tem acesso a esta funcionalidade";
        header("Location: index.php");
        die();
    }
}

function adminEstaLogado() {
    //return isset( $_COOKIE["usuario_logado"] );
    return isset( $_SESSION["admin_logado"] );
}

function adminLogado() {
    //return $_COOKIE["usuario_logado"];
    return $_SESSION["admin_logado"];
}

function logaAdmin( $email ) {
    //setcookie("usuario_logado", $email, time() + 60);
    $_SESSION["admin_logado"] = $email;

}

function logout() {
    session_destroy();
    session_start();
}