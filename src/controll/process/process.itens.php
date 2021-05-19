<?php

	require("../../domain/connection.php");
	require("../../domain/itens.php");

	class ItensProcess {
		var $id;

		function doGet($arr){
			$id = new ItensDAO();
			//if($arr["idPedido"]== 0){
				$result = $id->readAll();
			//} else {
			//	$result = $id->read($arr["idPedido"]);
			//}
			http_response_code(200);
			echo json_encode($result);
		}


		function doPost($arr){
			$id = new ItensDAO();
			$item = new Item();
			$item->setIdPedido($arr["idPedido"]);
			$item->setIdProduto($arr["idProduto"]);
			$item->setQuantidade($arr["quantidade"]);
			$result = $id->create($item);
			
			if(is_object($result)){
				echo '{"mensagem":"Pedido cadastrado com sucesso"}';
			} else {
				echo json_encode($result);
			}
		}


		function doPut($arr){
			$id = new ItensDAO();
			$item = new Item();
			$item->setIdPedido($arr["idPedido"]);
			$item->setIdProduto($arr["idProduto"]);
			$item->setQuantidade($arr["quantidade"]);
			$result = $id->update($item);
			if(is_object($result)){
				echo '{"mensagem":"Pedido alterado com sucesso"}';
			} else {
				echo json_encode($result);
			}
		}


		function doDelete($arr){
			$id = new ItensDAO();
			$result = $id->delete($arr["idPedido"],$arr["idProduto"]);
			http_response_code(200);
			echo json_encode($result);
		}
	}