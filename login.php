<?php
if (isset($_POST['usr']))
{
require('connection.php');

$usr=$_POST['usr'];
$pssw=$_POST['pssw'];

$sql = "SELECT * FROM usuarios WHERE usuario='$usr'";
$row = "";
try {
    //connect as appropriate as above
    $query = $conn->query($sql); //invalid query!
} catch(PDOException $ex) {
    echo "An Error occured!"; //user friendly message
    some_logging_function($ex->getMessage());
}
$pass = "";
while ($row=$query->fetch(PDO::FETCH_ASSOC)) {
    $pass = $row;

}

if ($pssw==$pass['contrasena'] and $pssw<>'')
{
	session_start();
	$_SESSION['usuario']=$row['usuario'];
	$_SESSION['nombre']=$row['nombre'];
	$_SESSION['usrid']=$row['id'];
	$_SESSION['tipo']=$row['tipo'];
	


$sql1 = "INSERT INTO accesos SET usuario='$usr'";
$statement = $conn->prepare($sql1);
$statement->execute(array());
$row1 = $statement->fetchAll();


	header ("location: index.php");
}
else
{
	echo "<script type=\"text/javascript\">alert(\"Verifica tu usuario y contraseña!\");</script>";  
}
}

if (isset($_GET['es']))
{
	$es=$_GET['es'];
}else{
	$es='';
}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Paycesa</title>
    <!-- Bootstrap Styles-->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <!-- FontAwesome Styles-->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <!-- Morris Chart Styles-->
    <link href="assets/js/morris/morris-0.4.3.min.css" rel="stylesheet" />
    <!-- Custom Styles-->
    <link href="assets/css/custom-styles.css" rel="stylesheet" />
    <!-- Google Fonts-->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
<style>
body {
    background-color: #f8f8f8;
}
.login-panel {
    margin-top: 10%;
}

.panel-default {
    border-color: #ddd;
}
.panel {
    margin-bottom: 20px;
    background-color: #fff;
    border: 1px solid transparent;
    border-radius: 4px;
    -webkit-box-shadow: 0 1px 1px rgba(0,0,0,.05);
    box-shadow: 0 1px 1px rgba(0,0,0,.05);
}
.panel-default>.panel-heading {
    color: #333;
    background-color: #f5f5f5;
    border-color: #ddd;
}
.panel-heading {
    padding: 10px 15px;
    border-bottom: 1px solid transparent;
    border-top-left-radius: 3px;
    border-top-right-radius: 3px;
}
</style>
</head>

<body>

    <div class="container">
        <div class="row">
			<center><img src="paycesa.png" width="70"></center>
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default" style="border-color: #ddd;">
                    <div class="panel-heading">
                        <h3 class="panel-title">Iniciar Sesion</h3>
                    </div>
                    <div class="panel-body">
                        <form role="form" action="login.php" method="post" name="loginForm" id="loginForm">
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Usuario" name="usr" type="text" autofocus>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Contraseña" name="pssw" type="password" value="">
                                </div>
                                <!-- <div class="checkbox">
                                    <label>
                                        <input name="remember" type="checkbox" value="Remember Me">Remember Me
                                    </label>
                                </div> -->
                                <!-- Change this to a button or input when using this as a form -->
                                <input type="submit" class="btn btn-lg btn-success btn-block" value="Entrar">
                                <!-- <a href="#index.html" class="btn btn-lg btn-success btn-block">Entrar</a> -->
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

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
