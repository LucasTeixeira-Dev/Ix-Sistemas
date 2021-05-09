<?php

	class Usuario {
		var $idUsuario;
		var $login;
		var $senha;
		var $tipo;

		function getIdUsuario(){
			return $this->idUsuario;
		}
		function setIdUsuario($idUsuario){
			$this->idUsuario = $idUsuario;
		}

		function getLogin(){
			return $this->login;
		}
		function setLogin($login){
			$this->login = $login;
		}

		function getSenha(){
			return $this->senha;
		}
		function setSenha($senha){
			$this->senha = $senha;
		}

		function getTipo(){
			return $this->tipo;
		}
		function setTipo($tipo){
			$this->tipo = $tipo;
		}
	}

	class UsuarioDAO {
		function create($usuario) {
			$result = array();
			$login = $usuario->getLogin();
			$senha = $usuario->getSenha();
			$tipo = $usuario->getTipo();
			$query = "INSERT INTO usuario VALUES (DEFAULT, '$login', '$senha', '$tipo')";
			try {

				$con = new Connection();
				if(Connection::getInstance()->exec($query) >= 1){
					$result = $usuario;
				} else {
					$result["err"] = "Erro ao criar usuario";
				}

				$con = null;
			}catch(PDOException $e) {
				$result["error"] = $e->getMessage();
			}

			return $result;
		}

		function read($idUsuario) {
			$result = array();
			$query = "SELECT * FROM usuario WHERE idUsuario = '$idUsuario'";
			try {
				
				$con = new Connection();
				$resultSet = Connection::getInstance()->query($query);
				if($resultSet){
					while($row = $resultSet->fetchObject()){
					$usuario = new Usuario();
					$usuario->setIdUsuario($row->idusuario);
					$usuario->setLogin($row->login);
					$usuario->setSenha($row->senha);
					$usuario->setTipo($row->tipo);
					$result[] = $usuario;
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
			$query = "SELECT * FROM usuario";
			try {
				
				$con = new Connection();
				$resultSet = Connection::getInstance()->query($query);
					while($row = $resultSet->fetchObject()){
					$usuario = new Usuario();
					$usuario->setIdUsuario($row->idusuario);
					$usuario->setLogin($row->login);
					$usuario->setSenha($row->senha);
					$usuario->setTipo($row->tipo);
					$result[] = $usuario;
				}
			
				$con = null;
			}catch(PDOException $e) {
				$result["error"] = $e->getMessage();
			}

			return $result;
		}

		function update($usuario) {
			$result = array();
			$idUsuario = $usuario->getIdUsuario();
			$senha = $usuario->getSenha();
			$tipo = $usuario->getTipo();
			$query = "UPDATE usuario SET senha = '$senha', tipo = '$tipo' WHERE idUsuario = idUsuario";
			try {

				$con = new Connection();
				$status = Connection::getInstance()->prepare($query);
				if($status->execute()){
					$result[] = $usuario;
				} else {
					$result["err"] = "não foi possivel atualizar os dados";
				}

				$con = null;
			}catch(PDOException $e) {
				$result["error"] = $e->getMessage();
			}

			return $result;
		}

		function delete($idUsuario) {
			$result = array();
			$query = "DELETE FROM usuario WHERE idUsuario = '$idUsuario'";
			try {
				
				$con = new Connection();
				if(Connection::getInstance()->exec($query) >= 1){
					$result["msg"] = "Usuario excluido com sucesso";
				} else {
					$result["err"] = "Usuario não excluido";
				}

				$con = null;
			}catch(PDOException $e) {
				$result["error"] = $e->getMessage();
			}

			return $result;
		}
	}