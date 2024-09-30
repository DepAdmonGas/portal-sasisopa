<?php

class Estacion
{
	private $class_base_datos;
	private $con;
	private $sesion_id_estacion;
	private $sesion_nombre_estacion;
	private $sesion_permiso_cre;
	private $sesion_razon_social;
	private $sesion_rfc;
	private $sesion_direccion_completa;
	private $sesion_direccion_estado;
	private $sesion_direccion_municipio;
	private $sesion_apoderado_legal;
	private $sesion_firma;
	private $sesion_politica;
	private $sesion_mision;
	private $sesion_vision;
	private $sesion_franquicia;
	private $sesion_producto_uno;
	private $sesion_producto_dos;
	private $sesion_producto_tres;
	private $sesion_sasisopa;
	private $sesion_fecha_autorizacion;
	private $sesion_organigrama;
	
	function __construct($idestacion)
	{
		$this->class_base_datos = new ConexionBD();
		$this->con = $this->class_base_datos->conectarBD();
		$this->sesion_id_estacion = $idestacion;
		$this->informacionEstacion();

	}

	private function informacionEstacion()
	{

		$query = "SELECT 
		nombre, 
		permisocre, 
		razonsocial,
		rfc, 
		direccioncompleta,
		di_estado,
		di_municipio,
		apoderado_legal,
		firma,
		politica,
		mision,
		vision,
		franquicia,
		producto_uno,
		producto_dos,
		producto_tres,
		sasisopa,
		fecha_autorizacion,
		organigrama
		FROM tb_estaciones 
		WHERE id = '".$this->sesion_id_estacion."' ";
		$result = mysqli_query($this->con, $query);
		$numero = mysqli_num_rows($result);
		$row = mysqli_fetch_array($result, MYSQLI_ASSOC);

			$this->setNombreEstacion($row['nombre']);
			$this->setPermisoCre($row['permisocre']);
			$this->setRazonSocial($row['razonsocial']);
			$this->setRFC($row['rfc']);
			$this->setDireccionCompleta($row['direccioncompleta']);
			$this->setDireccionEstado($row['di_estado']);
			$this->setDireccionMunicipio($row['di_municipio']);			
			$this->setApoderadoLegal($row['apoderado_legal']);
			$this->setFirma($row['firma']);
			$this->setPolitica($row['politica']);
			$this->setMision($row['mision']);	
			$this->setVision($row['vision']);
			$this->setFranquicia($row['franquicia']);			
			$this->setProductoUno($row['producto_uno']);
			$this->setProductoDos($row['producto_dos']);
			$this->setProductoTres($row['producto_tres']);
			$this->setSasisopa($row['sasisopa']);

			$this->setFechaAutorizacion($row['fecha_autorizacion']);
			$this->setOrganigrama($row['organigrama']);		
		
	}

			public function setNombreEstacion($param){$this->sesion_nombre_estacion = $param;}
			public function setPermisoCre($param){$this->sesion_permiso_cre = $param;}
			public function setRazonSocial($param){$this->sesion_razon_social = $param;}
			public function setRFC($param){$this->sesion_rfc = $param;}
			public function setDireccionCompleta($param){$this->sesion_direccion_completa = $param;}
			public function setDireccionEstado($param){$this->sesion_direccion_estado = $param;}
			public function setDireccionMunicipio($param){$this->sesion_direccion_municipio = $param;}
			public function setApoderadoLegal($param){$this->sesion_apoderado_legal = $param;}
			public function setFirma($param){$this->sesion_firma = $param;}
			public function setPolitica($param){$this->sesion_politica = $param;}
			public function setMision($param){$this->sesion_mision = $param;}
			public function setVision($param){$this->sesion_vision = $param;}
			public function setFranquicia($param){$this->sesion_franquicia = $param;}
			public function setProductoUno($param){$this->sesion_producto_uno = $param;}
			public function setProductoDos($param){$this->sesion_producto_dos = $param;}
			public function setProductoTres($param){$this->sesion_producto_tres = $param;}
			public function setSasisopa($param){$this->sesion_sasisopa = $param;}
			public function setFechaAutorizacion($param){$this->sesion_fecha_autorizacion = $param;}
			public function setOrganigrama($param){$this->sesion_organigrama = $param;}


			public function getNombreEstacion(){return $this->sesion_nombre_estacion;}
			public function getPermisoCre(){return $this->sesion_permiso_cre;}
			public function getRazonSocial(){return $this->sesion_razon_social;}
			public function getRFC(){return $this->sesion_rfc;}
			public function getDireccionCompleta(){return $this->sesion_direccion_completa;}
			public function getDireccionEstado(){return $this->sesion_direccion_estado;}
			public function getDireccionMunicipio(){return $this->sesion_direccion_municipio;}
			public function getApoderadoLegal(){return $this->sesion_apoderado_legal;}
			public function getFirma(){return $this->sesion_firma;}
			public function getPolitica(){return $this->sesion_politica;}
			public function getMision(){return $this->sesion_mision;}
			public function getVision(){return $this->sesion_vision;}
			public function getFranquicia(){return $this->sesion_franquicia;}
			public function getProductoUno(){return $this->sesion_producto_uno;}
			public function getProductoDos(){return $this->sesion_producto_dos;}
			public function getProductoTres(){return $this->sesion_producto_tres;}
			public function getSasisopa(){return $this->sesion_sasisopa;}
			public function getFechaAutorizacion(){return $this->sesion_fecha_autorizacion;}
			public function getOrganigrama(){return $this->sesion_organigrama;}

	

}