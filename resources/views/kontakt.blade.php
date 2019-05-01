
<!--autor: Kurek -->
<!--Kontaktformular -->

@extends('layout.mainlayout')
@section('content')
        <div class="container bg-light">

            <div class="row">

                <div class="col-lg-8 col-lg-offset-2">
                    <br>
                    <h1>Kontakt mit Knödel</h1>

                    <form class="needs-validation" id="contact-form" method="post" action="/kontakt" role="form" novalidate>

                        {{ csrf_field() }}

                        <div class="messages"></div>

                        <div class="controls">

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="form_name">Vorname *</label>
                                        <input id="form_name" type="text" name="name" class="form-control"
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
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="form_phone">Telefonnummer</label>
                                        <input id="form_phone" type="tel" name="phone" class="form-control"
                                               placeholder="Bitte Telefonnummer eingeben">
                                        <div class="valid-feedback">Schaut gut aus!</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="form_message">Nachricht *</label>
                                        <textarea id="form_message" name="message" class="form-control"
                                                  placeholder="Nachricht erforderlich" rows="4" required></textarea>
                                        <div class="valid-feedback">Schaut gut aus!</div>
                                        <div class="invalid-feedback">Bitte geben Sie eine Nachricht ein</div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary" id="submit">Senden</button>
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
