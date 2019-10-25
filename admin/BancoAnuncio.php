<?php

function buscaidUsuarioo( $conexao, $email) {
    $query = "select id from usuarios where email ='{$email}'";
    $result = mysqli_query($conexao, $query);
    
    return mysqli_fetch_array($result);
}

// Inserir o produto no banco de dados:
function insereAnuncio( $conexao, $nome, $placa, $modelo, $cor, $quilometragem, $preco, $ano, $combustivel, 
        $opcionais, $observacoes, $imagem, $imagem2, $imagem3, $idmarca,$idcategoria, $idusuario, $idcidade, $data) {
    $query = "insert into carros (nome, placa, modelo, cor, quilometragem, preco, ano, combustivel, 
    opcionais, observacoes, imagem, imagem2, imagem3, idmarca, idcategoria, idusuario, idcidade, status, data) 
    values ('{$nome}', '{$placa}', '{$modelo}' , '{$cor}' , '{$quilometragem}', '{$preco}', '{$ano}'
    , '{$combustivel}', '{$opcionais}', '{$observacoes}' , '{$imagem}', '{$imagem2}', '{$imagem3}'
    , '{$idmarca}', '{$idcategoria}', '{$idusuario}', '{$idcidade}', '1', '{$data}')";
    return mysqli_query($conexao, $query);
}

// Altarar o produto no banco de dados:
function alteraAnuncio( $conexao, $id, $nome, $placa, $modelo, $cor, $quilometragem, $preco, $ano, $combustivel, 
        $opcionais, $observacoes, $imagem, $imagem2, $imagem3, $idmarca, $idcategoria, $idcidade) {
    $query = "update carros set nome = '{$nome}',placa = '{$placa}',modelo = '{$modelo}',cor = '{$cor}'
    ,quilometragem = '{$quilometragem}',preco = '{$preco}',ano = '{$ano}',combustivel = '{$combustivel}'
    ,opcionais = '{$opcionais}' ,observacoes = '{$observacoes}' ,imagem = '{$imagem}' ,imagem2 = '{$imagem2}' 
     ,imagem3 = '{$imagem3}' ,idmarca = '{$idmarca}',idcategoria = '{$idcategoria}', idcidade = '{$idcidade}' where id = {$id}";
    return mysqli_query($conexao, $query);
}

function removeAnuncio($conexao, $id){
    $query = "delete from carros where id = {$id}";
    
    return mysqli_query($conexao, $query);
}



// Desativa o produto do banco de dados:
function desativaAnuncio($conexao, $id) {
    $query = "update carros set status = '0' where id = {$id}";
    return mysqli_query($conexao, $query);
}

// Ativa o produto do banco de dados:
function ativaAnuncio($conexao, $id) {
    $query = "update carros set status = '1' where id = {$id}";
    return mysqli_query($conexao, $query);
}

// Buscar o produto do banco de dados:
function BuscaAnuncio( $conexao, $id ) {
    $query = "select * from carros where id = {$id}";
    $resultado = mysqli_query($conexao, $query);
    return mysqli_fetch_assoc($resultado);
}

// Listar os produtos já gravados:
function listaAnuncios($conexao, $filtro, $ordem) {
    $cidades = array();
    $sql = "select * from carros";
    if ($filtro <> "") {
        $sql = $sql .
           " where carros.nome like '%{$filtro}%'";
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

function listaAnunciosAtivos($conexao, $filtro, $ordem) {
    $anuncios = array();
    $sql = "select ca.*,co.nomecor,us.nomeuser, us.sobrenome, ci.nomecidade, ma.nomemarca,cat.nomecategoria from carros ca"
            . " inner join cores co on ca.cor = co.id"
            . " inner join usuarios us on ca.idusuario = us.id"
            . " inner join marcas ma on ca.idmarca = ma.id"
            . " inner join categorias cat on ca.idcategoria = cat.id"
            . " INNER JOIN cidades ci ON ca.idcidade = ci.id"
            . " where ca.status = 1";
    if ($filtro <> "") {
        $sql = $sql . " and ca.nome like '%{$filtro}%'";
    }
    if ($ordem <> "") {
        $sql = $sql . " order by {$ordem}";
    }
    $resultado = mysqli_query($conexao, $sql );
    while ($anuncio = mysqli_fetch_assoc($resultado)) {
        array_push($anuncios, $anuncio);
    }
    return $anuncios;
}

// Listar os produtos já gravados:
function listaAnunciosAtivosUsu($conexao,$usuario, $filtro, $ordem) {
    $cidades = array();
    $sql = "select carros.*, us.email
        from carros 
        inner join usuarios us on carros.idusuario = us.id
        where status = 1 and us.email = '{$usuario}'";
    if ($filtro <> "") {
        $sql = $sql .
           " and carros.nome like '%{$filtro}%'";
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

// Listar os produtos já gravados:
function listaAnunciosDesativados($conexao, $filtro, $ordem) {
    $anuncios = array();
    $sql = "select ca.*,co.nomecor,us.nomeuser, us.sobrenome, ci.nomecidade,"
            . " ma.nomemarca,cat.nomecategoria from carros ca"
            . " inner join cores co on ca.cor = co.id"
            . " inner join usuarios us on ca.idusuario = us.id"
            . " inner join marcas ma on ca.idmarca = ma.id"
            . " inner join categorias cat on ca.idcategoria = cat.id"
            . " inner join cidades ci on ca.idcidade = ci.id"
            . " where ca.status = 0";
    if ($filtro <> "") {
        $sql = $sql . " and ca.nome like '%{$filtro}%'";
    }
    if ($ordem <> "") {
        $sql = $sql . " order by {$ordem}";
    }
    $resultado = mysqli_query($conexao, $sql );
    while ($anuncio = mysqli_fetch_assoc($resultado)) {
        array_push($anuncios, $anuncio);
    }
    return $anuncios;
}

function verAnuncio( $conexao, $id ) {
    $anuncios = array();
    $query = "select ca.*, us.id as iduser, co.nomecor,us.nomeuser, us.sobrenome,"
            . " ci.nomecidade, ma.nomemarca,cat.nomecategoria from carros ca "
            . " inner join cores co on ca.cor = co.id"
            . " inner join usuarios us on ca.idusuario = us.id"
            . " inner join marcas ma on ca.idmarca = ma.id"
            . " inner join categorias cat on ca.idcategoria = cat.id"
            . " INNER JOIN cidades ci ON ca.idcidade = ci.id"
            
            . " where ca.id = {$id}";
    $resultado = mysqli_query($conexao, $query );
    while ($anuncio = mysqli_fetch_assoc($resultado)) {
        array_push($anuncios, $anuncio);
    }
    return $anuncios;

}

// Listar os produtos já gravados:
function listaAnunciosDesativadosUsu($conexao,$usuario, $filtro, $ordem) {
    $cidades = array();
    $sql = "select carros.*, us.email
        from carros 
        inner join usuarios us on carros.idusuario = us.id
        where status = 0 and us.email = '{$usuario}'";
    if ($filtro <> "") {
        $sql = $sql .
           " and carros.nome like '%{$filtro}%'";
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

function perfilUsuario($conexao, $id){
    $sql = "select * from usuarios where id = {$id}";
    
    $resultado  = mysqli_query($conexao, $sql);
    
    return mysqli_fetch_assoc($resultado);
}



function indexAnuncios($conexao, $ordem) {
    $cidades = array();
    $sql = "select ca.*,co.nomecor,us.nomeuser, us.sobrenome, ci.nomecidade, ma.nomemarca,cat.nomecategoria from carros ca"
            . " inner join cores co on ca.cor = co.id"
            . " inner join usuarios us on ca.idusuario = us.id"
            . " inner join marcas ma on ca.idmarca = ma.id"
            . " inner join categorias cat on ca.idcategoria = cat.id"
            
            . " INNER JOIN cidades ci ON ca.idcidade = ci.id
                WHERE data
              BETWEEN DATE_SUB(NOW(), INTERVAL 3 DAY) AND NOW() AND status=1";
    
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

function buscaAnuncios($conexao, $nome) {
    $query = "select ca.*,co.nomecor,us.nomeuser, us.sobrenome, ci.nomecidade, ma.nomemarca,cat.nomecategoria from carros ca"
            . " inner join cores co on ca.cor = co.id"
            . " inner join usuarios us on ca.idusuario = us.id"
            . " inner join marcas ma on ca.idmarca = ma.id"
            . " inner join categorias cat on ca.idcategoria = cat.id"
            
            . " INNER JOIN cidades ci ON ca.idcidade = ci.id"
            . " where ca.nome  like '%{$nome}%' and ca.status = 1";
    return mysqli_query($conexao, $query);
}

function buscaAnunciosCidade($conexao, $nomecidade) {
    $query = "select ca.*,co.nomecor,us.nomeuser, us.sobrenome, ci.nomecidade, ma.nomemarca,cat.nomecategoria from carros ca"
            . " inner join cores co on ca.cor = co.id"
            . " inner join usuarios us on ca.idusuario = us.id"
            . " inner join marcas ma on ca.idmarca = ma.id"
            . " inner join categorias cat on ca.idcategoria = cat.id"
            
            . " INNER JOIN cidades ci ON ca.idcidade = ci.id"
            . " where ci.nomecidade  like '%{$nomecidade}%' and ca.status = 1";
    return mysqli_query($conexao, $query);
}

function totalAnuncioUs($conexao, $id) {
    $sql = "SELECT COUNT( * ) as num  
      FROM carros
      WHERE idusuario ={$id}";
    $resultado  = mysqli_query($conexao, $sql);
    
    return mysqli_fetch_assoc($resultado);
}

function vwAnuncios($conexao,$ordem) {
    $query = "select ca.*,co.nomecor,us.nomeuser, us.sobrenome, ci.nomecidade, ma.nomemarca,cat.nomecategoria from carros ca"
            . " inner join cores co on ca.cor = co.id"
            . " inner join usuarios us on ca.idusuario = us.id"
            . " inner join marcas ma on ca.idmarca = ma.id"
            . " inner join categorias cat on ca.idcategoria = cat.id"
            
            . " INNER JOIN cidades ci ON ca.idcidade = ci.id
                WHERE ma.id=4 and ca.status =1";
    if ($ordem <> "") {
        $query = $query .
           " order by {$ordem}";
    }
    return mysqli_query($conexao, $query);
}

function tyAnuncios($conexao, $ordem) {
    $query = "select ca.*,co.nomecor,us.nomeuser, us.sobrenome, ci.nomecidade, ma.nomemarca,cat.nomecategoria from carros ca"
            . " inner join cores co on ca.cor = co.id"
            . " inner join usuarios us on ca.idusuario = us.id"
            . " inner join marcas ma on ca.idmarca = ma.id"
            . " inner join categorias cat on ca.idcategoria = cat.id"
            
            . " INNER JOIN cidades ci ON ca.idcidade = ci.id
                WHERE ma.id=2 and ca.status =1";
    if ($ordem <> "") {
        $query = $query .
           " order by {$ordem}";
    }
    return mysqli_query($conexao, $query);
}

function auAnuncios($conexao, $ordem) {
    $query = "select ca.*,co.nomecor,us.nomeuser, us.sobrenome, ci.nomecidade, ma.nomemarca,cat.nomecategoria from carros ca"
            . " inner join cores co on ca.cor = co.id"
            . " inner join usuarios us on ca.idusuario = us.id"
            . " inner join marcas ma on ca.idmarca = ma.id"
            . " inner join categorias cat on ca.idcategoria = cat.id"
            
            . " INNER JOIN cidades ci ON ca.idcidade = ci.id
                WHERE ma.id=3 and ca.status =1";
    if ($ordem <> "") {
        $query = $query .
           " order by {$ordem}";
    }
    return mysqli_query($conexao, $query);
}

function ftAnuncios($conexao, $ordem) {
    $query = "select ca.*,co.nomecor,us.nomeuser, us.sobrenome, ci.nomecidade, ma.nomemarca,cat.nomecategoria from carros ca"
            . " inner join cores co on ca.cor = co.id"
            . " inner join usuarios us on ca.idusuario = us.id"
            . " inner join marcas ma on ca.idmarca = ma.id"
            . " inner join categorias cat on ca.idcategoria = cat.id"
            
            . " INNER JOIN cidades ci ON ca.idcidade = ci.id
                WHERE ma.id=5 and ca.status =1";
    if ($ordem <> "") {
        $query = $query .
           " order by {$ordem}";
    }
    return mysqli_query($conexao, $query);
}

function chAnuncios($conexao, $ordem) {
    $query = "select ca.*,co.nomecor,us.nomeuser, us.sobrenome, ci.nomecidade, ma.nomemarca,cat.nomecategoria from carros ca"
            . " inner join cores co on ca.cor = co.id"
            . " inner join usuarios us on ca.idusuario = us.id"
            . " inner join marcas ma on ca.idmarca = ma.id"
            . " inner join categorias cat on ca.idcategoria = cat.id"
            
            . " INNER JOIN cidades ci ON ca.idcidade = ci.id
                WHERE ma.id=7 and ca.status =1";
    if ($ordem <> "") {
        $query = $query .
           " order by {$ordem}";
    }
    return mysqli_query($conexao, $query);
}

