<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
</head>

<?php
include("barra_navegacion.php");

if($_SERVER['REQUEST_METHOD'] == 'POST'){

	$descripcion = "";
	if (isset($_POST['descripcion']) == true) {
		$descripcion_trim = trim($_POST['descripcion']);
		$descripcion = $descripcion_trim;
	}else{
		echo "<h1>Descripcion no ingresada<h1>";
	}

	$estado = "";
	if (isset($_POST['estado']) == true) {
		$estado_trim = trim($_POST['estado']);
		$estado = $estado_trim;
	}else{
		echo "<h1>Estado no ingresado<h1>";
	}

	$sql = "INSERT INTO tarea(descripcion, estado) VALUES ('$descripcion', '$estado');";

	$respuesta_consulta = mysqli_query($db, $sql);

	if ($respuesta_consulta == false) {
	 die("No se pudo ingresar el registro");
	}

	echo "<div class='alert alert-success center' role='alert'><h3>La tarea ha sido registrada correctamente.</h3>
		<a class='btn btn-outline-primary' href='listado.php' role='button'>Regresar</a></div>";	

}else{

?>

<body>
    <div class="container">
        <div class="row">
            <form class="col-lg-6" method="POST" action="formulario_tareas.php">
                <div class="form-group">
                    <label for="descripcion">Descripcion</label> 
                    <input class="form-control input-sm" placeholder="Descripcion" type="text" name="descripcion" required>
                </div>
                <div class="form-group">
                    <label for="estado">Estado</label> 
                    <input class="form-control input-sm" placeholder="Estado" type="text" name="estado" required>
                </div>
                <button type="submit" class="btn btn-success center btn-dark" >Guardar</button>
            </form>
        </div>
    </div>
</body>
</html>
<?php
}
?>