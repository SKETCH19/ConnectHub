<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Hotel Template">
    <meta name="keywords" content="Hotel, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Hotel | Reservas</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css?family=Taviraj:300,400,500,600,700,800,900&display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800&display=swap" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    
    <!-- Linearicons -->
    <link rel="stylesheet" href="https://cdn.linearicons.com/free/1.0.0/icon-font.min.css">

    <!-- Css Styles -->
     <link rel="stylesheet" href="css/Reservas.css" type="text/css">
</head>

<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    <!-- Header -->
    <?php include("Templates/menu.php"); ?>
    <!-- Close Header -->

<!-- Booking Section Begin -->
<section class="booking-section spad">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10 col-xl-8">
                <div class="booking-container">
                    <div class="booking-header text-center">
                        <h2 class="section-title">Reserva tu Habitación</h2>
                        <p class="section-subtitle">Complete los siguientes pasos para realizar su reserva</p>
                    </div>
                    
                    <div class="booking-steps">
                        <div class="step active" data-step="1">
                            <span class="step-number">1</span>
                            <span class="step-title">Fechas</span>
                        </div>
                        <div class="step" data-step="2">
                            <span class="step-number">2</span>
                            <span class="step-title">Datos</span>
                        </div>
                        <div class="step" data-step="3">
                            <span class="step-number">3</span>
                            <span class="step-title">Confirmar</span>
                        </div>
                        <div class="step-progress"></div>
                    </div>
                    
                    <form id="booking-form" class="booking-form" action="procesar_reserva.php" method="POST">
                        <!-- Paso 1: Selección de fechas y habitación -->
                        <div class="form-step active" data-step="1">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="check-in">
                                        <i class="lnr lnr-calendar-full"></i> Fecha de Entrada
                                    </label>
                                    <input type="date" id="check-in" name="check-in" class="form-control" required min="<?= date('Y-m-d') ?>">
                                </div>
                                
                                <div class="form-group col-md-6">
                                    <label for="check-out">
                                        <i class="lnr lnr-calendar-full"></i> Fecha de Salida
                                    </label>
                                    <input type="date" id="check-out" name="check-out" class="form-control" required>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label for="room-type">
                                    <i class="lnr lnr-home"></i> Tipo de Habitación
                                </label>
                                <select id="room-type" name="room-type" class="form-control" required>
                                    <option value="">Seleccione una habitación</option>
                                    <option value="standard">Standard ($80/noche)</option>
                                    <option value="deluxe">Deluxe ($150/noche)</option>
                                    <option value="suite">Suite ($300/noche)</option>
                                    <option value="doble">Habitación Doble ($200/noche)</option>
                                    <option value="ninos">Habitación de Niños ($100/noche)</option>
                                    <option value="king">Habitación King ($240/noche)</option>
                                    <option value="queen">Habitación Queen ($220/noche)</option>
                                    <option value="familiar">Habitación Familiar ($185/noche)</option>
                                    <option value="studio">Studio ($80/noche)</option>
                                    <option value="bungalow">Bungalow ($160/noche)</option>
                                </select>
                            </div>
                            
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="adults">
                                        <i class="lnr lnr-user"></i> Adultos
                                    </label>
                                    <select id="adults" name="adults" class="form-control" required>
                                        <option value="1">1 Adulto</option>
                                        <option value="2" selected>2 Adultos</option>
                                        <option value="3">3 Adultos</option>
                                        <option value="4">4 Adultos</option>
                                    </select>
                                </div>
                                
                                <div class="form-group col-md-6">
                                    <label for="children">
                                        <i class="lnr lnr-users"></i> Niños (0-12 años)
                                    </label>
                                    <select id="children" name="children" class="form-control">
                                        <option value="0">0 Niños</option>
                                        <option value="1">1 Niño</option>
                                        <option value="2">2 Niños</option>
                                        <option value="3">3 Niños</option>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="form-actions text-center">
                                <button type="button" class="btn btn-next">
                                    Siguiente <i class="lnr lnr-arrow-right"></i>
                                </button>
                            </div>
                        </div>
                        
                        <!-- Paso 2: Datos personales -->
                        <div class="form-step" data-step="2">
                            <div class="form-group">
                                <label for="full-name">
                                    <i class="lnr lnr-user"></i> Nombre Completo
                                </label>
                                <input type="text" id="full-name" name="full-name" class="form-control" required>
                            </div>
                            
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="email">
                                        <i class="lnr lnr-envelope"></i> Email
                                    </label>
                                    <input type="email" id="email" name="email" class="form-control" required>
                                </div>
                                
                                <div class="form-group col-md-6">
                                    <label for="phone">
                                        <i class="lnr lnr-phone-handset"></i> Teléfono
                                    </label>
                                    <input type="tel" id="phone" name="phone" class="form-control" required>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label for="special-requests">
                                    <i class="lnr lnr-bubble"></i> Solicitudes Especiales
                                </label>
                                <textarea id="special-requests" name="special-requests" class="form-control" rows="3"></textarea>
                            </div>
                            
                            <div class="form-actions">
                                <button type="button" class="btn btn-prev">
                                    <i class="lnr lnr-arrow-left"></i> Anterior
                                </button>
                                <button type="button" class="btn btn-next">
                                    Siguiente <i class="lnr lnr-arrow-right"></i>
                                </button>
                            </div>
                        </div>
                        
                        <!-- Paso 3: Confirmación -->
                        <div class="form-step" data-step="3">
                            <div class="booking-summary">
                                <h3><i class="lnr lnr-checkmark-circle"></i> Resumen de tu Reserva</h3>
                                <div class="summary-grid">
                                    <div class="summary-item">
                                        <span class="summary-label">Habitación:</span>
                                        <span class="summary-value" id="summary-room">-</span>
                                    </div>
                                    <div class="summary-item">
                                        <span class="summary-label">Fechas:</span>
                                        <span class="summary-value" id="summary-dates">-</span>
                                    </div>
                                    <div class="summary-item">
                                        <span class="summary-label">Huéspedes:</span>
                                        <span class="summary-value" id="summary-guests">-</span>
                                    </div>
                                    <div class="summary-item">
                                        <span class="summary-label">Noches:</span>
                                        <span class="summary-value" id="summary-nights">-</span>
                                    </div>
                                    <div class="summary-item total">
                                        <span class="summary-label">Total estimado:</span>
                                        <span class="summary-value" id="summary-total">-</span>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="policy-box">
                                <h4><i class="fas fa-info-circle"></i> Políticas de Reserva</h4>
                                <div class="policy-grid">
                                    <div class="policy-item">
                                        <div class="policy-icon">
                                            <i class="fas fa-calendar-check"></i>
                                        </div>
                                        <div class="policy-content">
                                            <h5>Política de Reservas</h5>
                                            <ul>
                                                <li>Depósito requerido: 30% del total</li>
                                                <li>Saldo al check-in</li>
                                                <li>Sujeto a disponibilidad</li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="policy-item">
                                        <div class="policy-icon">
                                            <i class="fas fa-calendar-times"></i>
                                        </div>
                                        <div class="policy-content">
                                            <h5>Política de Cancelación</h5>
                                            <ul>
                                                <li>> 7 días: Reembolso 100%</li>
                                                <li>3-7 días: Reembolso 50%</li>
                                                <li>< 3 días: Sin reembolso</li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="policy-item">
                                        <div class="policy-icon">
                                            <i class="fas fa-exclamation-triangle"></i>
                                        </div>
                                        <div class="policy-content">
                                            <h5>No Show</h5>
                                            <ul>
                                                <li>Cobro de la primera noche</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="form-group terms text-center">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="terms" name="terms" required>
                                    <label class="custom-control-label" for="terms">Acepto los <a href="#" data-toggle="modal" data-target="#termsModal">términos y condiciones</a></label>
                                </div>
                            </div>
                            
                            <div class="form-actions text-center">
                                <button type="button" class="btn btn-prev">
                                    <i class="lnr lnr-arrow-left"></i> Anterior
                                </button>
                                <button type="submit" class="btn btn-submit">
                                    Confirmar Reserva <i class="lnr lnr-checkmark-circle"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Booking Section End -->

<!-- Modal Términos y Condiciones -->
<!--div class="modal fade" id="termsModal" tabindex="-1" role="dialog" aria-labelledby="termsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="termsModalLabel">Términos y Condiciones</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="terms-content">
                    <div class="terms-section">
                        <h4><i class="fas fa-calendar-check text-primary"></i> Política de Reservas</h4>
                        <div class="terms-list">
                            <div class="term-item">
                                <span class="term-number">1</span>
                                <p>Todas las reservas están sujetas a disponibilidad al momento de recibir la solicitud.</p>
                            </div>
                            <div class="term-item">
                                <span class="term-number">2</span>
                                <p>Se requiere un depósito del 30% del total de la estancia para garantizar la reserva.</p>
                            </div>
                            <div class="term-item">
                                <span class="term-number">3</span>
                                <p>El saldo restante deberá pagarse al momento del check-in.</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="terms-section">
                        <h4><i class="fas fa-calendar-times text-warning"></i> Política de Cancelación</h4>
                        <div class="terms-list">
                            <div class="term-item">
                                <span class="term-number">1</span>
                                <p>Cancelaciones con más de 7 días de anticipación: reembolso completo del depósito.</p>
                            </div>
                            <div class="term-item">
                                <span class="term-number">2</span>
                                <p>Cancelaciones entre 7 y 3 días antes: se retendrá el 50% del depósito.</p>
                            </div>
                            <div class="term-item">
                                <span class="term-number">3</span>
                                <p>Cancelaciones con menos de 3 días: no habrá reembolso del depósito.</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="terms-section">
                        <h4><i class="fas fa-exclamation-triangle text-danger"></i> Política de No Show</h4>
                        <div class="terms-list">
                            <div class="term-item">
                                <span class="term-number">1</span>
                                <p>En caso de no presentarse el día de la reserva sin previo aviso, se cobrará el total de la primera noche.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Entendido</button>
            </div>
        </div>
    </div>
</div>
<!-- End -->

    <!-- Footer Section Begin -->
    <?php include("Templates/footer.php"); ?>
    <!-- Footer Section End -->

    <!-- Js Plugins -->
    <script src="js/Reservas.js"></script>
</body>

</html>