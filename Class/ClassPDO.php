<?php
/**
 * Archivo de clase de conexion PDO
 *
 * Clase que permite acciones CRUD usando PDO
 *
 * PHP version 5
 *
 * LICENSE: This source file is subject to version 3.01 of the PHP license
 * that is available through the world-wide-web at the following URI:
 * http://www.php.net/license/3_01.txt.  If you did not receive a copy of
 * the PHP License and are unable to obtain it through the web, please
 * send a note to license@php.net so we can mail you a copy immediately.
 *
 * @package    PDO
 * @author     Cristian Bernal <crisbera@gmail.com.com>
 * @author     Juan Perez <juan@gmail.com>
 * @copyright  1997-2005 The PHP Group
 * @license    http://www.php.net/license/3_01.txt  PHP License 3.01
 * @version    SVN: $Id$
 * @link       http://pear.php.net/package/PackageName
 * @see        NetOther, Net_Sample::Net_Sample()
 * @since      File available since Release 1.2.0
 * @deprecated File deprecated in Release 2.0.0
 */

class ClassPDO{
	private $connection;
	private $dsn;
	private $username;
	private $password;

/**
  * Constructor de la clase
  * @return void
  */
	public function __construct(){
		$this->dsn = 'mysql:host=127.0.0.1;dbname=test';
		$this->username = 'root';
		$this->password = 'ivanpoot';
		$this->connection();
	}

/**
  * Méto de conexión a la base de datos.
  *
  * Método que permite establecer una conexión a la base de datos
  *
  * @return void
  */
	private function connection(){
		try{
			$this->connection = new PDO(
				$this->dsn,
				$this->username,
				$this->password
			);
			$this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		}catch(PDOException $e){
			echo "ERROR: " . $e->getMessage();
			die();
		}		
	}

/**
  * Método find
  *
  * Método que sirve para hacer consultas a la base de datos
  *
  * @param string $table nombe de la tabla a consultar
  * @param string $query tipo de consulta
  *  - all
  *  - first
  *  - count
  * @param array $options restriciones en la consulta
  *  - fields
  *  - conditions
  *  - group
  *  - order
  *  - limit
  * @return object
  */
	public function find($table = null, $query = null, $options = array()){
		$fields = '*';
		$parameters = '';

		if(!empty($options['fields'])){
			$fields  = $options['fields'];
		}

		if(!empty($options['conditions'])){
			$parameters = ' WHERE '.$options['conditions'];
		}

		if(!empty($options['group'])){
			$parameters  .= ' GROUP BY '.$options['group'];
		}		

		if(!empty($options['order'])){
			$parameters  .= ' ORDER BY '.$options['order'];
		}

		if(!empty($options['limit'])){
			$parameters  .= ' LIMIT '.$options['limit'];
		}

		switch ($query) {
			case 'all':{
				$sql = "SELECT $fields FROM ".$table.' '.$parameters;
				$this->result = $this->connection->query($sql);
				break;
			}
			case 'count':{
				$sql = "SELECT COUNT(*) FROM ".$table.' '.$parameters;
				$result = $this->connection->query($sql);
				$this->result = $result->fetchColumn();
				break;
			}
			case 'first':{
				$sql = "SELECT $fields FROM ".$table.' '.$parameters;
				$result = $this->connection->query($sql);
				$this->result = $result->fetch();
				break;
			}
			
			default:
				$sql = "SELECT $fields FROM ".$table.' '.$parameters;
				$this->result = $this->connection->query($sql);
				break;
		}

		return $this->result;

	}
/**
 * 
 * 
 * */


	/**
	 * Metodo save 
	 * 
	 * Metodo que sirve para guardar registros
	 * 
	 * @param  $table tabla a consultar
	 * @param  $data valores a guardar
	 * @return object
	 * @author Cristian Bernal <crisbera@gmail.com>
	 */

	public function save($table = null, $data = array()){
		$sql = "SELECT * FROM $table";
		$result = $this->connection->query($sql);

		for ($i=0; $i < $result->columnCount(); $i++) { 
			$meta = $result->getColumnMeta($i);
			$fields[$meta['name']]=null;
		}

		$fieldsToSave="id";
		$valueToSave="NULL";

		foreach ($data as $key => $value) {
			if(array_key_exists($key, $fields)){
				$fieldsToSave .= ", ".$key;
				$valueToSave  .= ", "."\"$value\""; 
			}
		}

		$sql = "INSERT INTO $table ($fieldsToSave)VALUES($valueToSave);";

		$this->result = $this->connection->query($sql);

		return $this->result;
	}

	public function update($table = null, $data = array()){
		$sql = "SELECT * FROM $table";
		$result = $this->connection->query($sql);

		for ($i=0; $i < $result->columnCount(); $i++) { 
			$meta = $result->getColumnMeta($i);
			$fields[$meta['name']]=null;
		}		

		if(array_key_exists("id", $data)){
			//Update
			$fieldsToSave = "";
			$id = $data["id"];
			unset($data["id"]);
			$i = 0;

			foreach ($data as $key => $value) {
				if(array_key_exists($key, $fields)){
					if($i==0){
						$fieldsToSave .= $key."="."\"$value\", ";
					}elseif($i == count($data)-1){
						$fieldsToSave .= $key."="."\"$value\"";
					}else{
						$fieldsToSave .= $key."="."\"$value\", ";
					}
				}
				$i++;
			}

			$sql = "UPDATE $table SET $fieldsToSave WHERE $table.id =$id;";
		}
		$this->result = $this->connection->query($sql);

		return $this->result;		
	}

	public function delete(){

	}

	public function getLastId(){
		
	}

}

$db = new ClassPDO();