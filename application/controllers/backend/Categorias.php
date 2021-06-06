<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Categorias extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model("Categorias_model");
        if (!$this->session->userdata("login")) {
            redirect(base_url() . "cpanel");
        }
    }

    public function index()
    {
        $contenido_interno = array(
            'categorias' => $this->Categorias_model->getCategorias(),
        );

        $contenido_exterior = array(
            'title'     => 'Categorias',
            'contenido' => $this->load->view('backend/categorias/index', $contenido_interno, true),
        );

        $this->load->view('backend/template', $contenido_exterior);
    }

    public function add()
    {
        $data = array(
            'title'     => 'Agregar Categorias',
            'contenido' => $this->load->view('backend/categorias/add', '', true),
        );

        $this->load->view('backend/template', $data);
    }

    public function store()
    {
        $nombre = $this->input->post("nombre");

        $this->form_validation->set_rules('nombre', 'Nombre', 'trim|required|is_unique[categorias.nombre]', array('required' => 'Debes proporcionar un %s.', 'is_unique' => 'Este %s ya existe'));
        $this->form_validation->set_error_delimiters('<span class="help-block">', '</span>');

        if ($this->form_validation->run() == false) {
            $this->add();
        } else {
            $datos = [
                "nombre" => $nombre,
            ];
            if ($this->Categorias_model->guardar($datos)) {
                //$this->session->set_flashdata("msg_success","La categoria ".$nombre." ha sido registrado");
                redirect(base_url() . "backend/categorias");
            } else {
                //$this->session->set_flashdata("msg_error","La categoria ".$name." no pudo registrarse");
                redirect(base_url() . "backend/categorias/add");
            }
        }
    }

    public function edit($idCategoria)
    {
        $contenido_interno = array(
            'categorias' => $this->Categorias_model->getCategoria($idCategoria),
        );

        $contenido_exterior = array(
            'title'     => 'Editar Categoria',
            'contenido' => $this->load->view('backend/categorias/edit', $contenido_interno, true),
        );

        $this->load->view('backend/template', $contenido_exterior);
    }

    public function update()
    {
        $idCategoria = $this->input->post("idfacultad");
        $nombre     = $this->input->post("nombre");

        $categoria_actual = $this->Categorias_model->getCategoria($idCategoria);

        if ($nombre != $categoria_actual->nombre) {
            $is_unique = '|is_unique[categorias.nombre]';
        } else {
            $is_unique = '';
        }

        $this->form_validation->set_rules('nombre', 'Nombre', 'trim|required' . $is_unique, array('required' => 'Debes proporcionar un %s.', 'is_unique' => 'Este %s ya existe'));
        $this->form_validation->set_error_delimiters('<span class="help-block">', '</span>');

        if ($this->form_validation->run() == false) {
            $this->edit($idCategoria);
        } else {
            $datos = [
                "nombre" => $nombre,
            ];
            if ($this->Categorias_model->update($idCategoria, $datos)) {
                //$this->session->set_flashdata("msg_success","La informacion de la categoria  ".$name." se actualizo correctamente");
                redirect(base_url() . "backend/categorias");
            } else {
                //$this->session->set_flashdata("msg_error","La informacion de la categoria ".$name." no pudo actualizarse");
                redirect(base_url() . "backend/categorias/edit/" . $idCategoria);
            }
        }

    }

    public function delete($idCategoria)
    {
        if ($this->Categorias_model->delete($idCategoria)) {
            //$this->session->set_flashdata("msg_success","La categoria se elimino correctamente");
            echo "categorias";
        } else {
            //$this->session->set_flashdata("msg_error","No se pudo eliminar la categoria");
            redirect(base_url() . "backend/categorias");
        }
    }

}
