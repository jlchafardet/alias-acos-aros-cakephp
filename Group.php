<?php

class Group extends AppModel {

	// Display field HAS to be set, you can decide which "field" on your User table is to be used.
	// If the display field is not set, the script will not work.
	public $displayField = 'group_name';

	// If you have a beforeSave function, add this below it.
	function afterSave(){
        $saveAro = false;
        if ($this->getLastInsertID()){
            $saveAro = true;
            $insertId = $this->getLastInsertID();
        }else{
            if ($this->data[$this->name]['id']){
                $saveAro = true;
                $insertId = $this->data[$this->name]['id'];
            }
        }
        if ($saveAro == true){
                $aroRecord = $this->Aro->find('first', array('conditions' => array('foreign_key' => $insertId, 'model' => $this->name)));
                $aroRecord['Aro']['alias'] = $this->name . '::' . $this->data[$this->name][$this->displayField];
                $this->Aro->save($aroRecord);
        }
    }

    // rest of your code below here.

}