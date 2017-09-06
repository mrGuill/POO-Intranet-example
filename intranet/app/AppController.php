<?php

namespace App;
use \Core\Config;
use \Core\Database\Database;

// AppController fait office de factory pour notre application.

class AppController{

	private $dbInstance;
	private static $_instance;

	public static function getInstance(){
		if(self::$_instance === null){
			self::$_instance = new AppController;
		}
		return self::$_instance;
	}

	public function getDb(){
		if($this->dbInstance === null){
			$settings = Config::getInstance();
			$dbInstance = new Database($settings);
			$this->dbInstance = $dbInstance->getConnection();
		}
		return $this->dbInstance;
	}

	// Permet de créer une instance d'une table pré-définie
	public function getTable($tableName){
		$tableName = '\App\Table\\' . ucfirst($tableName) . 'Table';
		var_dump($tableName);
		return new $tableName($this->getDb());
	}
}

?>