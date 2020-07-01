<?php

include("top.php");
include("includes/session.php");

$id = $_GET["id"];
try{
	$sql = "select * from tarea where id = '$id'";
	$rs = mysqli_query($db, $sql);

	if ($r = mysqli_fetch_array($rs)) {
	    $sql = "DELETE from tarea where id = '$id'";
	    $rs = mysqli_query($db, $sql);
	    header("Location: listado.php");
	}else{
		echo "No se encontraron tareas";
	}
}catch(Exception $ex){
    echo "OCURRIO UN ERROR";
}
?>