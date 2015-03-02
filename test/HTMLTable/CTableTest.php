<?php
namespace Ann\HTMLTable;

class CTableTest extends \PHPUnit_Framework_Testcase
{
   /**
    * Test creating table when creating object $table.
    *
    * @return void
    *
    */
		public function testConstructCTable()
		{
				// Normal test
				$data = [0 => ['id' => '1', 'Null' => '']];
				$table = new \Ann\HTMLTable\CTable($data, []);
				
				$res = preg_replace('/\s+/', '', $table->table);
				$exp = '<tableclass=""><thead><tr><th>Id</th><th>Null</th></tr></thead><tbody><tr><td>1</td><td>Null</td></tr></tbody></table>';
				
				$this->assertEquals($res, $exp, "Created table missmatch when using normal array as data.");
				
			  // Test with object in array.
				$object = new \stdClass();
				$data = ['id' => '1', 'Null' => ''];
				
				foreach($data AS $key => $value){
						$object->$key = $value;
				}
				$array = array(0 => $object);
				
				$table = new \Ann\HTMLTable\CTable($array, []);
				$res = preg_replace('/\s+/', '', $table->table);
				$this->assertEquals($res, $exp, "Created table missmatch when using array with object as data.");
		}
		
		/*
		 * Test public method CTable->create($data, []).
		 *
		 */
		public function testMethodCreate()
		{
				// Test as normal array
				$data = [0 => ['id' => '1']];
				$table = new \Ann\HTMLTable\CTable();
				
				$table->create($data, []);
				
				$res = preg_replace('/\s+/', '', $table->table);
				$exp = '<tableclass=""><thead><tr><th>Id</th></tr></thead><tbody><tr><td>1</td></tr></tbody></table>';
				
				$this->assertEquals($res, $exp, "Created table missmatch when using array as data in method create().");
				
				// Test with object in array.
				$object = new \stdClass();
				$data = ['id' => '1'];
				
				foreach($data AS $key => $value){
						$object->$key = $value;
				}
				
				$array = array(0 => $object);
        $table->create($array, []);
				
				$res = preg_replace('/\s+/', '', $table->table);
				
				$this->assertEquals($res, $exp, "Created table missmatch when using array with object as data.");
		}
		
		/* 
		 * Test private method remove is called when $remove array exists.
		 *
		 */
		public function testMethodRemoveInCall()
		{
				$data = [0 => ['id' => '1', 'password' => 'removethis']];
				$remove = ['password'];
				$table = new \Ann\HTMLTable\CTable($data, $remove);
				
				$res = preg_replace('/\s+/', '', $table->table);
				$exp = '<tableclass=""><thead><tr><th>Id</th></tr></thead><tbody><tr><td>1</td></tr></tbody></table>';
				
				$this->assertEquals($res, $exp, "Created table missmatch.");
		}
		
		/*
		 * Test public method CTable->remove($data, $remove)
		 *
		 */
		public function testMethodRemove()
		{
				// First test
				$data = [0 => ['id' => '1', 'password' => 'removethis']];
				$remove = ['password'];
				$table = new \Ann\HTMLTable\CTable();
				
				$res = $table->remove($data, $remove);
				unset($data[0]['password']);
				
				$arraysAreEqual = ($res === $data);
				
				$this->assertTrue($arraysAreEqual);
				
				// Second test as array with object.
				$object = new \stdClass();
				$data = ['id' => '1', 'password' => 'removethis'];
				
				foreach($data AS $key => $value){
						$object->$key = $value;
				}
				
				$array = array(0 => $object);
				
				$res = $table->remove($array, $remove = ['password']);
				
				unset($array[0]->password);
				$exp = $array;
				
				$arraysAreEqual = ($res === $exp);
				$this->assertTrue($arraysAreEqual);
		}
		
		/**
		 * Test 
		 *
		 * @expectedException Exception
		 *
		 * @return void
		 *
		 */
		public function testCTableWierdArray() 
		{
				$data = [0 => 'this is not an array'];
				$remove = ['password'];
				
				$table = new \Ann\HTMLTable\CTable();
				$table->remove($data, $remove);
		}
}