<?php

function selectRelatorioAnuncio($conexao, $dias) {
    $cidades = array();
    $query = "select ca.*, us.nomeuser, us.sobrenome from carros ca "
            . "inner join usuarios us on ca.idusuario = us.id";

    if ($dias <> "") {
        $query = $query . " where ca.data BETWEEN DATE_SUB(NOW(), INTERVAL $dias DAY) AND NOW()";
    }

    //$query = "select * from carros ";    
    $result = mysqli_query($conexao, $query);


    //echo $result;

    while ($cidade = mysqli_fetch_assoc($result)) {
        array_push($cidades, $cidade);
    }
    return $cidades;
}

function selectRelatorioUsuario($conexao, $dias) {
    $cidades = array();
    $query = "select * from usuarios";

    if ($dias <> "") {
        $query = $query . " where datacad BETWEEN DATE_SUB(NOW(), INTERVAL $dias DAY) AND NOW()";
    }


    //$query = "select * from carros ";    
    $result = mysqli_query($conexao, $query);


    //echo $result;

    while ($cidade = mysqli_fetch_assoc($result)) {
        array_push($cidades, $cidade);
    }
    return $cidades;
}
