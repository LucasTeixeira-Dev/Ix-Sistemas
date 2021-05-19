<?php

	class Mesa {
		var $idMesa;
		var $descricao;
		var $idUsuario;

		function getIdMesa(){
			return $this->idMesa;
		}
		function setIdMesa($idMesa){
			$this->idMesa = $idMesa;
		}

		function getDescricao(){
			return $this->descricao;
		}
		function setDescricao($descricao){
			$this->descricao = $descricao;
		}

		function getIdUsuario(){
			return $this->idUsuario;
		}
		function setIdUsuario($idUsuario){
			$this->idUsuario = $idUsuario;
		}
	}

	class MesaDAO {
		function create($mesa) {
			$result = array();
			$descricao = $mesa->getDescricao();
			$idUsuario = $mesa->getIdUsuario();
			$query = "INSERT INTO mesa VALUES (DEFAULT, '$descricao', '$idUsuario')";
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

		function read($idMesa) {
			$result = array();
			$query = "SELECT * FROM mesa WHERE idMesa = '$idMesa'";
			try {
				
				$con = new Connection();
				$resultSet = Connection::getInstance()->query($query);
				if($resultSet){
				while($row = $resultSet->fetchObject()){
					$mesa = new Mesa();
					$mesa->setIdMesa($row->id_mesa);
					$mesa->setDescricao($row->descricao);
					$mesa->setIdUsuario($row->idusuario);
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
					$mesa->setIdMesa($row->id_mesa);
					$mesa->setDescricao($row->descricao);
					$mesa->setIdUsuario($row->id_usuario);
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
			$idMesa = $mesa->getIdMesa();
			$descricao = $mesa->getDescricao();
			$idUsuario = $mesa->getIdUsuario();
			$query = "UPDATE mesa SET descricao = '$descricao', idUsuario = '$idUsuario' WHERE idMesa = $idMesa";
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
			$query = "DELETE FROM mesa WHERE idMesa = '$idMesa'";
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
	}
