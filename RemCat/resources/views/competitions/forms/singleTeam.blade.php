<script src="{{ asset('js/joinCompetitionSingle.js')}}"></script>
<script src="https://www.paypal.com/sdk/js?client-id=AZJld8gcAnjfOhAt7qo3EgdvyVMHLoyF6T727CeyU-yXmuSCrzzVq4hdnSvr_iAnI29fAkG7H0VB1C-a&currency=EUR"></script>
<form action="#" method="post" enctype="multipart/form-data" id="joinSingleForm">
    @csrf
    <div class="row">
        <div class="col-4">
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="teamName" name="teamName" placeholder="" value="{{ session('userEmail') }}" required readonly>
                <label for="teamName">Team name</label>
                <div class="invalid-feedback">Nombre no válido</div>
            </div>
            <h2>Categoria</h2>
            <div class="mb-3">
                <select class="form-select" name="category1">
                    <option selected disabled>Selecciona categoria</option>
                    @if ($competition->boatType == "batel")
                        <option value="A">Alevin</option>
                    @endif
                    <option value="I">Infantil</option>
                    <option value="C">Cadete</option>
                    <option value="J">Juvenil</option>
                    <option value="S">Sénior</option>
                    <option value="V">Veterano</option>
                </select>
                <div class="invalid-feedback">Tienes que seleccionar una categoría.</div>
            </div>
            <div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="category2" id="M" value="M">
                    <label class="form-check-label" for="M">Masculino</label>
                    <div class="invalid-feedback">Tienes que elegir Masculino o Femenino.</div>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="category2" id="F" value="F">
                    <label class="form-check-label" for="F">Femenino</label>
                </div>
            </div>
            <h2>Aseguradora</h2>
            <div class="mb-3">
                <select class="form-select" name="insurance_id" id="insuranceSelect">
                    <option selected disabled>Selecciona aseguradora</option>
                    @foreach ($insurances as $insurance)
                        <option value="{{ $insurance->id }}" data-price="{{ $insurance->price }}">{{ $insurance->name }} {{$insurance->price}}€</option>
                    @endforeach
                </select>
                <div class="invalid-feedback">Tienes que elegir una aseguradora.</div>
            </div>
            <div id="paypal-btn-container" style="display: none;">
                <div id="paypal-btn"></div>
            </div>
            <div id="purchaseError" class="alert alert-danger" style="display: none;"></div>
            <div id="purchaseSuccess" class="alert alert-success" style="display: none;"></div>
        </div>
        <div class="col-8 boat-layout">
            @switch($competition->boatType)
                @case("llaut_med")
                @case("llagut_cat")
                    <div class="row">
                        <div class="col-12 mb-3">
                            <input type="text" class="form-control" id="participante1" placeholder="Timonel" name="teamMembers[]">
                            <div class="invalid-feedback">Debe contener solo letras y cada palabra separada por un espacio.</div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6 pe-0 mb-3">
                            <input type="text" class="form-control" id="participante2" placeholder="1 Estribor" name="teamMembers[]">
                            <div class="invalid-feedback">Debe contener solo letras y cada palabra separada por un espacio.</div>
                        </div>
                        <div class="col-6 ps-0 mb-3">
                            <input type="text" class="form-control" id="participante3" placeholder="1 Babor" name="teamMembers[]">
                            <div class="invalid-feedback">Debe contener solo letras y cada palabra separada por un espacio.</div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6 pe-0 mb-3">
                            <input type="text" class="form-control" id="participante4" placeholder="2 Estribor" name="teamMembers[]">
                            <div class="invalid-feedback">Debe contener solo letras y cada palabra separada por un espacio.</div>
                        </div>
                        <div class="col-6 ps-0 mb-3">
                            <input type="text" class="form-control" id="participante5" placeholder="2 Babor" name="teamMembers[]">
                            <div class="invalid-feedback">Debe contener solo letras y cada palabra separada por un espacio.</div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6 pe-0 mb-3">
                            <input type="text" class="form-control" id="participante6" placeholder="3 Estribor" name="teamMembers[]">
                            <div class="invalid-feedback">Debe contener solo letras y cada palabra separada por un espacio.</div>
                        </div>
                        <div class="col-6 ps-0 mb-3">
                            <input type="text" class="form-control" id="participante7" placeholder="3 Babor" name="teamMembers[]">
                            <div class="invalid-feedback">Debe contener solo letras y cada palabra separada por un espacio.</div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6 pe-0 mb-3">
                            <input type="text" class="form-control" id="participante8" placeholder="4 Estribor" name="teamMembers[]">
                            <div class="invalid-feedback">Debe contener solo letras y cada palabra separada por un espacio.</div>
                        </div>
                        <div class="col-6 ps-0 mb-3">
                            <input type="text" class="form-control" id="participante9" placeholder="4 Babor" name="teamMembers[]">
                            <div class="invalid-feedback">Debe contener solo letras y cada palabra separada por un espacio.</div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 mb-3">
                            <input type="text" class="form-control" id="participante10" placeholder="Suplentes" name="substitutes">
                            <div class="invalid-feedback">Los nombres deben estar separados por comas y contener solo letras.</div>
                        </div>
                    </div>
                    @break
                @case("batel")
                    <div class="row">
                        <div class="col-12 mb-3">
                            <input type="text" class="form-control" id="participante1" placeholder="Timonel" name="teamMembers[]">
                            <div class="invalid-feedback">Debe contener solo letras y cada palabra separada por un espacio.</div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 mb-3">
                            <input type="text" class="form-control" id="participante3" placeholder="1 Babor" name="teamMembers[]">
                            <div class="invalid-feedback">Debe contener solo letras y cada palabra separada por un espacio.</div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 mb-3">
                            <input type="text" class="form-control" id="participante4" placeholder="2 Estribor" name="teamMembers[]">
                            <div class="invalid-feedback">Debe contener solo letras y cada palabra separada por un espacio.</div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 mb-3">
                            <input type="text" class="form-control" id="participante7" placeholder="3 Babor" name="teamMembers[]">
                            <div class="invalid-feedback">Debe contener solo letras y cada palabra separada por un espacio.</div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 mb-3">
                            <input type="text" class="form-control" id="participante8" placeholder="4 Estribor" name="teamMembers[]">
                            <div class="invalid-feedback">Debe contener solo letras y cada palabra separada por un espacio.</div>
                        </div>
                    </div>
                    <div class="col-12 mb-3">
                        <input type="text" class="form-control" id="participante10" placeholder="Suplentes" name="substitutes">
                        <div class="invalid-feedback">Los nombres deben estar separados por comas y contener solo letras.</div>
                    </div>
                    @break
            @endswitch
        </div>
    </div>
    <div class="d-grid mt-3">
        <button type="submit" class="btn btn-lg btn-primary" id="submit-button">Enviar</button>
    </div>
</form>
