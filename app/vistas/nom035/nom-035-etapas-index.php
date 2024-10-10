<?php
require('app/help.php');
?>
<html lang="es">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <title>SASISOPA</title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width initial-scale=1.0">
  <link rel="shortcut icon" href="<?= RUTA_IMG_ICONOS ?>/icono-web.png">
  <link rel="apple-touch-icon" href="<?= RUTA_IMG_ICONOS ?>/icono-web.png">
  <link rel="stylesheet" href="<?= RUTA_CSS ?>alertify.css">
  <link rel="stylesheet" href="<?= RUTA_CSS ?>themes/default.rtl.css">
  <link rel="stylesheet" href="<?= RUTA_CSS ?>bootstrap.css" />
  <link rel="stylesheet" href="<?= RUTA_CSS ?>componentes.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.2/umd/popper.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.13.2/jquery-ui.min.js"></script>
  <script type="text/javascript" src="<?= RUTA_JS ?>alertify.js"></script>
  <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
  <link href="https://cdn.datatables.net/v/bs5/jszip-3.10.1/dt-2.0.3/b-3.0.1/b-colvis-3.0.1/b-html5-3.0.1/b-print-3.0.1/datatables.min.css" rel="stylesheet">
  <style media="screen">
    .LoaderPage {
      position: fixed;
      left: 0px;
      top: 0px;
      width: 100%;
      height: 100%;
      z-index: 9999;
      background: url('imgs/iconos/load-img.gif') 50% 50% no-repeat rgb(249, 249, 249);
    }

    .cont-puntos {
      border-bottom: 3px solid #3399cc;
      box-shadow: 1px 1px 5px #EDEDED;
    }

    .titulo-punto {
      font-size: 1.25em;
    }
  </style>
  <script type="text/javascript">
    $(document).ready(function() {
      $('[data-toggle="tooltip"]').tooltip();
      $(".LoaderPage").fadeOut("slow");
    });

    function regresarP() {
      window.history.back();
    }

    function Politica() {
      window.location.href = 'nom-035-politica';
    }

    function Acontecimientos() {
      window.location.href = 'nom-035-acontecimientos';
    }

    function FactoresRS() {
      window.location.href = 'nom-035-factores-riesgo';
    }
  </script>
</head>

<body>

  <div class="LoaderPage"></div>
  <div class="fixed-top navbar-admin">
    <?php require('app/vistas/componentes/navbar-perfil.php'); ?>
  </div>

  <div class="magir-top-principal p-3">

    <!-- Inicio -->
    <div class="float-end">
      <div class="dropdown dropdown-sm d-inline ms-2">
      </div>
    </div>
    <!-- Fin -->

    <!-- Inicio -->
    <div aria-label="breadcrumb" style="padding-left: 0; margin-bottom: 0;">
      <ol class="breadcrumb breadcrumb-caret">
        <li class="breadcrumb-item text-primary c-pointer" onclick="regresarP()"><i class="fa-solid fa-house"></i> SASISOPA</li>
        <li aria-current="page" class="breadcrumb-item active"><?= strtoupper($session_nomestacion) ?> (NOM-035)</li>
      </ol>
    </div>
    <!-- Fin -->

    <h3><?= strtoupper($session_nomestacion) ?> (NOM-035)</h3>


    <div class="row">

      <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">

        <div class="card rounded-0">
          <div class="card-body">
            <h5 class="card-title border-bottom pb-3">Etapa 1</h5>

            <div class="row">
              <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 mb-2">
                <div class="p-3 cont-puntos mb-3">
                  <div class="titulo-punto">1. Política</div>

                  <div class="text-end mt-3">
                    <button type="button" class="btn btn-primary rounded-0" onclick="Politica()">Entrar</button>
                  </div>

                </div>
              </div>

              <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 mb-2">
                <div class="rounded-0 p-3 cont-puntos mb-3">
                  <div class="titulo-punto">2. Acontecimientos traumáticos severos</div>

                  <div class="text-end mt-3">
                    <button type="button" class="btn btn-primary rounded-0" onclick="Acontecimientos()">Entrar</button>
                  </div>
                </div>
              </div>

              <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 mb-2">
                <div class="rounded-0 p-3 cont-puntos mb-3">
                  <div class="titulo-punto">3. Resultados ATS</div>

                  <div class="text-end mt-3">
                    <button type="button" class="btn btn-light rounded-0">Entrar</button>
                  </div>
                </div>
              </div>
            </div>

          </div>
        </div>

      </div>


      <div class="col-xl-6 col-lg-6 col-md-12 col-12 mb-3">


        <div class="card rounded-0">
          <div class="card-body">
            <h5 class="card-title border-bottom pb-3">Etapa 2</h5>

            <div class="row">
              <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 mb-2">
                <div class="p-3 cont-puntos mb-3">
                  <div class="titulo-punto">1. Factores de riesgo psicosocial</div>

                  <div class="text-end mt-3">
                    <button type="button" class="btn btn-primary rounded-0" onclick="FactoresRS()">Entrar</button>
                  </div>

                </div>
              </div>

              <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 mb-2">
                <div class="rounded-0 p-3 cont-puntos mb-3">
                  <div class="titulo-punto">2. Resultados FRP</div>

                  <div class="text-end mt-3">
                    <button type="button" class="btn btn-light rounded-0">Entrar</button>
                  </div>

                </div>
              </div>
              <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 mb-2">
                <div class="rounded-0 p-3 cont-puntos mb-3">
                  <div class="titulo-punto">3. Mejora continua</div>

                  <div class="text-end mt-3">
                    <button type="button" class="btn btn-light rounded-0">Entrar</button>
                  </div>
                </div>
              </div>

              <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 mb-2">
                <div class="rounded-0 p-3 cont-puntos mb-3">
                  <div class="titulo-punto">3. Medidas de mitigación</div>

                  <div class="text-end mt-3">
                    <button type="button" class="btn btn-light rounded-0">Entrar</button>
                  </div>
                </div>
              </div>
            </div>

          </div>
        </div>

      </div>
    </div>

  </div>

  <script src="<?php echo RUTA_JS ?>bootstrap.min.js"></script>
</body>

</html>