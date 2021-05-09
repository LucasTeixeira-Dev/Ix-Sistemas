<?php

	class Produto {
		var $idProduto;
		var $nome;
		var $descricao;
		var $valor;
		var $tipo;

		function getIdProduto(){
			return $this->idProduto;
		}
		function setIdProduto($idProduto){
			$this->idProduto = $idProduto;
		}

		function getNome(){
			return $this->nome;
		}
		function setNome($nome){
			$this->nome = $nome;
		}

		function getDescricao(){
			return $this->descricao;
		}
		function setDescricao($descricao){
			$this->descricao = $descricao;
		}

		function getValor(){
			return $this->valor;
		}
		function setValor($valor){
			$this->valor = $valor;
		}

		function getTipo(){
			return $this->tipo;
		}
		function setTipo($tipo){
			$this->tipo = $tipo;
		}
	}

	class ProdutoDAO {
		function create($produto) {
			$result = array();
			$nome = $produto->getNome();
			$descricao =$produto->getDescricao();
			$valor =$produto->getValor();
			$tipo = $produto->getTipo();
			$query = "INSERT INTO produto VALUES (DEFAULT, '$nome', '$descricao', '$valor', '$tipo')";
			try {
				
				$con = new Connection();
				if(Connection::getInstance()->exec($query) >= 1){
					$result = $produto;
				} else {
					$result["err"] = "Erro ao criar produto";
				}
			

				$con = null;
			}catch(PDOException $e) {
				$result["error"] = $e->getMessage();
			}

			return $result;
		}

		function read($idProduto) {
			$result = array();
			$query = "SELECT * FROM produto WHERE idProduto = '$idProduto'";
			try {
				
				$con = new Connection();
				$resultSet = Connection::getInstance()->query($query);
				if($resultSet){
					while($row = $resultSet->fetchObject()){
						$produto = new Produto();
						$produto->setIdProduto($row->idproduto);
						$produto->setNome($row->nome);
						$produto->setDescricao($row->descricao);
						$produto->setValor($row->valor);
						$produto->setTipo($row->tipo);
						$result[] = $produto;
						
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
			$query = "SELECT * FROM produto";
			try {
				
				$con = new Connection();
				$resultSet = Connection::getInstance()->query($query);
					while($row = $resultSet->fetchObject()){
						$produto = new Produto();
						$produto->setIdProduto($row->idproduto);
						$produto->setNome($row->nome);
						$produto->setDescricao($row->descricao);
						$produto->setValor($row->valor);
						$produto->setTipo($row->tipo);
						$result[] = $produto;
						
				}
			
				$con = null;
			}catch(PDOException $e) {
				$result["error"] = $e->getMessage();
			}

			return $result;
		}

		function update($produto) {
			$result = array();
			$idProduto = $produto->getIdProduto();
			$nome = $produto->getNome();
			$descricao = $produto->getDescricao();
			$valor = $produto->getValor();
			$tipo = $produto->getTipo();
			$query = "UPDATE produto SET nome = '$nome', descricao = '$descricao', valor = '$valor', tipo = '$tipo' WHERE idProduto = $idProduto";
			try {
				
				$con = new Connection();
				$status = Connection::getInstance()->prepare($query);
				if($status->execute()){
					$result[] = $produto;
				} else {
					$result["err"] = "Nãpo foi possivel atualizar os dados";
				}

				$con = null;
			}catch(PDOException $e) {
				$result["error"] = $e->getMessage();
			}

			return $result;
		}

		function delete($idProduto) {
			$result = array();
			$query = "DELETE FROM produto WHERE idProduto = '$idProduto'";
			try {
				
				$con = new Connection();
				if(Connection::getInstance()->exec($query) >= 1){
					$result["msg"] = "Produto excluido com sucesso";
				} else {
					$result["err"] = "Produto nao excluido";
				}
				$con = null;
			}catch(PDOException $e) {
				$result["error"] = $e->getMessage();
			}

			return $result;
		}
	}
