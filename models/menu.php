<?php 
	class Menu extends model{

		public function getMenu(){

			$array = array();

			$sql = "SELECT * FROM menu";
			$sql = $this->db->prepare($sql);
			$sql->execute();

			if($sql->rowCount()){
				$array = $sql->fetchAll();
			}

			return $array;
		}
	}
 ?>