<!-- Contact-->
<section class="page-section" id="contact">
    <div class="container">
        <div class="text-center">
            <h2 class="section-heading text-uppercase">Contáctanos</h2>
            <h3 class="section-subheading text-muted">¿Tienes preguntas? La Universidad Cooperativa de Colombia está para ayudarte.</h3>
        </div>
        <!-- * * * * * * * * * * * * * * *-->
        <!-- * * Formulario de contacto * *-->
        <!-- * * * * * * * * * * * * * * *-->
        <form id="contactForm" data-sb-form-api-token="API_TOKEN">
            <div class="row align-items-stretch mb-5">
                <div class="col-md-6">
                    <div class="form-group">
                        <!-- Name input-->
                        <input class="form-control" id="name" type="text" placeholder="Tu nombre *" data-sb-validations="required" />
                        <div class="invalid-feedback" data-sb-feedback="name:required">El nombre es obligatorio.</div>
                    </div>
                    <div class="form-group">
                        <!-- Email address input-->
                        <input class="form-control" id="email" type="email" placeholder="Tu correo electrónico *" data-sb-validations="required,email" />
                        <div class="invalid-feedback" data-sb-feedback="email:required">El correo electrónico es obligatorio.</div>
                        <div class="invalid-feedback" data-sb-feedback="email:email">El correo electrónico no es válido.</div>
                    </div>
                    <div class="form-group mb-md-0">
                        <!-- Phone number input-->
                        <input class="form-control" id="phone" type="tel" placeholder="Tu teléfono *" data-sb-validations="required" />
                        <div class="invalid-feedback" data-sb-feedback="phone:required">El número de teléfono es obligatorio.</div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group form-group-textarea mb-md-0">
                        <!-- Message input-->
                        <textarea class="form-control" id="message" placeholder="Tu mensaje *" data-sb-validations="required"></textarea>
                        <div class="invalid-feedback" data-sb-feedback="message:required">El mensaje es obligatorio.</div>
                    </div>
                </div>
            </div>
            <!-- Submit success message-->
            <div class="d-none" id="submitSuccessMessage">
                <div class="text-center text-white mb-3">
                    <div class="fw-bolder">¡Formulario enviado con éxito!</div>
                    Gracias por comunicarte con la Universidad Cooperativa de Colombia.
                    <br />
                    Te responderemos pronto.
                </div>
            </div>
            <!-- Submit error message-->
            <div class="d-none" id="submitErrorMessage"><div class="text-center text-danger mb-3">¡Error al enviar el mensaje!</div></div>
            <!-- Submit Button-->
            <div class="text-center"><button class="btn btn-primary btn-xl text-uppercase disabled" id="submitButton" type="submit">Enviar mensaje</button></div>
        </form>
    </div>
</section>
