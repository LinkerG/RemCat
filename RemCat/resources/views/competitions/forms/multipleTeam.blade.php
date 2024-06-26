<form action="#" method="post" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-4">
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="teamName" name="teamName" placeholder="" value="{{session('teamName')}}" required readonly>
                <label for="teamName">Team name</label>
                <div class="invalid-feedback ms-2">Nombre no valido</div>
            </div>
            <div class="container data-container" id="data-container">
                <div class="spinner-border"></div>
            </div>
        </div>
        <div class="col-8 boat-layout ">
            <div class="row">
                <h2>Categoria</h2>
                <div class="mb-3">
                    <select class="form-select" name="category1" id="category1">
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
                </div>
                <div class="d-flex mb-2">
                    <div class="form-check me-3">
                        <input class="form-check-input" type="radio" name="category2" id="M" value="M">
                        <label class="form-check-label" for="M">
                            Masculino
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="category2" id="F" value="F">
                        <label class="form-check-label" for="F">
                            Femenino
                        </label>
                    </div>
                </div>
            </div>
            @switch($competition->boatType)
                @case("llaut_med")
                @case("llagut_cat")
                    <div class="row">
                        <div class="col-12">
                            <input type="text" class="form-control" id="participante1" placeholder="Timonel" name="teamMembers[]">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6 pe-0">
                            <input type="text" class="form-control" id="participante2" placeholder="1 Estribor" name="teamMembers[]">
                        </div>
                        <div class="col-6 ps-0">
                            <input type="text" class="form-control" id="participante3" placeholder="1 Babor" name="teamMembers[]">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6 pe-0">
                            <input type="text" class="form-control" id="participante4" placeholder="2 Estribor" name="teamMembers[]">
                        </div>
                        <div class="col-6 ps-0">
                            <input type="text" class="form-control" id="participante5" placeholder="2 Babor" name="teamMembers[]">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6 pe-0">
                            <input type="text" class="form-control" id="participante6" placeholder="3 Estribor" name="teamMembers[]">
                        </div>
                        <div class="col-6 ps-0">
                            <input type="text" class="form-control" id="participante7" placeholder="3 Babor" name="teamMembers[]">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6 pe-0">
                            <input type="text" class="form-control" id="participante8" placeholder="4 Estribor" name="teamMembers[]">
                        </div>
                        <div class="col-6 ps-0">
                            <input type="text" class="form-control" id="participante9" placeholder="4 Babor" name="teamMembers[]">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <input type="text" class="form-control" id="participante10" placeholder="Suplentes" name="substitutes">
                        </div>
                    </div>
                    @break
                @case("batel")
                    <div class="row">
                        <div class="col-12">
                            <input type="text" class="form-control" id="participante1" placeholder="Timonel" name="teamMembers[]">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <input type="text" class="form-control" id="participante3" placeholder="1 Babor" name="teamMembers[]">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <input type="text" class="form-control" id="participante4" placeholder="2 Estribor" name="teamMembers[]">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <input type="text" class="form-control" id="participante7" placeholder="3 Babor" name="teamMembers[]">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <input type="text" class="form-control" id="participante8" placeholder="4 Estribor" name="teamMembers[]">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <input type="text" class="form-control" id="participante10" placeholder="Suplentes" name="substitutes">
                        </div>
                    </div>
                    @break
                @default
                    @break
            @endswitch
            <div class="row mt-4 mb-3">
                <div class="col-12">
                    <button class="btn btn-primary w-100 btn-block" type="button" id="save-team" value="Enviar">Guardar equipo</button>
                </div>
            </div>
        </div>

    </div>
</form>
