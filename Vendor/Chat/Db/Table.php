<?php

namespace Chat\Db;

use PDO;

class Table
{
	protected $db;
	protected $table;

	public function __construct(PDO $db)
	{
		$this->db = $db;		
	}
	
/*// Criar Base por usuario
	public function create_base($nome)
	{
		$sql = "CREATE SCHEMA {$nome} DEFAULT CHARACTER SET utf8 COLLATE utf8_bin";		
		
		try
		{
			$run = $this->db->prepare($sql);						
			if($run->execute())
			{
				return true;
			}
			else
			{				
				return false;
			}
			
			
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}

	public function gerar_tabela(array $tabelas, $db_name)
	{	
		foreach($tabelas as $key => $value)
		{
			$sql = "CREATE TABLE ".$db_name.".".$key."(";
			$sql .= $value;
			$sql .= ")
						ENGINE = InnoDB
						DEFAULT CHARACTER SET = utf8
						COLLATE = utf8_bin
					";
			try
			{
				$run = $this->db->prepare($sql);
				if(!$run->execute())
					return false;
			}
			catch(PDOException $e)
			{
				echo $e->getMessage();
			}	
		}
	}
//
*/
	/*
	*
	* Select
	*
	*/		

		/*public function find(array $array_campos_busca, array $array_argumentos)
		{		
			$campo_busca = '';
			$argumentos = '';
			if(!empty($array_campos_busca))
			{
				if(count($array_campos_busca) === 1)
				{
					$campo_busca = $array_campos_busca[0];
				}
				else
				{
					$campo_busca = implode(',' ,$array_campos_busca); // transformando os itens do array em uma string
				}
			}

			if(!empty($array_argumentos))
			{

				if(count($array_argumentos) === 1)
				{
					$campos = array_keys($array_argumentos);
					$argumentos = `{$campos[0]} = {$array_argumentos[0]}`;
				}
				else
				{
					$i=0;
					foreach($array_argumentos as $key => $value)
					{
						$i++;

						$argumentos .= ' WHERE '.$key."=".$value;

						if($i < count($array_argumentos))
						{
							$argumentos .= ', ';
						}
					}
				}
			}	

			$sql = `SELECT {$campo_busca} FROM {$this->table} {$argumentos}`;
								
			try
			{
				$run = $this->db->prepare($sql);
				
				if($value !== false)
					$run->bindParam(":value", $value, PDO::PARAM_STR);				

				if($run->execute())
				{
					if($run->rowCount() > 0)
					{
						if($fetch === true)
						{					
							$get = $run->fetchAll(PDO::FETCH_OBJECT); 
						}
						else
						{
							$get = $run;
						}
					}
					else
					{
						$get = false;
					}

					return $get;
				}
				
			}
			catch(PDOException $e)
			{
				echo $e->getMessage();
			}
		}*/

		public function find_all($column = false, $value=false, $opt=false, $fetch=true)
		{
			$sql = "SELECT * FROM ".$this->table;
				
				if($column !== false && $value !== false)
					$sql .=  " WHERE ".$column." = :value ";

				if($opt !== false)
					$sql .=  " $opt ";
				
			try
			{
				$run = $this->db->prepare($sql);
				
				if($value !== false)
					$run->bindParam(":value", $value, PDO::PARAM_STR);				

				if($run->execute())
				{
					if($run->rowCount() > 0)
					{
						if($fetch === true)
						{					
							$get = $run->fetchAll(PDO::FETCH_ASSOC); 
						}
						else
						{
							$get = $run;
						}
					}
					else
					{
						$get = false;
					}

					return $get;
				}
				
			}
			catch(PDOException $e)
			{
				echo $e->getMessage();
			}
		}
			
		public function find_by_id($id)
		{
			
			$sql = " SELECT * FROM " . $this->table . " WHERE id=:id ";

			try
			{
				$run = $this->db->prepare($sql);

				$run->bindParam(":id", $id, PDO::PARAM_INT);
				
				if($run->execute())
				{
					if($run->rowCount() > 0)
					{
						$get = $run->fetchAll(\PDO::FETCH_ASSOC); // retorna os valores como array associativo

						return $get;
					}
					else
					{
						return false;		
					}
				}
				
			}
			catch(PDOException $e)
			{
				echo $e->getMessage();
			}
		}

		public function find_by_field_value($field, $value, $args="*", $opt="")
		{
			
			$sql = " SELECT $args FROM " . $this->table . " WHERE $field = :value $opt";

			try
			{
				$run = $this->db->prepare($sql);
				$run->bindParam(":value", $value, PDO::PARAM_STR);		
							
				if($run->execute())
				{
					if($run->rowCount() > 0)
					{
						$run = $run->fetchAll(PDO::FETCH_ASSOC);

						return $run;
					}
					else
					{
						return false;
					}
				}
				else
				{
					return false;
				}

			}
			catch(PDOException $e)
			{
				echo $e->getMessage();
			}
		}

	/*
	*
	* Insert
	*
	*/

		public function insert(array $dados)
		{
			
			$chaves = array_keys($dados);

			$chaves = implode(",", $chaves);

			$keys = implode(",",substr_replace(array_keys($dados), ':', 0, 0));

			$sql = "INSERT INTO {$this->table} ( {$chaves} ) VALUES ( {$keys} ) ";

			try
			{
				$run = $this->db->prepare($sql);
				
				foreach ($dados as $key => $value)
				{
	 				  $run->bindValue(":$key", $value, PDO::PARAM_STR);
				}
				
				if($run->execute())
				{
					return true;
				}
				else
				{
					return false;
				}

			}
			catch(PDOException $e)
			{
				echo $e->getMessage();
			}
		}

	/*
	*
	* Update
	*
	*/

		public function update($field, $newData, $param1, $param2, $and = '')
		{
					
			$sql = "UPDATE {$this->table} SET {$field} = :newData WHERE {$param1} = :param2 {$and}";

			try
			{				
				$run = $this->db->prepare($sql);
				$run->bindValue(":param2", $param2, PDO::PARAM_STR);
				$run->bindValue(":newData", $newData, PDO::PARAM_STR);
				if($run->execute())
				{
					return true;
				}
				else
				{
					return false;

				}
			}
			catch(PDOException $e)
			{
				echo $e->getMessage();
			}
		}
	
	/*
	*
	* Delete
	*
	*/	

		public function delete_all() // Apagar tudo
		{
					
			$sql = "DELETE FROM {$this->table}";

			try
			{
				$run = $this->db->prepare($sql);
								
				if($run->execute())
				{
					return true;
					
				}
				else
				{
					return false;
				}

			}
			catch(PDOException $e)
			{
				echo $e->getMessage();
			}
		}

		public function delete_by_option($opt) // Apagar com opções
		{
					
			$sql = "DELETE FROM {$this->table} ".$opt;

			try
			{
				$run = $this->db->prepare($sql);
								
				if($run->execute())
				{
					return true;
					
				}
				else
				{
					return false;
				}

			}
			catch(PDOException $e)
			{
				echo $e->getMessage();
			}
		}


		public function delete_by_id($id) // Apagar pelo ID
		{
					
			$sql = "DELETE FROM {$this->table} WHERE id = :id";

			try
			{
				$run = $this->db->prepare($sql);
				$run->bindValue(":id", $id, PDO::PARAM_INT);
							
				if($run->execute())
				{
					return true;
					
				}
				else
				{
					return false;
				}

			}
			catch(PDOException $e)
			{
				echo $e->getMessage();
			}
		}


		public function delete_in($id) // Apagando varios registros com varios id
		{
					
			$sql = "DELETE FROM {$this->table} WHERE id IN (".$id.")";

			try
			{
				$run = $this->db->prepare($sql);
										
				if($run->execute())
				{
					return true;
					
				}
				else
				{
					return false;
				}

			}
			catch(PDOException $e)
			{
				echo $e->getMessage();
			}

		}
}