<?php

class TableKindContr extends TableKind {
    private $kindof;

    public function __construct($kindof){
        $this->kindof = $kindof;
    }


   public function addNewKindOf(){
    //Logic to insert new record into the database
    if(empty($this->kindof)){
        echo 'Name field cant be emtpy!';
        return;
    }
    $this->setKindof($this->kindof);
   }

//    public function updateKindof($kind_id){
//     //logtic to update an record
//     if(empty($kind_id) || empty($this->kindof)){
//         echo'ID and name field cant be empty';
//         return;
//     }
//     $this-updateKindof($kind_id, $this->kindof);
//    }
}
