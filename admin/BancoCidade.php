<?php

// Inserir o produto no banco de dados:
function insereCidade( $conexao, $nome, $uf) {
    $query = "insert into cidades (nomecidade, uf) values ('{$nome}', '{$uf}')";
    return mysqli_query($conexao, $query);
}

// Altarar o produto no banco de dados:
function alteraCidade( $conexao, $id, $nome, $uf ) {
    $query = "update cidades set nomecidade = '{$nome}',uf = {$uf} where id = {$id}";
    return mysqli_query($conexao, $query);
}



// Exluir o produto do banco de dados:
function removeCidade( $conexao, $id ) {
    $query = "delete from cidades where id = {$id}";
    return mysqli_query($conexao, $query);
}

// Buscar o produto do banco de dados:
function BuscaCidade( $conexao, $id ) {
    $query = "select * from cidades where id = {$id}";
    $resultado = mysqli_query($conexao, $query);
    return mysqli_fetch_assoc($resultado);
}

// Listar os produtos já gravados:
function listaCidade($conexao) {
    $cidades = array();
    $sql = "select cidades.*, estados.sigla as uf " .
                "from cidades " .
                "left join estados on estados.id = cidades.uf";
    
    $resultado = mysqli_query($conexao, $sql );
    while ($cidade = mysqli_fetch_assoc($resultado)) {
        array_push($cidades, $cidade);
    }
    return $cidades;
}

// Listar os produtos já gravados:
function listaCidades($conexao, $filtro, $ordem) {
    $cidades = array();
    $sql = "select cidades.*, estados.sigla as uf " .
                "from cidades " .
                "left join estados on estados.id = cidades.uf";
    if ($filtro <> "") {
        $sql = $sql .
           " where cidades.nomecidade like '%{$filtro}%'";
    }
    if ($ordem <> "") {
        $sql = $sql .
           " order by {$ordem}";
    }
    $resultado = mysqli_query($conexao, $sql );
    while ($cidade = mysqli_fetch_assoc($resultado)) {
        array_push($cidades, $cidade);
    }
    return $cidades;
}

function listaCidadesEstado($conexao, $filtro, $ordem, $uf){
    $cidades = array();
    $sql = "select cidades.*, estados.sigla as uf " .
                "from cidades " .
                "left join estados on estados.id = cidades.uf"
            . " where estados.id = {$uf} ";
    if ($filtro <> "") {
        $sql = $sql .
           " and cidades.nomecidade like '%{$filtro}%'";
    }
    if ($ordem <> "") {
        $sql = $sql .
           " order by {$ordem}";
    }
    $resultado = mysqli_query($conexao, $sql );
    while ($cidade = mysqli_fetch_assoc($resultado)) {
        array_push($cidades, $cidade);
    }
    return $cidades;
}
