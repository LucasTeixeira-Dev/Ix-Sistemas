<?php
// 000webHost
class Mesa {
	var $id_mesa;
	var $descricao;
	var $id_usuario;

	function getId_mesa(){
		return $this->id_mesa;
	}
	function setId_mesa($id_mesa){
		$this->id_mesa = $id_mesa;
	}

	function getDescricao(){
		return $this->descricao;
	}
	function setDescricao($descricao){
		$this->descricao = $descricao;
	}

	function getId_usuario(){
		return $this->id_usuario;
	}
	function setId_usuario($id_usuario){
		$this->id_usuario = $id_usuario;
	}
}

class MesaDAO {
	function create($mesa) {
		$result = array();
		
		$descricao = $mesa->getDescricao();
		$id_usuario = $mesa->getId_usuario();
		
		try {
			$query = "INSERT INTO mesa (descricao, id_usuario) VALUES ('$descricao', '$id_usuario')";
			
			$con = new Connection();
			
			if(Connection::getInstance()->exec($query) >= 1){
				$result["id_mesa"] = Connection::getInstance()->lastInsertId();
				$result["status"] = "SUCESSO";
			} else {
				$result["status"] = "ERRO";
			}

			$con = null;
		}catch(PDOException $e) {
			$result["status"] = "PDO".$e->getCode();
		}

		return $result;
	}

	function read($id_mesa) {
		$result = array();
		
		try {
			if($id_mesa == 0){
				$cond = "";
			}else{
				$cond = "WHERE id_mesa = $id_mesa";
			}
			
			$query = "SELECT * FROM mesa" . $cond;
			
			$con = new Connection();
			
			$resultSet = Connection::getInstance()->query($query);
			
			while($row = $resultSet->fetchObject()){
				$result[] = $row;
			}
			$con = null;
		}catch(PDOException $e) {
			$result["status"] = "PDO".$e->getCode();
		}

		return $result;
	}

	function update($m) {
		$result = array();
		
		$id_mesa = $m->getId_mesa();
		$descricao = $m->getDescricao();
		$id_usuario = $m->getId_usuario();
		
		try {
			$query = "UPDATE mesa SET descricao = '$descricao',
									  id_usuario = '$id_usuario'
									  WHERE id_mesa = $id_mesa";
									  
			$con = new Connection();
			
			$status = Connection::getInstance()->prepare($query);
			
			if($status->execute()){
				$result["status"] = "SUCESSO";
			} else {
				$result["status"] = "ERRO";
			}

			$con = null;
		}catch(PDOException $e) {
			$result["status"] = "PDO".$e->getCode();
		}

		return $result;
	}

	function delete($id_mesa) {
		$result = array();
		
		try {
			$query = "DELETE FROM mesa WHERE id_mesa = '$id_mesa'";
			$con = new Connection();
			if(Connection::getInstance()->exec($query) >= 1){
				$result["status"] = "SUCESSO";
			} else {
				$result["status"] = "ERRO";
			}

			$con = null;
		}catch(PDOException $e) {
			$result["status"] = "PDO".$e->getCode();
		}

		return $result;
	}
}

	/* Local
	class Mesa {
		var $id_mesa;
		var $descricao;
		var $id_usuario;

		function getId_mesa(){
			return $this->id_mesa;
		}
		function setId_mesa($id_mesa){
			$this->id_mesa = $id_mesa;
		}

		function getDescricao(){
			return $this->descricao;
		}
		function setDescricao($descricao){
			$this->descricao = $descricao;
		}

		function getId_usuario(){
			return $this->id_usuario;
		}
		function setId_usuario($id_usuario){
			$this->id_usuario = $id_usuario;
		}
	}

	class MesaDAO {
		function create($mesa) {
			$result = array();
			$descricao = $mesa->getDescricao();
			$id_msuario = $mesa->getId_usuario();
			$query = "INSERT INTO mesa VALUES (DEFAULT, '$descricao', '$id_usuario')";
			try {
				
				$con = new Connection();
				if(Connection::getInstance()->exec($query) >= 1){
					$result = $mesa;
				} else {
					$result["err"] = "Erro ao criar mesa";
				}

				$con = null;
			}catch(PDOException $e) {
				$result["error"] = $e->getMessage();
			}

			return $result;
		}

		function read($id_mesa) {
			$result = array();
			$query = "SELECT * FROM mesa WHERE id_mesa = '$id_mesa'";
			try {
				
				$con = new Connection();
				$resultSet = Connection::getInstance()->query($query);
				if($resultSet){
				while($row = $resultSet->fetchObject()){
					$mesa = new Mesa();
					$mesa->setId_mesa($row->id_mesa);
					$mesa->setDescricao($row->descricao);
					$mesa->setId_usuario($row->id_usuario);
					$result[] = $mesa;
				}
			}
				$con = null;
			}catch(PDOException $e) {
				$result["error"] = $e->getMessage();
			}

			return $result;
		}

		function readAll() {
			$result = array();
			$query = "SELECT * FROM mesa";
			try {
				
				$con = new Connection();
				$resultSet = Connection::getInstance()->query($query);
				while($row = $resultSet->fetchObject()){
					$mesa = new Mesa();
					$mesa->setId_mesa($row->id_mesa);
					$mesa->setDescricao($row->descricao);
					$mesa->setId_usuario($row->id_usuario);
					$result[] = $mesa;
				}

				$con = null;
			}catch(PDOException $e) {
				$result["error"] = $e->getMessage();
			}

			return $result;
		}

		function update($mesa) {
			$result = array();
			$id_mesa = $mesa->getId_mesa();
			$descricao = $mesa->getDescricao();
			$id_usuario = $mesa->getId_usuario();
			$query = "UPDATE mesa SET descricao = '$descricao', id_usuario = '$id_usuario' WHERE idMesa = $idMesa";
			try {
				
				$con = new Connection();
				$status = Connection::getInstance()->prepare($query);
				if($status->execute()){
					$result[] = $mesa;
				} else {
					$result["err"] = "Não foi possivel atualizar os dados";
				}

				$con = null;
			}catch(PDOException $e) {
				$result["error"] = $e->getMessage();
			}

			return $result;
		}

		function delete($idMesa) {
			$result = array();
			$query = "DELETE FROM mesa WHERE idMesa = '$id_mesa'";
			try {
				
				$con = new Connection();
				if(Connection::getInstance()->exec($query) >= 1){
					$result["msg"] = "Mesa excluida com sucesso";
				} else {
					$result["err"] = "Mesa nao excluida";
				}

				$con = null;
			}catch(PDOException $e) {
				$result["error"] = $e->getMessage();
			}

			return $result;
		}
	}*/