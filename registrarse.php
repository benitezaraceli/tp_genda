<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
</head>

<?php
include("top.php");
include("validar_registro.php");

	if($_SERVER['REQUEST_METHOD'] == 'POST'){
		
		$formulario = new Formulario();

		if ($formulario->validar($_POST) == true) {


			$query = "SELECT * FROM usuario WHERE usuario = '$_POST[usuario]' OR email = '$_POST[email]' ";
			$result = mysqli_query($db, $query);
			$count = mysqli_num_rows($result);

			if ($count == 1) {

				echo "<div class='alert center' role='alert'><h3>El usuario ingresado ya está registrado.</h3><hr />
					<a class='btn btn-outline-primary' href='index.php' role='button'>Ingresar</a></div>";

			} else {

				$nombre_completo = $_POST['nombre_completo'];
				$email = $_POST['email'];
				$usuario = $_POST['usuario'];
				$contrasenia = $_POST['contrasenia'];
				
				$passHash = password_hash($contrasenia, PASSWORD_DEFAULT);
				
				$query = "INSERT INTO usuario(usuario, contrasenia, email, nombre_completo)
							VALUES ('$usuario', '$passHash', '$email', '$nombre_completo')";
							
				if (mysqli_query($db, $query)) {
					echo "<div class='alert alert-success center' role='alert'><h3>La cuenta ha sido registrada correctamente.</h3>
					<a class='btn btn-outline-primary' href='index.php' role='button'>Login</a></div>";		
					} else {
						echo "Error: " . $query . "<br>" . mysqli_error($db);
					}	
				}

			mysqli_close($db);
		}

	}else{
	
?>

<body>
	<div class="col-lg-6">
		<h2>Sign In</h2><hr />
		<form action="registrarse.php" method="post">                           	

			<div class="form-group">        
			<input type="text" name="nombre_completo" placeholder="Nombre completo">
			</div>
			<div class="form-group">        
			<input type="text" name="email" placeholder="Email">
			</div>
			<div class="form-group">
			<input type="text" name="usuario" placeholder="Nombre de usuario">
			</div>
			<div class="form-group">        
			<input type="password" name="contrasenia" placeholder="Contraseña">
			</div>
			<button type="submit" class="btn btn-success">Crear</button>
			
		</form>
	</div>
</body>
</html>
<?php
}
?>