<?php

function buscaidUsuario( $conexao, $email) {
    $query = "select id from usuarios where email ='{$email}'";
    $result = mysqli_query($conexao, $query);
    
    return mysqli_fetch_array($result);
}

function verificaEndereco( $conexao, $id) {
    $query = "SELECT COUNT( * ) 
              FROM  enderecos where idusuario='{$id}'";
    $result = mysqli_query($conexao, $query);
    
    return mysqli_fetch_array($result);
}



// Inserir o produto no banco de dados:
function insereEndereco( $conexao, $titulo, $logradouro, $numero, $bairro, $complemento, $cidade, $id) {
    $query = "insert into enderecos (titulo, logradouro, numero, bairro, complemento, idcidade, idusuario) 
    values ('{$titulo}','{$logradouro}', '{$numero}', '{$bairro}', '{$complemento}', '{$cidade}', '{$id}')";
    return mysqli_query($conexao, $query);
}

// Altarar o produto no banco de dados:
function alteraEndereco( $conexao, $id, $titulo, $logradouro, $numero, $bairro, $complemento, $idcidade ) {
    $query = "update enderecos set titulo = '{$titulo}',logradouro = '{$logradouro}',numero = '{$numero}'
    ,bairro = '{$bairro}',complemento = '{$complemento}',idcidade = '{$idcidade}'
    where id = {$id}";
    return mysqli_query($conexao, $query);
}



// Exluir o produto do banco de dados:
function removeEndereco( $conexao, $id ) {
    $query = "delete from enderecos where id = {$id}";
    return mysqli_query($conexao, $query);
}

// Buscar o produto do banco de dados:
function BuscaEndereco( $conexao, $id ) {
    $query = "select * from enderecos where id = {$id}";
    $resultado = mysqli_query($conexao, $query);
    return mysqli_fetch_assoc($resultado);
}

//busca endereço para perfil de usuario logado
function BuscaEnderecoUser( $conexao, $id ) {
    $query = "select * from enderecos where idusuario = {$id}";
    $resultado = mysqli_query($conexao, $query);
    return mysqli_fetch_assoc($resultado);
}



// Listar os produtos já gravados:
function listaEnderecos($conexao, $usuario, $filtro, $ordem) {
    $enderecos = array();
    $sql = "select enderecos.*, us.email, cidades.nomecidade as idcidade 
                from enderecos 
                inner join usuarios us on enderecos.idusuario = us.id
                left join cidades on cidades.id =  enderecos.idcidade
                where us.email = '{$usuario}'";
    if ($filtro <> "") {
        $sql = $sql .
           " and enderecos.titulo like '%{$filtro}%'";
    }
    if ($ordem <> "") {
        $sql = $sql .
           " order by {$ordem}";
    }
    $resultado = mysqli_query($conexao, $sql );
    while ($endereco = mysqli_fetch_assoc($resultado)) {
        array_push($enderecos, $endereco);
    }
    return $enderecos;
}

