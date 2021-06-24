<?php

	class Itens {
		var $id_pedido;

		function getId_pedido(){
			return $this->id_pedido;
		}
		function setId_pedido($id_pedido){
			$this->id_pedido = $id_pedido;
		}
	}

	class ItensDAO {
		function read($id_pedido) {
			$result = array();
			
			try {
				if($id_pedido == 0){
				    $cond = "";
				}else{
				    $cond = " WHERE id_pedido = $id_pedido";
				}
				$query = "SELECT * FROM vw_itens_pedido_produto" . $cond;
				
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
		function readAll() {
			$result = array();
			$query = "SELECT * FROM vw_itens_pedido_produto";
			try {
				
				$con = new Connection();
				$resultSet = Connection::getInstance()->query($query);
					while($row = $resultSet->fetchObject()){
						$item = new Item();
						$item->setId_pedido($row->id_pedido);
						$result[] = $itens;

				}
			
				$con = null;
			}catch(PDOException $e) {
				$result["error"] = $e->getMessage();
			}

			return $result;
		}
	}
?>
