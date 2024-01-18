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
      url:   '../../public/cursos/evaluacion/tema1/modulo-2/evaluacion-1.php',
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
    .padding-5{padding: 5px;}
  </style>


  <div class="card animated fadeIn">
  <div class="card-body">
  <div style="font-size: 1.3em;">EVALUACION</div>
  <div style="font-size: 1em;">Responde correctamente las siguientes preguntas </div> 

  <div style="padding: 20px;">

    <div id="resultado"></div>
  
  <div class="row">
    <div class="col-2"></div>
    <div class="col-8">
      <!-- --- Pregunta numero 1 --- -->
  <div class="padding-5 pregunta-1">
  <div class="font-weight-bold title-pregunta" id="Titulo-1">1.- Son algunos instrumentos de trabajo de un despachador:</div>
  <div class="form-check">
  <input class="form-check-input" type="radio" name="preg1" id="Radio1Pregunta1" value="a,b,0">
  <label class="form-check-label" for="Radio1Pregunta1">
  a) Escoba
  </label>
  </div>
  <div class="form-check">
  <input class="form-check-input" type="radio" name="preg1" id="Radio2Pregunta2" value="b,b,1">
  <label class="form-check-label" for="Radio2Pregunta2">
  b)  Recipiente de agua jabonosa, jalador de agua de plástico y franela limpia
  </label>
  </div>
  <div class="form-check disabled">
  <input class="form-check-input" type="radio" name="preg1" id="Radio3Pregunta3" value="c,b,0">
  <label class="form-check-label" for="Radio3Pregunta3">
  c)  Recipiente de agua y franela.
  </label>
  </div>   
  </div>
  <div class="padding-5 pregunta-2">
    <!-- --- Pregunta numero 2 --- -->
  <div class="font-weight-bold title-pregunta" id="Titulo-2">2.- Es una responsabilidad del despachador para el despacho de combustible al cliente:</div>
  <div class="form-check">
  <input class="form-check-input" type="radio" name="preg2" id="Radio4Pregunta4" value="a,a,1">
  <label class="form-check-label" for="Radio4Pregunta4">
  a)  No servir combustible a transportes públicos con pasajeros a bordo, informándole al conductor que no está permitido.
  </label>
  </div>
  <div class="form-check">
  <input class="form-check-input" type="radio" name="preg2" id="Radio5Pregunta5" value="b,a,0">
  <label class="form-check-label" for="Radio5Pregunta5">
  b)  Guiar al conductor al estacionamiento
  </label>
  </div>
  <div class="form-check disabled">
  <input class="form-check-input" type="radio" name="preg2" id="Radio6Pregunta6" value="c,a,0">
  <label class="form-check-label" for="Radio6Pregunta6">
  c)  Guiar al conductor a su destino
  </label>
  </div>  
  </div>
  <div class="padding-5 pregunta-3">
  <!-- --- Pregunta numero 3 --- -->
  <div class="font-weight-bold title-pregunta" id="Titulo-3">3.- ¿Qué hacer en caso de pequeños derrames?</div>
  <div class="form-check">
  <input class="form-check-input" type="radio" name="preg3" id="Radio7Pregunta7" value="a,b,0">
  <label class="form-check-label" for="Radio7Pregunta7">
  a) Limpiar con jabón y cloro
  </label>
  </div>
  <div class="form-check">
  <input class="form-check-input" type="radio" name="preg3" id="Radio8Pregunta8" value="b,b,1">
  <label class="form-check-label" for="Radio8Pregunta8">
  b) Actuar con rapidez para limpiarlo, vertiendo con agua y encauzándolo a los registros del drenaje aceitoso y lavando el piso con limpiadores biodegradables
  </label>
  </div>
  <div class="form-check disabled">
  <input class="form-check-input" type="radio" name="preg3" id="Radio9Pregunta9" value="c,b,0">
  <label class="form-check-label" for="Radio9Pregunta9">
  c) Limpiar solo con jabón
  </label>
  </div>  
  </div>
  <div class="padding-5 pregunta-4">
    <!-- --- Pregunta numero 4 --- -->
  <div class="font-weight-bold title-pregunta" id="Titulo-4">¿Qué hacer en caso de derrame que no pueda ser controlado?</div>
  <div class="form-check">
  <input class="form-check-input" type="radio" name="preg4" id="Radio10Pregunta10" value="a,a,1">
  <label class="form-check-label" for="Radio10Pregunta10">
  a) Gerente solicitará inmediatamente la ayuda del Cuerpo de Protección Civil de la localidad y al personal capacitado para contener el derrame, deberá proceder conforme a los protocolos establecidos en la ES.
  </label>
  </div>
  <div class="form-check">
  <input class="form-check-input" type="radio" name="preg4" id="Radio11Pregunta11" value="b,a,0">
  <label class="form-check-label" for="Radio11Pregunta11">
  b) Deberá ordenar a todo el personal la ayuda para la recolección del combustible
  </label>
  </div>
  <div class="form-check disabled">
  <input class="form-check-input" type="radio" name="preg4" id="Radio12Pregunta12" value="c,a,0">
  <label class="form-check-label" for="Radio12Pregunta12">
  c) El gerente solicitara ayuda al Municipio.
  </label>
  </div> 
  </div>
  <div class="padding-5 pregunta-5">
   <!-- --- Pregunta numero 5 --- -->
  <div class="font-weight-bold title-pregunta" id="Titulo-5">5.- Quien es el factor principal en la relación comercial de la estación de servicio </div>
  <div class="form-check">
  <input class="form-check-input" type="radio" name="preg5" id="Radio13Pregunta13" value="a,a,1">
  <label class="form-check-label" for="Radio13Pregunta13">
  a)  El Cliente 
  </label>
  </div>
  <div class="form-check">
  <input class="form-check-input" type="radio" name="preg5" id="Radio14Pregunta14" value="b,a,0">
  <label class="form-check-label" for="Radio14Pregunta14">
 b) El despachador
  </label>
  </div>
  <div class="form-check disabled">
  <input class="form-check-input" type="radio" name="preg5" id="Radio15Pregunta15" value="c,a,0">
  <label class="form-check-label" for="Radio15Pregunta15">
  c)  El gerente
  </label>
  </div> 
  </div>
    
     <div class="float-right"><button type="button" id="validate" class="btn btn-outline-primary">Finalizar Evaluación</button></div>

  </div>
  <div class="col-2"></div>

  </div>
  </div>

  
 
  


  </div>
  </div>