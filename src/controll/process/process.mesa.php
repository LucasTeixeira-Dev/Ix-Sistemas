<?php

	require("../../domain/connection.php");
	require("../../domain/mesa.php");

	class MesaProcess {
		var $md;
		var $m;

		function doGet($arr){
			if(isset($arr["id_mesa"])){
			    $md = new MesaDAO;
				$result = $md->read($arr["id_mesa"]);
			}else{
				$result["status"] = "ERRO-02";
			}
			http_response_code(200);
			echo json_encode($result);
		}


		function doPost($arr){
		if(isset($arr["verbo"])) {
				if($arr["verbo"] == "POST") {
					if(
						isset($arr["descricao"]) &&
						isset($arr["id_usuario"]) 
					){
						$m = new Mesa();
						$m->setDescricao($arr["descricao"]);
						$m->setId_usuario($arr["id_usuario"]);
		
						$md = new MesaDAO();
						$result = $md->create($m);
					}else {
						$result["status"] = "ERRO-02";
					}
				}else if($arr["verbo"] == "DELETE") {
					if(isset($arr["id_mesa"])) {
						if($arr["id_mesa"] > 0) {
							$md = new MesaDAO();
							$result = $md->delete($arr["id_mesa"]);
						}else {
							$result["status"] = "ERRO-03";
						}				
					}else {
						$result["status"] = "ERRO-4";
					}
				}else if($arr["verbo"] == "PUT") {
					if(
						isset($arr["id_mesa"]) &&
						isset($arr["descricao"]) &&
						isset($arr["id_usuario"]) 
					){
						$m = new Mesa();
						$m->setId_mesa($arr["id_mesa"]);
						$m->setDescricao($arr["descricao"]);
						$m->setId_usuario($arr["id_usuario"]);
		
						$md = new MesaDAO();
						$result = $md->update($m);
					}else {
						$result["status"] = "ERRO-02";
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
	/*class MesaProcess {
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