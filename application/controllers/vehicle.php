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

    public function Fetch($id=''){
        $this->vmodel->FetchData();
    }

    public function Add()
    {

    }
    public function Update(){

    }

    public function Delete($id){

    }

    private function CleanInput($var){

    }

    public function Test(){

        $array = array('vehiclename' => 'abc', 'enginedisplacement' => '200', 'unit' => '1', 'enginepower' => '200');
        $this->db->select('*');
        $this->db->from('vehicleinformation');
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
