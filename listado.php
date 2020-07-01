<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
</head>

<?php
include("barra_navegacion.php");
?>

<body>

    <div class="col-sm-12 p-5">
        <div id="container">
            <div class="row align-content-md-center">
                <h2>Lista de tareas</h2>
                <form action="listado.php" method="GET">     
                    <input id="filtro" name="filtro" placeholder="Filtro" required>
                    <select class="selectpicker" name="seccion" id="seccion">
                        <option value="estado">Estado</option>
                        <option value="descripcion">Descripcion</option>
                    </select>
                    <button type="submit" class="btn btn-success">Aceptar</button>
                </form>
                    <table class="table">
<?php

if (empty($_GET) == false) {

    if (isset($_GET['seccion']) == true) {
        $_SESSION['seccion'] = trim($_GET['seccion']);
    }else{
        echo "<h1>Seccion no ingresada<h1>";
    }

    if (isset($_GET['filtro']) == true) {
        $_SESSION['filtro'] = trim($_GET['filtro']);

    }else{
        echo "<h1>Filtro no ingresado<h1>";
    }

    $sql = "SELECT * from tarea
        WHERE " . $_SESSION['seccion'] . " LIKE '%" . $_SESSION['filtro'] . "%'";

}else{

    if(empty($_SESSION['seccion']) == false && empty($_SESSION['filtro']) == false){
        $sql = "SELECT * from tarea
            WHERE " . $_SESSION['seccion'] . " LIKE '%" . $_SESSION['filtro'] . "%'";

    }else{

    $sql = "SELECT descripcion, estado, fecha_creacion, id FROM tarea";

    }
}

        $rs = mysqli_query($db, $sql);
        if ( $rs ) {
            while ($r = mysqli_fetch_array($rs) ) {
?>
                    <tr>
                        <th>Descripcion</th>
                        <th>Estado</th>
                        <th>Fecha de creación</th>
                        <th></th>
                        <th></th>
                    </tr>

                    <td><?php echo $r['descripcion'];?></td>
                    <td><?php echo $r['estado'];?></td>
                    <td><?php echo $r['fecha_creacion'];?></td>
                    <td><button type= button onclick=location.href='./editar_tarea.php?id=<?php echo $r['id'];?>' class="btn btn-dark" >Editar</button></td>
                    <td><button type= button onclick=location.href='./borrar_tarea.php?id=<?php echo $r['id'];?>' class="btn btn-dark" >Borrar</button></td>
<?php
    }
}
?>
                </table>
            </div>
        </div>
    </div>
</body>
</html>