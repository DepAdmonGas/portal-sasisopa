<?php 
require('../../app/help.php');
include_once "../../app/modelo/ControlActividadProceso.php";

$class_control_actividad_proceso = new ControlActividadProceso();

switch($_POST['accion']){
    case 'agregar-programa-anual':
        echo $class_control_actividad_proceso->agregarProgramaAnual($_POST['idestacion'],$_POST['fecha']);
    break;
    case 'buscar-periodicidad':
        echo $class_control_actividad_proceso->buscarPeriodicidad($_POST['idselect']);
    break;
    case 'agregar-equipo-instalacion':
        echo $class_control_actividad_proceso->agregarEquipoInstalacion($Session_IDEstacion,$_POST['idreporte'],$_POST['id'],$_POST['fecha'],$_POST['select']);
    break;
    case 'eliminar-equipo-instalacion':
        echo $class_control_actividad_proceso->eliminarEquipoInstalacion($_POST['id']);
    break;
    case 'editar-equipo-instalacion':

        $array = array(
        "id" => $_POST['id'],
        "Enero" => $_POST['Enero'],
        "Febrero" => $_POST['Febrero'],
        "Marzo" => $_POST['Marzo'],
        "Abril" => $_POST['Abril'],
        "Mayo" => $_POST['Mayo'],
        "Junio" => $_POST['Junio'],
        "Julio" => $_POST['Julio'],
        "Agosto" => $_POST['Agosto'],
        "Septiembre" => $_POST['Septiembre'],
        "Octubre" => $_POST['Octubre'],
        "Noviembre" => $_POST['Noviembre'],
        "Diciembre" => $_POST['Diciembre']);

        echo $class_control_actividad_proceso->editarEquipoInstalacion($array);
    break;
    //----------------------------------------------------------------------------------------------------
    //----------------------------------------------------------------------------------------------------
    case 'agregar-acceso-trabajador':
        echo $class_control_actividad_proceso->agregarAccesoTrabajador($Session_IDEstacion,$_POST['idUsuario'],$_POST['categoria']);
    break;
    case 'eliminar-firma-personal':
        echo $class_control_actividad_proceso->eliminarFirmaPersonal($_POST['idFirma'],$_POST['Comentario'],$hoy);
    break;
    //----------------------------------------------------------------------------------------------------------
    //----------------------------------------------------------------------------------------------------------
    case 'agregar-evidencia-mantenimiento-preventivo':

        $id_mantenimiento = $_POST['idMantenimiento'];
        $file_name = $_FILES['FileEvidencia']['name'];
        $file_tmp_name = $_FILES['FileEvidencia']['tmp_name'];

        echo $class_control_actividad_proceso->agregarEvidenciaMantenimientoPreventivo($id_mantenimiento,$file_name,$file_tmp_name,$hoy);
    break;
    case 'eliminar-evidencia-mantenimiento-preventivo':
        echo $class_control_actividad_proceso->eliminarEvidenciaMantenimientoPreventivo($_POST['idevidencia']);
    break;
    //----------------------------------------------------------------------------------------------------------
    //----------------------------------------------------------------------------------------------------------
    case 'agregar-extintor':
        echo $class_control_actividad_proceso->agregarExtintor($Session_IDEstacion,$_POST['NoExtintor'],$_POST['Ubicacion'],$_POST['FechaRecarga'],$_POST['TipoExtintor'],$_POST['Peso']);
    break;
    case 'editar-extintor':
       echo $class_control_actividad_proceso->editarExtintor($_POST['idExtintor'],$_POST['NoExtintor'],$_POST['Ubicacion'],$_POST['FechaRecarga'],$_POST['TipoExtintor'],$_POST['Peso']);
    break;
    case 'eliminar-extintor':
        echo $class_control_actividad_proceso->eliminarExtintor($_POST['idExtintor']);
    break;
    //----------------------------------------------------------------------------------------------------------
    //----------------------------------------------------------------------------------------------------------
    case 'actualizar-mantenimiento-correctivo':
        echo $class_control_actividad_proceso->actualizarMantenimientoCorrectivo($_POST['idmantenimiento'],$_POST['EquipoArea'],$_POST['DeHallazgo'],$_POST['DeMantenimiento'],$_POST['Herramienta']);
    break;
    case 'agregar-evidencia-mantenimiento-correctivo':
        
        $file_name = $_FILES['FileEvidencia']['name'];
        $file_tmp_name = $_FILES['FileEvidencia']['tmp_name'];

        echo $class_control_actividad_proceso->agregarEvidenciaMantenimientoCorrectivo($_POST['idMantenimiento'],$file_name,$file_tmp_name,$hoy);
    break;
    case 'eliminar-evidencia-mantenimiento-correctivo':
        echo $class_control_actividad_proceso->eliminarEvidenciaMantenimientoCorrectivo($_POST['idevidencia']);
    break;
    //----------------------------------------------------------------------------------------------------------
    //----------------------------------------------------------------------------------------------------------
    //---- Calibración de equipos
    
    case 'agregar-tanque-almacenamiento':      
        echo $class_control_actividad_proceso->agregarTanqueAlmacenamiento($Session_IDEstacion,$_POST['NoTanque'],$_POST['Capacidad'],$_POST['Producto']);
    break;
    case 'eliminar-tanque-almacenamiento':      
        echo $class_control_actividad_proceso->eliminarTanqueAlmacenamiento($_POST['idTanque']);
    break;
    case 'editar-tanque-almacenamiento':    
        echo $class_control_actividad_proceso->editarTanqueAlmacenamiento($_POST['idTanque'],$_POST['EditNoTanque'],$_POST['EditCapacidad'],$_POST['EditProducto']);
    break;
    case 'agregar-dispensario':    
        echo $class_control_actividad_proceso->agregarDispensario($Session_IDEstacion,$_POST['NoDispensario'],$_POST['Marca'],$_POST['Modelo'],$_POST['Serie'],$_POST['Producto1'],$_POST['Producto2'],$_POST['Producto3']);
    break;
    case 'eliminar-dispensario':      
        echo $class_control_actividad_proceso->eliminarDispensario($_POST['idDispensario']);
    break;
    case 'agregar-sonda-medicion':      
        echo $class_control_actividad_proceso->agregarSondaMedicion($Session_IDEstacion,$_POST['NoSonda'],$_POST['Marca'],$_POST['Modelo'],$_POST['Ubicacion']);
    break;
    case 'eliminar-sonda-medicion':      
        echo $class_control_actividad_proceso->eliminarSondaMedicion($_POST['idSonda']);
    break;
    case 'editar-sonda-medicion':      
        echo $class_control_actividad_proceso->editarSondaMedicion($_POST['idSonda'],$_POST['EditNoSonda'],$_POST['EditMarca'],$_POST['EditModelo'],$_POST['EditUbicacion']);
    break;
    case 'agregar-jarra-patron':      
        echo $class_control_actividad_proceso->agregarJarraPatron($Session_IDEstacion,$_POST['Marca'],$_POST['NoSerie'],$_POST['Capacidad'],$_POST['Material']);
    break;
    case 'eliminar-jarra-patron':      
        echo $class_control_actividad_proceso->eliminarJarraPatron($_POST['idJarra']);
    break;
    case 'editar-jarra-patron':      
        echo $class_control_actividad_proceso->editarJarraPatron($_POST['idJarra'],$_POST['EditMarca'],$_POST['EditNoSerie'],$_POST['EditCapacidad'],$_POST['EditMaterial']);
    break;
    //----------------------------------------------------------------------------------
    //--------------------------- Bitácora calibración de equipos -----------------------
    case 'agregar-calibracion-equipos':      
        echo $class_control_actividad_proceso->agregarCalibracionEquipo($Session_IDEstacion,$Session_IDUsuarioBD,$_POST['Equipo']);
    break;
    case 'editar-calibracion-equipos-jarra-patron':      
        echo $class_control_actividad_proceso->editarCalibracionEquipoJarraPatron($_POST['contenido'],$_POST['id'],$_POST['input']);
    break;
    case 'finalizar-calibracion-equipos':      
        echo $class_control_actividad_proceso->finalizarCalibracionEquipos($Session_IDEstacion,$Session_IDUsuarioBD,$_POST['Id'],$_POST['Equipo']);
    break;
    case 'editar-calibracion-equipos-dispensario':      
        echo $class_control_actividad_proceso->editarCalibracionEquipoDispensario($_POST['contenido'],$_POST['id'],$_POST['input']);
    break;
    case 'eliminar-calibracion-equipos-dispensario':      
        echo $class_control_actividad_proceso->eliminarCalibracionEquipoDispensario($_POST['Id']);
    break;
    case 'agregar-calibracion-equipos-dispensario':      
        echo $class_control_actividad_proceso->agregarCalibracionEquipoDispensario($_POST['Id'],$_POST['idDispensario']);
    break;
    case 'editar-calibracion-equipos-sonda-medicion':      
        echo $class_control_actividad_proceso->editarCalibracionEquipoSondaMedicion($_POST['contenido'],$_POST['id'],$_POST['input']);
    break;
    case 'editar-calibracion-equipos-tanque-almacenamiento':      
        echo $class_control_actividad_proceso->editarCalibracionEquipoTanque($_POST['contenido'],$_POST['id'],$_POST['input']);
    break;
    case 'agregar-resultados-calibracion-tanque':      
        echo $class_control_actividad_proceso->agregarResultadosCalibracionTanque($_POST['id'],$_FILES['file']['tmp_name'],$hoy);
    break;
    case 'agregar-resultados-calibracion':      
        echo $class_control_actividad_proceso->agregarResultadosCalibracion($_POST['id'],$_FILES['file']['tmp_name'],$hoy);
    break;
    //--------------------------------------------------------------------------------------------------------------
    //------------------ Bitácora de registro de eventos PROFECO

    case 'agregar-dispensario-bitacora':      
        echo $class_control_actividad_proceso->agregarDispensarioBitacora($Session_IDEstacion,$Session_IDUsuarioBD,$_POST['categoria'],$_POST['Fecha'],$_POST['HoraInicio'],$_POST['HoraTermino'],$_POST['Dispensario'],$_POST['Lado'],$_POST['Producto'],$_POST['Detalle']);
    break;
    case 'editar-dispensario-bitacora':      
        echo $class_control_actividad_proceso->editarDispensarioBitacora($_POST['id']);
    break;
    //--------------------------------------------------------------------------------------------------------------
    //-------------------------------------- Bitacora Mantenimiento Quincenal --------------------------------------
    
    case 'agregar-mantenimiento-quincenal':      

    $array = array(
        'fecha' => $_POST['Fecha'],
        'file_name_1' => $_FILES['Formato1_file']['name'],
        'file_name_2' => $_FILES['Formato2_file']['name'],
        'file_name_3' => $_FILES['Formato3_file']['name'],
        'file_name_4' => $_FILES['Formato4_file']['name'],
        'file_name_5' => $_FILES['Formato5_file']['name'],
        'file_name_6' => $_FILES['Formato6_file']['name'],
        'file_name_7' => $_FILES['Formato7_file']['name'],
        'file_tmp_name_1' => $_FILES['Formato1_file']['tmp_name'],
        'file_tmp_name_2' => $_FILES['Formato2_file']['tmp_name'],
        'file_tmp_name_3' => $_FILES['Formato3_file']['tmp_name'],
        'file_tmp_name_4' => $_FILES['Formato4_file']['tmp_name'],
        'file_tmp_name_5' => $_FILES['Formato5_file']['tmp_name'],
        'file_tmp_name_6' => $_FILES['Formato6_file']['tmp_name'],
        'file_tmp_name_7' => $_FILES['Formato7_file']['tmp_name']
    );

        echo $class_control_actividad_proceso->agregarMantenimientoQuincenal($Session_IDEstacion,$Session_IDUsuarioBD,$array,$fecha_del_dia,$hoy);
    break;
    case 'eliminar-bitacora-quincenal':      
        echo $class_control_actividad_proceso->eliminarBitacoraQuincenal($_POST['id']);
    break;
    //-------------------------------------------------------------------------------------
    //-------------------------------------------------------------------------------------
    case 'agregar-detector-humo':
        echo $class_control_actividad_proceso->agregarDetectorHumo($Session_IDEstacion,$_POST['NoDetector'],$_POST['Ubicacion']);
    break;
    case 'eliminar-detector-humo':      
        echo $class_control_actividad_proceso->eliminarDetectorHumo($_POST['id']);
    break;

    }
    
