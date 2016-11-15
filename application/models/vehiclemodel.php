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

    private  $id = '';
    private $ui = "";
    private $name = "";
    private $engine_displacement = "";
    private $engine_power = "";

    /**
     * create setters
     */


    public function SetId($var){
        $this->id = $var;
    }

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

    public function GetId(){
        return $this->id;
    }

    public function GetUI(){
        return $this->ui;
    }

    public function GetName(){
        return $this->name;
    }

    public function GetEngineDisplacement(){
        return $this->engine_displacement;
    }

    public function GetEnginePower(){
        return $this->engine_power ;
    }

    public function FetchData(){
        $this->db->select('*');
        $this->db->from('vehicleview');
        if($this->GetId() != ''){
            $this->db->where('name', $this->GetId());
        }
        if($this->GetUI() != ''){
            $this->db->where('idtype_name', $this->GetId());
        }

        if($this->GetName() != ''){
            $this->db->where('vehiclename', $this->GetName());
        }

        if($this->GetEngineDisplacement() != ''){
            $this->db->where('enginedisplacement', $this->GetEngineDisplacement());
        }

        if($this->GetEnginePower() != ''){
            $this->db-t>where('enginepower', $this->GetEnginePower());
        }

        $query = $this->db->get();

        return $query->result();
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

    public function UpdateData(){
        if($this->Validatedata(update) != false){
            $data = array('vehiclename' => $this->name, 'enginedisplacement' => $this->engine_displacement, 'unit' => $this->ui, 'enginepower' => $this->engine_power);
            $this->db->where('id', $this->id);
            $this->db->update('vehiclename', $data);
            $value = array('id' => $this->id, 'vehiclename' => $this->name, 'enginedisplacement' => $this->engine_displacement, 'unit' => $this->ui, 'enginepower' => $this->engine_power, 'status' => 1);
        }
        else{
            $value = array('id' => $this->id, 'vehiclename' => $this->name, 'enginedisplacement' => $this->engine_displacement, 'unit' => $this->ui, 'enginepower' => $this->engine_power, 'status' => 0);
        }
    }

    public function DelData($var){
        $data = array('deldata' => 1);
        $this->db->where('id', $this->id);
        $this->db->update('vehiclename', $data);

        return true;
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
                $array = array('id'=> $this->id, 'vehiclename' => $this->name, 'enginedisplacement' => $this->engine_displacement, 'unit' => $this->ui, 'enginepower' => $this->engine_power);
                $this->db->select('*');
                $this->db->from('vehicleinformation');
                $this->db->where($array);
                $query = $this->db->get();

                if(count($query->result()) == 0){
                    $val = true;
                }
                break;
            case 'deldata':
                break;
        }
        return $val;
    }
}

/*function literstocid(form) {
    checkIsNumb(form);

    if (form.lit.value.toString()>"") {
        form.cid.value = Math.round((form.lit.value.toString() * 61.0237441)*10)/10;
        form.ccs.value = Math.round((form.lit.value.toString() * 1000)*10)/10;
        return;
    }

    if (form.cid.value.toString()>"") {
        form.lit.value = Math.round((form.cid.value.toString() / 61.0237441)*10)/10;
        form.ccs.value = Math.round((form.lit.value.toString() * 1000)*10)/10;
        return;
    }

    if (form.ccs.value.toString()>"") {
        form.lit.value = Math.round((form.ccs.value.toString() / 1000)*10)/10;
        form.cid.value = Math.round((form.lit.value.toString() * 61.0237441)*10)/10;
        return;
    }
}*/
