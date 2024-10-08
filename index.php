<?php

include_once "app/controlador/IndexControlador.php";
$index_controlador = new IndexControlador();

$componentes_url = parse_url($_SERVER["REQUEST_URI"]);
$rura = $componentes_url['path'];

$partes_ruta = explode("/", $rura);
$partes_ruta = array_filter($partes_ruta);
$partes_ruta = array_slice($partes_ruta, 0);

$ruta_elegida = 'public/error/404.php';

if ($partes_ruta[0] == 'portal-sasisopa') 
{
if (count($partes_ruta) == 1)
{
$ruta_elegida = $index_controlador->homeGerente();
}else if(count($partes_ruta) == 2)
{
switch ($partes_ruta[1])
{

    //-------- ELEMENTOS SASISOPA INICIO -----------------
    //----------------------------------------------------
    case '1-politica':
      $ruta_elegida = $index_controlador->politicaRuta();
    break;
    case '2-analisis-riesgo-evaluacion-impactos-ambientales':
      $ruta_elegida = $index_controlador->analisisRiesgoEvaluacionImpactosAmbientales();
    break;
    case 'descargar-formato-2':
      $ruta_elegida = $index_controlador->descargarFormato2();
    break;
    case 'descargar-formato-3':
      $ruta_elegida = $index_controlador->descargarFormato3();
    break;
    case '3-requisitos-legales':
      $ruta_elegida = $index_controlador->requisitosLegales();
    break;
    case '3-requisitos-legales-configuracion':
      $ruta_elegida = $index_controlador->requisitosLegalesConfiguracion();
    break;
    case 'descargar-requisitos-legales':
      $ruta_elegida = $index_controlador->descargarRequisitosLegales();
    break;
    case '4-objetivos-metas-indicadores':
      $ruta_elegida = $index_controlador->objetivosMetasIndicadores();
    break;
    case '5-funciones-responsabilidades-autoridad':
      $ruta_elegida = $index_controlador->funcionesResponsabilidadesAutoridad();
    break;
    case '6-competencia-personal-capacitacion-entrenamiento':
      $ruta_elegida = $index_controlador->competenciaPersonalCapacitacionEntrenamiento();
    break;
    case 'perfiles-puestos-trabajo':
      $ruta_elegida = $index_controlador->perfilesPuestoTrabajo();
    break;
    case 'perfiles-personal':
      $ruta_elegida = $index_controlador->perfilesPersonal();
    break;
    case 'descargar-ficha-personal-reporte':
      $ruta_elegida = $index_controlador->descargarFichaPersonalReporte();
    break;
    case 'capacitacion-interna':
      $ruta_elegida = $index_controlador->capacitacionInterna();
    break;
    case 'capacitacion-externa':
      $ruta_elegida = $index_controlador->capacitacionExterna();
    break;
    case '7-comunicacion-participacion-consulta':
    $ruta_elegida = $index_controlador->comunicacionParticipacionConsulta();
    break;
    case '8-control-documentos-registros':
    $ruta_elegida = $index_controlador->controlDocumentosRegistros();
    break;
    case 'control-documentos-rl':
    $ruta_elegida = $index_controlador->controlDocumentosRL();
    break;
    case 'descargar-control-documentos-rl':
    $ruta_elegida = $index_controlador->descargarControlDocumentosRL();
    break;
    case 'control-documentos-sa':
    $ruta_elegida = $index_controlador->controlDocumentosSA();
    break;
    case 'descargar-control-documentos-sa':
    $ruta_elegida = $index_controlador->descargarControlDocumentosSA();
    break;
    case '9-mejores-practicas-estandares':
    $ruta_elegida = $index_controlador->mejoresPracticasEstandares();
    break;
    case 'descargar-diseno-construccion':
    $ruta_elegida = $index_controlador->descargarDisenoConstruccion();
    break;
    case 'descargar-operacion-mantenimiento':
    $ruta_elegida = $index_controlador->descargarOperacionMantenimiento();
    break;
    case '10-control-actividades-procesos':
    $ruta_elegida = $index_controlador->controlActividadesProcesos();
    break;
    case 'programa-anual-mantenimiento':
    $ruta_elegida = $index_controlador->programaAnualMantenimiento();
    break;
    case 'configuracion-bitacora':
    $ruta_elegida = $index_controlador->configuracionBitacora();
    break;
    case 'recepcion-descargar-producto':
    $ruta_elegida = $index_controlador->recepcionDescargarProducto();
    break;
    case 'mantenimiento-preventivo-correctivo':
      $ruta_elegida = $index_controlador->mantenimientoPreventivoCorrectivo();
    break;
    case 'configuracion-extintores':
      $ruta_elegida = $index_controlador->configuracionExtintores();
    break;
    case 'configuracion-detector-humo':
      $ruta_elegida = $index_controlador->configuracionDetectorHumo();
    break;
    case 'mantenimiento-correctivo':
      $ruta_elegida = $index_controlador->mantenimientoCorrectivo();
    break;
    case 'reporte-mantenimiento-correctivo':
      $ruta_elegida = $index_controlador->reporteMantenimientoCorrectivo();
    break;
    case 'calibracion-equipos':
      $ruta_elegida = $index_controlador->calibracionEquipos();
    break;
    case 'configuracion-tanques':
      $ruta_elegida = $index_controlador->configuracionTanques();
    break;
    case 'configuracion-dispensario':
      $ruta_elegida = $index_controlador->configuracionDispensario();
    break;
    case 'configuracion-sondas-medicion':
      $ruta_elegida = $index_controlador->configuracionSondasMedicion();
    break;
    case 'configuracion-jarra-patron':
      $ruta_elegida = $index_controlador->configuracionJarraPatron();
    break;
    case 'bitacora-calibracion-equipos':
      $ruta_elegida = $index_controlador->bitacoraCalibracionEquipos();
    break;
    case 'bitacora-profeco':
      $ruta_elegida = $index_controlador->bitacoraProfeco();
    break;
    case 'bitacora-dispensario':
      $ruta_elegida = $index_controlador->bitacoraDispensario();
    break;
    case 'bitacora-mantenimiento':
      $ruta_elegida = $index_controlador->bitacoraMantenimiento();
    break;
    case 'bitacora-mantenimiento-quincenal':
      $ruta_elegida = $index_controlador->bitacoraMantenimientoQuincenal();
      break;
    case '11-integridad-mecanica-aseguramiento':
      $ruta_elegida = $index_controlador->integridadMecanicaAseguramiento();
    break;
    case 'bitacoras-caracteristicas':
      $ruta_elegida = $index_controlador->bitacorasCaracteristicas();
    break;
    case 'equipos-criticos':
      $ruta_elegida = $index_controlador->descargarEquipoCritico();
    break;
    case '12-seguridad-contratistas':
      $ruta_elegida = $index_controlador->seguridadContratistas();
    break;
    case '13-preparacion-emergencias':
      $ruta_elegida = $index_controlador->preparacionEmergencias();
    break;
    case '14-monitoreo-verificacion-evaluacion':
      $ruta_elegida = $index_controlador->monitoreoVerificacionEvaluacion();
    break;
    case 'descargar-programa-implementacion-s-a':
      $ruta_elegida = $index_controlador->descargarProgramaImplementacionSA();
    break;
    case 'calibracion-verificacion-mantenimiento-equipos':
      $ruta_elegida = $index_controlador->calibracionVerificacionMantenimientoEquipos();
    break;
    case 'descargar-equipos-sometidos-calibracion':
      $ruta_elegida = $index_controlador->descargarEquipoSometidosCalibracion();
    break;
    case 'descargar-calendario-calibracion':
      $ruta_elegida = $index_controlador->descargarCalendarioCalibracion();
    break;
    case 'evaluacion-cumplimiento-requisitos-legales':
      $ruta_elegida = $index_controlador->evaluacionCumplimientoRequisitosLegales();
    break;
    case 'descargar-evaluacion-cumplimiento-legal':
      $ruta_elegida = $index_controlador->descargarEvaluacionCumplimiento();
    break;
    case 'atencion-hallazgos':
      $ruta_elegida = $index_controlador->atencionHallazgos();
    break;
    case '15-auditorias':
      $ruta_elegida = $index_controlador->auditoria();
    break;
    case 'programa-auditorias-internas-externas':
      $ruta_elegida = $index_controlador->programaAuditoriaInternaExterna();
    break;
    case 'auditoria-interna':
      $ruta_elegida = $index_controlador->auditoriaInterna();
    break;
    case 'auditoria-externa':
      $ruta_elegida = $index_controlador->auditoriaExterna();
    break;
    case '16-investigacion-incidentes-accidentes':
      $ruta_elegida = $index_controlador->investigacionIncidentesAccidentes();
    break;
    case 'descargar-investigacion-incidentes-accidentes':
      $ruta_elegida = $index_controlador->descargarIncidentesAccidentes();
    break;
    case '17-revision-resultados':
      $ruta_elegida = $index_controlador->revisionResultados();
    break;
    case '18-informes-desempeno':
      $ruta_elegida = $index_controlador->informeDesempeno();
    break;
    //-------- ELEMENTOS SASISOPA FIN -------------------
    //---------------------------------------------------

    //---------------------------------------------------
    //------------ NOM 035 ------------------------------
    case 'nom-035-etapas':
      $ruta_elegida = $index_controlador->nom035Etapas();
    break;
    case 'nom-035-politica':
      $ruta_elegida = $index_controlador->nom035Politica();
    break;
    case 'nom-035-acontecimientos':
      $ruta_elegida = $index_controlador->nom035Acontecimientos();
    break;
    case 'nom-035-factores-riesgo':
      $ruta_elegida = $index_controlador->nom035FactoresRiesgo();
    break;
    //---------------------------------------------------
    //---------------------------------------------------

    //-----------------------SGM-------------------------
    case 'sgm':
      $ruta_elegida = $index_controlador->sgmIndex();
    break;
    case 'estructura-sistema-medicion':
      $ruta_elegida = $index_controlador->estructuraSistemaMedicion();
    break;
    case 'control-documental-sistema-gestion-medicion':
      $ruta_elegida = $index_controlador->controlDocumentalSistemaGestionMedicion();
    break;
    case 'descargar-control-documental-sgm':
      $ruta_elegida = $index_controlador->descargarControlDocumentalSgm();
    break;
    case 'responsabilidades-direccion':
      $ruta_elegida = $index_controlador->responsabilidadesDireccion();
    break;
    case 'editar-politica-sgm':
      $ruta_elegida = $index_controlador->editarPoliticaSgm();
    break;
    case 'establecimiento-objetivos-enfocados-cliente':
      $ruta_elegida = $index_controlador->establecimientoObjetivosEnfocadosCliente();
    break;
    case 'normatividad-aplicable-mediciones':
      $ruta_elegida = $index_controlador->normatividadAplicableMediciones();
    break;
    case 'requisitos-legales-sgm':
      $ruta_elegida = $index_controlador->requisitosLegalesSgm();
    break;
    case 'descargar-inventario-normatividad-aplicable':
      $ruta_elegida = $index_controlador->descargarInventarioNormatividadAplicable();
    break;
    case 'descargar-requisitos-legal-sgm':
      $ruta_elegida = $index_controlador->descargarRequisitosLegalSgm();
    break;
    case 'gestion-recursos':
      $ruta_elegida = $index_controlador->gestionRecursos();
    break;
    case 'lista-personal-sgm':
      $ruta_elegida = $index_controlador->listaPersonalSgm();
    break;
    case 'descargar-lista-personal-sgm':
      $ruta_elegida = $index_controlador->descargarListaPersonalSgm();
    break;
    case 'inventario-equipo-sgm':
      $ruta_elegida = $index_controlador->inventarioEquipoSgm();
    break;
    case 'descargar-inventario-equipo-sgm':
      $ruta_elegida = $index_controlador->descargarInventarioEquipoSgm();
    break;
    case 'evaluacion-proveedor-servicio-sgm':
      $ruta_elegida = $index_controlador->evaluacionProveedorServicioSgm();
    break;
    case 'capacitacion-interna-sgm':
      $ruta_elegida = $index_controlador->capacitacionInternaSgm();
    break;
    case 'descargar-programa-anual-capacitacion-interna-sgm':
      $ruta_elegida = $index_controlador->descargarProgramaAnualCapacitacionInternaSgm();
    break;
    case 'capacitacion-externa-sgm':
      $ruta_elegida = $index_controlador->capacitacionExternaSgm();
    break;
    case 'descargar-programa-anual-capacitacion-externa-sgm':
      $ruta_elegida = $index_controlador->descargarProgramaAnualCapacitacionExternaSgm();
    break;
    case 'capacitacion-induccion-sgm':
      $ruta_elegida = $index_controlador->capacitacionInduccionSgm();
    break;
    case 'descargar-capacitacion-induccion-sgm':
      $ruta_elegida = $index_controlador->descargarCapacitacionInduccionSgm();
    break;
    case 'procesos-medicion':
      $ruta_elegida = $index_controlador->procesosMedicion();
    break;
    case 'programa-anual-calibracion-patrones-instrumentos-medida':
      $ruta_elegida = $index_controlador->programaAnualCalibracionPatronesInstrumentosMedida();
    break;
    case 'bitacora-calibracion-equipos-sgm':
      $ruta_elegida = $index_controlador->bitacoraCalibracionEquiposSgm();
    break;
    case 'programa-anual-verificacion-equipos':
      $ruta_elegida = $index_controlador->programaAnualVerificacionEquipos();
    break;
    case 'bitacora-verificacion-equipo-medicion-sgm':
      $ruta_elegida = $index_controlador->bitacoraVerificacionEquipoMedicionSgm();
    break;
    case 'gestion-riesgos-impactan-medicion':
      $ruta_elegida = $index_controlador->gestionRiesgosImpactanMedicion();
    break;
    case 'establecimiento-seguimiento-confirmacion-metrologica':
      $ruta_elegida = $index_controlador->establecimientoSeguimientoConfirmacionMetrologica();
    break;
    case 'auditorias-internas-externas-atencion-hallazgos':
      $ruta_elegida = $index_controlador->auditoriasInternasExternasAtencionHallazgos();
    break;
    case 'evaluacion-cumplimiento-objetivos-revision-direccion':
      $ruta_elegida = $index_controlador->evaluacionCumplimientoObjetivosRevisionDireccion();
    break;
    
    //---------------------------------------------------
    //---------------------------------------------------
    
case 'perfil':
$ruta_elegida = 'public/perfil/perfil-index.php';
break;	 
case 'personal':
$ruta_elegida = 'public/gerente/personal-index.php';
break;     
case 'reporte-diario':
$ruta_elegida = 'public/gerente/reporte-diario-index.php';
break;
//----------------------------------
//---- Version nueva cursos --------
case 'cursos':
$ruta_elegida = 'public/cursos/cursos-index.php';
break;
//----------------------------------
//----------------------------------
case 'administrador-sasisopa':
$ruta_elegida = 'public/administrador/index.php';
break;
case 'administrador-noticias':
$ruta_elegida = 'public/administrador/noticias-index.php';
break;
case 'gestoria-requisitos-legales':
$ruta_elegida = 'public/administrador/gestoria-requisitos-legales-index.php';
break;
case 'gestoria-permisos':
$ruta_elegida = 'public/administrador/gestoria-permisos-index.php';
break;
case 'gestoria-firma-apoderado':
$ruta_elegida = 'public/administrador/gestoria-firma-apoderado-index.php';
break;
case 'gestoria-entregas':
$ruta_elegida = 'public/administrador/gestoria-entregas-index.php';
break;
case 'programa-implementacion':
$ruta_elegida = 'public/gerente/programa-implementacion-index.php';
break;
case 'comunicados':
$ruta_elegida = 'public/gerente/comunicados-index.php';
break;
//--------------------Puntos Sasisopa ----------
case 'reporte-bitacora-recepcion-descargar-producto':
$ruta_elegida = 'public/sasisopa/reporte-bitacora-recepcion-descargar-producto-index.php';
break;
//-----------------------------------------------------------------
case 'bitacora-mantenimiento-pendiente':
$ruta_elegida = 'public/sasisopa/bitacora-mantenimiento-pendiente-index.php';
break;
case 'bitacora-mantenimiento-preventivo':
$ruta_elegida = 'public/sasisopa/bitacora-mantenimiento-preventivo-index.php';
break;
case 'bitacora-mantenimiento-correctivo':
$ruta_elegida = 'public/sasisopa/bitacora-mantenimiento-correctivo-index.php';
break;
case 'bitacora-mantenimiento-predictivo':
$ruta_elegida = 'public/sasisopa/bitacora-mantenimiento-predictivo-index.php';
break;
case 'bitacora-recepcion-descargar-producto':
$ruta_elegida = 'public/sasisopa/bitacora-recepcion-descargar-producto-index.php';
break;
//-----------------------------------------------------------------


case 'cambio-precio':
$ruta_elegida = 'public/gerente/cambio-precio-index.php';
break;
case 'apertura-dispensario':
$ruta_elegida = 'public/administrador/apertura-dispensario-index.php';
break;
//----- CERRAR SESION DEL USUARIO -----//
case 'salir':
$ruta_elegida = 'app/modelo/acceso/logout-usuarios.php';
break;
}

}else if(count($partes_ruta) == 3){
  
    //--------------------------------------------
    //--------- SASISOPA POLITICA-----------------
    if ($partes_ruta[1] == 'descargar-politica') {
      $GET_idEstacion = $partes_ruta[2];
      $ruta_elegida = $index_controlador->descargarPolitica();
    }
    else if ($partes_ruta[1] == 'descargar-lista-comprobacion') {
      $GET_idRegistro = $partes_ruta[2];
      $ruta_elegida = $index_controlador->descargarListaComprobacion();
    }
    else if ($partes_ruta[1] == '3-requisitos-legales') {
      $NGobierno = $partes_ruta[2];
      $ruta_elegida = $index_controlador->detalleRequisitosLegales();
    }
    else if ($partes_ruta[2] == 'capacitacion-personal'){
      $ruta_elegida = $index_controlador->capacitacionPersonal();
    }
    else if ($partes_ruta[2] == 'experiencia-cliente'){
      $ruta_elegida = $index_controlador->experienciaCliente();
    }
    else if ($partes_ruta[2] == 'agregar-experiencia-cliente'){
      $ruta_elegida = $index_controlador->agregarExperienciaCliente();
    }
    else if ($partes_ruta[2] == 'indicador-ventas'){
      $ruta_elegida = $index_controlador->indicadorVentas();
    }
    else if ($partes_ruta[1] == 'descargar-ficha-personal') {
      $GET_idUsuario = $partes_ruta[2];
      $ruta_elegida = $index_controlador->descargarFichaPersonal();
    }
    else if ($partes_ruta[1] == 'ficha-personal') {
      $GET_idUsuario = $partes_ruta[2];
      $ruta_elegida = $index_controlador->fichaPersonal();
    }
    else  if ($partes_ruta[1] == 'capacitacion-interna-modulos') {
      $idModulo = $partes_ruta[2];
      $ruta_elegida = $index_controlador->capacitacionInternaModulos();
    }
    else if ($partes_ruta[1] == 'descargar-capacitacion-externa') {
      $GET_idRegistro = $partes_ruta[2];
      $ruta_elegida = $index_controlador->descargarCapacitacionExterna();
    }
    else if ($partes_ruta[1] == 'descargar-quejas-sugerencias') {
    $GET_idRegistro = $partes_ruta[2];
    $ruta_elegida = $index_controlador->descargarQuejaSugerencia();
    }
    else if ($partes_ruta[1] == 'programa-anual-mantenimiento'){
    $idReporte = $partes_ruta[2];
    $ruta_elegida = $index_controlador->agregarProgramaAnual();
    }
    else if ($partes_ruta[1] == 'descargar-programa-anual-mantenimiento') {
    $GET_idRegistro = $partes_ruta[2];
    $ruta_elegida = $index_controlador->descargarProgramaAnualMantenimiento();
    }
    else if ($partes_ruta[1] == 'bitacora-calibracion-equipos-jarra-patron') {
      $GET_ID = $partes_ruta[2];
      $ruta_elegida = $index_controlador->bitacoraCalibracionEquipoJarraPatron();
    }
    else if ($partes_ruta[1] == 'bitacora-calibracion-equipos-dispensario') {
      $GET_ID = $partes_ruta[2];
      $ruta_elegida = $index_controlador->bitacoraCalibracionEquipoDispensario();
    }
    else if ($partes_ruta[1] == 'bitacora-calibracion-equipos-sonda') {
      $GET_ID = $partes_ruta[2];
      $ruta_elegida = $index_controlador->bitacoraCalibracionEquipoSonda();
    }
    else if ($partes_ruta[1] == 'bitacora-calibracion-equipos-tanques-almacenamiento') {
      $GET_ID = $partes_ruta[2];
      $ruta_elegida = $index_controlador->bitacoraCalibracionEquipoTanque();
    }
    else if ($partes_ruta[1] == 'descargar-bitacora-calibracion-equipos') {
      $GET_YEAR = $partes_ruta[2];
      $ruta_elegida = $index_controlador->descargarBitacoraCalibracionEquipo();
    }
    else if ($partes_ruta[1] == 'descargar-carta-responsiva') {
      $GET_ID = $partes_ruta[2];
      $ruta_elegida = $index_controlador->descargarCartaResponsiva();
    }
    else if ($partes_ruta[1] == 'descargar-lista-verificacion') {
      $GET_ID = $partes_ruta[2];
      $ruta_elegida = $index_controlador->descargarListaVerificacion();
    }
    else if ($partes_ruta[1] == 'descargar-autorizacion-trabajos-peligrosos') {
      $GET_ID = $partes_ruta[2];
      $ruta_elegida = $index_controlador->descargarAutorizacionTrabajosPeligrosos();
    }
    else if ($partes_ruta[1] == 'descargar-seguridad-contratistas') {
      $GET_idRegistro = $partes_ruta[2];
      $ruta_elegida = $index_controlador->descargarSeguridadContratista();
    }
    else if ($partes_ruta[1] == 'descargar-simulacros') {
      $GET_Year = $partes_ruta[2];
      $ruta_elegida = $index_controlador->descargarSimulacros();
    }
    else if ($partes_ruta[2] == 'implementacion-sa') {
      $ruta_elegida = $index_controlador->implementacionSA();
    }
    else if ($partes_ruta[2] == 'ventas-mes') {
      $ruta_elegida = $index_controlador->ventasMes();
    }
    else if ($partes_ruta[1] == 'descargar-revision-resultados-detalle') {
      $GET_Year = $partes_ruta[2];
      $ruta_elegida = $index_controlador->descargarRevisionResultadoDetalle();
    }
    else if ($partes_ruta[1] == 'atencion-hallazgos') {
      $GET_ID = $partes_ruta[2];
      $ruta_elegida = $index_controlador->atencionHallazgosEditar();
    }
    else if ($partes_ruta[1] == 'descargar-atencion-hallazgos') {
      $GET_ID = $partes_ruta[2];
      $ruta_elegida = $index_controlador->descargarAtencionHallazgos();
    }
    else if ($partes_ruta[1] == 'descargar-investigacion-sin-incidentes-accidentes') {
      $GET_ID = $partes_ruta[2];
      $ruta_elegida = $index_controlador->descargarSinIncidentesAccidentes();
    }
    else if ($partes_ruta[1] == 'descargar-registro-atencio-seguimiento-comunicacion-interna-externa') {
      $GET_ID = $partes_ruta[2];
      $ruta_elegida = $index_controlador->descargarRegistroAtencionSeguimiento();
    }
    else if ($partes_ruta[1] == 'implementacion-sasisopa'){
      $idReporte = $partes_ruta[2];
      $ruta_elegida = $index_controlador->detalleImplementacionSasisopa();
      }
    //---------------------------------------------
    //---------------------------------------------
    //------------ LISTA ASISTENCIA ---------------
    //---------------------------------------------
    else if ($partes_ruta[1] == 'descargar-lista-asistencia') {
    $GET_idRegistro = $partes_ruta[2];
    $ruta_elegida = $index_controlador->descargarListaAsistencia();
    }
    else if ($partes_ruta[1] == 'lista-asistencia') {
    $GET_idRegistro = $partes_ruta[2];
    $ruta_elegida = $index_controlador->listaAsistencia();
    }
    //-------------------------------------------------
    //-------------------------------------------------
    //------------------- SGM -------------------------
    else if ($partes_ruta[1] == 'descargar-lista-asistencia-sgm') {
    $GET_idRegistro = $partes_ruta[2];
    $ruta_elegida = $index_controlador->descargarListaAsistenciaSgm();
    }
    else if ($partes_ruta[1] == 'revision-sgm-procedimiento-registro') {
    $GET_idRegistro = $partes_ruta[2];
    $ruta_elegida = $index_controlador->revisionSgmProcedimientoRegistro();
    }
    else if ($partes_ruta[1] == 'descargar-revision-sgm-procedimiento-registro') {
    $GET_idRegistro = $partes_ruta[2];
    $ruta_elegida = $index_controlador->descargarRevisionSgmProcedimientoRegistro();
    }
    else if ($partes_ruta[1] == 'seguimiento-objetivos-indicadores') {
    $GET_idRegistro = $partes_ruta[2];
    $ruta_elegida = $index_controlador->seguimientoObjetivosIndicadores();
    }
    else if ($partes_ruta[1] == 'descargar-seguimiento-objetivos-indicadores') {
    $GET_idRegistro = $partes_ruta[2];
    $ruta_elegida = $index_controlador->descargarSeguimientoObjetivosIndicadores();
    }
    else if ($partes_ruta[1] == 'plan-auditoria-sgm') {
    $GET_idRegistro = $partes_ruta[2];
    $ruta_elegida = $index_controlador->planAuditoriaSgm();
    }
    else if ($partes_ruta[1] == 'descargar-plan-auditoria-sgm') {
    $GET_idRegistro = $partes_ruta[2];
    $ruta_elegida = $index_controlador->descargarPlanAuditoriaSgm();
    }
    else if ($partes_ruta[1] == 'reporte-hallazgos-auditoria-sgm') {
    $GET_idRegistro = $partes_ruta[2];
    $ruta_elegida = $index_controlador->reporteHallazgosAuditoriaSgm();
    }
    else if ($partes_ruta[1] == 'descargar-reporte-hallazgos-auditoria-sgm') {
    $GET_idRegistro = $partes_ruta[2];
    $ruta_elegida = $index_controlador->descargarReporteHallazgosAuditoriaSgm();
    }
    else if ($partes_ruta[1] == 'plan-atencion-hallazgos-sgm') {
    $GET_idRegistro = $partes_ruta[2];
    $ruta_elegida = $index_controlador->planAtencionHallazgosSgm();
    }
    else if ($partes_ruta[1] == 'descargar-plan-atencion-hallazgos-sgm') {
    $GET_idRegistro = $partes_ruta[2];
    $ruta_elegida = $index_controlador->descargarPlanAtencionHallazgosSgm();
    }
    else if ($partes_ruta[1] == 'descargar-evaluacion-cumplimiento-sgm') {
    $GET_idRegistro = $partes_ruta[2];
    $ruta_elegida = $index_controlador->descargarEvaluacionCumplimientoSgm();
    }
    else if ($partes_ruta[1] == 'bitacora-calibracion-equipos-sgm') {
    $GET_idRegistro = $partes_ruta[2];
    $ruta_elegida = $index_controlador->bitacoraCalibracionEquiposSgmEditar();
    }
    else if ($partes_ruta[1] == 'descargar-bitacora-calibracion-equipos-sgm') {
      $GET_idRegistro = $partes_ruta[2];
      $ruta_elegida = $index_controlador->descargarBitacoraCalibracionEquiposSgm();
    }
    else if ($partes_ruta[1] == 'descargar-responsable-sgm') {
      $GET_idRegistro = $partes_ruta[2];
      $ruta_elegida = $index_controlador->descargarResponsableSgm();
    }
    else if ($partes_ruta[1] == 'descargar-orden-servicio-sgm') {
      $GET_idRegistro = $partes_ruta[2];
      $ruta_elegida = $index_controlador->descargarOrdenServicioSgm();
    }
    else if ($partes_ruta[1] == 'descargar-evaluacion-proveedores-sgm') {
      $GET_idRegistro = $partes_ruta[2];
      $ruta_elegida = $index_controlador->descargarEvaluacionProveedoresSgm();
    }
    else if ($partes_ruta[1] == 'descargar-reconocimiento-sgm') {
      $GET_idCalendario = $partes_ruta[2];
      $ruta_elegida = $index_controlador->descargarReconocimientoSgm();
    }
    else if ($partes_ruta[1] == 'bitacora-verificacion-equipo-medicion-sgm') {
      $GET_idRegistro = $partes_ruta[2];
      $ruta_elegida = $index_controlador->bitacoraVerificacionEquipoMedicionSgmEditar();
    }
    else if ($partes_ruta[1] == 'descargar-bitacora-verificacion-equipos-sgm') {
      $GET_idRegistro = $partes_ruta[2];
      $ruta_elegida = $index_controlador->descargarBitacoraVerificacionEquiposSgm();
    }
    

    //--------------------------------------------------
    //--------------------------------------------------
    
        
    else if ($partes_ruta[1] == '1-politica-asistencia') {
    $GET_idRegistro = $partes_ruta[2];
    $ruta_elegida = 'public/sasisopa/politica-asistencia-index.php';
    }
    else if($partes_ruta[1] == 'nuevo-reporte-diario'){
    $GET_idReporte = $partes_ruta[2];
    $ruta_elegida = 'public/gerente/agregar-reporte-diario-index.php';
    }else if ($partes_ruta[1] == 'gestoria-requisitos-legales') {
    $idEstacion = $partes_ruta[2];
    $ruta_elegida = 'public/administrador/requisitos-legales-index.php';
    }else if ($partes_ruta[1] == 'gestoria-reporte-estadistico-cre') {
    $idEstacion = $partes_ruta[2];
    $ruta_elegida = 'public/administrador/reporte-estadistico-index.php';
    }    
    else  if ($partes_ruta[1] == 'modulos') {
    $idTema = $partes_ruta[2];
    $ruta_elegida = 'public/cursos/detalle-modulos.php';
    }
    else if ($partes_ruta[1] == 'reporte-diario'){
    $idYear = $partes_ruta[2];
    $ruta_elegida = 'public/gerente/lista-year-cre-index.php';
    }
    else if ($partes_ruta[1] == 'facturas-reporte-diario'){
    $idYear = $partes_ruta[2];
    $ruta_elegida = 'public/gerente/facturas-reporte-diario-index.php';
    }
    else if ($partes_ruta[1] == 'gestoria-nom-035') {
    $idEstacion = $partes_ruta[2];
    $ruta_elegida = 'public/administrador/nom-035-index.php';
    }
    else if ($partes_ruta[1] == 'gestoria-nom-035-politica') {
    $idEstacion = $partes_ruta[2];
    $ruta_elegida = 'public/administrador/nom-035-politica-index.php';
    }
    else if ($partes_ruta[1] == 'gestoria-nom-035-acontecimientos') {
    $idEstacion = $partes_ruta[2];
    $ruta_elegida = 'public/administrador/nom-035-acontecimientos-index.php';
    }
    else if ($partes_ruta[1] == 'gestoria-nom-035-factores-riesgo') {
    $idEstacion = $partes_ruta[2];
    $ruta_elegida = 'public/administrador/nom-035-factores-riesgo-index.php';
    }
    //--------------------------------------------------------------
    else if ($partes_ruta[1] == 'gestoria-calibracion-tanques') {
    $idEstacion = $partes_ruta[2];
    $ruta_elegida = 'public/administrador/gestoria-calibracion-tanques.php';
    }  
    //--------------------------------------------------------------
    else if ($partes_ruta[1] == 'gestoria-bitacoras-configuracion'){
    $idEstacion = $partes_ruta[2];
    $ruta_elegida = 'public/administrador/bitacoras-configuracion-index.php';
    }
    else if ($partes_ruta[1] == 'gestoria-programa-mantenimiento'){
    $idEstacion = $partes_ruta[2];
    $ruta_elegida = 'public/administrador/programa-mantenimiento-index.php';
    }
    else if ($partes_ruta[1] == 'reporte-bitacora-mantenimiento'){
    $Mantenimiento = $partes_ruta[2];
    $ruta_elegida = 'public/sasisopa/reporte-bitacora-mantenimiento-index.php';
    }
    else if ($partes_ruta[1] == 'cambio-precio') {
    $idEstacion = $partes_ruta[2];
    $ruta_elegida = 'public/administrador/cambio-precio-index.php';
    }
    //---------------------------------------------------------------
    else if ($partes_ruta[1] == 'gestoria-analisis-riesgo') {
    $idEstacion = $partes_ruta[2];
    $ruta_elegida = 'public/administrador/analisis-riesgo-index.php';
    }
    //-----------------------------------------------------------------
    else if ($partes_ruta[1] == 'editar-calendario') {
    $idEstacion = $partes_ruta[2];
    $ruta_elegida = 'public/gerente/calendario-editar.php';
    }
    


   
    //-------------------------------------------------------------------
    //-------------------------------------------------------------------
    //----------------------------------
    //---- Version nueva cursos --------
    else if ($partes_ruta[1] == 'cursos-temas') {
    $GET_idModulo = $partes_ruta[2];
    $ruta_elegida = 'public/cursos/cursos-temas-index.php';
    }
    else if ($partes_ruta[1] == 'descargar-reconocimiento') {
    $GET_idCalendario = $partes_ruta[2];
    $ruta_elegida = 'public/cursos/descargar-reconocimiento.php';
    }
    else if ($partes_ruta[1] == 'cursos-temas-iniciar') {
    $GET_idCalendario = $partes_ruta[2];
    $ruta_elegida = 'public/cursos/cursos-temas-iniciar.php';
    }
    else if ($partes_ruta[1] == 'cursos-temas-evaluacion') {
    $GET_idCalendario = $partes_ruta[2];
    $ruta_elegida = 'public/cursos/cursos-temas-evaluacion.php';
    }
    //----------------------------------
    //----------------------------------
    else if ($partes_ruta[1] == 'gestoria-entregas-editar') {
    $GET_ID = $partes_ruta[2];
    $ruta_elegida = 'public/administrador/gestoria-entregas-editar.php';
    }
    else if ($partes_ruta[1] == 'gestoria-entregas-descargar') {
    $GET_ID = $partes_ruta[2];
    $ruta_elegida = 'public/administrador/gestoria-entregas-descargar.php';
    }
    else if ($partes_ruta[1] == 'gestoria-control-documental-sgm') {
      $GET_idEstacion = $partes_ruta[2];
      $ruta_elegida = 'public/administrador/gestoria-control-documental-sgm.php';
      }
  }else if(count($partes_ruta) == 4){
    //---------------------------- SASISOPA --------------------------------
    //----------------------------------------------------------------------
    if ($partes_ruta[2] == 'detalle-experiencia-cliente'){
      $idReporte = $partes_ruta[3];
      $ruta_elegida = $index_controlador->detalleExperienciaCliente();
    }
    else if ($partes_ruta[2] == 'editar-experiencia-cliente'){
      $idReporte = $partes_ruta[3];
      $ruta_elegida = $index_controlador->editarExperienciaCliente();
    }
    else if ($partes_ruta[2] == 'indicador-ventas'){
      $selyear = $partes_ruta[3];
      $ruta_elegida = $index_controlador->indicadorVentasReporte();
      }
      else if ($partes_ruta[1] == 'reporte-mantenimiento-correctivo') {
        $SelYear = $partes_ruta[2];
        $SelMes = $partes_ruta[3];
        $ruta_elegida = $index_controlador->reporteMantenimientoCorrectivo();
      }
      else if ($partes_ruta[1] == 'descargar-programa-auditorias-internas-externas') {
        $FechaInicio = $partes_ruta[2];
        $FechaFin = $partes_ruta[3];
        $ruta_elegida = $index_controlador->descargarProgramaAuditoriaInternaExterna();
      }
    //-----------------------------------------------------------------------
    //-----------------------------------------------------------------------
    //-------------------------- SGM ----------------------------------------

    else if ($partes_ruta[1] == 'descargar-programa-anual-sgm') {
      $GET_idYear = $partes_ruta[2];
      $GET_idFormato = $partes_ruta[3];
      $ruta_elegida = $index_controlador->descargarProgramaAnualSgm();
    }

    //---------------------------------------------------------------------------
    else if ($partes_ruta[1] == 'detalle-reporte-diario'){
    $idReporte = $partes_ruta[2];
    $idFecha = $partes_ruta[3];
    $ruta_elegida = 'public/gerente/detalle-reporte-diario-index.php';
    }else if ($partes_ruta[1] == 'editar-reporte-diario'){
    $idReporte = $partes_ruta[2];
    $idFecha = $partes_ruta[3];
    $ruta_elegida = 'public/gerente/editar-reporte-diario-index.php';
    }else if ($partes_ruta[1] == 'reporte-diario'){
    $idMes = $partes_ruta[2];
    $idYear = $partes_ruta[3];
    $ruta_elegida = 'public/gerente/lista-dias-cre-index.php';
    }
    else if ($partes_ruta[1] == 'iniciar-presentacion') {
    $idTema = $partes_ruta[2];
    $idModulo = $partes_ruta[3];
    $ruta_elegida = 'public/cursos/detalle-presentacion-modulo.php';
    }      
    else if ($partes_ruta[1] == 'reporte-bitacora-profeco') {
    $selyear = $partes_ruta[2];
    $selmes = $partes_ruta[3];
    $ruta_elegida = 'public/sasisopa/vistas/reporte-bitacora-profeco-index.php';
    }
    else if ($partes_ruta[2] == 'descargar-requisitos-legales') {
    $idEstacion = $partes_ruta[3];
    $ruta_elegida = 'public/administrador/vistas/descargar-requisitos-legales.php';
    }
    else if ($partes_ruta[1] == 'gestoria-requisitos-legales') {
    $NGobierno = $partes_ruta[2];
    $idEstacion = $partes_ruta[3];
    $ruta_elegida = 'public/administrador/detalle-requisitos-legales-index.php';
    }
    
    else if ($partes_ruta[1] == 'gestoria-calibracion-tanques') {
    $idEstacion = $partes_ruta[2];
    $idReporte = $partes_ruta[3];
    $ruta_elegida = 'public/administrador/gestoria-calibracion-tanques-nuevo.php';
    } 
    else if ($partes_ruta[1] == 'reporte-sasisopa') {
    $FechaInicio = $partes_ruta[2];
    $FechaTermino = $partes_ruta[3];
    $ruta_elegida = 'public/reporte-sasisopa/reporte-sasisopa-elementos.php';
    }
    else if ($partes_ruta[1] == 'descargar-reconocimiento-modulo') {
    $GET_idYear = $partes_ruta[2];
    $GET_idModulo = $partes_ruta[3];
    $ruta_elegida = 'public/cursos/descargar-reconocimiento-modulo.php';
    }
    else if ($partes_ruta[1] == 'descargar-programa-anual-mantenimiento') {
      $GET_idRegistro = $partes_ruta[2];
      $GET_idEstacion = $partes_ruta[3];
      $ruta_elegida = 'public/administrador/descargar-programa-anual-mantenimiento.php';
      }

  }else if(count($partes_ruta) == 5){

    if ($partes_ruta[1] == 'descargar-comunicacion-participacion-consulta') {
    $GET_idYear = $partes_ruta[2];
    $GET_idEstacion = $partes_ruta[3];
    $GET_idRegistro = $partes_ruta[4];
    $ruta_elegida = $index_controlador->descargarComunicacionParticipacionConsulta();
    }
    else if ($partes_ruta[1] == 'descargar-comunicacion-participacion-consulta-reporte') {
    $GET_idYear = $partes_ruta[2];
    $GET_idEstacion = $partes_ruta[3];
    $GET_idRegistro = $partes_ruta[4];
    $ruta_elegida = $index_controlador->descargarComunicacionParticipacionConsultaReporte();
    }
    else if ($partes_ruta[1] == 'reporte-mantenimiento-preventivo') {
    $Selectequipo = $partes_ruta[2];
    $selyear = $partes_ruta[3];
    $selmes = $partes_ruta[4];
    $ruta_elegida = $index_controlador->descargarReporteMantenimientoPreventivo();
    }
    //-------------------------------------------------------------------
    //-------------------------------------------------------------------
    else if ($partes_ruta[1] == 'reconocimiento-pdf') {
    $idTema = $partes_ruta[2];
    $idModulo = $partes_ruta[3];
    $idUsuario = $partes_ruta[4];
    $ruta_elegida = 'public/cursos/reconocimiento.php';
    }
    else if ($partes_ruta[2] == 'descargar-reporte-cre') {
    $idEstacion = $partes_ruta[3];
    $selyear = $partes_ruta[4];
    $ruta_elegida = 'public/administrador/vistas/descargar-facturas.php';
    }

  }else if(count($partes_ruta) == 6){
   
  if ($partes_ruta[1] == 'reporte-bitacora-producto') {
  $selyear = $partes_ruta[2];
  $selmes = $partes_ruta[3];
  $inicio = $partes_ruta[4];
  $fin = $partes_ruta[5];
  $ruta_elegida = 'public/sasisopa/descargar-reporte-bitacora-recepcion-descarga-producto.php';
  }

  }

}

require_once $ruta_elegida;
?>