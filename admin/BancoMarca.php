<?php

// Inserir o produto no banco de dados:
function insereMarca( $conexao, $nome) {
    $query = "insert into marcas (nomemarca) values ('{$nome}')";
    return mysqli_query($conexao, $query);
}

// Altarar o produto no banco de dados:
function alteraMarca( $conexao, $id, $nome) {
    $query = "update marcas set nomemarca = '{$nome}' " .
                                 "where id = {$id}";
    return mysqli_query($conexao, $query);
}

// Exluir o produto do banco de dados:
function removeMarca( $conexao, $id ) {
    $query = "delete from marcas where id = {$id}";
    return mysqli_query($conexao, $query);
}

// Buscar o produto do banco de dados:
function BuscaMarca( $conexao, $id ) {
    $query = "select * from marcas where id = {$id}";
    $resultado = mysqli_query($conexao, $query);
    return mysqli_fetch_assoc($resultado);
}

// Listar os produtos ja� gravados:
function listaMarcas($conexao, $filtro, $ordem) {
    $marcas = array();
    $sql =  "select * from marcas";
    if ($filtro <> "") {
        $sql = $sql .
           " where marcas.nomemarca like '%{$filtro}%'";
    }
    if ($ordem <> "") {
        $sql = $sql .
           " order by {$ordem}";
    }
    $resultado = mysqli_query($conexao, $sql );
    while ($marca = mysqli_fetch_assoc($resultado)) {
        array_push($marcas, $marca);
    }
    return $marcas;
}

// Listar os produtos ja� gravados:
function listaMarca($conexao) {
    $marcas = array();
    $resultado = mysqli_query($conexao, "select * from marcas");
    while ($marca = mysqli_fetch_assoc($resultado)) {
        array_push($marcas, $marca);
    }
    return $marcas;
}