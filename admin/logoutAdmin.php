
<?php include("LogicaAdmin.php");

logout();

$_SESSION["success"] = "Deslogado com sucesso";

header("Location: index.php");
die();
