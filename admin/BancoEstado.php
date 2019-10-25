<?php

// Inserir o produto no banco de dados:
function insereEstado( $conexao, $nome, $sigla) {
    $query = "insert into estados (nomeestado, sigla) values ('{$nome}', '{$sigla}')";
    return mysqli_query($conexao, $query);
}

// Altarar o produto no banco de dados:
function alteraEstado( $conexao, $id, $nome, $sigla ) {
    $query = "update estados set nomeestado = '{$nome}', sigla = '{$sigla}' " .
                                 "where id = {$id}";
    return mysqli_query($conexao, $query);
}

// Exluir o produto do banco de dados:
function removeEstado( $conexao, $id ) {
    $query = "delete from estados where id = {$id}";
    return mysqli_query($conexao, $query);
}

// Buscar o produto do banco de dados:
function BuscaEstado( $conexao, $id ) {
    $query = "select * from estados where id = {$id}";
    $resultado = mysqli_query($conexao, $query);
    return mysqli_fetch_assoc($resultado);
}

// Listar os produtos ja� gravados:
function listaEstados($conexao, $filtro, $ordem) {
    $estados = array();
    $sql =  "select * from estados";
    if ($filtro <> "") {
        $sql = $sql .
           " where estados.nomeestado like '%{$filtro}%'";
    }
    if ($ordem <> "") {
        $sql = $sql .
           " order by {$ordem}";
    }
    $resultado = mysqli_query($conexao, $sql );
    while ($estado = mysqli_fetch_assoc($resultado)) {
        array_push($estados, $estado);
    }
    return $estados;
}

function listaEstado($conexao) {
    $estados = array();
    $resultado = mysqli_query($conexao, "select * from estados "); // where nome like '%ca%'");
    while ($estado = mysqli_fetch_assoc($resultado)) {
        array_push($estados, $estado);
    }
    return $estados;
}