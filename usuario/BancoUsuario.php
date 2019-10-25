<?php

function buscaidUsuariooo( $conexao, $email) {
    $query = "select id from usuarios where email ='{$email}'";
    $result = mysqli_query($conexao, $query);
    
    return mysqli_fetch_array($result);
}

// Inserir o usuário no banco de dados:
function insereUsuario( $conexao, $cpf, $nome , $sobrenome, $telefone, $genero, $email, $senha, $datacad) {
    $query = "insert into usuarios (nomeuser, sobrenome, cpf, telefone, genero, email, senha, datacad) "
            . "values ('{$nome}','{$sobrenome}','{$cpf}', '{$telefone}', '{$genero}', '{$email}', '{$senha}' , '{$datacad}')";
    return mysqli_query($conexao, $query);
}

// Altarar o usuário no banco de dados:
function alteraUsuario( $conexao, $id, $nome, $sobrenome, $email, $telefone  ) {
    $query = "update usuarios set nomeuser='{$nome}', sobrenome='{$sobrenome}',"
            . " email = '{$email}', telefone='{$telefone}'  where id = {$id}";
    return mysqli_query($conexao, $query);
}

// Altarar o usuário no banco de dados:
function alteraSenhaEsq( $conexao, $senha, $id  ) {
    $query = "update usuarios set senha='{$senha}'  where id = {$id}";
    return mysqli_query($conexao, $query);
}

// Exluir o usuário do banco de dados:
function removeUsuario( $conexao, $id ) {
    $query = "delete from usuarios where id = {$id}";
    return mysqli_query($conexao, $query);
}

// Buscar o usuário do banco de dados:
function buscaUsuario( $conexao, $email, $senha ) {
    
    $query = "select * from usuarios where email = '{$email}' and senha = '{$senha}'";
    $resultado = mysqli_query($conexao, $query);
    return mysqli_fetch_assoc($resultado);
}

// Listar os usuários já gravados:
function listaUsuarios($conexao) {
    $usuarios = array();
    $resultado = mysqli_query($conexao, "select * from usuarios "); // where nome like '%ca%'");
    while ($usuario = mysqli_fetch_assoc($resultado)) {
        array_push($usuarios, $usuario);
    }
    return $usuarios;
}

function emailUsado($conexao, $email){
    $sql = "select * from usuarios where email = '{$email}'";
    
    $resultado = mysqli_query($conexao, $sql);
    
    return mysqli_fetch_assoc($resultado);
}

function cpfUsado($conexao, $cpf){
    $sql = "select * from usuarios where cpf = '{$cpf}'";
    
    $resultado = mysqli_query($conexao, $sql);
    
    return mysqli_fetch_assoc($resultado);
}

function buscaPerfil($conexao, $id){
    $sql = "select * from usuarios where id = {$id}";
    
    $resultado = mysqli_query($conexao, $sql);
    
    return mysqli_fetch_assoc($resultado);
}
function buscaSenha($conexao, $id){
    $query = "select senha from usuarios where id = {$id}";
    $resultado = mysqli_query($conexao, $query); 
    return mysqli_fetch_assoc($resultado);
}

function alteraSenha($conexao, $id, $senhaAntiga, $senhaNova){
    $sql = "select senha from usuarios where id = {$id}";
    $antiga = mysqli_fetch_assoc(mysqli_query($conexao, $sql));
    $senhaAntigamd5 = $senhaAntiga;
    if($senhaAntigamd5 === $antiga['senha']){
        $senhaNova = ($senhaNova);
        $query = "update usuarios set senha = '{$senhaNova}' where id = {$id}";
        if(mysqli_query($conexao, $query)){
            return true;
            
        }else{
            return mysqli_error($conexao);
        }
        
    }else{
        return false;
    }
    
    
    
}

function geraSenha($tamanho = 8, $maiusculas = true, $numeros = true, $simbolos = false) {
    $lmin = 'abcdefghijklmnopqrstuvwxyz';
    $lmai = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $num = '1234567890';
    $simb = '!@#$%*-';
    $retorno = '';
    $caracteres = '';

    $caracteres .= $lmin;
    if ($maiusculas)
        $caracteres .= $lmai;
    if ($numeros)
        $caracteres .= $num;
    if ($simbolos)
        $caracteres .= $simb;

    $len = strlen($caracteres);
    for ($n = 1; $n <= $tamanho; $n++) {
        $rand = mt_rand(1, $len);
        $retorno .= $caracteres[$rand - 1];
    }
    return $retorno;
}


