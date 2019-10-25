<?php

// Inserir o produto no banco de dados:
function insereCor( $conexao, $nome) {
    $query = "insert into cores (nomecor) values ('{$nome}')";
    return mysqli_query($conexao, $query);
}

// Altarar o produto no banco de dados:
function alteraCor( $conexao, $id, $nome) {
    $query = "update cores set nomecor = '{$nome}' " .
                                 "where id = {$id}";
    return mysqli_query($conexao, $query);
}

// Exluir o produto do banco de dados:
function removeCor( $conexao, $id ) {
    $query = "delete from cores where id = {$id}";
    return mysqli_query($conexao, $query);
}

// Buscar o produto do banco de dados:
function BuscaCor( $conexao, $id ) {
    $query = "select * from cores where id = {$id}";
    $resultado = mysqli_query($conexao, $query);
    return mysqli_fetch_assoc($resultado);
}

// Listar os produtos ja� gravados:
function listaCores($conexao, $filtro, $ordem) {
    $cores = array();
    $sql =  "select * from cores";
    if ($filtro <> "") {
        $sql = $sql .
           " where cores.nomecor like '%{$filtro}%'";
    }
    if ($ordem <> "") {
        $sql = $sql .
           " order by {$ordem}";
    }
    $resultado = mysqli_query($conexao, $sql );
    while ($cor = mysqli_fetch_assoc($resultado)) {
        array_push($cores, $cor);
    }
    return $cores;
}

// Listar os produtos ja� gravados:
function listaCor($conexao) {
    $cores = array();
    $resultado = mysqli_query($conexao, "select * from cores");
    while ($cor = mysqli_fetch_assoc($resultado)) {
        array_push($cores, $cor);
    }
    return $cores;
}
