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

		 /**
     * Constructor
     *
     * @param array $data, data to display in a table, preferably database array.
     * @param array $remove, column names to remove before creating html table.
     */
		public function __construct($data = [], $remove = [])
		{
				$this->remove($data, $remove);
				
				print_r($this->data);
		
		}
		
		/**
		 * Remove columns from data.
		 *
		 */
		public function remove($data = [], $remove = [])
		{
				$this->data = $data;
				$this->remove = $remove;
				
				for($i = 0; $i < count($this->data); $i++) {
						foreach($this->remove AS $column) {
								unset($this->data[$i]->$column);
						}
				}
			
		}

}
