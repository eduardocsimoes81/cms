<?php 
	class depoimentos extends model{

		public function getDepoimentos($limit = 0){

			$array = array();

			if($limit > 0){
				$sql = "SELECT * FROM depoimentos ORDER BY RAND() LIMIT ".$limit;	
			}else{
				$sql = "SELECT * FROM depoimentos ORDER BY RAND()";
			}
			
			$sql = $this->db->prepare($sql);
			$sql->execute();

			if($sql->rowCount() > 0){
				$array = $sql->fetchAll();
			}

			return $array;
		}
	}
 ?>