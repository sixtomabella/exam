<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Vehicle extends CI_Controller {


    function __construct() {
        parent::__construct();
        $this->load->model('vehiclemodel','vmodel');
    }

    public function index()
    {
        $this->fetch();
    }

    public function Fetch(){
      $cleaneddata = $_POST;
      json_encode($this->vmodel->FetchData());
    }

    public function Add()
    {
        $cleaneddata = $_POST;
    }
    public function Update(){
        $cleaneddata = $_POST;
    }

    public function Delete($id){

    }

    private function CleanInput($var){
        $result = array();
        foreach($var as $key => $value){
            $result[$key] = $this->security->xss_clean($value);
        }
        return $result;
    }

    private  function Compute($var){

    }

    public function Test(){

        $array = array('vehiclename' => 'abc', 'enginedisplacement' => '200', 'idtype_name' => 1, 'enginepower' => '200');
        $this->db->select('*');
        $this->db->from('vehicleview');
        $this->db->where($array);
        $query = $this->db->get();

        $this->Dump(count($query->result()));



        $this->output->enable_profiler(TRUE);
    }


    private  function  Dump($var){
        echo "<pre>";
        var_dump($var);
        echo "</pre>";
    }
}
