<?php

	require("../../domain/connection.php");
	require("../../domain/usuario.php");

	class UsuarioProcess {
		//DAO 00webHost
		var $iu;
		var $u;

		function doGet($arr){
			if(isset($arr["id_usuario"])){
			    $iu = new UsuarioDAO();
				$result = $iu->read($arr["id_usuario"]);
			} else {
				$result["status"] = "ERRO-01";
			}
			http_response_code(200);
			echo json_encode($result);
		}

		function doPost($arr){
		if(isset($arr["verbo"])) {
				if($arr["verbo"] == "POST") {
					if(
						isset($arr["login"]) &&
						isset($arr["senha"]) &&
						isset($arr["tipo"])
					){//cadastro usuario
						$u = new Usuario();
						$u->setLogin($arr["login"]);
						$u->setSenha($arr["senha"]);
						$u->setTipo($arr["tipo"]);
		
						$iu = new UsuarioDAO();
						$result = $iu->create($u);
					}else if(isset($arr["login"]) &&
							isset($arr["senha"])){//login
								$iu = new UsuarioDAO();
								$result = $iu->readLogin($arr["login"],$arr["senha"]);
							
					}else{//erro
						$result["status"] = "ERRO-01";
					}
				}else if($arr["verbo"] == "DELETE") {
					if(isset($arr["id_usuario"])) {
						if($arr["id_usuario"] > 0) {
							$iu = new UsuarioDAO();
							$result = $iu->delete($arr["id_usuario"]);
						}else {
							$result["status"] = "ERRO-03";
						}				
					}else {
						$result["status"] = "ERRO-02";
					}
				}else if($arr["verbo"] == "PUT") {
					if(
						isset($arr["id_usuario"]) &&
						isset($arr["login"]) &&
						isset($arr["senha"]) &&
						isset($arr["tipo"])
					){
						$u = new Usuario();
						$u->setId_usuario($arr["id_usuario"]);
						$u->setLogin($arr["login"]);
						$u->setSenha($arr["senha"]);
						$u->setTipo($arr["tipo"]);
		
						$iu = new UsuarioDAO();
						$result = $iu->update($u);
					}else {
						$result["status"] = "ERRO-03";
					}
				}else {
					$result["status"] = "ERRO-04";
				}
			}else {
				$result["status"] = "ERRO-05";
			}

			http_response_code(200);
			echo json_encode($result);
		}

	}

		/* Processa Local
		var $ud;

		function doGet($arr){
			$ud = new UsuarioDAO();
			if($arr["idUsuario"]== 0 ){
				$result = $ud->readAll();
			} else {
				$result = $ud->read($arr["idUsuario"]);
			}
			http_response_code(200);
			echo json_encode($result);
		}

		function doPost($arr){
			$ud = new UsuarioDAO();
			$usuario = new Usuario();
			$usuario->setLogin($arr["login"]);
			$usuario->setSenha($arr["senha"]);
			$usuario->setTipo($arr["tipo"]);
			$result = $ud->create($usuario);
			if(is_object($result)){
				echo '{"mensagem":"Usuario cadastrado com sucesso}';
			} else {
			echo json_encode($result);
		}
	}

		function doPut($arr){
			$ud = new UsuarioDAO();
			$usuario = new Usuario();
			$usuario->setIdUsuario($arr["idUsuario"]);
			$usuario->setSenha($arr["senha"]);
			$usuario->setTipo($arr["tipo"]);
			$result = $ud->update($usuario);
			if(is_object($result)){
				echo '{"mensagem":"Usuario alterado com sucesso}';
			} else {
			echo json_encode($result);
		}
	}

		function doDelete($arr){
			$ud = new UsuarioDAO();
			$result = $ud->delete($arr["idUsuario"]);
			http_response_code(200);
			echo json_encode($result);
		}
		}*/