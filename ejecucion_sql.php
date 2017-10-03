<pre>
<?php 
require('connection.php');

$sql = 'select * from usuarios';

foreach($conn->query( $sql ) as $rs)
{
    var_dump($rs);
}

?>
</pre>