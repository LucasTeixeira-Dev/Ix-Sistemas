<?php

	require("../../domain/connection.php");
	require("../../domain/usuario.php");

	class UsuarioProcess {
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
		}