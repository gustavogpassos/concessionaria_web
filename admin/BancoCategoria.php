<?php

// Inserir o produto no banco de dados:
function insereCategoria( $conexao, $nome) {
    $query = "insert into categorias (nomecategoria) values ('{$nome}')";
    return mysqli_query($conexao, $query);
}

// Altarar o produto no banco de dados:
function alteraCategoria( $conexao, $id, $nome) {
    $query = "update categorias set nomecategoria = '{$nome}' " .
                                 "where id = {$id}";
    return mysqli_query($conexao, $query);
}

// Exluir o produto do banco de dados:
function removeCategoria( $conexao, $id ) {
    $query = "delete from categorias where id = {$id}";
    return mysqli_query($conexao, $query);
}

// Buscar o produto do banco de dados:
function BuscaCategoria( $conexao, $id ) {
    $query = "select * from categorias where id = {$id}";
    $resultado = mysqli_query($conexao, $query);
    return mysqli_fetch_assoc($resultado);
}

// Listar os produtos ja� gravados:
function listaCategorias($conexao, $filtro, $ordem) {
    $categorias = array();
    $sql =  "select * from categorias";
    if ($filtro <> "") {
        $sql = $sql .
           " where categorias.nomecategoria like '%{$filtro}%'";
    }
    if ($ordem <> "") {
        $sql = $sql .
           " order by {$ordem}";
    }
    $resultado = mysqli_query($conexao, $sql );
    while ($categoria = mysqli_fetch_assoc($resultado)) {
        array_push($categorias, $categoria);
    }
    return $categorias;
}

// Listar os produtos ja� gravados:
function listaCategoria($conexao) {
    $categorias = array();
    $resultado = mysqli_query($conexao, "select * from categorias");
    while ($categoria = mysqli_fetch_assoc($resultado)) {
        array_push($categorias, $categoria);
    }
    return $categorias;
}
