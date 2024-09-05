<?php

if(isset($_GET['erro'])){
    echo('<script> alert("Error de sesion, debe loguearse para continuar");</script>');
}
?>
<!doctype html>
<html lang="en" data-bs-theme="auto">
  <head><script src="../assets/js/color-modes.js"></script>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.122.0">
    <title>Signin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@docsearch/css@3">
    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }

      .b-example-divider {
        width: 100%;
        height: 3rem;
        background-color: rgba(0, 0, 0, .1);
        border: solid rgba(0, 0, 0, .15);
        border-width: 1px 0;
        box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
      }

      .b-example-vr {
        flex-shrink: 0;
        width: 1.5rem;
        height: 100vh;
      }

      .bi {
        vertical-align: -.125em;
        fill: currentColor;
      }

      .nav-scroller {
        position: relative;
        z-index: 2;
        height: 2.75rem;
        overflow-y: hidden;
      }

      .nav-scroller .nav {
        display: flex;
        flex-wrap: nowrap;
        padding-bottom: 1rem;
        margin-top: -1px;
        overflow-x: auto;
        text-align: center;
        white-space: nowrap;
        -webkit-overflow-scrolling: touch;
      }

      .btn-bd-primary {
        --bd-violet-bg: #712cf9;
        --bd-violet-rgb: 112.520718, 44.062154, 249.437846;

        --bs-btn-font-weight: 600;
        --bs-btn-color: var(--bs-white);
        --bs-btn-bg: var(--bd-violet-bg);
        --bs-btn-border-color: var(--bd-violet-bg);
        --bs-btn-hover-color: var(--bs-white);
        --bs-btn-hover-bg: #6528e0;
        --bs-btn-hover-border-color: #6528e0;
        --bs-btn-focus-shadow-rgb: var(--bd-violet-rgb);
        --bs-btn-active-color: var(--bs-btn-hover-color);
        --bs-btn-active-bg: #5a23c8;
        --bs-btn-active-border-color: #5a23c8;
      }

      .bd-mode-toggle {
        z-index: 1500;
      }

      .bd-mode-toggle .dropdown-menu .active .bi {
        display: block !important;
      }

      html,
      body {
        height: 100%;
      }

      .form-signin {
        max-width: 400px;
        padding: 1rem;
      }

      .form-signin .form-floating:focus-within {
        z-index: 2;
      }

      .form-signin input[type="email"] {
        margin-bottom: -1px;
        border-bottom-right-radius: 0;
        border-bottom-left-radius: 0;
      }

      .form-signin input[type="password"] {
        margin-bottom: 10px;
        border-top-left-radius: 0;
        border-top-right-radius: 0;
      }
      
      .image-container {
        position: relative;
        display: inline-block;
      }

      .image-container img {
        width: 100%;
        height: auto;
      }

       .form-overlay {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, 3%);
        width: 100%;
        max-width: 400px;
        background-color: rgba(255, 255, 255, 0.8);
        padding: 20px;
        border-radius: 8px;
      }

    </style>
  </head>
  <body class="d-flex align-items-center py-4 bg-body-tertiary">
      <main class="form-signin w-100 m-auto">
        <div class="image-container">
          <img class="mb-4" src="public/assets/imgs/pexels-padrinan-2882566.jpg" alt="" width="300" height="120">
          <form id="frmlogin" class="form-overlay">
            <h1 class="h3 mb-3 fw-normal">Ingresar credenciales</h1>

            <div class="form-floating">
              <input type="email" class="form-control" id="correo" placeholder="name@example.com">
              <label for="correo">Correo</label>
            </div>
            <div class="form-floating">
              <input type="password" class="form-control" id="password" placeholder="Password">
              <label for="password">Contraseña</label>
            </div>

            <button class="btn btn-primary w-100 py-2" type="submit">Ingresar</button>
            <p class="mt-5 mb-3 text-body-secondary">&copy; Libreria–2024</p>
          </form>
        </div>
      </main>


    <script>
      document.getElementById('frmlogin').addEventListener('submit', function(e) {
        e.preventDefault(); //detiene el cambio de pagina
        const correo = document.getElementById('correo').value;
        const password = document.getElementById('password').value;

        fetch('controllers/LoginController.php', {
          method: 'POST',
          headers: {
              'Content-Type': 'application/json'
          },
          body: JSON.stringify({correo, password})
        }).then(response => response.json()).then(data => {
            if (data.status == 200)
            {
              window.location.href = "public/views/dashboard.php";
            }
            else
            {
              alert(data.message);
            }
        });
      });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

  </body>
</html>

