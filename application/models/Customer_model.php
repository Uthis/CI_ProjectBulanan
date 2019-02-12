<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Customer_model extends CI_Model
{
    private $_table = "Customer";

    public $Customer_id;
    public $Customer_name;
    public $Customer_address;

    public function rules()
    {
        return [
            ['field' => 'Customer_name',
            'label' => 'Customer_name',
            'rules' => 'required'],

            ['field' => 'Customer_address',
            'label' => 'Customer_address',
            'rules' => 'required']
        ];
    }

    public function getAll()
    {
        return $this->db->get($this->_table)->result();
    }
    
    public function getById($id)
    {
        return $this->db->get_where($this->_table, ["Customer_id" => $id])->row();
    }

    public function save()
    {
        $post = $this->input->post();
        $this->Customer_name = $post["Customer_name"];
        $this->Customer_address = $post["Customer_address"];
        $this->db->insert($this->_table, $this);
    }

    public function update()
    {
        $post = $this->input->post();
        $this->Customer_name = $post["Customer_name"];
        $this->Customer_address = $post["Customer_address"];
        $this->db->update($this->_table, $this, array('Customer_id' => $post['id']));
    }

    public function delete($id)
    {
        return $this->db->delete($this->_table, array("Customer_id" => $id));
    }
}
