<?php

	require("../../domain/connection.php");
	require("../../domain/pedido.php");

	class PedidoProcess {
		var $pd;

		function doGet($arr){
			$pd = new PedidoDAO();
			//if($arr["idPedido"]== 0 ){
				$result = $pd->readAll();
			//}else{
			//	$result = $pd->read($arr["idPedido"]);
			//}
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
	}