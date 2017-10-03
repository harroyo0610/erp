<?php
include("header.php");
$dsn = 'mysql:dbname=erprueda_com_datab;host=127.0.0.1';
$user = 'root';
$password = '';

$conn = new PDO($dsn, $user, $password) or die('Error connecting to mysql');

$inv=$_GET['inv'];
$buscar1=$_POST['buscar1'];
$buscar2=$_POST['buscar2'];

?>
        <div id="page-wrapper">
            <div id="page-inner">


                <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-header">
                            <i class="fa fa-money"></i> Cuentas por Cobrar <small> </small>
                        </h1>
                    </div>
                </div>

				
				
                <div class="col-md-12">
                     <!--    Hover Rows  -->
                    <div class="panel panel-default">
                        <!-- <div class="panel-heading">
                            <a href="#add.php?es=blog"><i class='fa fa-plus-square'></i> Agregar Credito</a>
                        </div> -->
                        <div class="panel-body">
                            <div class="table-responsive">
<form role="form" action="porcobrar.php?inv=<?php echo $inv; ?>" method="post" name="form" id="form">
<div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Fecha Inicio</label>
                                            <input type="date" class="form-control" value="<?php echo $buscar1; ?>" id="buscar1" name="buscar1">
                                        </div>
</div>
<div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Fecha Fin</label>
                                            <input type="date" class="form-control" value="<?php echo $buscar2; ?>" id="buscar2" name="buscar2">
                                        </div>
</div>
<div class="col-lg-12">
                                        <div style="text-align:right;">
										<button type="submit" class="btn btn-default">Buscar</button>
										</div>
</div>
</form>
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
											<th>Orden</th>
											<th>Nombre</th>
											<th>Tipo</th>
											<th>Fecha de Venta</th>
											<th>Venta</th>
											<th>Bodega</th>
											<th>Status</th>
											<th>Tipo</th>
                                            <!-- <th><i class='fa fa-edit'></i></th>
                                            <th><i class='fa fa-trash-o'></i></th> -->
                                        </tr>
                                    </thead>
                                    <tbody>
									
									
<?php
// if ($inv==1)
// {
	// $query = mysql_query("select orden, nombre, tipo, sum(stotal) as total, fecha, bodegab, status from ordentc_b where status = 'venta' and tipo <> 'Industrial' or status = 'CANCELADO' and tipo <> 'Industrial' group by orden", $conn);
// }else{
	// $query = mysql_query("select orden, nombre, tipo, sum(stotal) as total, fecha, bodegab, status from ordentc_b where status = 'venta' and tipo = 'Industrial' or status = 'CANCELADO' and tipo = 'Industrial' group by orden", $conn);
// }


$sql = "SELECT orden, nombre, tipo, sum(stotal) AS total, fecha, bodegab, status, tpago FROM ordentc_c WHERE status = 'venta' AND tpago = 'Credito' GROUP BY orden";

if ($buscar1<>'' and $buscar2<>'')
{
	$sql = "SELECT * FROM ordentc_c    WHERE status = 'venta' AND tpago = 'Credito' AND fecha BETWEEN '$buscar1' AND '$buscar2'";
}
$query = $conn->prepare($sql);
$query->execute(array());
while($row = $query->fetchAll()) {
$total=number_format($row['total'], 2, '.', ',');
echo "
                                        <tr>
											<td><a href='venta_orden.php?id=$row[orden]' target='blank'>$row[orden]</a></td>
											<td>$row[nombre]</td>
											<td>$row[tipo]</td>
											<td>$row[fecha]</td>
											<td>$ $total</td>
											<td>$row[bodegab]</td>
											<td>$row[status]</td>
											<td>$row[tpago]</td>
                                            <!-- <td><a href='#add_blog.php?es=$row[id]'><i class='fa fa-edit'></i></a></td>
                                            <td><a href='#dlt_b.php?id=$row[id]&go=blog&tb=blog&gale=$row[foto]' class='bDelete' onclick='return confirm(&#39;Realmente desea eliminar el registro? Se eliminará la información relacionada&#39;)'><i class='fa fa-trash-o'></i></a></td> -->
                                        </tr>
";
		}

?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- End  Hover Rows  -->
                </div>
				
				
				<footer><p><?php echo date("Y"); ?> &copy; <a href="http://sisecorp.com" target="_blank">SISE Tecnologias S.A. de C.V.</a></p></footer>
            </div>
            <!-- /. PAGE INNER  -->
        </div>
        <!-- /. PAGE WRAPPER  -->
    </div>
    <!-- /. WRAPPER  -->
    <!-- JS Scripts-->
    <!-- jQuery Js -->
    <script src="assets/js/jquery-1.10.2.js"></script>
    <!-- Bootstrap Js -->
    <script src="assets/js/bootstrap.min.js"></script>
    <!-- Metis Menu Js -->
    <script src="assets/js/jquery.metisMenu.js"></script>
    <!-- Morris Chart Js -->
    <script src="assets/js/morris/raphael-2.1.0.min.js"></script>
    <script src="assets/js/morris/morris.js"></script>
    <!-- Custom Js -->
    <script src="assets/js/custom-scripts.js"></script>


</body>

</html>