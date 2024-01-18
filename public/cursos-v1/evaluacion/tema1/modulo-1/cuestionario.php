  <?php 
 
  $idTema = $_GET['idTema'];
  $idModulo = $_GET['idModulo']; 
  $valEvaluacion = $_GET['valEvaluacion'];
  ?>
  <script type="text/javascript">
    
    $(document).ready(function()
    {

    $("#validate").click(function () {  
      $('.pregunta-1').css('border',''); 
      $('.pregunta-2').css('border',''); 
      $('.pregunta-3').css('border',''); 
      $('.pregunta-4').css('border',''); 
      $('.pregunta-5').css('border',''); 
      

      var respuesta1 = $('input:radio[name=preg1]:checked').val();
      var respuesta2 = $('input:radio[name=preg2]:checked').val();
      var respuesta3 = $('input:radio[name=preg3]:checked').val();
      var respuesta4 = $('input:radio[name=preg4]:checked').val();
      var respuesta5 = $('input:radio[name=preg5]:checked').val();
      

      var Titulo1 = $("#Titulo-1").html();
      var Titulo2 = $("#Titulo-2").html();
      var Titulo3 = $("#Titulo-3").html();
      var Titulo4 = $("#Titulo-4").html();
      var Titulo5 = $("#Titulo-5").html();
      
      
      if (respuesta1 != undefined) {
      if (respuesta2 != undefined) {
      if (respuesta3 != undefined) {
      if (respuesta4 != undefined) {
      if (respuesta5 != undefined) {

      var parametros = {
      "idTema" : <?php echo $idTema; ?>,
      "idModulo" : <?php echo $idModulo; ?>,
      "valEvaluacion" : <?php echo $valEvaluacion; ?>,
      "Titulo1" : Titulo1,
      "respuesta1" : respuesta1,
      "Titulo2" : Titulo2,
      "respuesta2" : respuesta2,
      "Titulo3" : Titulo3,
      "respuesta3" : respuesta3,
      "Titulo4" : Titulo4,
      "respuesta4" : respuesta4,
      "Titulo5" : Titulo5,
      "respuesta5" : respuesta5
      };

      $.ajax({
      data:  parametros,
      url:   '../../public/cursos/evaluacion/tema1/modulo-1/evaluacion-1.php',
      type:  'post',
      beforeSend: function() {
      
      },
      complete: function(){
     $('#DivPrincipal').html("");
      },
      success:  function (response) {

     
$('#DivPrincipal').load('../../public/cursos/ver-resultado-modulo.php?' + response + '&idTema=<?=$idTema;?>');

      }
      });

    
      }else{ $('.pregunta-5').css('border','2px solid #A52525'); }
      }else{ $('.pregunta-4').css('border','2px solid #A52525'); }
      }else{ $('.pregunta-3').css('border','2px solid #A52525'); }
      }else{ $('.pregunta-2').css('border','2px solid #A52525'); }
      }else{ $('.pregunta-1').css('border','2px solid #A52525'); }
            
      });

     });

  </script>
  <style type="text/css">
    .title-pregunta{
      font-size: 1.2em;
    }
  </style>


  <div class="card animated fadeIn col-12">
  <div class="card-body">
  <div style="font-size: 1.3em;">EVALUACION</div>
  <div style="font-size: 1em;">Responde correctamente las siguientes preguntas </div> 


  <div id="resultado"></div>
  
  <div class="row justify-content-md-center">

  <div class="col-xl-8 col-lg-8 col-md-12 col-12">
      <!-- --- Pregunta numero 1 --- -->
  
  <div class=" pregunta-1 mb-3">
  
  <div class="font-weight-bold title-pregunta" id="Titulo-1">1.- Es una herramienta para la descarga del autotanque.</div>
  <div class="form-check">
  <input class="form-check-input" type="radio" name="preg1" id="Radio1Pregunta1" value="a,a,1">
  <label class="form-check-label" for="Radio1Pregunta1">
  a) Biombos.
  </label>
  </div>
  
  <div class="form-check">
  <input class="form-check-input" type="radio" name="preg1" id="Radio2Pregunta2" value="b,a,0">
  <label class="form-check-label" for="Radio2Pregunta2">
  b)  Franela
  </label>
  </div>

  <div class="form-check disabled">
  <input class="form-check-input" type="radio" name="preg1" id="Radio3Pregunta3" value="c,a,0">
  <label class="form-check-label" for="Radio3Pregunta3">
  c)  Escaleras
  </label>
  </div>

  </div>

  <div class=" pregunta-2 mb-3">
    <!-- --- Pregunta numero 2 --- -->
  <div class="font-weight-bold title-pregunta" id="Titulo-2">2.- Es una práctica segura para la descarga del autotanque al tanque de almacenamiento</div>
  <div class="form-check">
  <input class="form-check-input" type="radio" name="preg2" id="Radio4Pregunta4" value="a,b,0">
  <label class="form-check-label" for="Radio4Pregunta4">
  a)  Despachar combustible
  </label>
  </div>
  <div class="form-check">
  <input class="form-check-input" type="radio" name="preg2" id="Radio5Pregunta5" value="b,b,1">
  <label class="form-check-label" for="Radio5Pregunta5">
  b)  La manguera para la descarga del producto no debe quedar con tensión ni por debajo del Autotanque.
  </label>
  </div>
  <div class="form-check disabled">
  <input class="form-check-input" type="radio" name="preg2" id="Radio6Pregunta6" value="c,b,0">
  <label class="form-check-label" for="Radio6Pregunta6">
  c)  Saludar al cliente
  </label>
  </div>  
  </div>
  <div class=" pregunta-3 mb-3">
  <!-- --- Pregunta numero 3 --- -->
  <div class="font-weight-bold title-pregunta" id="Titulo-3">3.- En caso de fugas o  derrames que deben hacer en conjunto con el chofer repartidor y cobrador, ayudante de chofer y el encargado de la estación:</div>
  <div class="form-check">
  <input class="form-check-input" type="radio" name="preg3" id="Radio7Pregunta7" value="a,a,1">
  <label class="form-check-label" for="Radio7Pregunta7">
  a)  Suspender actividades y proceder a las actividades de contención y limpieza de del producto.
  </label>
  </div>
  <div class="form-check">
  <input class="form-check-input" type="radio" name="preg3" id="Radio8Pregunta8" value="b,a,0">
  <label class="form-check-label" for="Radio8Pregunta8">
  b)  Dejar el área para evitar el peligro
  </label>
  </div>
  <div class="form-check disabled">
  <input class="form-check-input" type="radio" name="preg3" id="Radio9Pregunta9" value="c,a,0">
  <label class="form-check-label" for="Radio9Pregunta9">
  c)  Mantener la calma y alejarse de la estación de servicio
  </label>
  </div>  
  </div>
  <div class=" pregunta-4 mb-3">
    <!-- --- Pregunta numero 4 --- -->
  <div class="font-weight-bold title-pregunta" id="Titulo-4">4.- ¿Cuál es la distancia máxima a la que se debe permanecer de la bocatoma del tanque de almacenamiento?</div>
  <div class="form-check">
  <input class="form-check-input" type="radio" name="preg4" id="Radio10Pregunta10" value="a,c,0">
  <label class="form-check-label" for="Radio10Pregunta10">
  a)  5 metros
  </label>
  </div>
  <div class="form-check">
  <input class="form-check-input" type="radio" name="preg4" id="Radio11Pregunta11" value="b,c,0">
  <label class="form-check-label" for="Radio11Pregunta11">
  b)  3 metros
  </label>
  </div>
  <div class="form-check disabled">
  <input class="form-check-input" type="radio" name="preg4" id="Radio12Pregunta12" value="c,c,1">
  <label class="form-check-label" for="Radio12Pregunta12">
  c)  2 metros
  </label>
  </div> 
  </div>
  <div class=" pregunta-5 mb-3">
   <!-- --- Pregunta numero 5 --- -->
  <div class="font-weight-bold title-pregunta" id="Titulo-5">5.- Para una mejor seguridad, salud y protección ambiental se debe de contar con:</div>
  <div class="form-check">
  <input class="form-check-input" type="radio" name="preg5" id="Radio13Pregunta13" value="a,b,0">
  <label class="form-check-label" for="Radio13Pregunta13">
  a)  Botiquín de primeros auxilios
  </label>
  </div>
  <div class="form-check">
  <input class="form-check-input" type="radio" name="preg5" id="Radio14Pregunta14" value="b,b,1">
  <label class="form-check-label" for="Radio14Pregunta14">
  b)  Equipo de Protección Personal
  </label>
  </div>
  <div class="form-check disabled">
  <input class="form-check-input" type="radio" name="preg5" id="Radio15Pregunta15" value="c,b,0">
  <label class="form-check-label" for="Radio15Pregunta15">
  c)  Equipo de plomería
  </label>
  </div> 
  </div>
    
     <div class="float-right"><button type="button" id="validate" class="btn btn-outline-primary">Finalizar Evaluación</button></div>

  </div>


  </div>



  </div>
  </div>