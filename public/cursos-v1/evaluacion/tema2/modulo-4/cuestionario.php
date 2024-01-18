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
      $('.pregunta-6').css('border',''); 
      $('.pregunta-7').css('border',''); 
      $('.pregunta-8').css('border',''); 
      

      var respuesta1 = $('input:radio[name=preg1]:checked').val();
      var respuesta2 = $('input:radio[name=preg2]:checked').val();
      var respuesta3 = $('input:radio[name=preg3]:checked').val();
      var respuesta4 = $('input:radio[name=preg4]:checked').val();
      var respuesta5 = $('input:radio[name=preg5]:checked').val();
      var respuesta6 = $('input:radio[name=preg6]:checked').val();
      var respuesta7 = $('input:radio[name=preg7]:checked').val();
      var respuesta8 = $('input:radio[name=preg8]:checked').val();
      

      var Titulo1 = $("#Titulo-1").html();
      var Titulo2 = $("#Titulo-2").html();
      var Titulo3 = $("#Titulo-3").html();
      var Titulo4 = $("#Titulo-4").html();
      var Titulo5 = $("#Titulo-5").html();
      var Titulo6 = $("#Titulo-6").html();
      var Titulo7 = $("#Titulo-7").html();
      var Titulo8 = $("#Titulo-8").html();
      
      
      if (respuesta1 != undefined) {
      if (respuesta2 != undefined) {
      if (respuesta3 != undefined) {
      if (respuesta4 != undefined) {
      if (respuesta5 != undefined) {
      if (respuesta6 != undefined) {
      if (respuesta7 != undefined) {
      if (respuesta8 != undefined) {

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
      "respuesta5" : respuesta5,
      "Titulo6" : Titulo6,
      "respuesta6" : respuesta6,
      "Titulo7" : Titulo7,
      "respuesta7" : respuesta7,
      "Titulo8" : Titulo8,
      "respuesta8" : respuesta8
      };

      $.ajax({
      data:  parametros,
      url:   '../../public/cursos/evaluacion/tema2/modulo-4/evaluacion.php',
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

      }else{ $('.pregunta-8').css('border','2px solid #A52525'); }
      }else{ $('.pregunta-7').css('border','2px solid #A52525'); }
      }else{ $('.pregunta-6').css('border','2px solid #A52525'); }
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
  <div class="font-weight-bold title-pregunta" id="Titulo-1">1. Estas son algunas de las actividades que se deben de realizan antes de hacer cualquier trabajo de mantenimiento en cualquiera de las líneas de productos:</div>
  <div class="form-check">
  <input class="form-check-input" type="radio" name="preg1" id="Radio1Pregunta1" value="a,c,0">
  <label class="form-check-label" for="Radio1Pregunta1">
  a) 
  <br>• Acordonar y delimitar el área de trabajo y poner un recipiente por si existiera un posible derrame.<br>
      • Realizar el trabajo de mantenimiento<br>

  </label>
  </div>
  <div class="form-check">
  <input class="form-check-input" type="radio" name="preg1" id="Radio2Pregunta2" value="b,c,0">
  <label class="form-check-label" for="Radio2Pregunta2">
  b) <br>•  Apagar el interruptor de la línea de producto<br>
    • El personal autorizado debe de vestir lo adecuado para realizar trabajos de mantenimiento.<br>

  </label>
  </div>
  <div class="form-check disabled">
  <input class="form-check-input" type="radio" name="preg1" id="Radio3Pregunta3" value="c,c,1">
  <label class="form-check-label" for="Radio3Pregunta3">
  c) Todas la anteriores 
  </label>
  </div>   
  </div>
  <div class="padding-5 pregunta-2">
    <!-- --- Pregunta numero 2 --- -->
  <div class="font-weight-bold title-pregunta" id="Titulo-2">2.- ¿Cuáles son algunos elementos con los que debe contar el etiquetado del candado en líneas de producto?</div>
  <div class="form-check">
  <input class="form-check-input" type="radio" name="preg2" id="Radio4Pregunta4" value="a,a,1">
  <label class="form-check-label" for="Radio4Pregunta4">
  a) Foto del trabajador, nombre del trabajador y una leyenda que diga: Esta tarjeta se colocó por el término de la jornada de trabajo y el equipo se encuentra en buenas condiciones
  </label>
  </div>
  <div class="form-check">
  <input class="form-check-input" type="radio" name="preg2" id="Radio5Pregunta5" value="b,a,0">
  <label class="form-check-label" for="Radio5Pregunta5">
  b) Dirección del trabajador y una etiqueta de advertencia en color rojo
  </label>
  </div>
  <div class="form-check disabled">
  <input class="form-check-input" type="radio" name="preg2" id="Radio6Pregunta6" value="c,a,0">
  <label class="form-check-label" for="Radio6Pregunta6">
  c) Una leyenda que diga: Esta tarjeta se colocó por el término de la jornada de trabajo y el equipo se encuentra en buenas condiciones y un número telefónico

  </label>
  </div>  
  </div>
  <div class="padding-5 pregunta-3">
  <!-- --- Pregunta numero 3 --- -->
  <div class="font-weight-bold title-pregunta" id="Titulo-3">3.- ¿con que propiedades tiene que contar el bloqueo que evitara que las válvulas sean abiertas? </div>
  <div class="form-check">
  <input class="form-check-input" type="radio" name="preg3" id="Radio7Pregunta7" value="a,a,1">
  <label class="form-check-label" for="Radio7Pregunta7">
  a)  <br>• El bloqueo se debe ajustar correctamente<br>
• Evitar el movimiento<br>
• Debe de ser resistente <br>

  </label>
  </div>
  <div class="form-check">
  <input class="form-check-input" type="radio" name="preg3" id="Radio8Pregunta8" value="b,a,0">
  <label class="form-check-label" for="Radio8Pregunta8">
  b)  <br>• Ser de color amarillo<br>
• Tener membrete de la empresa <br>
• Ser abierto solo con llave 
<br>

  </label>
  </div>
  <div class="form-check disabled">
  <input class="form-check-input" type="radio" name="preg3" id="Radio9Pregunta9" value="c,a,0">
  <label class="form-check-label" for="Radio9Pregunta9">
  c) <br>•  Ser de marca reconocida y autorizado por el encargado de la estación <br>
• Tener una medida más amplia a la llave a cerrar <br>
• Ser de color rojo<br>

  </label>
  </div>  
  </div>
  <div class="padding-5 pregunta-4">
    <!-- --- Pregunta numero 4 --- -->
  <div class="font-weight-bold title-pregunta" id="Titulo-4">4.- ¿Cuáles son los pasos finales para el mantenimiento de las líneas con productos?</div>
  <div class="form-check">
  <input class="form-check-input" type="radio" name="preg4" id="Radio10Pregunta10" value="a,c,0">
  <label class="form-check-label" for="Radio10Pregunta10">
  a) <br>•  Comprobar que el trabajo fue un éxito, apuntar en la bitácora el término del trabajo<br>
• Retirar sellos y área acordonada <br>
  </label>
  </div>
  <div class="form-check">
  <input class="form-check-input" type="radio" name="preg4" id="Radio11Pregunta11" value="b,c,0">
  <label class="form-check-label" for="Radio11Pregunta11">
  b) <br>•  Una vez finalizado el trabajo, retirar la etiqueta, el candado y el equipo de bloqueo<br>

  </label>
  </div>
  <div class="form-check disabled">
  <input class="form-check-input" type="radio" name="preg4" id="Radio12Pregunta12" value="c,c,1">
  <label class="form-check-label" for="Radio12Pregunta12">
  c) <br>•  Una vez finalizado el trabajo, retirar la etiqueta, el candado y el equipo de bloqueo<br>
     • Comprobar que el trabajo fue un éxito, apuntar en la bitácora el término del trabajo<br>
  </label>
  </div> 
  </div>
  <div class="padding-5 pregunta-5">
  <!-- --- Pregunta numero 5 --- -->
  <div class="font-weight-bold title-pregunta" id="Titulo-5">5.- ¿A qué se refiere el etiquetado, bloqueo y candadeo para interrupción de líneas con producto?</div>
  <div class="form-check">
  <input class="form-check-input" type="radio" name="preg5" id="Radio13Pregunta13" value="a,b,0">
  <label class="form-check-label" for="Radio13Pregunta13">
  a)  A la cancelación de producto de manera definitivo.


  </label>
  </div>
  <div class="form-check">
  <input class="form-check-input" type="radio" name="preg5" id="Radio14Pregunta14" value="b,b,1">
  <label class="form-check-label" for="Radio14Pregunta14">
 b) Al conjunto de procedimientos para reducir el riesgo de accidentes durante el mantenimiento en las líneas de producto.
  </label>
  </div>
  <div class="form-check disabled">
  <input class="form-check-input" type="radio" name="preg5" id="Radio15Pregunta15" value="c,b,0">
  <label class="form-check-label" for="Radio15Pregunta15">
  c) Interrupción del funcionamiento de la estación de servicio.

  </label>
  </div> 
  </div>
  <!-- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - --  -- - - - - -   -->
  <div class="padding-5 pregunta-6">
  <!-- --- Pregunta numero 6 --- -->
  <div class="font-weight-bold title-pregunta" id="Titulo-6">6.- ¿Cuál es la vestimenta adecuada para que los trabajadores realicen el mantenimiento?</div>
  <div class="form-check">
  <input class="form-check-input" type="radio" name="preg6" id="Radio16Pregunta16" value="a,c,0">
  <label class="form-check-label" for="Radio16Pregunta16">
  a)  Cualquier tipo de vestimenta, siempre y cuando se sientan cómodos.

  </label>
  </div>
  <div class="form-check">
  <input class="form-check-input" type="radio" name="preg6" id="Radio17Pregunta17" value="b,c,0">
  <label class="form-check-label" for="Radio17Pregunta17">
 b) Guantes Botas.

  </label>
  </div>
  <div class="form-check disabled">
  <input class="form-check-input" type="radio" name="preg6" id="Radio18Pregunta18" value="c,c,1">
  <label class="form-check-label" for="Radio18Pregunta18">
  c) Guantes 
Gafas de seguridad 
Ropa 100% de algodón
Botas.

  </label>
  </div> 
  </div>

  <div class="padding-5 pregunta-7">
  <!-- --- Pregunta numero 7 --- -->
  <div class="font-weight-bold title-pregunta" id="Titulo-7">7.- Definición de bloqueo.</div>
  <div class="form-check">
  <input class="form-check-input" type="radio" name="preg7" id="Radio19Pregunta19" value="a,a,1">
  <label class="form-check-label" for="Radio19Pregunta19">
  a)  Es un mecanismo para evitar que las válvulas sean abiertas. Asegura que no se active.

  </label>
  </div>
  <div class="form-check">
  <input class="form-check-input" type="radio" name="preg7" id="Radio20Pregunta20" value="b,a,0">
  <label class="form-check-label" for="Radio20Pregunta20">
b) Método por el cual se cierra la llave para que no pase el producto.

  </label>
  </div>
  <div class="form-check disabled">
  <input class="form-check-input" type="radio" name="preg7" id="Radio21Pregunta21" value="c,a,0">
  <label class="form-check-label" for="Radio21Pregunta21">
  c) Mecanismo para interceptar el funcionamiento de las bombas de producto. 
  </label>
  </div> 
  </div>

    <div class="padding-5 pregunta-8">
  <!-- --- Pregunta numero 8 --- -->
  <div class="font-weight-bold title-pregunta" id="Titulo-8">8.- ¿Quién esta autorizado para remover la etiqueta colocada?</div>
  <div class="form-check">
  <input class="form-check-input" type="radio" name="preg8" id="Radio22Pregunta22" value="a,c,0">
  <label class="form-check-label" for="Radio22Pregunta22">
  a) Solo los despachadores.

  </label>
  </div>
  <div class="form-check">
  <input class="form-check-input" type="radio" name="preg8" id="Radio23Pregunta23" value="b,c,0">
  <label class="form-check-label" for="Radio23Pregunta23">
 b) Cualquier persona.

  </label>
  </div>
  <div class="form-check disabled">
  <input class="form-check-input" type="radio" name="preg8" id="Radio24Pregunta24" value="c,c,1">
  <label class="form-check-label" for="Radio24Pregunta24">
  c) El trabajador que la coloco, el cual aparece en los datos de la etiqueta.

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