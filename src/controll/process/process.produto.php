<?php

	require("../../domain/connection.php");
	require("../../domain/produto.php");

	class ProdutoProcess {
		var $pd;

		function doGet($arr){
			$pd = new ProdutoDAO();
			if($arr["idProduto"]=="0"){
				$result = $pd->readAll();
			} else {
				$result = $pd->read($arr["idProduto"]);
			}
			http_response_code(200);
			echo json_encode($result);
		}


		function doPost($arr){
			$pd = new ProdutoDAO();
			$produto = new Produto();
			$produto->setNome($arr["nome"]);
			$produto->setDescricao($arr["descricao"]);
			$produto->setValor($arr["valor"]);
			$produto->setTipo($arr["tipo"]);
			$result = $pd->create($produto);
			if(is_object($result)){
				echo '{"mensagem":"Produto cadastrado com sucesso"}';
			} else {
				echo json_encode($result);
			}
		}


		function doPut($arr){
			$pd = new ProdutoDAO();
			$produto = new Produto();
			$produto->setIdProduto($arr["idProduto"]);
			$produto->setNome($arr["nome"]);
			$produto->setDescricao($arr["descricao"]);
			$produto->setValor($arr["valor"]);
			$produto->setTipo($arr["tipo"]);
			$result = $pd->update($produto);
			if(is_object($result)){
				echo '{"mensagem":"Produto alterado com sucesso"}';
			} else {
				echo json_encode($result);
			}
		}
		function doDelete($arr){
			$pd = new ProdutoDAO();
			$result = $pd->delete($arr["idProduto"]);
			http_response_code(200);
			echo json_encode($result);
		}
	}