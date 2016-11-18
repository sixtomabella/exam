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
        $data = array();
        $result_count = $this->vmodel->FetchData();

     //$this->Dump($data);
      $data['jsondata'] = json_encode( $result_count );
      $this->load->view('json_view', $data);
    }

    public function Add()
    {

        $cleaneddata = $_POST;

        $this->vmodel->SetUI($cleaneddata['ui']);
        $this->vmodel->SetName($cleaneddata['vehiclename']);
        $this->vmodel->SetEngineDisplacement($cleaneddata['enginedisplacement']);
        $this->vmodel->SetEnginePower($cleaneddata['enginepower']);
        $data['jsondata'] = $this->vmodel->AddData();
        $this->load->view('json_view', $data);
    }
    public function Update(){


        $cleaneddata = $_POST;

        $this->vmodel->SetId($cleaneddata['id']);
        $this->vmodel->SetUI($cleaneddata['ui']);
        $this->vmodel->SetName($cleaneddata['vehiclename']);
        $this->vmodel->SetEngineDisplacement($cleaneddata['enginedisplacement']);
        $this->vmodel->SetEnginePower($cleaneddata['enginepower']);
        $data['jsondata'] = $this->vmodel->UpdateData();
        $this->load->view('json_view', $data);

    }

    public function Delete(){
        $_POST['id'] = 2;
        $cleaneddata = $_POST;
        $this->vmodel->SetId($cleaneddata['id']);
        $data['jsondata'] = $this->vmodel->DelData();
        $this->load->view('json_view', $data);
    }

    private function CleanInput($var){
        $result = array();
        foreach($var as $key => $value){
            $result[$key] = $this->security->xss_clean($value);
        }
        return $result;
    }


    public function Test(){

       // $this->output->enable_profiler(TRUE);
    }


    private  function  Dump($var){
        echo "<pre>";
        var_dump($var);
        echo "</pre>";
    }
}
