<?php 

//extende da classe pdo pois agora tudo o que o PDO faz a classe Sql faz também.
class Sql extends PDO{

	private $conn;

//Usou o __construct para conectar altomaticamente, basta fazer um new sql que vai conectar altomaticamnete.

	public function __construct(){

		$this->conn = new PDO("mysql:host=localhost;dbname=dbphp7", "root","");

	}



	private function setParams($statment, $parameters = array()){

		foreach ($parameters as $key => $value) {

			$this->setParam($key, $value);

		}

	}


	private function setParam($statment, $key, $value){

		$statment->bindParam($key, $value);

	}

	//passo a passo para conversar com o banco de dados. A query está recebendo dois parametros, é array pois os dados serão atribuidos a ele. O $stmt não começa com $this pois será uma variavel que vai funcionar apenas no metodo query

	public function query($rawQuery, $params = array()){

		$stmt = $this->conn->prepare($rawQuery);

		$this->setParams($stmt, $params);

		$stmt->execute();

		return $stmt;

	}


	public function select($rawQuery, $params = array()):array {

		$stmt=$this->query($rawQuery, $params);

		return $stmt->fetchAll(PDO::FETCH_ASSOC);

	}

}


 ?>