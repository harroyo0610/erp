<nav class="navbar-default navbar-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="main-menu">

                    <li>
                        <a href="index.php"><i class="fa fa-dashboard"></i> Dashboard</a>
                    </li>
					
                    <li>
                        <a href="#"><i class="fa fa-database"></i> Inventario<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="inventario_view.php?inv=1">Artesanal</a>
                            </li>
                            <li>
                                <a href="inventario_view.php?inv=2">Industrial</a>
                            </li>
<?php
if ($_SESSION['tipo']=="admin")
{
?>
                            <li>
                                <a href="add_inventario.php">Producto</a>
                            </li>
<?php
}
?>
                            <li>
                                <a href="inventario_view_mov.php">Movimientos Inventario</a>
                            </li>
                        </ul>
                    </li>
					
					
                    <li>
                        <a href="#"><i class="fa fa-tag"></i> Clientes<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="add_cliente.php">Alta</a>
                            </li>
                            <li>
                                <a href="clientes_view.php">Ver Clientes</a>
                            </li>
                        </ul>
                    </li>
					

                    <li>
                        <a href="venta_view.php"><i class="fa fa-tag"></i> Ventas</a>
                    </li>
					
<?php
if ($_SESSION['tipo']=="admin")
{
?>
                    <li>
                        <a href="#"><i class="fa fa-shopping-cart"></i> Compras<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="add_orden.php">Orden Nueva</a>
                            </li>
                            <li>
                                <a href="ordenes_view.php">Ordenes</a>
                            </li>
                            <!-- <li>
                                <a href="#">Detalles</a>
                            </li> -->
                        </ul>
                    </li>
<?php
}
?>				
					
                    <li>
                        <a href="#"><i class="fa fa-truck"></i> Control de Embarques<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="add_embarque.php">Nuevo</a>
                            </li>
                            <li>
                                <a href="embarques_view.php">Detalle</a>
                            </li>
                        </ul>
                    </li>
					
                    <li>
                        <a href="cotiza_view.php"><i class="fa fa-edit"></i> Cotizar</a>
                    </li>

                    <li>
                        <a href="porcobrar.php"><i class="fa fa-money"></i> Cuentas por Cobrar</a>
                    </li>
					
<?php
if ($_SESSION['tipo']=="admin")
{
?>
                    <li>
                        <a href="#"><i class="fa fa-credit-card-alt"></i> Creditos a Empleados<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="add_credito.php">Nuevo</a>
                            </li>
                            <!-- <li>
                                <a href="#add_credito.php">Abonar</a>
                            </li> -->
                            <li>
                                <a href="creditos_emp_view.php">Detalle</a>
                            </li>
                        </ul>
                    </li>
					
                    <li>
                        <a href="#"><i class="fa fa-credit-card"></i> Cuentas por Pagar<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="add_credito.php">Nuevo</a>
                            </li>
                            <li>
                                <a href="creditos_view.php">Detalle</a>
                            </li>
                        </ul>
                    </li>
					
					
                    <li>
                        <a href="#"><i class="fa fa-line-chart"></i> Proyeccion de Ventas<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="proyeccion_view.php?inv=1">Artesanal</a>
                            </li>
                            <li>
                                <a href="proyeccion_view.php?inv=2">Industrial</a>
                            </li>
                        </ul>
                    </li>
					
					
                    <li>
                        <a href="#"><i class="fa fa-briefcase"></i> Caja Chica<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="add_caja.php">Nuevo</a>
                            </li>
                            <li>
                                <a href="caja_chica_view.php">Detalle</a>
                            </li>
                            <li>
                                <a href="add_caja_corte.php">Corte de Caja</a>
                            </li>
                            <li>
                                <a href="caja_chica_view_h.php">Historico</a>
                            </li>
                        </ul>
                    </li>


                    <li>
                        <a href="#"><i class="fa fa-dollar"></i> Costos<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="add_costos.php">Nuevo</a>
                            </li>
                            <li>
                                <a href="costos_view.php">Detalle</a>
                            </li>
                            <!-- <li>
                                <a href="#">Grafico</a>
                            </li> -->
                        </ul>
                    </li>
					
                    <li>
                        <a href="log_accesos.php"><i class="fa fa-history"></i> Log Accesos</a>
                    </li>
<?php
}
?>
					
                    <!--
					<li>
                        <a href="biblioteca.php"><i class="fa fa-book"></i> Bilblioteca</a>
                    </li>
                    <li>
                        <a href="blog.php"><i class="fa fa-rss-square"></i> Blog</a>
                    </li>
					-->
					
                </ul>

            </div>

        </nav>
        <!-- /. NAV SIDE  -->
		
<!-- class="active-menu" -->