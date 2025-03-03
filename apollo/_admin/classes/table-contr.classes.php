<?php

class TableContr extends Table {
    private $tablekind;

    public function __construct($tablekind){
        $this->tablekind = $tablekind;
    }


   public function addNewTable(){
    //Logic to insert new record into the database
    if(empty($this->tablekind)){
        echo 'Name field cant be emtpy!';
        return;
    }
    $this->setTable($this->tablekind);
   }

//    public function updatetablekind($kind_id){
//     //logtic to update an record
//     if(empty($kind_id) || empty($this->tablekind)){
//         echo'ID and name field cant be empty';
//         return;
//     }
//     $this-updatetablekind($kind_id, $this->tablekind);
//    }
}
