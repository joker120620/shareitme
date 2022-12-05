<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Shareitme</title>
 <link rel="stylesheet" href="./style.css">
 <!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
<body class="bg-dark">
 <?php
 include ('publi_con_db.php');
 ?>
  <h1 class="text-light p-5 ">SHAREITME</h1>
 <section class="d-flex justify-content-center">
<form method="post" action="person.php" class="container text-center w-50 text-white" enctype="multipart/form-data">
 <input name ="autor" id="autor" value="" style="display:none ">
 <div class="mb-3  ">
 <label class="form-label" >Título</label>
 <input type="text" name="titulo" class="form-control">
 </div>
 <div class="mb-3 row ">
 <div class="mb-3 col-sm-8 col-lg-8">
 <label class="form-label">Descripción</label>
 <textarea type="text" name="publi" class="form-control " rows="3"></textarea>
 </div>
 <div class="mb-3 mt-5 col-sm-4 col-lg-4">
 <label class="form-label  " for="img"><svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-images" viewBox="0 0 16 16">
  <path d="M4.502 9a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3z"/>
  <path d="M14.002 13a2 2 0 0 1-2 2h-10a2 2 0 0 1-2-2V5A2 2 0 0 1 2 3a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2v8a2 2 0 0 1-1.998 2zM14 2H4a1 1 0 0 0-1 1h9.002a2 2 0 0 1 2 2v7A1 1 0 0 0 15 11V3a1 1 0 0 0-1-1zM2.002 4a1 1 0 0 0-1 1v8l2.646-2.354a.5.5 0 0 1 .63-.062l2.66 1.773 3.71-3.71a.5.5 0 0 1 .577-.094l1.777 1.947V5a1 1 0 0 0-1-1h-10z"/>
</svg></label>
 <input type="file" id="img" name="image" class="form-control">
 </div>
 </div>
 <div class="mb-3">
 <input type="submit" name="btnEnviar" class="btn p-1 border border-light text-light" value="Publicar">
 </div>
</form></section>
<section class="container mb-5">
 <h2 class="text-light ">Publicaciones</h2>
</section>
<?php
mysqli_select_db($conn, $database);
$query = "SELECT * FROM tbl_publicado";
function mostrarDatos($row){
 echo '<section class="container d-flex justify-content-center "> <section class=" rounded p-4 text-white mb-3 border border-ligth">
<div class="mb-3" >  --'.  $row["aut_pub"]. '--</div>
<div class="mb-3 text-center">'. $row["tit_pub"].' </div>
<div class="text-center"> <div><div><img src = "data:image/png;base64,' . base64_encode($row["ima_pub"]) . '" width = "200px" height = "200px" ></div><div class="mt-3" >'. $row["pub_pub"].' </div></div>'. $row["fec_pub"]. '</div>
</section></section>';
};
$result = mysqli_query($conn,$query);
while ($fila = mysqli_fetch_array($result)){
 mostrarDatos($fila);
};
if (isset($_POST['btnEnviar'])){
 if (strlen($_POST['autor']) >= 1 && strlen($_POST['publi']) >= 1 && getimagesize($_FILES["image"]["tmp_name"])){
	    $autor = trim($_POST['autor']);
	    $titulo= trim($_POST['titulo']);
	    $publi= trim($_POST['publi']);
	    $image = $_FILES['image']['tmp_name'];
     $imgContent = addslashes(file_get_contents($image));
	    $dataTime = date("Y-m-d H:i:s");
	    $consulta = "INSERT INTO tbl_publicado(aut_pub, tit_pub, pub_pub, ima_pub, fec_pub) VALUES ('$autor','$titulo','$publi', '$imgContent', '$dataTime')";
	    $resultado = mysqli_query($conn,$consulta);
	    if($resultado){
	     echo '<script>alert("Enviado"); </script>' ;
	    };
}else {
 echo '<script>alert("Casillas Vacias ") </script>' ;
};
};
?>
<h4 class="text-light text-center">DESARROLLADO POR: JUAN DAVID TOLOZA ORTEGA </h4>
<script src="./main.js"></script>
<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>
</html>