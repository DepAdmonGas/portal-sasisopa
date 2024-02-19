<?php
require('../../../app/help.php');

if($_POST['Action'] == 1){

$sql = "UPDATE tb_entregas SET
estacion = '".$_POST['idEstacion']."',
fecha = '".$_POST['Fecha']."',
destinatario = '".$_POST['Destinatario']."',
estatus = 1
 WHERE id = '".$_POST['id']."' ";
mysqli_query($con, $sql);

}else{

$sql = "SELECT * FROM tb_entregas WHERE id = '".$_POST['id']."' ";
$result = mysqli_query($con, $sql);
$numero = mysqli_num_rows($result);
while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
$razonsocial = $row['estacion'];
$Estacion = Estacion($razonsocial, $con);
$emailuno = $Estacion['emailuno'];
}

    $sql_insert1 = "INSERT INTO tb_entregas_finalizar (
        id_entrega,
        nombre)
        VALUES (
        '".$_POST['id']."',
        '".$_POST['Recibe']."'
        )";

        if(mysqli_query($con, $sql_insert1)){
	
            $sql1 = "UPDATE tb_entregas SET
            estatus = 2
             WHERE id = '".$_POST['id']."' ";
            if(mysqli_query($con, $sql1)){
            
            $Enviar1 = EnviarEmail($_POST['id'],$emailuno,$con);
            echo 1;
            
            }
            }

}

function Estacion($Estacion, $con){
    $sql = "SELECT permisocre,razonsocial,direccioncompleta,email FROM tb_estaciones WHERE razonsocial = '".$Estacion."'";
    $result = mysqli_query($con, $sql);
    $numero = mysqli_num_rows($result);
    while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
    $razonsocial = $row['razonsocial'];
    $direccion = $row['direccioncompleta'];
    $emailuno = $row['email']; 
    }
     $return = array('razonsocial' => $razonsocial, 'direccion' => $direccion, 'emailuno' => $emailuno);
    return $return;
    }

    function EnviarEmail($id,$Email,$con){

        $subject = 'Entregas AdmonGas';
        $msg = Detalle($id,$con);
        $from = $Email;
        
        // El from DEBE corresponder a una cuenta de correo real creada en el servidor
        $headers = "From: entregas@admongas.com.mx\r\n"; 
        $headers .= "Reply-To: $from\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=utf-8\r\n"; 
            
        if(mail($from, $subject, $msg,$headers)){
            $result = 1;
            }else{
            $errorMessage = error_get_last()['msg'];
            $result = 0;
        }
        
       
              return $result;
        
        }

        function Detalle($id,$con){

            $Documento = Documentos($id, $con);
        
            $sql = "SELECT * FROM tb_entregas WHERE id = '".$id."' ";
            $result = mysqli_query($con, $sql);
            $numero = mysqli_num_rows($result);
            while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
            $id_estacion = $row['estacion'];
            $Estacion = Estacion($id_estacion, $con);
            $razonsocial = $Estacion['razonsocial'];
            $direccion = $Estacion['direccion'];
            $destinatario = $row['destinatario'];
            $fecha = $row['fecha'];
            $estatus = $row['estatus'];
            }
    
            $sqlED = "SELECT * FROM tb_entregas_finalizar WHERE id_entrega = '".$id."' ";
            $resultED = mysqli_query($con, $sqlED);
            $numeroED = mysqli_num_rows($resultED);
            while($rowED = mysqli_fetch_array($resultED, MYSQLI_ASSOC)){
            $explode = explode(' ',$rowED['fecha']);
            $FechaE = $explode[0];
            $HoraE = $explode[1];
            $nombre = $rowED['nombre'];
            }
            
            $sqlLista = "SELECT * FROM tb_entregas_documentos WHERE id_entrega = '".$id."' ";
            $resultLista = mysqli_query($con, $sqlLista);
            $numeroLista = mysqli_num_rows($resultLista);
    
            $contenido = '';
            $RutaLogo = RUTA_IMG_LOGOS.'Logo.png';
            $contenido .= '<img src="'.$RutaLogo.'" style="width: 180px;">';
    
            $contenido .= '<div style="text-align: right;margin-top: 20px;">Huixquilucan, Estado de México a '.FormatoFecha($fecha).'</div>';
            $contenido .= '<div style="text-align: right;"><b>Asunto:</b> Entrega de documentos</div>';
    
            $contenido .= '<div style="margin-top: 40px;"></div>';
            $contenido .= '<div><b>'.$destinatario.'</b></div>';
            $contenido .= '<div>'.$razonsocial.'</div>';
            $contenido .= '<div>'.$direccion.'</div>';
    
            $contenido .= '<div style="margin-top: 40px;">P r e s e n t e.</div>';
            $contenido .= '<div style="margin-top: 10px;">Se hace entrega de la siguiente documentación:</div>';
    
            $contenido .= '<table style="width: 100%;border: 1px solid #ddd;border-collapse: collapse;margin-top: 30px;">';
            $contenido .= '<thead>';
            $contenido .= '<tr>';
            $contenido .= '<th style="text-align: center;padding-top: 5px;padding-bottom: 5px;background-color: #2D82DD;color: white;">No.</th>';
            if($Documento > 1){
            $contenido .= '<th style="text-align: center;padding-top: 5px;padding-bottom: 5px;background-color: #2D82DD;color: white;">Razón Social</th>';
            }
            $contenido .= '<th style="text-align: center;padding-top: 5px;padding-bottom: 5px;background-color: #2D82DD;color: white;">Nombre del documento</th>  
            <th style="text-align: center;padding-top: 5px;padding-bottom: 5px;background-color: #2D82DD;color: white;">Fecha del oficio</th>
            <th style="text-align: center;padding-top: 5px;padding-bottom: 5px;background-color: #2D82DD;color: white;">Original y/o copia</th>
            </tr>
            </thead>
            <tbody>';
    
            $num = 1;
            while($rowLista = mysqli_fetch_array($resultLista, MYSQLI_ASSOC)){
    
            $id = $rowLista['id'];
    
            if($rowLista['id_estacion'] != 0){
            $Estacion = Estacion($rowLista['id_estacion'], $con);
            $RazonSocial = $Estacion['razonsocial'];
            }
    
            $contenido .= '<tr>';
            $contenido .= '<td style="text-align: center;border: 1px solid #ddd;"><b>'.$num.'</b></td>';
            if($Documento > 1){
            $contenido .= '<td style="text-align: center;border: 1px solid #ddd;">'.$RazonSocial.'</td>';
            }
            $contenido .= '<td style="text-align: center;border: 1px solid #ddd;">'.$rowLista['documento'].'</td>';
            $contenido .= '<td style="text-align: center;border: 1px solid #ddd;">'.FormatoFecha($rowLista['fecha']).'</td>';
            $contenido .= '<td style="text-align: center;border: 1px solid #ddd;">'.$rowLista['detalle'].'</td>';
            $contenido .= '</tr>';
    
            $num++;
            }
    
            $contenido .= '</tbody> 
            </table>';
    
            $contenido .= '<div style="margin-top: 30px;"><b>Nota: Es importante mencionar que estos documentos deben estar bien archivados en la estación de servicio.</b></div>';
    
            $contenido .= '<div style="margin-top: 30px;">Recibido</div>';
            $contenido .= '<div style="margin-top: 0px;"><b>Nombre:</b> '.$nombre.'</div>';
            $contenido .= '<div style="margin-top: 0px;"><b>Fecha:</b> '.FormatoFecha($FechaE).', '.date("g:i a",strtotime($HoraE)).'</div>';
    
    
            return $contenido;
    
    
        }


mysqli_close($con);