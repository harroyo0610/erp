<?php
include("header.php");
?>
        <div id="page-wrapper">
            <div id="page-inner">


                <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-header">
                            Dashboard <small>Resumen</small>
                        </h1>
                    </div>
                </div>
                <!-- /. ROW  -->

                <div class="row">
<?php
$sql = "SELECT count(*) FROM 'ordentc'";
$statement = $conn->prepare($sql);
$statement->execute(array());
$row = $statement->fetch();
?>
                    <div class="col-md-3 col-sm-12 col-xs-12">
                        <div class="panel panel-primary text-center no-boder bg-color-green">
                            <div class="panel-body">
                                <i class="fa fa-tag fa-5x"></i>
                                <h3><?php echo $row[0]; ?></h3>
                            </div>
                            <div class="panel-footer back-footer-green">
Ventas Contado
                            </div>
                        </div>
                    </div>

<?php
$sql = "SELECT count(*) FROM 'inventario' WHERE cantidad='0'";
$statement = $conn->prepare($sql);
$statement->execute(array());
$row = $statement->fetch();
?>
					<div class="col-md-3 col-sm-12 col-xs-12">
                        <div class="panel panel-primary text-center no-boder bg-color-red">
                            <div class="panel-body">
                                <i class="fa fa-warning fa-5x"></i>
                                <h3><?php echo $row[0]; ?></h3>
                            </div>
                            <div class="panel-footer back-footer-red">
Productos sin Inventario
                            </div>
                        </div>
                    </div>
					
<?php
$query = "SELECT count(*) FROM 'ordentc' WHERE tpago='Credito' and status='Venta'";
$statement = $conn->prepare($sql);
$statement->execute(array());
$row = $statement->fetch();

?>
					<div class="col-md-3 col-sm-12 col-xs-12">
                        <div class="panel panel-primary text-center no-boder bg-color-red">
                            <div class="panel-body">
                                <i class="fa fa-money fa-5x"></i>
                                <h3><?php echo $row[0]; ?></h3>
                            </div>
                            <div class="panel-footer back-footer-red">
Ventas a Credito
                            </div>
                        </div>
                    </div>
					
					
<?php
$query = "SELECT count(*) FROM 'embarques' WHERE status='En Proceso'";
$statement = $conn->prepare($sql);
$statement->execute(array());
$row = $statement->fetch();
?>
					<div class="col-md-3 col-sm-12 col-xs-12">
                        <div class="panel panel-primary text-center no-boder bg-color-brown">
                            <div class="panel-body">
                                <i class="fa fa-truck fa-5x"></i>
                                <h3><?php echo $row[0]; ?></h3>
                            </div>
                            <div class="panel-footer back-footer-brown">
Embarques en Proceso
                            </div>
                        </div>
                    </div>
					
					
<?php
$query = "SELECT count(*) FROM 'creditos' WHERE vencimiento >= CURDATE()";
$statement = $conn->prepare($sql);
$statement->execute(array());
$row = $statement->fetch();
?>
<?php
if ($_SESSION['tipo']=="admin")
{
?>
                    <div class="col-md-3 col-sm-12 col-xs-12">
                        <div class="panel panel-primary text-center no-boder bg-color-green">
                            <div class="panel-body">
                                <i class="fa fa-credit-card fa-5x"></i>
                                <h3><?php echo $row[0]; ?></h3>
                            </div>
                            <div class="panel-footer back-footer-green">
Por pagar pendientes
                            </div>
                        </div>
                    </div>
<?php
}
?>
<?php
$query = "SELECT count(*) FROM 'creditos' WHERE vencimiento < CURDATE()";
$statement = $conn->prepare($sql);
$statement->execute(array());
$row = $statement->fetch();
?>
<?php
if ($_SESSION['tipo']=="admin")
{
?>
                    <div class="col-md-3 col-sm-12 col-xs-12">
                        <div class="panel panel-primary text-center no-boder bg-color-red">
                            <div class="panel-body">
                                <i class="fa fa-credit-card fa-5x"></i>
                                <h3><?php echo $row[0]; ?></h3>
                            </div>
                            <div class="panel-footer back-footer-red">
Por pagar vencidas
                            </div>
                        </div>
                    </div>
<?php
}
?>	
					

                </div>
                <!-- /. ROW  -->
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