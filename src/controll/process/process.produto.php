<?php

	require("../../domain/connection.php");
	require("../../domain/produto.php");

	class ProdutoProcess {
		// Processa 000webhost
		var $prd;
		var $pr;
		
		function doGet($arr){
			if(isset($arr["id_produto"])) {
				$prd = new ProdutoDAO();
				$result = $prd->read($arr["id_produto"]);
			} else {
				$result["status"] = "ERRO";
			}
			http_response_code(200);
			echo json_encode($result);
		}


		function doPost($arr){
		$code = 200;
		if(isset($arr["verbo"])) {
				if($arr["verbo"] == "POST") {
					if(
						isset($arr["nome"]) &&
						isset($arr["descricao"]) &&
						isset($arr["valor"]) &&
						isset($arr["tipos"])
					){
						$pr = new Produto();
						$pr->setNome($arr["nome"]);
						$pr->setDescricao($arr["descricao"]);
						$pr->setValor($arr["valor"]);
						$pr->setTipo($arr["tipos"]);
						$prd = new ProdutoDAO();
						$result = $prd->create($pr);
					}else {
					    $code = 500;
						$result["status"] = "ERRO";
					}
				}else if($arr["verbo"] == "DELETE") {
					if(isset($arr["id_produto"])) {
						if($arr["id_produto"] > 0) {
							$prd = new ProdutoDAO();
							$result = $prd->delete($arr["id_produto"]);
						}else {
						    $code = 501;
							$result["status"] = "ERRO-00";
						}				
					}else {
						$result["status"] = "ERRO-01";
					}
				}else if($arr["verbo"] == "PUT") {
					if(
						isset($arr["id_produto"]) &&
						isset($arr["nome"]) &&
						isset($arr["descricao"]) &&
						isset($arr["valor"]) &&
						isset($arr["tipos"]) 
					){
						$pr = new Produto();
						$pr->setId_produto($arr["id_produto"]);
						$pr->setNome($arr["nome"]);
						$pr->setDescricao($arr["descricao"]);
						$pr->setValor($arr["valor"]);
						$pr->setTipo($arr["tipos"]);
						$prd = new ProdutoDAO();
						$result = $prd->update($pr);
					}else {
					    $code = 500;
						$result["status"] = "ERRO-01";
					}
				}else {
					$result["status"] = "ERRO-02";
				}
			}else {
				$result["status"] = "ERRO-03";
			}
			
			http_response_code($code);
			echo json_encode($result);
		}
		
	}
		
		/* Processa local
		var $pd;

		function doGet($arr){
			$pd = new ProdutoDAO();
			if($arr["id_produto"]== 0 ){
				$result = $pd->readAll();
			} else {
				$result = $pd->read($arr["id_produto"]);
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
			$produto->setTipo($arr["tipos"]);
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
			$produto->setId_produto($arr["id_produto"]);
			$produto->setNome($arr["nome"]);
			$produto->setDescricao($arr["descricao"]);
			$produto->setValor($arr["valor"]);
			$produto->setTipo($arr["tipos"]);
			$result = $pd->update($produto);
			if(is_object($result)){
				echo '{"mensagem":"Produto alterado com sucesso"}';
			} else {
				echo json_encode($result);
			}
		}
		function doDelete($arr){
			$pd = new ProdutoDAO();
			$result = $pd->delete($arr["id_produto"]);
			http_response_code(200);
			echo json_encode($result);
		}
	}*/