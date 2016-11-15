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
        $value = "";
        if($this->Validatedata(adddata) != false){
           $data = array('vehiclename' => $this->name, 'enginedisplacement' => $this->engine_displacement, 'unit' => $this->ui, 'enginepower' => $this->engine_power);
           $this->db->insert_string('vehicleinformation', $data);
           $value = array('vehiclename' => $this->name, 'enginedisplacement' => $this->engine_displacement, 'unit' => $this->ui, 'enginepower' => $this->engine_power, 'status' => 1);

        }
        else{
           $value = array('vehiclename' => $this->name, 'enginedisplacement' => $this->engine_displacement, 'unit' => $this->ui, 'enginepower' => $this->engine_power, 'status' => 0);
        }

        return $value;
    }

    public function UpdateData($var = array()){

    }

    public function DelData($var){

    }

    public function Validatedata($type){
        $val = false;
        switch($type){
            case 'adddata':
                $array = array('vehiclename' => $this->name, 'enginedisplacement' => $this->engine_displacement, 'unit' => $this->ui, 'enginepower' => $this->engine_power);
                $this->db->select('*');
                $this->db->from('vehicleinformation');
                $this->db->where($array);
                $query = $this->db->get();

                if(count($query->result()) == 0){
                    $val = true;
                }

                break;
            case 'update':
                break;
            case 'deldata':
                break;
        }
        return $val;
    }
} 