<?php

// Inserir o usuário no banco de dados:
function insereAdmin( $conexao, $nome ) {
    $query = "insert into admin (email, senha) values ('{$email}', '{$senha}')";
    return mysqli_query($conexao, $query);
}

// Altarar o usuário no banco de dados:
function alteraAdmin( $conexao, $id, $email, $senha ) {
    $query = "update admin set email = '{$email}', senha = '{$senha}' where id = {$id}";
    return mysqli_query($conexao, $query);
}

// Exluir o usuário do banco de dados:
function removeAdmin( $conexao, $id ) {
    $query = "delete from admin where id = {$id}";
    return mysqli_query($conexao, $query);
}

// Buscar o usuário do banco de dados:
function buscaAdmin( $conexao, $email, $senha ) {
    $senhaMd5 = md5($senha);
    $query = "select * from admin where email = '{$email}' and senha = '{$senhaMd5}'";
    $resultado = mysqli_query($conexao, $query);
    return mysqli_fetch_assoc($resultado);
}

// Listar os usuários já gravados:
function listaCategorias($conexao) {
    $usuarios = array();
    $resultado = mysqli_query($conexao, "select * from usuarios "); // where nome like '%ca%'");
    while ($usuario = mysqli_fetch_assoc($resultado)) {
        array_push($usuarios, $usuario);
    }
    return $usuarios;
}
