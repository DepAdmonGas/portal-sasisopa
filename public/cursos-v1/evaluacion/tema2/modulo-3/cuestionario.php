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
      $('.pregunta-9').css('border',''); 
      

      var respuesta1 = $('input:radio[name=preg1]:checked').val();
      var respuesta2 = $('input:radio[name=preg2]:checked').val();
      var respuesta3 = $('input:radio[name=preg3]:checked').val();
      var respuesta4 = $('input:radio[name=preg4]:checked').val();
      var respuesta5 = $('input:radio[name=preg5]:checked').val();
      var respuesta6 = $('input:radio[name=preg6]:checked').val();
      var respuesta7 = $('input:radio[name=preg7]:checked').val();
      var respuesta8 = $('input:radio[name=preg8]:checked').val();
      var respuesta9 = $('input:radio[name=preg9]:checked').val();
      

      var Titulo1 = $("#Titulo-1").html();
      var Titulo2 = $("#Titulo-2").html();
      var Titulo3 = $("#Titulo-3").html();
      var Titulo4 = $("#Titulo-4").html();
      var Titulo5 = $("#Titulo-5").html();
      var Titulo6 = $("#Titulo-6").html();
      var Titulo7 = $("#Titulo-7").html();
      var Titulo8 = $("#Titulo-8").html();
      var Titulo9 = $("#Titulo-9").html();
      
      
      if (respuesta1 != undefined) {
      if (respuesta2 != undefined) {
      if (respuesta3 != undefined) {
      if (respuesta4 != undefined) {
      if (respuesta5 != undefined) {
      if (respuesta6 != undefined) {
      if (respuesta7 != undefined) {
      if (respuesta8 != undefined) {
      if (respuesta9 != undefined) {

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
      "respuesta8" : respuesta8,
      "Titulo9" : Titulo9,
      "respuesta9" : respuesta9
      };

      $.ajax({
      data:  parametros,
      url:   '../../public/cursos/evaluacion/tema2/modulo-3/evaluacion.php',
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


      }else{ $('.pregunta-9').css('border','2px solid #A52525'); }
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
  <div class="font-weight-bold title-pregunta" id="Titulo-1">1.- ¿Qué es el etiquetado, bloqueo y candadeo para interrupción de líneas eléctricas?</div>
  <div class="form-check">
  <input class="form-check-input" type="radio" name="preg1" id="Radio1Pregunta1" value="a,a,1">
  <label class="form-check-label" for="Radio1Pregunta1">
  a) Conjunto de procedimientos de seguridad para reducir el riesgo de posibles lesiones durante el mantenimiento en líneas eléctricas.
  </label>
  </div>
  <div class="form-check">
  <input class="form-check-input" type="radio" name="preg1" id="Radio2Pregunta2" value="b,a,0">
  <label class="form-check-label" for="Radio2Pregunta2">
  b) Pasos para cerrar la estación de servicio.
  </label>
  </div>
  <div class="form-check disabled">
  <input class="form-check-input" type="radio" name="preg1" id="Radio3Pregunta3" value="c,a,0">
  <label class="form-check-label" for="Radio3Pregunta3">
  c) Procedimiento para cortar la energía eléctrica de toda la estación de servicio.
  </label>
  </div>   
  </div>
  <div class="padding-5 pregunta-2">
    <!-- --- Pregunta numero 2 --- -->
  <div class="font-weight-bold title-pregunta" id="Titulo-2">2.- ¿Qué se trata de evitar con el etiquetado, bloqueo y candadeo durante el mantenimiento?</div>
  <div class="form-check">
  <input class="form-check-input" type="radio" name="preg2" id="Radio4Pregunta4" value="a,c,0">
  <label class="form-check-label" for="Radio4Pregunta4">
  a) Cerrar definitivamente la estación de servicio.
  </label>
  </div>
  <div class="form-check">
  <input class="form-check-input" type="radio" name="preg2" id="Radio5Pregunta5" value="b,c,0">
  <label class="form-check-label" for="Radio5Pregunta5">
  b) Energización del sistema eléctrico.
  </label>
  </div>
  <div class="form-check disabled">
  <input class="form-check-input" type="radio" name="preg2" id="Radio6Pregunta6" value="c,c,1">
  <label class="form-check-label" for="Radio6Pregunta6">
  c) Activación accidental de la maquinaria.
Energización del sistema eléctrico.

  </label>
  </div>  
  </div>
  <div class="padding-5 pregunta-3">
  <!-- --- Pregunta numero 3 --- -->
  <div class="font-weight-bold title-pregunta" id="Titulo-3">3.- ¿Qué procedimientos de seguridad se deben de contemplar para las instalaciones?</div>
  <div class="form-check">
  <input class="form-check-input" type="radio" name="preg3" id="Radio7Pregunta7" value="a,a,1">
  <label class="form-check-label" for="Radio7Pregunta7">
  a)  <br>• La indicación <br>
• Utilizar el equipo de medición<br>
• Colocar señalización<br>
• Seguir las instrucciones para verificar que la puesta a tierra <br>
• Seguir las instrucciones para realizar una inspección en todo el circuito o red en el que se efectuaron los mantenimientos<br>

  </label>
  </div>
  <div class="form-check">
  <input class="form-check-input" type="radio" name="preg3" id="Radio8Pregunta8" value="b,a,0">
  <label class="form-check-label" for="Radio8Pregunta8">
  b)  <br>• La indicación <br>
• Poner el candado <br>
Guardar la llave<br>

  </label>
  </div>
  <div class="form-check disabled">
  <input class="form-check-input" type="radio" name="preg3" id="Radio9Pregunta9" value="c,a,0">
  <label class="form-check-label" for="Radio9Pregunta9">
  c) <br>•  La indicación<br>
• Utilizar el equipo de medición<br>
• Colocar señalización<br>
• Hacer pausas continuamente para reanudar actividad y así verificar que se esté llevando de manera adecuada el procedimiento.<br>

  </label>
  </div>  
  </div>
  <div class="padding-5 pregunta-4">
    <!-- --- Pregunta numero 4 --- -->
  <div class="font-weight-bold title-pregunta" id="Titulo-4">4.- Para el mantenimiento de las instalaciones eléctricas, ¿Con que deben de contar?</div>
  <div class="form-check">
  <input class="form-check-input" type="radio" name="preg4" id="Radio10Pregunta10" value="a,a,1">
  <label class="form-check-label" for="Radio10Pregunta10">
  a) <br>•  El diagrama unifilar y al menos el cuadro general de cargas correspondientes a la zona donde se realizará el mantenimiento.<br>
• Las indicaciones para conseguir las autorizaciones por escrito que correspondan, donde se describa al menos la actividad a realizar.<br>
• Las instrucciones concretas sobre el trabajo a realizar.<br>


  </label>
  </div>
  <div class="form-check">
  <input class="form-check-input" type="radio" name="preg4" id="Radio11Pregunta11" value="b,a,0">
  <label class="form-check-label" for="Radio11Pregunta11">
  b) <br>•  El diagrama unifilar y al menos el cuadro general de cargas correspondientes a la zona donde se realizará el mantenimiento.<br>
• Guantes 
Saber dónde se realizará el trabajo<br>


  </label>
  </div>
  <div class="form-check disabled">
  <input class="form-check-input" type="radio" name="preg4" id="Radio12Pregunta12" value="c,a,0">
  <label class="form-check-label" for="Radio12Pregunta12">
  c) <br>• Uniformes. <br>
• Las indicaciones para conseguir las autorizaciones por escrito que correspondan, donde se describa al menos la actividad a realizar.<br>


  </label>
  </div> 
  </div>
  <div class="padding-5 pregunta-5">
  <!-- --- Pregunta numero 5 --- -->
  <div class="font-weight-bold title-pregunta" id="Titulo-5">5.- Las herramientas, equipos, materiales de protección aislante y equipo de protección personal deberán</div>
  <div class="form-check">
  <input class="form-check-input" type="radio" name="preg5" id="Radio13Pregunta13" value="a,c,0">
  <label class="form-check-label" for="Radio13Pregunta13">
  a)
<br>• Ser entregados al trabajador <br>
• Ser nuevos <br>
• Manipularse para realizar el mantenimiento <br>


  </label>
  </div>
  <div class="form-check">
  <input class="form-check-input" type="radio" name="preg5" id="Radio14Pregunta14" value="b,c,0">
  <label class="form-check-label" for="Radio14Pregunta14">
 b)
<br>• Ser entregados al trabajador <br>
• Contar con instrucciones <br>
• Ser de la talla del trabajador<br>
Ser de marca reconocida para la operación a realizar.
<br>
  </label>
  </div>
  <div class="form-check disabled">
  <input class="form-check-input" type="radio" name="preg5" id="Radio15Pregunta15" value="c,c,1">
  <label class="form-check-label" for="Radio15Pregunta15">
  c) 
<br>• Ser entregados al trabajador <br>
• Contar con instrucciones <br>
• Ser de acuerdo a los voltajes de operación <br>
• Manipularse para realizar el mantenimiento <br>

  </label>
  </div> 
  </div>
  <!-- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - --  -- - - - - -   -->
  <div class="padding-5 pregunta-6">
  <!-- --- Pregunta numero 6 --- -->
  <div class="font-weight-bold title-pregunta" id="Titulo-6">6.- ¿Cuál es la definición de Bloqueo:</div>
  <div class="form-check">
  <input class="form-check-input" type="radio" name="preg6" id="Radio16Pregunta16" value="a,c,0">
  <label class="form-check-label" for="Radio16Pregunta16">
  a)  Cortar las comunicaciones entre dos partes, detener el funcionamiento normal de algún aparato.

  </label>
  </div>
  <div class="form-check">
  <input class="form-check-input" type="radio" name="preg6" id="Radio17Pregunta17" value="b,c,0">
  <label class="form-check-label" for="Radio17Pregunta17">
 b) Impedir el funcionamiento normal de algo.

  </label>
  </div>
  <div class="form-check disabled">
  <input class="form-check-input" type="radio" name="preg6" id="Radio18Pregunta18" value="c,c,1">
  <label class="form-check-label" for="Radio18Pregunta18">
  c) Es un mecanismo para evitar que sea activado un equipo, maquinaria. Asegura que no se active. 
  </label>
  </div> 
  </div>

  <div class="padding-5 pregunta-7">
  <!-- --- Pregunta numero 7 --- -->
  <div class="font-weight-bold title-pregunta" id="Titulo-7">7.- ¿Cuáles son algunos de los elementos de etiquetado para candado de las líneas eléctricas bloqueadas?</div>
  <div class="form-check">
  <input class="form-check-input" type="radio" name="preg7" id="Radio19Pregunta19" value="a,c,1">
  <label class="form-check-label" for="Radio19Pregunta19">
  a)  <br>• Foto del trabajador<br>
• Nombre del trabajador<br>
• La leyenda: Esta tarjeta se colocó por el término de la jornada de trabajo y el equipo se encuentra en buenas condiciones<br>

  </label>
  </div>
  <div class="form-check">
  <input class="form-check-input" type="radio" name="preg7" id="Radio20Pregunta20" value="b,c,0">
  <label class="form-check-label" for="Radio20Pregunta20">
b) <br>•  Foto del trabajador<br>
• ID del trabajador<br>
• Tipo de sangre<br>
• Nombre del trabajador<br>
La leyenda: Esta tarjeta se colocó por el término de la jornada de trabajo y el equipo se encuentra en buenas condiciones<br>

  </label>
  </div>
  <div class="form-check disabled">
  <input class="form-check-input" type="radio" name="preg7" id="Radio21Pregunta21" value="c,c,0">
  <label class="form-check-label" for="Radio21Pregunta21">
  c) <br>•  Foto del trabajador<br>
• Dirección del domicilio del trabajador<br>
• Número de teléfono <br>
• Puesto<br>
• Nombre del trabajador
La leyenda: Esta tarjeta se colocó por el término de la jornada de trabajo y el equipo se encuentra en buenas condiciones<br>

  </label>
  </div> 
  </div>

    <div class="padding-5 pregunta-8">
  <!-- --- Pregunta numero 8 --- -->
  <div class="font-weight-bold title-pregunta" id="Titulo-8">8.- ¿Cuáles son algunas de las recomendaciones para realizar trabajos en líneas eléctricas? </div>
  <div class="form-check">
  <input class="form-check-input" type="radio" name="preg8" id="Radio22Pregunta22" value="a,b,0">
  <label class="form-check-label" for="Radio22Pregunta22">
  a)  Avisarle al gerente de la estación
Limpiar el área de trabajo
Liberar energía del equipo.

  </label>
  </div>
  <div class="form-check">
  <input class="form-check-input" type="radio" name="preg8" id="Radio23Pregunta23" value="b,b,1">
  <label class="form-check-label" for="Radio23Pregunta23">
 b) Programar el trabajo de mantenimiento
Contar con la autorización del Gerente de la estación
Detectar energías eléctricas a bloquear
Bloquear swich
Liberar energía del equipo.

  </label>
  </div>
  <div class="form-check disabled">
  <input class="form-check-input" type="radio" name="preg8" id="Radio24Pregunta24" value="c,b,0">
  <label class="form-check-label" for="Radio24Pregunta24">
  c) Cerrar la estación de servicio
Darle aviso al gerente de la estación
Bloquear swich. 

  </label>
  </div> 
  </div>

    <div class="padding-5 pregunta-9">
  <!-- --- Pregunta numero 9 --- -->
  <div class="font-weight-bold title-pregunta" id="Titulo-9">9.- ¿Qué recomendaciones se hacen una vez que se terminan los trabajos de mantenimiento?</div>
  <div class="form-check">
  <input class="form-check-input" type="radio" name="preg9" id="Radio25Pregunta25" value="a,c,0">
  <label class="form-check-label" for="Radio25Pregunta25">
  a)  No dejar objetos personales en el área de trabajo
Encender las líneas eléctricas
Avisarle al gerente de la estación el termino de trabajos.


  </label>
  </div>
  <div class="form-check">
  <input class="form-check-input" type="radio" name="preg9" id="Radio26Pregunta26" value="b,c,0">
  <label class="form-check-label" for="Radio26Pregunta26">
 b) Limpiar el área de trabajo
Brindar servicio en la estación de servicio.


  </label>
  </div>
  <div class="form-check disabled">
  <input class="form-check-input" type="radio" name="preg9" id="Radio27Pregunta27" value="c,c,1">
  <label class="form-check-label" for="Radio27Pregunta27">
  c) Revisar a detalle que todo este en orden y limpio
Retirar etiqueta, bloqueo y candadeo
Comprobar que el trabajo fue un éxito
Apuntar en la bitácora el termino de trabajo.


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