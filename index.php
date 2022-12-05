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
</head>
<body class="bg-dark">
 <?php
 include("publi_con_db.php");
 ?>
 <main>
  <section class="container mt-5 d-flex text-light  justify-content-center" >
   <form class="p-3 rounded-4 text-center border border-light fw-bolder w-sm-75  " method ="post" action="index.php">
    <div class="mb-3"><svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" fill="currentColor" class="bi bi-person" viewBox="0 0 16 16">
  <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6Zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0Zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4Zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10Z"/>
</svg></div>
    <div class="mb-3">
    <label for="usuario" class="form-label">Usuario</label>
    <input type="text" class="form-control " id="usuario" name="usuario">
    </div>
    <div class="mb-3">
    <label for="pass" class="form-label">Contraseña</label>
    <input type ="password" class="form-control" id="pass" name="pass">
    </div>
    <div class="mb-3 ">
    <input class="btn btn-light mb-3" type="submit" value="Entrar" name="btnLogin">
    </div>
    <div class="mb-3 ">
     <a href="" class ="btn p-1 border border-light text-light" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Registrarse</a>
    </div>
   </form>
  </section>
  <section >
<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5 text-center" id="staticBackdropLabel">Registrarse</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
       <form class="text-center" method="post" action="index.php">
        <div class="mb-3">
         <label for="nEmail" class="form-label">Email</label>
         <input type="email" class="form-control " id="nEmail" name="nEmail" required>
         </div>
        <div class="mb-3">
         <label for="nUsuario" class="form-label">Usuario</label>
         <input type="text" class="form-control" id="nUsuario" name="nUsuario" required>
         </div>
         <div class="mb-3">
         <label for="nPass" class="form-label">Contraseña</label>
         <input type ="password" class="form-control " id="nPass" name="nPass" required>
         </div>
          <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
         <input type="submit" class="btn btn-primary" value ="Registrarse" name="btnRegistrarse">

      </div>
      </div>
      
       </form>
       
     
    </div>
  </div>
</div>

	 <?php
 if (isset($_POST['btnRegistrarse'])){
 if (strlen($_POST['nUsuario']) >= 1 && strlen($_POST['nPass']) >= 1  && strlen($_POST['nEmail']) >= 1){
  $nUsuario= trim($_POST['nUsuario']);
  $nPass= trim($_POST['nPass']);
	 $nEmail =trim($_POST['nEmail']);
	 mysqli_select_db($conn, $database);
	    $consulta ="SELECT * FROM tbl_usuarios WHERE use_usu ='".$nUsuario. "' OR ema_usu='". $nEmail. "';" ;
	    $resultado =mysqli_query($conn,$consulta);
	    if($resultado){
	     $consul ="INSERT INTO tbl_usuarios(ema_usu, use_usu, pas_usu) VALUES ('$nEmail', '$nUsuario', '$nPass');";
	    $result =mysqli_query($conn,$consul);
	    if($result){
	     echo '<div class="container mt-5 d-flex justify-content-center" ><h3 class="text-light bg-success p-2 rounded-2">Usuario registrado con éxito </h3></div>';
	    }else{
	     echo '<div class="container mt-5 d-flex justify-content-center" ><h3 class="text-light bg-danger p-2 rounded-2">el Usuario ya existe </h3></div>';
	    };
	    };
 }else{
  echo '<div class="container mt-5 d-flex justify-content-center" ><h3 class="text-light bg-danger p-2 rounded-2">Casillas vacias</h3></div>';
 } ;
} ;
 ?>
  </section>
  </main>

	 <?php
 if (isset($_POST['btnLogin'])){
 if (strlen($_POST['usuario']) >= 1 && strlen($_POST['pass']) >= 1){
  $usuario= trim($_POST['usuario']);
  function verificar($fila, $usuario){
	  $pass= trim($_POST['pass']);
	  if($fila['use_usu']!==$usuario){
	   echo '<div class="container mt-5 d-flex justify-content-center" ><h3 class="text-light bg-danger p-2 rounded-2">Usuario inexistente</h3></div>';
	   
  }else if($fila['use_usu']===$usuario && $fila['pas_usu']===$pass){
	     echo '<div class="container mt-5 d-flex justify-content-center" ><h3 class="text-light bg-success p-2 rounded-2">Bienvenido '. $usuario . '</h3></div>';
	     echo "<script>window.localStorage.setItem('usuario','". $usuario."' ); window.location.href='./person.php' ;</script>" ;
    
   }else{
	     echo '<div class="container mt-5 d-flex justify-content-center" ><h3 class="text-light bg-danger p-2 rounded-2">Datos incorrectos </h3></div>';
	    };
  };
	    mysqli_select_db($conn, $database);
	    $consulta ="SELECT * FROM tbl_usuarios WHERE use_usu = '". $usuario. "'; ";
	    $resultado =mysqli_query($conn,$consulta);
	    if($resultado){
	     $fila = mysqli_fetch_array($resultado);
	     verificar($fila, $usuario);
	    }else{
	     echo '<div class="container mt-5 d-flex justify-content-center" ><h3 class="text-light bg-danger p-2 rounded-2">Usuario inexistente</h3></div>';
	    };
	    
 }else{
  echo '<div class="container mt-5 d-flex justify-content-center" ><h3 class="text-light bg-danger p-2 rounded-2">Casillas vacias</h3></div>';
 } ;
} ;
 ?>
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
	</body>
	</html>
