<?php

	require("../../domain/connection.php");
	require("../../domain/pedido.php");

	class PedidoProcess {
		var $pd;
		var $p;

		function doGet($arr){
		
			if(isset($arr["id_pedido"])){
			            $pd = new PedidoDAO();
		                $result = $pd->read($arr["id_pedido"]);
			}else{
				$result["status"] = "ERRO-01";
			}
			http_response_code(200);
			echo json_encode($result);
		}


		function doPost($arr){
			if(isset($arr["verbo"])) {
				if($arr["verbo"] == "POST") {
					if(
					    isset($arr["id_mesa"]) &&
						isset($arr["data"]) &&
						isset($arr["hora"]) &&
						isset($arr["status"]) &&
						isset($arr["obs"]) 
					){
						$p = new Pedido();
						$p->setId_mesa($arr["id_mesa"]);
						$p->setData($arr["data"]);
						$p->setHora($arr["hora"]);
					    $p->setStatus($arr["status"]);	
						$p->setObs($arr["obs"]);
					    
					    $pd = new PedidoDAO();
						$result = $pd->create($p);
					}else {
						$result["status"] = "ERRO-01";
					}
				}else if($arr["verbo"] == "DELETE") {
					if(isset($arr["id_pedido"])) {
						if($arr["id_pedido"] > 0) {
							$pd = new PedidoDAO();
							$result = $pd->delete($arr["id_pedido"]);
						}else {
							$result["status"] = "ERR0-02";
						}				
					}else {
						$result["status"] = "ERRO-03";
					}
				}else if($arr["verbo"] == "PUT") {
					if(
						isset($arr["id_pedido"]) &&
						isset($arr["id_mesa"]) &&
						isset($arr["data"]) &&
						isset($arr["hora"]) &&
						isset($arr["status"]) &&
						isset($arr["obs"]) 
					){
						$p = new Pedido();
						$p->setId_pedido($arr["id_pedido"]);
						$p->setId_mesa($arr["id_mesa"]);
						$p->setData($arr["data"]);
						$p->setHora($arr["hora"]);
						$p->setStatus($arr["status"]);
						$p->setObs($arr["obs"]);
		
						$pd = new PedidoDAO();
						$result = $pd->update($p);
					}else {
						$result["status"] = "ERRO-02";
					}
				}else {
					$result["status"] = "ERRO-03";
				}
			}else {
				$result["status"] = "ERRO-05";
			}

			http_response_code(200);
			echo json_encode($result);
		}

	}
	/*class PedidoProcess {
		var $pd;

		function doGet($arr){
			$pd = new PedidoDAO();
			if($arr["idPedido"]== 0 ){
				$result = $pd->readAll();
			}else{
				$result = $pd->read($arr["idPedido"]);
			}
			http_response_code(200);
			echo json_encode($result);
		}


		function doPost($arr){
			$pd = new PedidoDAO();
			$pedido = new Pedido();
			$pedido->setIdMesa($arr["idMesa"]);
			$pedido->setData($arr["data"]);
			$pedido->setHora($arr["hora"]);
			$pedido->setStatus($arr["status"]);
			$pedido->setObs($arr["obs"]);
			$result = $pd->create($pedido);
			if(is_object($result)){
				echo '{"mensagem":"Pedido cadastrado com sucesso"}';
			} else {
				echo json_encode($result);
			}
		}

		function doPut($arr){
			$pd = new PedidoDAO();
			$pedido = new Pedido();
			$pedido->setIdPedido($arr["idPedido"]);
			$pedido->setIdMesa($arr["idMesa"]);
			$pedido->setData($arr["data"]);
			$pedido->setHora($arr["hora"]);
			$pedido->setStatus($arr["status"]);
			$pedido->setObs($arr["obs"]);
			$result = $pd->update($pedido);
			if(is_object($result)){
				echo '{"mensagem":"Pedido alterado com sucesso"}';
			} else {
				echo json_encode($result);
			}
		}


		function doDelete($arr){
			$pd = new PedidoDAO();
			$result = $pd->delete($arr["idPedido"]);
			http_response_code(200);
			echo json_encode($result);
		}
	}*/