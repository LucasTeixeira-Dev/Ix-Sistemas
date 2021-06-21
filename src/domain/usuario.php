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
		//DAO 000webHost
		function create($usuario) {
			$result = array();
			
			$login = $usuario->getLogin();
			$senha = $usuario->getSenha();
			$tipo = $usuario->getTipo();
			
			try {
                $query = "INSERT INTO usuario (login, senha, tipo) VALUES ('$login', md5('$senha'), '$tipo')";
                
				$con = new Connection();
				if(Connection::getInstance()->exec($query) >= 1){
					$result["id_usuario"] = Connection::getInstance()->lastInsertId();
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

		function read($id_usuario) {
			$result = array();
			
			try {
			    if($id_usuario == 0){
			        $cond = "";
			    }else{
			        $cond = " WHERE id_usuario = $id_usuario";
			    }
				$query = "SELECT * FROM usuario" . $cond;
				
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

		function readLogin($login,$senha) {
			$result = array();
			
			try {
			
		        $cond = " WHERE login = '$login' and senha = md5('$senha')";
			    
				$query = "SELECT * FROM usuario" . $cond;
				
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

		function update($u) {
			$result = array();
			
			$id_usuario = $u->getId_usuario();
			$login = $u->getLogin();
			$senha = $u->getSenha();
			$tipo = $u->getTipo();
			
		
			try {
	            $query = "UPDATE usuario SET login = '$login',
	                                         senha = '$senha',
	                                         tipo = '$tipo' 
	                                         WHERE id_usuario = $id_usuario";
	                                         
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

		function delete($id_usuario) {
			$result = array();
			
			$query = "DELETE FROM usuario WHERE id_usuario = '$id_usuario'";
			try {
				
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

		/* DAO Local
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
					$usuario->setIdUsuario($row->id_usuario);
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
					$usuario->setIdUsuario($row->id_usuario);
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
	}*/