<?php
include_once('../autoloader.php');

$data = [
						0 => [
											'id'       => '1',
											'name'     => 'Andreas',
											'email'    => 'andreas@example.com',
											'password' => 'We don\'t want to show this',
								 ],
						1 => [
											'id'       => '2',
											'name'     => 'Kalle',
											'email'    => 'kalle@example.com',
											'password' => 'We don\'t want to show this',
								 ],
						2 => [
											'id'       => '3',
											'name'     => 'John',
											'email'    => 'john@example.com',
											'password' => 'We don\'t want to show this',
								 ],
				];
	
// We want to remove "password" from $data, in case $data was a database query result. CTable can do that for us.
$remove = ['password'];

$table = new \Ann\HTMLTable\CTable($data, $remove, 'table-css-class');
?>
<!doctype html>
<html>
<head>
	<meta charset=utf8>
	<title>CTable Example: How to create HTML table with CTable.</title>
	<style>
		table.table-css-class{
			font-size:26px;
		}
		th, td{
			border:1px solid #999999;
			padding:5px;
			text-align:left;
		}
	</style>
</head>
<body>
	<h1>CTable Example: How to create HTML table with CTable.</h1>
	<p>First of all CTable needs some data to display. This below is how my array $data looks like. This is the content I want to show in a html table.</p>
	<?=var_dump($data)?>
	<h2>I don't want to show the array key "password" to everyone.</h2>
	<p>To remove the "password" key I add the key name in another array $remove = ['password'];</p>
	<?=var_dump($remove)?>
	<h2>Create and display table</h2>
	<p><pre><code>
$table = new \Ann\HTMLTable\CTable($data, $remove, 'table-css-class');
echo $table->table;
	</code></pre></p>
	<?=$table->table?>
	<p>As you see above "password" never showed up cause CTable removed it from $data. </p>
</body>
</html>