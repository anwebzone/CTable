<?php
include_once('../autoloader.php');

// First array is $data, second is $remove, third is string to add css classes to <table>
$table = new \Ann\HTMLTable\CTable(
									[
											0 => [
																'id'       => '1',
																'name'     => 'Andreas',
																'password' => 'We don\'t want to show this',
											     ],
											1 => [
																'id'       => '2',
																'name'     => 'Kalle',
																'password' => 'We don\'t want to show this',
											     ],
											2 => [
																'id'       => '3',
																'name'     => 'John',
																'password' => 'We don\'t want to show this',
											     ],
									],
									['password'],
									'table-css-class'
							);
?>
<!doctype html>
<html>
<head>
	<meta charset=utf8>
	<title>CTable Example: How to create CTable using array</title>
	<style>
		table.table-css-class{
			font-size:26px;
		}
		th, td{
			border:1px solid #999999;
			padding:5px;
		}
	</style>
</head>
<body>
	<h1>CTable Example: How to create CTable using array</h1>
	<?=$table->table?>
</body>
</html>