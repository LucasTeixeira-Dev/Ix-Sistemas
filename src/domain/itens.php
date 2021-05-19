<?php

	class Item {
		var $idPedido;
		var $idProduto;

		function getIdPedido(){
			return $this->idPedido;
		}
		function setIdPedido($idPedido){
			$this->idPedido = $idPedido;
		}

		function getIdProduto(){
			return $this->idProduto;
		}
		function setIdProduto($idProduto){
			$this->idProduto = $idProduto;
		}
	}

	class ItensDAO {
		function create($itens) {
			$result = array();
			$idPedido = $itens->getIdPedido();
			$idProduto = $itens->getIdProduto();
			$query = "INSERT INTO itens VALUES ('$idPedido', '$idProduto')";
			try {
				
				$con = new Connection();
				if(Connection::getInstance()->exec($query) >= 1){
					$result = $itens;
				} else {
					$result["err"] = "Erro ao adicionar pedido";
				}

				$con = null;
			}catch(PDOException $e) {
				$result["error"] = $e->getMessage();
			}

			return $result;
		}

		function read($idPedido) {
			$result = array();
			$query = "SELECT * FROM itens WHERE idPedido = '$idPedido'";
			try {
				
				$con = new Connection();
				$resultSet = Connection::getInstance()->query($query);
				if($resultSet){
					while($row = $resultSet->fetchObject()){
						$item = new Item();
						$item->setIdPedido($row->id_pedido);
						$item->setIdProduto($row->id_produto);
						$result[] = $item;

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
			$query = "SELECT * FROM itens";
			try {
				
				$con = new Connection();
				$resultSet = Connection::getInstance()->query($query);
					while($row = $resultSet->fetchObject()){
						$item = new Item();
						$item->setIdPedido($row->idpedido);
						$item->setIdProduto($row->idproduto);
						$item->setQuantidade($row->quantidade);
						$result[] = $item;

				}
			
				$con = null;
			}catch(PDOException $e) {
				$result["error"] = $e->getMessage();
			}

			return $result;
		}

		function update($pedido) {
			$result = array();
			$idPedido = $pedido->getIdPedido();
			$idProduto = $pedido->getIdProduto();
			$quantidade = $pedido->getQuantidade();
			$result = array();
			$query = "UPDATE itens SET quantidade = '$quantidade' WHERE idPedido = $idPedido and idProduto = $idProduto";
			try {
				
				$con = new Connection();
				$status = Connection::getInstance()->prepare($query);
				if($status->execute()){
					$result[] = $pedido;
				} else {
					$result["err"] = "Não foi possivel atualizar os dados";
				}

				$con = null;
			}catch(PDOException $e) {
				$result["error"] = $e->getMessage();
			}

			return $result;
		}

		function delete($idPedido,$idProduto) {
			$result = array();
			$query = "DELETE FROM itens WHERE idPedido = $idPedido and idProduto = $idProduto";
			try {
				
				$con = new Connection();
				if(Connection::getInstance()->exec($query) >= 1){
					$result["sucesso"] = "item excluido com sucesso";
				} else {
					$result["err"] = "Nao foi possivel excluir item, valide o id do pedido e o id do produto";
				}

				$con = null;
			}catch(PDOException $e) {
				$result["error"] = $e->getMessage();
			}

			return $result;
		}
	}
