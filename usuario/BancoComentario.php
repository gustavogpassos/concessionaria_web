<?php

function buscaidUsuario( $conexao, $email) {
    $query = "select id from usuarios where email ='{$email}'";
    $result = mysqli_query($conexao, $query);
    
    return mysqli_fetch_array($result);
}

function verComentarios( $conexao, $id ) {
    $comentarios = array();
    $query = "select co.*,us.nomeuser, us.sobrenome, ca.id as idcarro from comentarios co
          
            inner join usuarios us on co.idusuario = us.id
            inner join carros ca on co.idcarro = ca.id   
             where ca.id = {$id}
             ORDER BY  co.id ASC";
    $resultado = mysqli_query($conexao, $query );
    while ($comentario = mysqli_fetch_assoc($resultado)) {
        array_push($comentarios, $comentario);
    }
    return $comentarios;

}

// Inserir o produto no banco de dados:
function insereComentario( $conexao, $mensagem, $datacoment, $idusuario, $idcarro) {
    $query = "insert into comentarios (mensagem, datacoment, idusuario, idcarro) 
    values ('{$mensagem}','{$datacoment}', '{$idusuario}', '{$idcarro}')";
    return mysqli_query($conexao, $query);
}


function excluirComentario($conexao, $id){
    $query = "delete from comentarios where id = {$id}";
    return mysqli_query($conexao, $query);
}


function removeComentariosCarro($conexao, $id){
    $query = "delete from comentarios where idcarro = {$id}";
    return mysqli_query($conexao, $query);
}
