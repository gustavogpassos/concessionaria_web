<?php
include ("./ConectaUsuario.php");


$id_estado = $_GET['estado'];
 
$rs = mysqli_query($conexao, "SELECT * FROM cidades WHERE uf = '$id_estado' ORDER BY nomecidade");
 
?><select class="form-control" name="idcidade">
    <?php
foreach ( $rs as $reg){ ?>
    <option value="<?=$reg['id']?>"><?= $reg['nomecidade']?></option>
<?php } ?>
</select>