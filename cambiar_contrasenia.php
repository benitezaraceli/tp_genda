<?php
include("barra_navegacion.php");

if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $contrasenia = $_POST['contrasenia'];
        $nueva_contrasenia = $_POST['nueva_contrasenia'];
        $confirmar_contrasenia = $_POST['confirmar_contrasenia'];
        $usuario = $_SESSION['usuario'];
    try{
        $rs = mysqli_query($db, "SELECT contrasenia FROM usuario WHERE usuario= '$usuario'");
        $row = mysqli_fetch_assoc($rs);
  
        $hash = $row['contrasenia'];
        if (password_verify($_POST['contrasenia'], $hash) && $nueva_contrasenia == $confirmar_contrasenia) {
            $passHash = password_hash($nueva_contrasenia, PASSWORD_DEFAULT);
            $sql = "UPDATE usuario SET 
                    contrasenia='$passHash'
                    WHERE usuario= '$usuario'";
            mysqli_query($db, $sql);
            header('Location: listado.php');
          } else {
        echo "<div class='alert alert-danger center' role='alert'>Datos ingresados invalidos<p><a href='./index.php'><strong>Regresar</strong></a></p></div>";
          }
    }catch(Exception $ex){
        echo "OCURRIO UN ERROR";
    }
}

?>
<body>
  
  <div class="container">
    <div class="row">
      <form class="col-sm-10" method="POST" action="./cambiar_contrasenia.php" >
        <div class="form-group">
          <label for="password">Ingresar contraseña</label>
          <input type="password" class="form-control input-lg" name="contrasenia" required>
        </div>
        <div class="form-group">
          <label for="nueva_contrasenia">Nueva contraseña</label>
          <input type="password" class="form-control input-lg" name="nueva_contrasenia" required>
        </div>
        <div class="form-group">
          <label for="confirmar_contrasenia">Repetir nueva contraseña</label>
        <input type="password" class="form-control input-lg" name="confirmar_contrasenia" required>
        </div>
        <button type="submit" class="btn btn-success center btn-dark">Ingresar</button>
        <br>
      </form>
    </div>
</body>