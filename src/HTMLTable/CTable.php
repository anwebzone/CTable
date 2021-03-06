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
     * @param array $data , data to display in a table, preferably database array.
     * @param array $remove , column names to remove before creating html table.
		 * @param string $class , css classes to add in <table>.
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
				if(empty($data)) {
						return null;
				}
				// Remove keys from $data specified in array $remove, set $this->data instead.
				$this->data = $this->remove($data, $remove);
				
				// Get first key?
				$first_key = current(array_keys($this->data));
				
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
		public function remove($data = [], $remove = [])
		{
				$this->data = $data;
				$this->remove = $remove;
				$count = count($this->data);
				
				for($i = 0; $i < $count; $i++) {
						foreach($this->remove AS $column) {
						
								// Different handling if object or not.
								if(is_object($this->data[$i])) {
										unset($this->data[$i]->$column);
								}
								else if (is_array($this->data[$i])){
										unset($this->data[$i][$column]);
								}
								else{
										throw new \Exception("While trying to remove key from \$data we found that \$data[\$key] is not array or object.");
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
				
				
				if(is_object($data) && strpos($keys[0], 'di') !== false){
						unset($keys[0]);
				}
				
				foreach($keys AS $header){
						$html .= '<th>' . htmlentities(ucfirst($header)) . '</th>';
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
				$count = count($data);
				for($i = 0; $i < $count; $i++)
				{
						$html = null;
						$keys = array_keys((array)$data[$i]);
						
						// Remove key "di".
						if(is_object($data[$i]))
						{
								if(strpos($keys[0], 'di') !== false){
										unset($keys[0]);
								}
								
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
										if(empty($data[$i][$value]) && $data[$i][$value] != '0'){
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
