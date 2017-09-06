<?php

// Cette classe ne sera quasiement jamais instanciée, seul ses enfants le seront.

namespace Core\Table;

class Table{

	protected $tableName;
	protected $dbInstance;

	public function __construct($dbInstance){
		// Récupération de l'instance $db via la factory.
		$this->dbInstance = $dbInstance;

		// Creation du nom de la table (appel des enfants).
		$tableName = get_class($this);
		// Explose une string en fonction d'un delimiter, retourne un array.
		$tableName = explode('\\', $tableName);
		// Retourne le dernier index d'un array.
		$tableName = end($tableName);
		$tableName = strtolower(str_replace('Table', '', $tableName));
		$this->tableName = $tableName;
	}

	// Permet de récupérer le nom de la table instanciée.
	public function getTableName(){
		return $this->tableName; 
	}

	// Permet de récupérer le contenu d'une table en entier.
	public function getAll(){
		$req = $this->dbInstance->query('SELECT * from ' . $this->tableName);
		$data = $req->fetchAll();
		return $data;
	}

	public function query($statement){
		$req = $this->dbInstance->query($statement);
		return $req->fetchAll();

	}

}


?>