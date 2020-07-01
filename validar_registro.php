<?php
class Formulario {


 public function validar($post) {

	if (!empty($_POST['nombre_completo']) == true) {
		$nombre_completo = trim($_POST['nombre_completo']);
	}else{
		echo "<div class='alert center' role='alert'><h3>Nombre no ingresado</h3><hr />
					<a class='btn btn-outline-primary' href='registrarse.php' role='button'>Regresar</a></div>";
		return false;
	}

	if (!empty($_POST['email']) == true) {
		$email = trim($_POST['email']);
	}else{
		echo "<div class='alert center' role='alert'><h3>Email no ingresado</h3><hr />
					<a class='btn btn-outline-primary' href='registrarse.php' role='button'>Regresar</a></div>";
		return false;
	}

	if (!empty($_POST['usuario']) == true) {
		$usuario = trim($_POST['usuario']);
	}else{
		echo "<div class='alert center' role='alert'><h3>Nombre de usuario no ingresado</h3><hr />
					<a class='btn btn-outline-primary' href='registrarse.php' role='button'>Regresar</a></div>";
		return false;
	}

	if (!empty($_POST['contrasenia']) == true) {
		$contrasenia = trim($_POST['contrasenia']);
	}else{
		echo "<div class='alert center' role='alert'><h3>Contraseña no ingresada</h3><hr />
					<a class='btn btn-outline-primary' href='registrarse.php' role='button'>Regresar</a></div>";
		return false;
	}

	return true;

 }

}

?>