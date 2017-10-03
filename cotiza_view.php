<?php
$dsn = 'mysql:dbname=erprueda_com_datab;host=127.0.0.1';
$user = 'root';
$password = '';

$conn = new PDO($dsn, $user, $password) or die('Error connecting to mysql');
include("header.php");
?>

<script>
function objetoAjax(){
	var xmlhttp=false;
	try {
		xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
	} catch (e) {
 
	try {
		xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	} catch (E) {
		xmlhttp = false;
	}
}
 
if (!xmlhttp && typeof XMLHttpRequest!='undefined') {
	  xmlhttp = new XMLHttpRequest();
	}
	return xmlhttp;
}


function clear(form) {
    document.getElementById(form).reset();
}

function frm_snd(form) {
	// alert(form);
	document.getElementById(form).submit();
}

function borrar(tbl,id)
{
	// alert('hola entre aqui hermosa muacks!!');
	//donde se mostrará el resultado
	divResultado = document.getElementById('resultado');
	//divResultado.innerHTML = "<img src='../img/ajax-loader.gif'>";
	// divResultado.innerHTML = "<img src='../../assets/admin/layout4/img/loading-spinner-blue.gif'>"; 

	//instanciamos el objetoAjax
	ajax=objetoAjax();
	//usamos el medoto POST
	//archivo que realizará la operacion
 //datoscliente.php
//	ajax.open("POST",Url,true);  se pasara distinto url al codigo
	ajax.open("POST", "erase.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState!=4) {
			// divResultado.innerHTML = "<img src='../../assets/admin/layout4/img/loading-spinner-blue.gif'>"; 
		}
		else
		{
			//mostrar resultados en esta capa
			divResultado.innerHTML = ajax.responseText
			
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores
 ajax.send("tbl="+tbl+"&id="+id)
	
}

function mostrardiv(descn) {
div = document.getElementById('N'+descn);
div.style.display = '';
div = document.getElementById('M'+descn);
div.style.display='none';
div = document.getElementById('MN'+descn);
div.style.display='';
}

function cerrar(ab) {
div = document.getElementById('N'+ab);
div.style.display='none';
div = document.getElementById('M'+ab);
div.style.display = '';
div = document.getElementById('MN'+ab);
div.style.display='none';
}

function mostrardiv_o(descn) {
div = document.getElementById('NO'+descn);
div.style.display = '';
// div = document.getElementById('MO'+descn);
// div.style.display='none';
// div = document.getElementById('MN'+descn);
// div.style.display='';
}

function cerrar_o(ab) {
div = document.getElementById('NO'+ab);
div.style.display='none';
// div = document.getElementById('MO'+ab);
// div.style.display = '';
// div = document.getElementById('MN'+ab);
// div.style.display='none';
}


function mostrar(div){
document.getElementById(div).style.display = 'block';
}

function hide(div){
document.getElementById(div).style.display = 'none';
// document.getElementById('radio-19').checked = false;
// document.getElementById('radio-20').checked = false;
// document.getElementById('radio-21').checked = false;
}

</script>

<?php



$cliente=$_POST['cliente'];
$clv=$_POST['buscar'];
$qty=$_POST['qty'];
$orden=$_POST['tc'];
$buscar=$_POST['buscar'];

$descuento=$_POST['descuento'];
$bodega=$_POST['bodega'];
$tpago=$_POST['tpago'];

// session_start();
$usuario=$_SESSION['usuario'];

if ($orden=='')
{
$sql = "DELETE FROM 'ordentc' WHERE status='pre'";
$query = $conn->prepare($sql);
$query->execute(array());
$row = $query->fetchAll();
	$orden=uniqid();
}else{
	$orden=$_POST['tc'];
}

if ($buscar=='')
{
	
}else{
$query = "SELECT * FROM 'inventario' WHERE clave='$clv'";
$query = $conn->prepare($sql);
$query->execute(array());
$row = $query->fetchAll();
$precio=$row['venta'];
$desc_prod=$row['descripcion'];
$inventario=$row['cantidad'];
$clave=$row['clave'];

$SQL0 = "SELECT sum(qty) AS qty FROM `ordentc` WHERE producto='$clv' AND orden='$orden'";
$query0 = $conn->prepare($sql0);
$query0->execute(array());
$row0 = $query0->fetchAll();
$ordenqty=$row0['qty'];

// $qtyordenvolatil=$inventario-$ordenqty;
$qtyorden=$inventario-$ordenqty-$qty;

	if($clave == '')
	{
echo "<script type=\"text/javascript\">alert(\"Producto no Existe!\");</script>";  
	}else{

		
		
		if($qty < 1)
		{
		echo "<script type=\"text/javascript\">alert(\"Por favor ingrese cantidad de producto mayor o igual a 1\");</script>"; 
		}else{
			if($descuento < 0)
			{
			echo "<script type=\"text/javascript\">alert(\"Por favor ingrese descuento de producto mayor a 0\");</script>"; 
			}else{
					if($qtyorden < 0)
					{
						$exedente=$qtyorden*-1;
				echo "<script type=\"text/javascript\">alert(\"No se cuenta con el inventario suficiente para surtir pedido! Disponible: $inventario Reservadas en Pedido: $ordenqty Exedente Solicitado: $exedente \");</script>";
				//
					$sql = "
						insert into ordentc set
								cliente='$cliente',
								producto='$clv',
								qty='$qty',
								orden='$orden',
								precio='$precio',
								descuento='$descuento',
								bodegab='$bodega',
								tpago='$tpago',
								descripcionb='$desc_prod',
								status='pre',
								usuario='$usuario'
					";
					$query = $conn->prepare($sql);
					$query->execute(array());
					$row = $query->fetchAll();
					}else{
					$sql = "
						insert into ordentc set
								cliente='$cliente',
								producto='$clv',
								qty='$qty',
								orden='$orden',
								precio='$precio',
								descuento='$descuento',
								bodegab='$bodega',
								tpago='$tpago',
								descripcionb='$desc_prod',
								status='pre',
								usuario='$usuario'
					";
					$query = $conn->prepare($sql);
					$query->execute(array());
					$row = $query->fetchAll();
					}
			}
		}
		
		
		
	}
}

?>
        <div id="page-wrapper">
            <div id="page-inner">


                <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-header">
                            <i class="fa fa-edit"></i> Cotizar <small></small>
                        </h1>
                    </div>
                </div>

				
				
                <div class="col-md-12">
                     <!--    Hover Rows  -->
                    <div class="panel panel-default">
                        <!-- <div class="panel-heading">
                            <a href="add_inventario.php"><i class='fa fa-plus-square'></i> Agregar Producto</a>
                        </div> -->
                        <div class="panel-body">
                            <div class="table-responsive">
							
<form role="form" action="cotiza_view.php?inv=<?php echo "$inv"; ?>" method="post" name="form" id="form">


                                        <div class="form-group">
                                            <label>TC# </label>
<input class="form-control" type="text" class="input-text" placeholder="TC# <?php echo "$orden"; ?>" id="tc" name="tc" readonly="readonly" value="<?php echo "$orden"; ?>"/>
											<br>
                                            <label>Ingrese Producto UPC</label>
                                            <input class="form-control" value="<?php echo "$buscar"; ?>" id="buscar" name="buscar">
                                        </div>
                                        <div style="text-align:right;">
										<button type="submit" class="btn btn-default">Agregar</button>
										</div>




                                <table class="table table-hover">
                                    <thead>
                                        <tr>
											<th>UPC / Producto</th>
											<th>Cantidad</th>
											<th>Precio Unitario</th>
											<th>Descuento</th>
											<th>Bodega</th>
											<th>Unitario con Descuento</th>
											<th>SubTotal</th>
                                            <th><i class='fa fa-trash-o'></i></th>
                                        </tr>
                                    </thead>
                                    <tbody>
									
									
<?php
// if ($inv==1)
// {
	// $query = mysql_query("select * from inventario where tipo <> 'Industrial'", $conn);
// }else{
	$sql = "SELECT *,(((`qty`*`precio`)/100*`descuento`)-(`qty`*`precio`))*-1 AS stotal FROM ordentc WHERE orden='$orden'";
// }


if ($buscar<>'')
{
	$sql = "SELECT *,(((`qty`*`precio`)/100*`descuento`)-(`qty`*`precio`))*-1 AS stotal FROM ordentc WHERE orden='$orden' ORDER BY id DESC";
}

$precio_ttl=0;
$query = $conn->prepare($sql);
$query->execute(array());
	while($row = $query->fetchAll()) {
$pcdesc=($row['precio']/100)*$row['descuento'];
$pcdesc=$row['precio']-$pcdesc;
$pcdesc=number_format($pcdesc, 2, '.', ',');
$precio=number_format($row['precio'], 2, '.', ',');
$descuento=$row['descuento']*1;
$precio_ttl=$row['stotal']+$precio_ttl;
$precio_ttl=number_format($precio_ttl, 2, '.', ',');
	echo "
	<tr id='NO$row[id]'>
		<td style='text-align: center; background-color:#d9edf7;'>$row[producto]<br>$row[descripcionb]</td>
		<td style='text-align: center; background-color:#d9edf7;'>$row[qty]</td>
		<td style='text-align: center; background-color:#d9edf7;'>$ $precio</td>
		<td style='text-align: center; background-color:#d9edf7;'>$descuento %</td>
		<td style='text-align: center; background-color:#d9edf7;'>$row[bodegab]</td>
		<td style='text-align: center; background-color:#d9edf7;'>$ $pcdesc</td>
		<td style='text-align: center; background-color:#d9edf7;'>$ $row[stotal]</td>
		<td style='text-align: center; background-color:#d9edf7;'><a href=\"javascript:cerrar_o($row[id]), borrar('ordentc','$row[id]')\"><i class='fa fa-trash-o'></i></a></td>
                                        </tr>
";
		}

?>
                                    </tbody>
                                </table>
								
<a href="venta_sl_1.php?id=<?php echo "$orden"; ?>" class="btn btn-default pull-right" target="_blank">Guardar / Cotizar</a>
<br>							
<br>


								<div class="form-group">
									<label>Cliente:</label>
<select class="form-control" id="cliente" name="cliente" <?php if ($cliente<>''){echo "readonly='readonly'";}?>>
		<option value=''>- Seleccione Cliente -</option>
<?php
$sql = "SELECT * FROM clientes";

$query = $conn->prepare($sql);
$query->execute(array());
while($row = $query->fetchAll()) {
	
	if($row['id']==$cliente)
	{
		$es="selected='selected'";
	}else{
		$es="";			
	}
echo "
			<option value='$row[id]' $es>$row[id] - $row[nombre]</option>               
";
}
?>
</select>
								</div>
		
		
										
										
								<div class="form-group">
									<label>Bodega:</label>
		<select class="form-control" id="bodega" name="bodega" <?php if ($bodega<>''){echo "readonly='readonly'";}?>>
		<option value=''>- Seleccione Bodega -</option>
		<option value='Ramos Millan' <?php if($bodega=='Ramos Millan'){echo "selected='selected'";} ?>>Ramos Millan</option>
		<option value='Texcoco' <?php if($bodega=='Texcoco'){echo "selected='selected'";} ?>>Texcoco</option>
		<option value='Veloz' <?php if($bodega=='Veloz'){echo "selected='selected'";} ?>>Veloz</option>
		</select>
								</div>
								
								
								<div class="form-group">
									<label>Pago:</label>
		<select class="form-control" id="tpago" name="tpago" <?php if ($tpago<>''){echo "readonly='readonly'";}?>>
		<option value='Contado' <?php if($tpago=='Contado'){echo "selected='selected'";} ?>>Contado</option>
		<option value='Credito' <?php if($tpago=='Credito'){echo "selected='selected'";} ?>>Credito</option>
		</select>
								</div>
								
                                        <div class="form-group">
                                            <label>Cantidad</label>
                                            <input class="form-control" value="1" id="qty" name="qty">
                                        </div>
										
                                        <div class="form-group">
                                            <label>Descuento</label>
                                            <input class="form-control" value="0" id="descuento" name="descuento">
                                        </div>
										
										
										

</form>
										
										
<!-- TABLA -->
<!-- TABLA -->
<!-- TABLA -->
<!-- TABLA -->
<!-- TABLA -->
<!-- TABLA -->
<!-- TABLA -->
								

								
                            </div>
                        </div>
                    </div>
                    <!-- End  Hover Rows  -->
                </div>
				<div style="display: inline-block; float: right;" id="resultado"></div>
				
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