<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Customers extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("Customer_model");
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data["Customers"] = $this->Customer_model->getAll();
        $this->load->view("admin/Customer/list", $data);
    }

    public function add()
    {
        $Customer = $this->Customer_model;
        $validation = $this->form_validation;
        $validation->set_rules($Customer->rules());

        if ($validation->run()) {
            $Customer->save();
            $this->session->set_flashdata('success', 'Berhasil disimpan');
            redirect('admin/Customers');
        }

        $this->load->view("admin/Customer/new_form");
    }

    public function edit($id = null)
    {
        if (!isset($id)) redirect('admin/Customers');
       
        $Customer = $this->Customer_model;
        $validation = $this->form_validation;
        $validation->set_rules($Customer->rules());

        if ($validation->run()) {
            $Customer->update();
            $this->session->set_flashdata('success', 'Berhasil disimpan');
            redirect('admin/Customers');
        }

        $data["Customer"] = $Customer->getById($id);
        if (!$data["Customer"]) show_404();
        
        $this->load->view("admin/Customer/edit_form", $data);
    }

    public function delete($id=null)
    {
        if (!isset($id)) show_404();
        
        if ($this->Customer_model->delete($id)) {
            redirect(site_url('admin/Customers'));
        }
    }
}
