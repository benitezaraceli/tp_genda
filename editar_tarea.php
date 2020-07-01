<?php
include("barra_navegacion.php");

$descripcion="";
$estado="";
$id = $_GET["id"];

$sql = "select * from tarea where id = '$id'";
$rs = mysqli_query($db, $sql);

if ($r = mysqli_fetch_array($rs)) {
    $id = $r["id"];
    $descripcion = $r["descripcion"];
    $estado = $r["estado"];
}
?>
<html>
<head>
    <title>Editar registro</title>
</head>
<body>
    <div class="container">
        <div class="row">
            <form class="col-lg-6" method="POST">
                <div class="form-group">
                    <label for="descripcion">Descripcion</label> 
                    <input class="form-control input-sm" placeholder="Descripcion" type="text" name="descripcion" value="<?php echo $descripcion;?>" required>
                </div>
                <div class="form-group">
                    <label for="estado">Estado</label> 
                    <input class="form-control input-sm" placeholder="Estado" type="text" name="estado" value="<?php echo $estado;?>" required>
                </div>
                <button type="submit" class="btn btn-success center btn-dark" >Guardar</button>
            </form>
        </div>
    </div>
</body>
</html>
<?php
if (empty($_POST) == false) {
    $descripcion = $_POST["descripcion"];
    $estado = $_POST["estado"];
    $sql = "update tarea set descripcion = '$descripcion', estado = '$estado'  where id = '$id'";
    mysqli_query($db, $sql);
    header("Location: listado.php");
}

?>