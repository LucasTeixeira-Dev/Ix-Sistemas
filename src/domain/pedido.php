<?php

	class Pedido {
		var $id_pedido;
		var $id_mesa;
		var $data;
		var $hora;
		var $status;
		var $obs;

		function getId_pedido(){
			return $this->id_pedido;
		}
		function setId_pedido($id_pedido){
			$this->id_pedido = $id_pedido;
		}

		function getId_mesa(){
			return $this->id_mesa;
		}
		function setId_mesa($id_mesa){
			$this->id_mesa = $id_mesa;
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
			
			$id_mesa = $pedido->getId_mesa();
			$data = $pedido->getData();
			$hora = $pedido->getHora();
			$status = $pedido->getStatus();
			$obs = $pedido->getObs();
		
			try {
				$query = "INSERT INTO pedido (id_mesa, data, hora, status, obs) VALUES ('$id_mesa', '$data', '$hora', '$status', '$obs')";
				
				$con = new Connection();
				
				if(Connection::getInstance()->exec($query) >= 1){
					$result["id_pedido"] = Connection::getInstance()->lastInsertId();
					$result["status"] = "SUCESSO";
				} else {
					$result["status"] = "ERRO";
				}

				$con = null;
			}catch(PDOException $e) {
				$result["status"] = "PDO".$e->getCode();
			}

			return $result;
		}

		function read($id_pedido) {
			$result = array();
			
			
			try {
			    if($id_pedido == 0){
			        $cond = "";
			    }else{
			        $cond = "WHERE id_pedido = $id_pedido";
			    }
			    
				$query = "SELECT * FROM pedido". $cond;
				
				$con = new Connection();
				
				$resultSet = Connection::getInstance()->query($query);
				while($row = $resultSet->fetchObject()){
						$result[] = $row;

				}
				$con = null;
			}catch(PDOException $e) {
				$result["status"] = "PDO".$e->getCode();
			}

			return $result;
		}

		function update($p) {
			$result = array();
			
			$id_pedido = $p->getId_pedido();
			$id_mesa = $p->getId_mesa();
			$data = $p->getData();
			$hora = $p->getHora();
			$status = $p->getStatus();
			$obs = $p->getObs();
			
			try {
				$query = "UPDATE pedido SET id_mesa = '$id_mesa',
				                            data = '$data',
				                            hora = '$hora',
				                            status = '$status',
				                            obs = '$obs'
				                            WHERE id_pedido = '$id_pedido'";
				
				$con = new Connection();
				
				$status = Connection::getInstance()->prepare($query);
				if($status->execute()){
					$result["status"] = "SUCESSO";
				} else {
					$result["status"] = "ERRO";
				}

				$con = null;
			}catch(PDOException $e) {
				$result["status"] = "PDO".$e->getCode();
			}

			return $result;
		}

		function delete($id_pedido) {
			$result = array();
		
			try {
				$query = "DELETE FROM pedido WHERE id_pedido = '$id_pedido'";
				
				$con = new Connection();
				
				if(Connection::getInstance()->exec($query) >= 1){
					$result["status"] = "SUCESSO";
				} else {
					$result["status"] = "ERRO";
				}

				$con = null;
            }catch(PDOException $e) {
				$result["status"] = "PDO".$e->getCode();
			}

			return $result;
		}
	}
}
	/*class Pedido {
		var $id_pedido;
		var $id_mesa;
		var $data;
		var $hora;
		var $status;
		var $obs;

		function getId_pedido(){
			return $this->id_pedido;
		}
		function setId_pedido($id_pedido){
			$this->id_pedido = $id_pedido;
		}

		function getId_mesa(){
			return $this->id_mesa;
		}
		function setId_mesa($id_mesa){
			$this->id_mesa = $id_mesa;
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
			$idMesa = $pedido->getId_mesa();
			$data = $pedido->getData();
			$hora = $pedido->getHora();
			$status = $pedido->getStatus();
			$obs = $pedido->getObs();
			$query = "INSERT INTO pedido VALUES (DEFAULT, '$id_mesa', '$data', '$hora', '$status', '$obs') ";
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

		function read($id_pedido) {
			$result = array();
			$query = "SELECT * FROM pedido WHERE id_pedido = '$id_pedido'";
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
	}*/