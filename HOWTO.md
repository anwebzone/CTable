#How to use CTable.

###Use CTable
When downloading CTable there is an example file in the webroot folder that explains how to use CTable.

Short and simple CTable can take 2 arrays and one string.
The first array is the data to be used when generating the html table.
The second array is used if you want to remove any key or keys from the first array.

The string is used to add css classes to <table>

Using CTable could look like this

$table = new \Ann\HTMLTable\CTable($data, $remove, 'table-css-class');
echo $table->table;




