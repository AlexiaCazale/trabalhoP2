<?php
    // if(!isset($_SESSION)){
    //     session_start();
    // }
?> 

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../CSS/global.css">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
	<link href="https://cdn.jsdelivr.net/npm/fastbootstrap@2.2.0/dist/css/fastbootstrap.min.css" rel="stylesheet" integrity="sha256-V6lu+OdYNKTKTsVFBuQsyIlDiRWiOmtC8VQ8Lzdm2i4=" crossorigin="anonymous">
  <link
      rel="stylesheet"
      type="text/css"
      href="https://cdn.jsdelivr.net/npm/@phosphor-icons/web@2.1.1/src/regular/style.css"
    />
    <link
      rel="stylesheet"
      type="text/css"
      href="https://cdn.jsdelivr.net/npm/@phosphor-icons/web@2.1.1/src/fill/style.css"
    />
	<title>Document</title>
</head>
<body>
<nav class="navbar navbar-expand-lg" style="background-color: #BEAFED; border-bottom: unset;">
  <div class="container-fluid">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarPillsExample" aria-controls="navbarExample" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <a class="navbar-brand" href="#"><img src="/images/bootstrap-logo.svg" width="36" /></a>
    <div class="collapse navbar-collapse" id="navbarPillsExample">
      <ul class="navbar-nav navbar-nav-pills" style="display: flex; align-items: center; gap: 20px;">
        <h4>
         Workspace name
		    </h4>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle active" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Membros</a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="#">Membro 1</a></li>
            <li><a class="dropdown-item" href="#">Membro 2</a></li>
          
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>
</body>
</html>