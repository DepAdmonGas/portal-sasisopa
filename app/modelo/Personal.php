<?php
class Personal
{
    private $class_base_datos;
	private $con;

    function __construct()
	{
        $this->class_base_datos = new ConexionBD();
		$this->con = $this->class_base_datos->conectarBD();
    }

    private function sqlQuery($sql){
        if(mysqli_query($this->con, $sql)){
        return true;
        }else{
        return false;
        }
        }    
    
    public function listaPersonal($id_usuario){

    }

    public function buscarPersonal($id_usuario){

        $sql_usuarios = "SELECT 
        tb_usuarios.nombre,
        tb_usuarios.fecha_nacimiento,
        tb_usuarios.estado_civil,
        tb_usuarios.seguro_social,
        tb_usuarios.domicilio,
        tb_usuarios.telefono,
        tb_usuarios.email,
        tb_usuarios.usuario,
        tb_usuarios.password,
        tb_puestos.tipo_puesto
        FROM tb_usuarios 
        INNER JOIN tb_puestos
        ON tb_usuarios.id_puesto = tb_puestos.id WHERE tb_usuarios.id = '".$id_usuario."' ";
        $result_usuarios = mysqli_query($this->con, $sql_usuarios);   
        return $row_usuarios = mysqli_fetch_array($result_usuarios, MYSQLI_ASSOC);
        $this->class_base_datos->desconectarBD($this->con);
    }

    public function editarNombre($id_usuario,$detalle){

        $sql = "UPDATE tb_usuarios SET
        nombre = '".$detalle."'
        WHERE id= '".$id_usuario."' ";
        return $this->sqlQuery($sql);
        $this->class_base_datos->desconectarBD($this->con);

    }

    public function editarDomicilio($id_usuario,$detalle){

        $sql = "UPDATE tb_usuarios SET
        domicilio = '".$detalle."'
        WHERE id= '".$id_usuario."' ";
        return $this->sqlQuery($sql);
        $this->class_base_datos->desconectarBD($this->con);

    }

    public function editarFechaNacimiento($id_usuario,$detalle){

        $sql = "UPDATE tb_usuarios SET
        fecha_nacimiento = '".$detalle."'
        WHERE id= '".$id_usuario."' ";
        return $this->sqlQuery($sql);
        $this->class_base_datos->desconectarBD($this->con);

    }

    public function editarEstadoCivil($id_usuario,$detalle){

        $sql = "UPDATE tb_usuarios SET
        estado_civil = '".$detalle."'
        WHERE id= '".$id_usuario."' ";
        return $this->sqlQuery($sql);
        $this->class_base_datos->desconectarBD($this->con);

    }

    public function editarSeguroSocial($id_usuario,$detalle){

        $sql = "UPDATE tb_usuarios SET
        seguro_social = '".$detalle."'
        WHERE id= '".$id_usuario."' ";
        return $this->sqlQuery($sql);
        $this->class_base_datos->desconectarBD($this->con);

    }

    public function editarTelefono($id_usuario,$detalle){

        $sql = "UPDATE tb_usuarios SET
        telefono = '".$detalle."'
        WHERE id= '".$id_usuario."' ";
        return $this->sqlQuery($sql);
        $this->class_base_datos->desconectarBD($this->con);

    }

    public function editarEmail($id_usuario,$detalle){

        $sql = "UPDATE tb_usuarios SET
        email = '".$detalle."'
        WHERE id= '".$id_usuario."' ";
        return $this->sqlQuery($sql);
        $this->class_base_datos->desconectarBD($this->con);

    }

    public function agregarDatosFamiliares($id_usuario,$nombre_familiar,$parentesco,$direccion,$telefono){

        $sql = "INSERT INTO tb_usuarios_familiares (
            id_usuario,
            nombrecompleto,
            parentesco,
            domicilio,
            telefono)
            VALUES (
              '".$id_usuario."',
              '".$nombre_familiar."',
              '".$parentesco."',
              '".$direccion."',
              '".$telefono."')";
              return $this->sqlQuery($sql);
        $this->class_base_datos->desconectarBD($this->con);

    }

    public function eliminarDatosFamiliares($id){
        $sql = "DELETE FROM tb_usuarios_familiares WHERE id = '".$id."' ";
        return $this->sqlQuery($sql);
        $this->class_base_datos->desconectarBD($this->con);
    }

    public function agregarFormacionAcademica($id_usuario,$nivel_academico,$institucion){

        $sql = "INSERT INTO tb_usuarios_formacion_academica (
            id_usuario,
            nivel,
            detalle)
            VALUES (
              '".$id_usuario."',
              '".$nivel_academico."',
              '".$institucion."')";
        return $this->sqlQuery($sql);
        $this->class_base_datos->desconectarBD($this->con);

    }

    public function eliminarFormacionAcademica($id){

        $sql = "DELETE FROM tb_usuarios_formacion_academica WHERE id = '".$id."' ";
        return $this->sqlQuery($sql);
        $this->class_base_datos->desconectarBD($this->con);

    }

    public function agregarExperienciaLaboral($id_usuario,$empresa_detalle){

        $sql = "INSERT INTO tb_usuarios_experiencia_laboral (
            id_usuario,
            detalle)
            VALUES (
              '".$id_usuario."',
              '".$empresa_detalle."')";
              return $this->sqlQuery($sql);
              $this->class_base_datos->desconectarBD($this->con);

    }

    public function eliminarExperienciaLaboral($id){

        $sql = "DELETE FROM tb_usuarios_experiencia_laboral WHERE id = '".$id."' ";
        return $this->sqlQuery($sql);
        $this->class_base_datos->desconectarBD($this->con);

    }

    public function agregarExperienciaEmpresa($id_usuario,$razon_social,$puesto,$fecha_inicio,$fecha_fin){

        $sql = "INSERT INTO tb_usuarios_experiencia_empresa_grupo (
            id_usuario,
            razon_social,
            puesto,
            periodo_inicio,
            periodo_fin)
            VALUES (
              '".$id_usuario."',
              '".$razon_social."',
              '".$puesto."',
                '".$fecha_inicio."',
                '".$fecha_fin."')";

            return $this->sqlQuery($sql);
        $this->class_base_datos->desconectarBD($this->con);

    }

    public function eliminarExperienciaEmpresa($id){
        $sql = "DELETE FROM tb_usuarios_experiencia_empresa_grupo WHERE id = '".$id."' ";
        return $this->sqlQuery($sql);
        $this->class_base_datos->desconectarBD($this->con);
    }

    public function editarExperienciaEmpresa($id,$razon_social,$puesto,$fecha_inicio,$fecha_fin){

        $sql = "UPDATE tb_usuarios_experiencia_empresa_grupo SET
        razon_social = '".$razon_social."',
        puesto = '".$puesto."',
        periodo_inicio = '".$fecha_inicio."',
        periodo_fin = '".$fecha_fin."'
        WHERE id = '".$id."' ";
        return $this->sqlQuery($sql);
        $this->class_base_datos->desconectarBD($this->con);

    }

    public function editarFirmaPersonal($id_usuario,$base_64){

        $aleatorio = uniqid();

        $img = $base_64;
        $img = str_replace('data:image/png;base64,', '', $img);
        $fileData = base64_decode($img);
        $fileName = $aleatorio.'.png';
        
        if(file_put_contents('../../imgs/firma-personal/'.$fileName, $fileData)){
        
        $sql = "UPDATE tb_usuarios SET
        firma = '".$fileName."'
         WHERE id= '".$id_usuario."' ";
         return $this->sqlQuery($sql);
         $this->class_base_datos->desconectarBD($this->con);
        }else{
            return false;
        }

    }

    public function porcentajeCumplimiento($id_usuario){

        $total = 0;
        $totalpuntos = 9;
        
        $sql_usuarios = "SELECT email, telefono, fecha_nacimiento, estado_civil,seguro_social, domicilio FROM tb_usuarios WHERE id = '".$id_usuario."' ";
        $result_usuarios = mysqli_query($this->con, $sql_usuarios);
        $numero_usuarios = mysqli_num_rows($result_usuarios); 
        $row_usuarios = mysqli_fetch_array($result_usuarios, MYSQLI_ASSOC);
        
        $email = $row_usuarios['email'];
        $telefono = $row_usuarios['telefono'];
        $fecha_nacimiento = $row_usuarios['fecha_nacimiento'];
        $estado_civil = $row_usuarios['estado_civil'];
        $seguro_social = $row_usuarios['seguro_social'];
        $domicilio = $row_usuarios['domicilio'];
        
        if ($email != "") {
        $total = $total + 1;
        }else{
        $total = $total + 0;
        }
        
        if ($telefono != "") {
        $total = $total + 1;
        }else{
        $total = $total + 0;
        }
        
        if ($fecha_nacimiento != "0000-00-00") {
        $total = $total + 1;
        }else{
        $total = $total + 0;
        }
        
        if ($estado_civil != "") {
        $total = $total + 1;
        }else{
        $total = $total + 0;
        }
        
        if ($seguro_social != "") {
        $total = $total + 1;
        }else{
        $total = $total + 0;
        }
        
        if ($domicilio != "") {
        $total = $total + 1;
        }else{
        $total = $total + 0;
        }
                
        
        $sql_usuarios_f = "SELECT id FROM tb_usuarios_familiares WHERE id_usuario = '".$id_usuario."' ";
        $result_usuarios_f = mysqli_query($this->con, $sql_usuarios_f);
        $numero_usuarios_f = mysqli_num_rows($result_usuarios_f); 
        
        if ($numero_usuarios_f >= 1) {
        $total = $total + 1;
        }else{
        $total = $total + 0;  
        }
        
        $sql_usuarios_fa = "SELECT id FROM tb_usuarios_formacion_academica WHERE id_usuario = '".$id_usuario."' ";
        $result_usuarios_fa = mysqli_query($this->con, $sql_usuarios_fa);
        $numero_usuarios_fa = mysqli_num_rows($result_usuarios_fa); 
        
        if ($numero_usuarios_fa >= 1) {
        $total = $total + 1;
        }else{
        $total = $total + 0;  
        }
        
        $sql_usuarios_el = "SELECT id FROM tb_usuarios_experiencia_laboral WHERE id_usuario = '".$id_usuario."' ";
        $result_usuarios_el = mysqli_query($this->con, $sql_usuarios_el);
        $numero_usuarios_el = mysqli_num_rows($result_usuarios_el); 
        
        if ($numero_usuarios_el >= 1) {
        $total = $total + 1;
        }else{
        $total = $total + 0;  
        }
        
        $porcentaje   =  $totalpuntos * 10;
        $resultado = $total;        
        $puntosTotal =  ($resultado / $porcentaje) * 100;
        $Promedio = $puntosTotal * 10;
        
        return $Promedio;
        $this->class_base_datos->desconectarBD($this->con);
        }

        
}
