<?php

	require("../../domain/connection.php");
	require("../../domain/mesa.php");

	class MesaProcess {
		var $md;

		function doGet($arr){
			 
			$md = new MesaDAO();
			if($arr["idMesa"]== 0){
				$result = $md->readAll();
			}else{
				$result = $md->read($arr["idMesa"]);
			}
			http_response_code(200);
			echo json_encode($result);
		}
		

		function doPost($arr){

			$md = new MesaDAO();
			$mesa = new Mesa();
			$mesa->setDescricao($arr["descricao"]);
			$mesa->setIdUsuario($arr["idUsuario"]);
			$result = $md->create($mesa);
			if(is_object($result)){
				echo '{"mensagem":"Mesa casdatrada com sucesso"}';
			} else {
				echo json_encode($result);
			}
		}
		
		function doPut($arr){
		
			$md = new MesaDAO();
			$mesa = new Mesa();
			$mesa->setIdMesa($arr["idMesa"]);
			$mesa->setDescricao($arr["descricao"]);
			$mesa->setIdUsuario($arr["idUsuario"]);
			$result = $md->update($mesa);
			if(is_object($result)){
				echo '{"mensagem":"Mesa alterada com sucesso"}';
			} else {
				echo json_encode($result);
			}
		}
		

		function doDelete($arr){
			$md = new MesaDAO();
			$result = $md->delete($arr["idMesa"]);
			http_response_code(200);
			echo json_encode($result);
		}
	}