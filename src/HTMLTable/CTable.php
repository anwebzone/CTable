<?php

namespace Ann\HTMLTable;

/**
 * A utility class to easy creating and handling of tables.
 * 
 * @package CTable
 */
 
class CTable
{
		public $data;
		public $remove;
		public $table;

		 /**
     * Constructor
     *
     * @param array $data, data to display in a table, preferably database array.
     * @param array $remove, column names to remove before creating html table.
		 * @param string $class, css classes to add in <table>
     */
		public function __construct($data = [], $remove = [], $class = null)
		{
				$this->create($data, $remove, $class);
		}
		
		/**
		 *	Create HTML Table with $data.
		 *
		 */
		public function create($data = [], $remove = [], $class = null)
		{
				$this->data = null;
				// Remove keys from $data specified in array $remove, set $this->data instead.
				$this->data = $this->remove($data, $remove);
				
				// Get first key?
				$first_key = current(array_keys($this->data));
				
				//var_dump($first_key);
				//var_dump($this->data);
				
				$table = '<table class="' . $class . '">
										<thead>
											<tr>' . $this->head($this->data[$first_key]) . '</tr>
										</thead>
										<tbody>
											' . $this->body($this->data) . '
										</tbody>
									</table>';
									
				return $this->table = $table;
				
		}
		
		/**
		 * Remove columns from data.
		 *
		 */
		private function remove($data = [], $remove = [])
		{
				$this->data = $data;
				$this->remove = $remove;
				
				for($i = 0; $i < count($this->data); $i++) {
						foreach($this->remove AS $column) {
						
								if(is_object($this->data[$i])) {
										unset($this->data[$i]->$column);
								}
								else if (is_array($this->data[$i])){
										unset($this->data[$i][$column]);
								}
								else{
										die('$data is not array or object.');
								}
						}
				}	
				
				return $this->data;
		}
		
		
		/**
		 * Create table head.
		 *
		 */
		private function head($data)
		{
				$html = null;
				$keys = array_keys((array)$data);
				
				if(is_object($data)){
						unset($keys[0]);
				}
				
				foreach($keys AS $header){
						$html .= '<th>' . htmlentities($header) . '</th>';
				}
				
				return $html;
				
		}
		
		/**
		 * Create table body with $data.
		 *
		 */
		private function body($data = [])
		{
				$body = null;
				for($i = 0; $i < count($data); $i++)
				{
						$html = null;
						$keys = array_keys((array)$data[$i]);
						
						// Remove key "di".
						if(is_object($data[$i]))
						{
								unset($keys[0]);
								
								foreach($keys AS $value)
								{
										if(empty($data[$i]->$value)){
												$data[$i]->$value = 'Null';
										}
										$html .= '<td>' . htmlentities($data[$i]->$value) . '</td>';
								}
						}
						else
						{					
								foreach($keys AS $value)
								{
										if(empty($data[$i][$value])){
												$data[$i][$value] = 'Null';
										}
										$html .= '<td>' . htmlentities($data[$i][$value]) . '</td>';
								}
						}
						
						$body .= '<tr>' . $html . '</tr>';
						
				}
				return $body;
		}
		

}
