
<!--author: Kanatschnig -->
<!--Kontaktformular -->

@extends('layout.formlayout')
@section('content')
    <section class="jumbotron text-center">
        <div class="container">
            <h1 class="jumbotron-heading">Registrieren</h1>
            <p class="lead text-muted">Betreiben Sie Ihre eigene Knödel Homepage</p>
        </div>
    </section>
    
    <div class="justify-content-center align-items-center container py-5 bg-light">
        <form class="needs-validation" id="contact-form" method="post" action="/registrieren" role="form" novalidate>
            {{ csrf_field() }}

            <div class="messages"></div>

            <div class="controls">

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="form_givenname">Vorname *</label>
                            <input id="form_givenname" type="text" name="givenname" class="form-control"
                                   placeholder="Bitte Vorname eingeben" required>
                            <div class="valid-feedback">Schaut gut aus!</div>
                            <div class="invalid-feedback">Bitte geben Sie einen Vornamen ein</div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="form_lastname">Nachname *</label>
                            <input id="form_lastname" type="text" name="surname" class="form-control"
                                   placeholder="Bitte Nachname eingeben" required>
                            <div class="valid-feedback">Schaut gut aus!</div>
                            <div class="invalid-feedback">Bitte geben Sie einen Nachnamen ein</div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="form_email">E-Mail Adresse *</label>
                            <input id="form_email" type="text" name="email" class="form-control"
                                   placeholder="Bitte Ihre E-Mail Adresse angeben">
                            <div class="valid-feedback">Schaut gut aus!</div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="form_subdomain">Gewünschte Subdomain (&lt;subdomain&gt;.apps.gabriel-hq.at)</label>
                            <input id="form_subdomain" type="text" name="subdomain" class="form-control"
                                   placeholder="Bitte Ihre gewünschte Subdomain eingeben">
                            <div class="valid-feedback">Schaut gut aus!</div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4 mt-3">
                            <button type="submit" class="btn btn-primary btn-md btn-block" id="submit1" name="subscription" value="1"><span style="font-size: 2em; font-weight: bold;">Basic</span> <br> 5 GB Speicher für Ihre Rezepte <br> 1 GB Arbeitsspeicher <br> 5 Support-Tickets / Jahr</button>
                    </div>
                    <div class="col-lg-4 mt-3">
                        <button type="submit" class="btn btn-primary btn-md btn-block" id="submit2" name="subscription" value="2"><span style="font-size: 2em; font-weight: bold;">Standard</span> <br> 15 GB Speicher für Ihre Rezepte <br> 2 GB Arbeitsspeicher <br> 15 Support-Tickets / Jahr</button>
                    </div>
                    <div class="col-lg-4 mt-3">
                        <button type="submit" class="btn btn-primary btn-md btn-block" id="submit3" name="subscription" value="3"><span style="font-size: 2em; font-weight: bold;">Premium</span> <br> 50 GB Speicher für Ihre Rezepte <br> 4 GB Arbeitsspeicher <br> 50 Support-Tickets / Jahr</button>
                    </div>
                </div>
                @if(session()->has('message'))
                    <div class="mt-3 alert alert-success">
                        {{ session()->get('message') }}
                    </div>
                @endif
                <div class="row mt-3">
                    <div class="col-md-12">
                        <p class="text-muted"><strong>*</strong>Diese Felder sind erforderlich</p>
                    </div>
                </div>
            </div>

                    </form>

                </div><!-- /.8 -->

            </div> <!-- /.row-->

        </div> <!-- /.container-->


        <script type='text/javascript'>
            function setup() {
                 // Fetch all the forms we want to apply custom Bootstrap validation styles to
                const forms = document.getElementsByClassName('needs-validation');
                // Loop over them and prevent submission
                const validation = Array.prototype.filter.call(forms, function (form) {
                    form.addEventListener('submit', function (event) {
                        if (form.checkValidity() === false) {
                            event.preventDefault();
                            event.stopPropagation();
                        }
                        form.classList.add('was-validated');
                    }, false);
                });
            }

            window.addEventListener("load", setup);
        </script>
@endsection
