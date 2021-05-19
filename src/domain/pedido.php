<?php

	class Pedido {
		var $idPedido;
		var $idMesa;
		var $data;
		var $hora;
		var $status;
		var $obs;

		function getIdPedido(){
			return $this->idPedido;
		}
		function setIdPedido($idPedido){
			$this->idPedido = $idPedido;
		}

		function getIdMesa(){
			return $this->idMesa;
		}
		function setIdMesa($idMesa){
			$this->idMesa = $idMesa;
		}

		function getData(){
			return $this->data;
		}
		function setData($data){
			$this->data = $data;
		}

		function getHora(){
			return $this->hora;
		}
		function setHora($hora){
			$this->hora = $hora;
		}

		function getStatus(){
			return $this->status;
		}
		function setStatus($status){
			$this->status = $status;
		}

		function getObs(){
			return $this->obs;
		}
		function setObs($obs){
			$this->obs = $obs;
		}
	}

	class PedidoDAO {
		function create($pedido) {
			$result = array();
			$idMesa = $pedido->getIdMesa();
			$data = $pedido->getData();
			$hora = $pedido->getHora();
			$status = $pedido->getStatus();
			$obs = $pedido->getObs();
			$query = "INSERT INTO pedido VALUES (DEFAULT, '$idMesa', '$data', '$hora', '$status', '$obs') ";
			try {
				
				$con = new Connection();
				if(Connection::getInstance()->exec($query) >= 1){
					$result = $pedido;
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
			$query = "SELECT * FROM pedido WHERE idPedido = '$idPedido'";
			try {
				
				$con = new Connection();
				$resultSet = Connection::getInstance()->query($query);
				if($resultSet){
					while($row = $resultSet->fetchObject()){
						$pedido = new Pedido();
						$pedido->setIdPedido($row->id_pedido);
						$pedido->setIdMesa($row->id_mesa);
						$pedido->setData($row->data);
						$pedido->setHora($row->hora);
						$pedido->setStatus($row->status);
						$pedido->setObs($row->obs);
						$result[] = $pedido;

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
			$query = "SELECT * FROM pedido";
			try {
				
				$con = new Connection();
				$resultSet = Connection::getInstance()->query($query);
					while($row = $resultSet->fetchObject()){
						$pedido = new Pedido();
						$pedido->setIdPedido($row->idpedido);
						$pedido->setIdMesa($row->idmesa);
						$pedido->setData($row->data);
						$pedido->setHora($row->hora);
						$pedido->setStatus($row->status);
						$pedido->setObs($row->obs);
						$result[] = $pedido;

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
			$idMesa = $pedido->getIdMesa();
			$data = $pedido->getData();
			$hora = $pedido->getHora();
			$status = $pedido->getStatus();
			$obs = $pedido->getObs();
			$query = "UPDATE pedido SET idMesa = '$idMesa', data = '$data', hora = '$hora', status = '$status', obs = '$obs' WHERE idPedido = '$idPedido'";
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

		function delete($idPedido) {
			$result = array();
			$query = "DELETE FROM pedido WHERE idPedido = '$idPedido'";
			try {
				
				$con = new Connection();
				if(Connection::getInstance()->exec($query) >= 1){
					$result["msg"] = "Pedido excluido com sucesso";
				} else {
					$result["err"] = "Pedido nao excluido";
				}

				$con = null;
			}catch(PDOException $e) {
				$result["error"] = $e->getMessage();
			}

			return $result;
		}
	}
