<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
</head>

<?php 
include("top.php");

	if($_SERVER['REQUEST_METHOD'] == 'POST'){
		try{
			$usuario = "";
			if (isset($_POST['usuario']) == true) {
				$usuario = trim($_POST['usuario']);

				$contrasenia = "";
				if (isset($_POST['contrasenia']) == true) {
					$contrasenia = $_POST['contrasenia'];

					$sql = "SELECT contrasenia, usuario FROM usuario WHERE usuario = '$usuario'";

					$rs = mysqli_query($db, $sql);
					$row = mysqli_fetch_assoc($rs);
					$hash = $row['contrasenia'];

					if (password_verify($contrasenia, $hash)) {

						session_start();
						$_SESSION['start'] = time();
						$_SESSION['loggedin'] = true;
						$_SESSION['usuario'] = $row['usuario'];
						$_SESSION['expire'] = $_SESSION['start'] + (200 * 999);

						echo '<meta http-equiv="Refresh" content="0;URL=listado.php">';

					} else {
						echo "<div class='alert alert-danger center' role='alert'>Las credenciales son invalidas<p><a href='./index.php'><strong>Regresar</strong></a></p></div>";
					}

				}else{
					echo "<h1>Usuario no ingresado<h1>";
					die;
				}
			}

		}catch(Exception $ex){
	        echo "OCURRIO UN ERROR AL ACTUALIZAR LOS DATOS";
	    }

		}else{
?>

<body>
	<div class="row col-lg-6">
			<div class="col-lg-6">
				<h2>Login</h2><hr />
				<form action="index.php" method="post">                           	
					<div class="form-group">
					<input type="user" name="usuario" placeholder="Nombre de usuario" required>
					</div>
					<div class="form-group">        
					<input type="password" name="contrasenia" placeholder="Contraseña" required>
					</div>
					<button type="submit" class="btn btn-success">Ingresar</button>
					<hr><p>¿No estás registrado? <a href="registrarse.php" title="Crea una cuenta">Crea una cuenta</a>.</p>
				</form>
			</div>
	</div>
</body>
</html>
<?php
	}
?>