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
        $dataresult = array();
        $this->db->select('*');
        $this->db->from('vehicleview');

        $query = $this->db->get();
        $data= $query->result_array();
        for($i = 0; $i <= count($data)-1; $i++) {
            $dataresult[$i]["id"] =  $data[$i]['id'];
            $dataresult[$i]["vehiclename"] =  $data[$i]['vehiclename'];
            $dataresult[$i]["enginepower"] =  $data[$i]['enginepower'];

            switch($data[$i]['idtype_name']){

                case "1":
                    $dataresult[$i]['Liter'] = $data[$i]['enginedisplacement'];
                    $dataresult[$i]['CubicInch'] =  round((($data[$i]['enginedisplacement'] * 61.0237441)*10)/10,2);
                    $dataresult[$i]['CubicCen'] =  round((($data[$i]['enginedisplacement'] * 1000)*10)/10,2);
                    break;
                case "2":
                    $dataresult[$i]['Liter'] = round((($data[$i]['enginedisplacement'] / 61.0237441)*10)/10,2);
                    $dataresult[$i]['CubicInch'] =  $data[$i]['enginedisplacement'];
                    $dataresult[$i]['CubicCen'] =  round((($data[$i]['enginedisplacement'] * 1000)*10)/10,2);
                    break;
                case "3":
                    $dataresult[$i]['Liter'] =  round((($data[$i]['enginedisplacement'] * 1000)*10)/10,2);
                    $dataresult[$i]['CubicInch'] = round((($data[$i]['enginedisplacement'] / 61.0237441)*10)/10,2);
                    $dataresult[$i]['CubicCen'] =  $data[$i]['enginedisplacement'];
                    break;
            }
        }


        return $dataresult;
    }

    public function AddData(){
        $value = "";
        $v = $this->Validatedata("adddata");



        if($v == "1"){

           $data = array('vehiclename' => $this->name, 'enginedisplacement' => $this->engine_displacement, 'unit' => $this->ui, 'enginepower' => $this->engine_power);
           $this->db->insert('vehicleinformation', $data);
           $value = array('vehiclename' => $this->name, 'enginedisplacement' => $this->engine_displacement, 'unit' => $this->ui, 'enginepower' => $this->engine_power, 'status' => 1);
        }
        else{
           $value = array('vehiclename' => $this->name, 'enginedisplacement' => $this->engine_displacement, 'unit' => $this->ui, 'enginepower' => $this->engine_power, 'status' => 0);
        }
        $this->output->enable_profiler(TRUE);
        return $value;
    }

    public function UpdateData(){
        $value = "";
        $v = $this->Validatedata("update");
        if($v == 1){
            $data = array('vehiclename' => $this->name, 'enginedisplacement' => $this->engine_displacement, 'unit' => $this->ui, 'enginepower' => $this->engine_power);
            $this->db->where('id', $this->id);
            $this->db->update('vehicleinformation', $data);
            $value = array('id' => $this->id, 'vehiclename' => $this->name, 'enginedisplacement' => $this->engine_displacement, 'unit' => $this->ui, 'enginepower' => $this->engine_power, 'status' => 1);
        }
        else{
            $value = array('id' => $this->id, 'vehiclename' => $this->name, 'enginedisplacement' => $this->engine_displacement, 'unit' => $this->ui, 'enginepower' => $this->engine_power, 'status' => 0);
        }

        return $value;
    }

    public function DelData(){
        $data = array('deldata' => 1);
        $this->db->where('id', $this->id);
        $this->db->update('vehicleinformation', $data);

        return true;
    }

    public function Validatedata($type){
        $val = 2;
        switch($type){
            case 'adddata':
                $array = array('vehiclename' => $this->name, 'enginedisplacement' => $this->engine_displacement, 'unit' => $this->ui, 'enginepower' => $this->engine_power);
                $this->db->select('*');
                $this->db->from('vehicleinformation');
                $this->db->where($array);
                $query = $this->db->get();

                if(count($query->result_array()) == 0){
                    $val = 1;
                }

                break;
            case 'update':
                $array = array('id'=> $this->id, 'vehiclename' => $this->name, 'enginedisplacement' => $this->engine_displacement, 'unit' => $this->ui, 'enginepower' => $this->engine_power);
                $this->db->select('*');
                $this->db->from('vehicleinformation');
                $this->db->where($array);
                $query = $this->db->get();

                if(count($query->result_array()) == 0){
                    $val = 1;
                }
                break;
            case 'deldata':
                break;
        }
        return $val;
    }
}

/*function literstocid(form) {
    checkIsNumb(form);.co

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
