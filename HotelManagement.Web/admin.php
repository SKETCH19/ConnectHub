<?php
// Verificación de rol de administrador
// session_start();
// if (!isset($_SESSION['usuario']) || $_SESSION['rol'] !== 'admin') {
    // header('Location: Iniciar Sesión.php');
    // exit(); }

?>
<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Hotel Template">
    <meta name="keywords" content="Hotel, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Hotel | Template</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css?family=Taviraj:300,400,500,600,700,800,900&display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800&display=swap" rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="css/Admin.css" type="text/css">
</head>

<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    <!-- Header -->
     <?php 
				 include ("Templates/menu.php");
				 ?>
    <!-- Close Header -->

<!-- Hero Section End -->

    <div class="admin-container">
        <aside class="admin-sidebar">
            <div class="admin-logo">
                <i class="fas fa-hotel"></i>
                <span>Hotel Admin</span>
            </div>
            <nav class="admin-nav">
                <ul>
                    <li class="active"><a href="#dashboard"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
                    <li><a href="#reportes"><i class="fas fa-file-alt"></i> Reportes</a></li>
                    <li><a href="#configuracion"><i class="fas fa-cog"></i> Configuración</a></li>
                    <li><a href="#habitaciones"><i class="fas fa-bed"></i> Habitaciones</a></li>
                    <li><a href="#pisos"><i class="fas fa-layer-group"></i> Pisos</a></li>
                    <li><a href="#temporadas"><i class="fas fa-calendar-alt"></i> Temporadas</a></li>
                </ul>
            </nav>
            <div class="admin-logout">
                <a href="logout.php"><i class="fas fa-sign-out-alt"></i> Cerrar Sesión</a>
            </div>
        </aside>

        <main class="admin-main">
            <header class="admin-header">
                <h1>Panel de Administración</h1>
                <div class="admin-user">
                    <span><?php echo $_SESSION['usuario']; ?></span>
                    <i class="fas fa-user-circle"></i>
                </div>
            </header>

            <section id="dashboard" class="admin-section">
                <h2><i class="fas fa-tachometer-alt"></i> Dashboard</h2>
                <div class="metrics-grid">
                    <div class="metric-card">
                        <div class="metric-value">85%</div>
                        <div class="metric-label">Ocupación</div>
                        <div class="metric-icon"><i class="fas fa-bed"></i></div>
                    </div>
                    <div class="metric-card">
                        <div class="metric-value">$24,580</div>
                        <div class="metric-label">Ingresos</div>
                        <div class="metric-icon"><i class="fas fa-dollar-sign"></i></div>
                    </div>
                    <div class="metric-card">
                        <div class="metric-value">12</div>
                        <div class="metric-label">Reservas Pendientes</div>
                        <div class="metric-icon"><i class="fas fa-calendar-check"></i></div>
                    </div>
                    <div class="metric-card">
                        <div class="metric-value">8</div>
                        <div class="metric-label">Huespedes Hoy</div>
                        <div class="metric-icon"><i class="fas fa-users"></i></div>
                    </div>
                </div>

                <div class="charts-container">
                    <div class="chart-card">
                        <h3>Ocupación Mensual</h3>
                        <canvas id="ocupacionChart"></canvas>
                    </div>
                    <div class="chart-card">
                        <h3>Ingresos por Temporada</h3>
                        <canvas id="ingresosChart"></canvas>
                    </div>
                </div>
            </section>

            <section id="reportes" class="admin-section" style="display:none;">
                <h2><i class="fas fa-file-alt"></i> Reportes</h2>
                <div class="report-actions">
                    <button class="btn-report" id="btnAuditoriaPDF">
                        <i class="fas fa-file-pdf"></i> Generar Reporte de Auditoría (PDF)
                    </button>
                    <button class="btn-report" id="btnTarifasExcel">
                        <i class="fas fa-file-excel"></i> Generar Reporte de Tarifas (Excel)
                    </button>
                    <button class="btn-report" id="btnReservasPDF">
                        <i class="fas fa-file-pdf"></i> Reporte de Reservas (PDF)
                    </button>
                </div>
                <div class="report-preview">
                    <div class="report-placeholder">
                        <i class="fas fa-file-alt"></i>
                        <p>Seleccione un tipo de reporte para generar</p>
                    </div>
                </div>
            </section>

            <section id="configuracion" class="admin-section" style="display:none;">
                <h2><i class="fas fa-cog"></i> Configuración</h2>
                <div class="config-tabs">
                    <button class="tab-btn active" data-tab="habitaciones">Habitaciones</button>
                    <button class="tab-btn" data-tab="pisos">Pisos</button>
                    <button class="tab-btn" data-tab="temporadas">Temporadas</button>
                </div>

                <div id="habitaciones" class="tab-content active">
                    <div class="crud-actions">
                        <button class="btn-add" id="btnAddHabitacion">
                            <i class="fas fa-plus"></i> Agregar Habitación
                        </button>
                    </div>
                    <table class="crud-table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Número</th>
                                <th>Tipo</th>
                                <th>Piso</th>
                                <th>Estado</th>
                                <th>Precio</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>101</td>
                                <td>101</td>
                                <td>Individual</td>
                                <td>1</td>
                                <td><span class="status available">Disponible</span></td>
                                <td>$125</td>
                                <td>
                                    <button class="btn-edit"><i class="fas fa-edit"></i></button>
                                    <button class="btn-delete"><i class="fas fa-trash"></i></button>
                                </td>
                            </tr>
                            <!-- Más filas de habitaciones -->
                        </tbody>
                    </table>
                </div>

                <div id="pisos" class="tab-content">
                    <!-- Contenido similar para pisos -->
                </div>

                <div id="temporadas" class="tab-content">
                    <!-- Contenido similar para temporadas -->
                </div>
            </section>
        </main>
    </div>

    <!-- Modal para agregar/editar -->
    <div class="modal" id="habitacionModal">
        <div class="modal-content">
            <span class="close-modal">&times;</span>
            <h3 id="modalTitle">Agregar Nueva Habitación</h3>
            <form id="habitacionForm">
                <div class="form-group">
                    <label for="numero">Número:</label>
                    <input type="text" id="numero" name="numero" required>
                </div>
                <div class="form-group">
                    <label for="tipo">Tipo:</label>
                    <select id="tipo" name="tipo" required>
                        <option value="individual">Individual</option>
                        <option value="doble">Doble</option>
                        <option value="suite">Suite</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="piso">Piso:</label>
                    <input type="number" id="piso" name="piso" min="1" max="10" required>
                </div>
                <div class="form-group">
                    <label for="precio">Precio por noche:</label>
                    <input type="number" id="precio" name="precio" min="50" step="10" required>
                </div>
                <button type="submit" class="btn-submit">Guardar</button>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.7.1/dist/chart.min.js"></script>
    <script src="js/admin.js"></script>
    <!-- Section End -->

    <!-- Footer Section Begin -->
          <?php 
				 include ("Templates/footer.php");
				 ?>
    <!-- Footer Section End -->

    <!-- Js Plugins -->
    <script src="js/Admin.js"></script>
</body>

</html>