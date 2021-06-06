<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Categorias_model extends CI_Model {

	public function getCategorias(){
		$resultados = $this->db->get("categorias");
		return $resultados->result();
	}

	public function getCategoria($idCategoria){
		$this->db->where("id",$idCategoria);
		$consulta = $this->db->get("categorias");
		return $consulta->row();
	}

	public function guardar($datos){	
		return $this->db->insert("categorias",$datos);
	}

	public function update($idCategoria,$datos){
		$this->db->where("id",$idCategoria);
		return $this->db->update("categorias",$datos);
	}

	public function delete($id){
		$this->db->where("id",$id);
		return $this->db->delete("categorias");
	}
}
