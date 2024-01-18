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
      url:   '../../public/cursos/evaluacion/tema2/modulo-5/evaluacion.php',
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
  <div class="font-weight-bold title-pregunta" id="Titulo-1">1.- ¿Que deben utilizar los trabajadores cuando se estime una posible caída libre mayor de 0.5 m y menor de 1.5 m.?</div>
  <div class="form-check">
  <input class="form-check-input" type="radio" name="preg1" id="Radio1Pregunta1" value="a,b,0">
  <label class="form-check-label" for="Radio1Pregunta1">
  a) Lentes y guantes de seguridad
  </label>
  </div>
  <div class="form-check">
  <input class="form-check-input" type="radio" name="preg1" id="Radio2Pregunta2" value="b,b,1">
  <label class="form-check-label" for="Radio2Pregunta2">
  b)  El arnés para trabajos en altura
  </label>
  </div>
  <div class="form-check disabled">
  <input class="form-check-input" type="radio" name="preg1" id="Radio3Pregunta3" value="c,b,0">
  <label class="form-check-label" for="Radio3Pregunta3">
  c)  Botas con casquillo 
  </label>
  </div>   
  </div>
  <div class="padding-5 pregunta-2">
    <!-- --- Pregunta numero 2 --- -->
  <div class="font-weight-bold title-pregunta" id="Titulo-2">2.- Cuando la caída libre pueda ser mayor de 1.5 m, pero sin exceder 4.0 m, los cinturones de seguridad deben usarse con: </div>
  <div class="form-check">
  <input class="form-check-input" type="radio" name="preg2" id="Radio4Pregunta4" value="a,c,0">
  <label class="form-check-label" for="Radio4Pregunta4">
  a)  Con un cinturón adicional amarrado alrededor de la cintura 
  </label>
  </div>
  <div class="form-check">
  <input class="form-check-input" type="radio" name="preg2" id="Radio5Pregunta5" value="b,c,0">
  <label class="form-check-label" for="Radio5Pregunta5">
  b) Una línea de seguridad fijada a una pared de alto rendimiento. 
  </label>
  </div>
  <div class="form-check disabled">
  <input class="form-check-input" type="radio" name="preg2" id="Radio6Pregunta6" value="c,c,1">
  <label class="form-check-label" for="Radio6Pregunta6">
  c) Un amortiguador de choque conectado a la línea de sujeción.
  </label>
  </div>  
  </div>
  <div class="padding-5 pregunta-3">
  <!-- --- Pregunta numero 3 --- -->
  <div class="font-weight-bold title-pregunta" id="Titulo-3">3.- Arneses, cinturones, líneas de vida, dispositivos de desaceleración son algunos elementos de protección para:</div>
  <div class="form-check">
  <input class="form-check-input" type="radio" name="preg3" id="Radio7Pregunta7" value="a,a,1">
  <label class="form-check-label" for="Radio7Pregunta7">
 a) Trabajador que labore sobre Equipos y/o Dispositivos de Seguridad para altura
  </label>
  </div>
  <div class="form-check">
  <input class="form-check-input" type="radio" name="preg3" id="Radio8Pregunta8" value="b,a,0">
  <label class="form-check-label" for="Radio8Pregunta8">
  b)  Trabajador que realice mantenimiento en los pisos. 
  </label>
  </div>
  <div class="form-check disabled">
  <input class="form-check-input" type="radio" name="preg3" id="Radio9Pregunta9" value="c,a,0">
  <label class="form-check-label" for="Radio9Pregunta9">
  c) Trabajador que despache el combustible 
  </label>
  </div>  
  </div>
  <div class="padding-5 pregunta-4">
    <!-- --- Pregunta numero 4 --- -->
  <div class="font-weight-bold title-pregunta" id="Titulo-4">4.- Para evitar que personal externo ponga en riesgo su integridad física, es necesario: </div>
  <div class="form-check">
  <input class="form-check-input" type="radio" name="preg4" id="Radio10Pregunta10" value="a,b,0">
  <label class="form-check-label" for="Radio10Pregunta10">
  a)  Decirle al personal de la estación que avise que se están llevando a cabo trabajos de mantenimiento 
  </label>
  </div>
  <div class="form-check">
  <input class="form-check-input" type="radio" name="preg4" id="Radio11Pregunta11" value="b,b,1">
  <label class="form-check-label" for="Radio11Pregunta11">
  b) Delimitar perfectamente el área de trabajo con cintas, barricadas y señalamientos 
  </label>
  </div>
  <div class="form-check disabled">
  <input class="form-check-input" type="radio" name="preg4" id="Radio12Pregunta12" value="c,b,0">
  <label class="form-check-label" for="Radio12Pregunta12">
  c) Suspender actividades en la estación.
  </label>
  </div> 
  </div>
  <div class="padding-5 pregunta-5">
   <!-- --- Pregunta numero 5 --- -->
  <div class="font-weight-bold title-pregunta" id="Titulo-5">5.- Queda prohibido utilizar para trabajos de altura lo siguiente: </div>
  <div class="form-check">
  <input class="form-check-input" type="radio" name="preg5" id="Radio13Pregunta13" value="a,a,1">
  <label class="form-check-label" for="Radio13Pregunta13">
  a)  </br>
  • Sillas</br>
• Gavetas</br>
• Cajas</br>
• Cajones</br>
• tambores o cualquier otro implemento provisional</br>

  </label>
  </div>
  <div class="form-check">
  <input class="form-check-input" type="radio" name="preg5" id="Radio14Pregunta14" value="b,a,0">
  <label class="form-check-label" for="Radio14Pregunta14">
  b)  </br>• Guantes</br>
• Cascos </br>
• Botas </br>

  </label>
  </div>
  <div class="form-check disabled">
  <input class="form-check-input" type="radio" name="preg5" id="Radio15Pregunta15" value="c,a,0">
  <label class="form-check-label" for="Radio15Pregunta15">
  c)  </br>• Cajones </br>
• Cubetas </br>
• Cintas </br>
• Arnés </br>

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