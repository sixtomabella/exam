<?php
/**
 * User: Sixto Abella
 * Date: 11/15/2016
 * Time: 5:31 PM
 * class descrption
 * - model for retrieving, adding, updating, deleting info of vehicle list
 */

class vehiclemodel extends CI_Model {

    /**
     * initialize variables
     */

    private $ui = "";
    private $name = "";
    private $engine_displacement = "";
    private $engine_power = "";

    /**
     * create setters
     */

    public function SetUI($var){
        $this->ui = $var;
    }

    public function SetName($var){
        $this->name = $var;
    }

    public function SetEngineDisplacement($var){
        $this->engine_displacement = $var;
    }

    public function SetEnginePower($var){
        $this->engine_power = $var;
    }

    /**
     * create getters
     */

    public function GetUI(){
        return $this->ui;
    }

    public function GetName($var){
        return $this->name;
    }

    public function GetEngineDisplacement(){
        return $this->engine_displacement;
    }

    public function GetEnginePower($var){
        return $this->engine_power ;
    }

    public function FetchData($var=''){

    }

    public function AddData(){

        if($this->Validatedata(adddata) != false){
            $data = array('vehiclename' => $this->name, 'enginedisplacement' => $this->engine_displacement, 'unit' => $this->ui, 'enginepower' => $this->engine_power);
            $str = $this->db->insert_string('vehicleinformation', $data);

        }

    }

    public function UpdateData(){

    }

    public function DelData($var){

    }

    public function Validatedata($type){
        $val = false;
        switch($type){
            case 'adddata':
                break;
            case 'update':
                break;
            case 'deldata':
                break;
        }
        return $val;
    }
} 