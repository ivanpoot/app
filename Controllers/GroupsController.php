<?php
/**
 * Clase Group
 * 
 * Clase para el manejo de los grupos
 * @author  Cristian Bernal <crisbera@gmail.com>
 */ 

class Group extends AppController{

	/**
	 * Metodo index
	 * 
	 * Metodo que sirve para listar los grupos
	 * @return  void no regresa ningún valor
	 */
	public function index(){
		$groups = $this->Group->find("groups", "all");

		$this->set("groups", $groups);
	}

	public function add(){
		if($_POST){
			if ($this->Group->save("groups", $_POST)){
				$this->redirect(array("controller"=>"groups", "action"=>"index"));
			}else{
				$this->redirect(array("controller"=>"groups", "action"=>"add"));		
			}
		}
	}

	public function edit($id = null){
		if($_POST){
			if ($this->Group->update("groups", $_POST)){
				$this->redirect(array("controller"=>"groups", "action"=>"index"));	
			}else{
				$this->redirect(array("controller"=>"groups", "action"=>"edit"));
			}	
		}else{

			if(!isset($id)){
				$this->redirect(array("controller"=>"groups", "action"=>"index"));
			}

			$group = $this->Group->find("groups", "first", 
				array("conditions"=>"id=$id")
			);

			if(empty($group)){
				$this->redirect(array("controller"=>"groups", "action"=>"index"));
			}

			$this->set("group", $group);
		} //End else

	}
}
