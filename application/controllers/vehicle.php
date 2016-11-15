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
}
