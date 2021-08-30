@extends('layouts.main')

@section('content')

    <div class="container">
        <h1 class="display-6 mb-5"> Cadastro de pessoal</h1>


        <form class="" method="POST" autocomplete="off">
            @csrf
            @if (isset($employee->id))
                @method('PUT')
            @endif



            <div class="row g-3 mb-4 border p-3 shadow-hover">
                <h5 class="card-title">Dados gerais</h5>
                <div class="col-md-6">
                    <label for="funName" class="form-label">Nome</label>
                    <input type="text" class="form-control" name="funName" value="{{ $employee->name }}" required>
                </div>
                <div class="col-md-2">
                    <label for="funBirthDate" class="form-label">Data de nascimento</label>
                    <input type="date" class="form-control" name="funBirthDate" value="{{ $employee->birthdate }}"
                        required>
                </div>
                <div class="col-md-2">
                    <label for="funMaritalStatus" class="form-label">Estado civil</label>
                    <input list="maritalstatus" type="text" class="form-control" name="funMaritalStatus"
                        placeholder="Digite para pesquisar..." value="{{ $employee->maritalstatus }}" required />
                    <datalist id="maritalstatus">
                        <option value="Solteiro(a)">Quem nunca se casou, ou que teve o casamento anulado.</option>
                        <option value="Casado(a)">Quem contraiu matrimônio, independente do regime de bens adotado.</option>
                        <option value="Divorciado(a)">Após a homologação do divórcio pela justiça ou por uma escritura
                            pública.
                        </option>
                        <option value="Viúvo(a)">Pessoa cujo cônjuge faleceu.</option>
                        <option value="Separado(a)">Pessoa cujo vínculo jurídico do casamento existe, mas foi dissolvida por
                            escritura pública ou decisão judicial a sociedade conjugal.</option>
                    </datalist>

                </div>
                <div class="col-md-2">
                    <label for="funKids" class="form-label">Filhos menores 14 anos</label>
                    <input type="number" class="form-control" name="funKids" value="{{ $employee->kids }}">
                </div>
                <div class="col-md-5">
                    <label for="funBirthCity" class="form-label">Cidade nascimento</label>
                    <input type="text" class="form-control" name="funBirthCity" value="{{ $employee->birthcity }}"
                        required>
                </div>
                <div class="col-md-1">
                    <label for="funBirthState" class="form-label">Estado</label>
                    <input type="text" class="form-control" name="funBirthState" value="{{ $employee->birthstate }}"
                        required>
                </div>





                <div class="col-md-6">
                    <label for="funSpousse" class="form-label">Nome cônjuge</label>
                    <input type="text" class="form-control" name="funSpousse" value="{{ $employee->spousename }}"
                        required>
                </div>

                <div class="col-md-6">
                    <label for="funFathersName" class="form-label">Nome do pai</label>
                    <input type="text" class="form-control" name="funFathersName" value="{{ $employee->fathersname }}">
                </div>
                <div class="col-md-6">
                    <label for="funMothersName" class="form-label">Nome da mãe</label>
                    <input type="text" class="form-control" name="funMothersName" value="{{ $employee->mothersname }}">
                </div>
            </div>

            <div class="row g-3 mb-4 border p-3 shadow-hover">
                <h5 class="card-title">Endereço</h5>
                <div class="col-md-8">
                    <label for="funemail" class="form-label">Email</label>
                    <input type="email" class="form-control" name="funEmail"
                        value="{{ isset($employee->user->email) ? $employee->user->email : '' }}" required @if (isset($employee->id)) disabled @endif>
                </div>
                <div class="col-md-4">
                    <label for="funPhone" class="form-label">Telefone</label>
                    <input type="text" class="form-control" name="funPhone" data-inputmask="'mask': '(99) 9999[9]-9999'"
                        value="{{ $employee->phone }}" required>
                </div>
                <div class="col-md-8">
                    <label for="funAddress" class="form-label">Endereço</label>
                    <input type="text" class="form-control" name="funAddress" value="{{ $employee->address }}"" required>
                                        </div>

                                        <div class=" col-md-4">
                    <label for="funDistrict" class="form-label">Bairro</label>
                    <input type="text" class="form-control" name="funDistrict" value="{{ $employee->district }}"
                        required>
                </div>
                <div class="col-md-6">
                    <label for="funCity" class="form-label">Cidade</label>
                    <input type="text" class="form-control" name="funCity" value="{{ $employee->city }}" required>
                </div>
                <div class="col-md-2">
                    <label for="funState" class="form-label">Estado</label>
                    <input type="text" class="form-control" name="funState" value="{{ $employee->state }}" required>
                </div>
                <div class="col-md-2">
                    <label for="funAdjunct" class="form-label">Complemento</label>
                    <input type="text" class="form-control" name="funAdjunct" value="{{ $employee->adjunct }}" required>
                </div>
                <div class="col-md-2">
                    <label for="funZipCode" class="form-label">CEP</label>
                    <input type="text" class="form-control" name="funZipCode" data-inputmask="'mask': '99.999-999'"
                        value="{{ $employee->zipcode }}" required>
                </div>

            </div>

            <div class="row g-3 mb-4 border p-3 shadow-hover">
                <h5 class="card-title">Documentos</h5>

                <div class="col-md-2">
                    <label for="funCTPS" class="form-label">CTPS/Série</label>
                    <input type="text" data-inputmask="'mask': '9[9][9][9][9][9]/9999'" class="form-control" name="funCTPS"
                        value="{{ $employee->ctps }}">
                </div>
                <div class="col-md-2">
                    <label for="funCTPSdate" class="form-label">Data de emissão</label>
                    <input type="date" class="form-control" name="funCTPSdate" value="{{ $employee->ctpsdate }}">
                </div>
                <div class="col-md-2">
                    <label for="funCPF" class="form-label">CPF</label>
                    <input type="string" class="form-control" name="funCPF" data-inputmask="'mask': '999.999.999-99'"
                        value="{{ $employee->cpf }}">
                </div>
                <div class="col-md-2">
                    <label for="funRG" class="form-label">RG</label>
                    <input type="string" data-inputmask="'mask': '9', 'repeat': 11, 'greedy' : false" class="form-control"
                        name="funRG" value="{{ $employee->rg }}">
                </div>
                <div class="col-md-1">
                    <label for="funRGIssuer" class="form-label">Emissor</label>
                    <input type="string" class="form-control" name="funRGIssuer" value="{{ $employee->rgissuer }}">
                </div>
                <div class="col-md-1">
                    <label for="funRGState" class="form-label">UF</label>
                    <input type="string" class="form-control" name="funRGState" value="{{ $employee->rgstate }}">
                </div>
                <div class="col-md-2">
                    <label for="funRGDate" class="form-label">Data emissão</label>
                    <input type="date" class="form-control" name="funRGDate" value="{{ $employee->rgdate }}">
                </div>
                <div class="col-md-3">
                    <label for="funMilitaryDoc" class="form-label">Certificado de reservista</label>
                    <input type="string" data-inputmask="'mask': '9', 'repeat': 11, 'greedy' : false" class="form-control"
                        name="funMilitaryDoc" value="{{ $employee->militarydoc }}">
                </div>
                <div class="col-md-1">
                    <label for="funMilitarySerie" class="form-label">Série</label>
                    <input type="string" class="form-control" name="funMilitarySerie"
                        value="{{ $employee->militaryserie }}">
                </div>
                <div class="col-md-2">
                    <label for="funMilitaryCategory" class="form-label">Categoria</label>
                    <input type="string" class="form-control" name="funMilitaryCategory"
                        value="{{ $employee->militarycategory }}">
                </div>
                <div class="col-md-2">
                    <label for="funVoterDoc" class="form-label">Título de eleitor</label>
                    <input type="string" class="form-control" name="funVoterDoc"
                        data-inputmask="'mask': '9999 9999 9999', 'removeMaskOnSubmit': 'true'" data
                        value="{{ $employee->voterdoc }}">
                </div>
                <div class="col-md-1">
                    <label for="funVoterZone" class="form-label">Zona</label>
                    <input type="string" data-inputmask="'mask': '9', 'repeat': 4" class="form-control" name="funVoterZone"
                        value="{{ $employee->voterzone }}">
                </div>
                <div class="col-md-1">
                    <label for="funVoterSection" class="form-label">Seção</label>
                    <input type="string" data-inputmask="'mask': '9', 'repeat': 4" class="form-control"
                        name="funVoterSection" value="{{ $employee->votersection }}">
                </div>
                <div class="col-md-2">
                    <label for="funPIS" class="form-label">PIS</label>
                    <input type="string" class="form-control" name="funPIS"
                        data-inputmask="'mask': '999.99999.99-99', 'removeMaskOnSubmit': 'true'"
                        value="{{ $employee->pis }}" required>
                </div>
                <div class="col-md-2">
                    <label for="fundriverslicense" class="form-label">CNH</label>
                    <input type="string" data-inputmask="'mask': '9', 'repeat': 11, 'greedy' : false" class="form-control"
                        name="fundriverslicense" value="{{ $employee->driverslicense }}">
                </div>
                <div class="col-md-1">
                    <label for="fundriverslicensecategory" class="form-label">Categoria</label>
                    <input type="string" class="form-control" name="fundriverslicensecategory"
                        value="{{ $employee->driverslicensecategory }}">
                </div>
                <div class="col-md-2">
                    <label for="fundriverslicensedate" class="form-label">1ª Habilitação</label>
                    <input type="date" class="form-control" name="fundriverslicensedate"
                        value="{{ $employee->driverslicensedate }}">
                </div>
                <div class="col-md-2">
                    <label for="fundriverslicenseissue" class="form-label">Emissão</label>
                    <input type="date" class="form-control" name="fundriverslicensedate"
                        value="{{ $employee->driverslicensedate }}">
                </div>
                <div class="col-md-2">
                    <label for="fundriverslicenseexpired" class="form-label">Vencimento</label>
                    <input type="date" class="form-control" name="fundriverslicenseexpired"
                        value="{{ $employee->driverslicensedateexpired }}">
                </div>

                <hr />
                <div class="col-md-2">
                    <label for="fungraduation" class="form-label">Grau de instrução</label>
                    <input type="string" list="graduationlist" class="form-control" name="fungraduation"
                        value="{{ $employee->graduation }}" required>
                    <datalist id="graduationlist">
                        <option value="Nenhum"></option>
                        <option value="Básico"></option>
                        <option value="Médio"></option>
                        <option value="Superior"></option>
                        <option value="Pós-graduação"></option>
                    </datalist>

                </div>
                <div class="col-md-1">
                    <label for=fungraduationstage" class="form-label">Série</label>
                    <input type="string" class="form-control" name="fungraduationstage"
                        value="{{ $employee->graduationstage }}">

                </div>
                <div class="col-md-2">
                    <label for="fungraduationsituation" class="form-label">Situação</label>
                    <input type="string" list="graduationsituationlist" class="form-control" name="fungraduationsituation"
                        value="{{ $employee->graduationsituation }}" required>
                    <datalist id="graduationsituationlist">
                        <option value="Completo"></option>
                        <option value="Incompleto"></option>
                    </datalist>

                </div>
            </div>

            <div class="row g-3 mb-4 border p-3 shadow-hover">
                <h5 class="card-title">Dados do contrato</h5>
                <div class="col-md-2">
                    <label for="funadmissiondate" class="form-label">Admissão</label>
                    <input type="date" class="form-control" name="funadmissiondate"
                        value="{{ $employee->admissiondate }}" required>
                </div>
                <div class="col-md-2">
                    <label for="funsalary" class="form-label">Salário</label>
                    <input type="text"
                        data-inputmask="'alias': 'decimal', 'numericInput': 'true', 'radixPoint': ',', 'groupSeparator': '.', 'removeMaskOnSubmit': 'true' "
                        class="form-control" name="funsalary" value="{{ $employee->salary }}" required>
                </div>
                <div class="col-md-4">
                    <label for="funrole" class="form-label">Cargo / Função</label>
                    <input type="string" class="form-control" name="funrole" value="{{ $employee->role }}" required>
                </div>
                <div class="col-md-4">
                    <label for="funjobtime" class="form-label">Horário</label>
                    <input type="string" class="form-control" name="funjobtime" value="{{ $employee->jobtime }}"
                        required>
                </div>
                <hr />
                <div class="col-md-2">
                    <label class="form-label">Vale transporte</label>
                    <div class="form-control">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="funtransportticket" id="transportticket1"
                                value="S" @if ($employee->transportticket == 'S') checked @endif>
                            <label class="form-check-label" for="transportticket1">Sim</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="funtransportticket" id="transportticket2"
                                value="N" @if ($employee->transportticket == 'N') checked @endif>
                            <label class="form-check-label" for="transportticket2">Não</label>
                        </div>
                    </div>
                </div>
                <div class="col-md-1">
                    <label for="funtransportticketstages" class="form-label">Trajetos</label>
                    <input type="number" class="form-control" name="funtransportticketstages"
                        value="{{ $employee->transportticketstages }}">
                </div>
                <div class="col-md-9">
                    <label for="funtransportticketcompany" class="form-label">Empresa</label>
                    <input type="text" class="form-control" name="funtransportticketcompany"
                        value="{{ $employee->transportticketcompany }}">
                </div>

                <hr />

                <div class="col-md-4">
                    <label class="form-label">Contrato de experiência</label>
                    <div class="form-control">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="funexperiencetime" id="funexperiencetime1"
                                value="30" @if ($employee->experiencetime == '30') checked @endif>
                            <label class="form-check-label" for="funexperiencetime1">30 dias</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="funexperiencetime" id="funexperiencetime2"
                                value="45" @if ($employee->experiencetime == '45') checked @endif>
                            <label class="form-check-label" for="funexperiencetime2">45 dias</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="funexperiencetime" id="funexperiencetime3"
                                value="N" @if ($employee->experiencetime == 'N') checked @endif>
                            <label class="form-check-label" for="funexperiencetime3">Não</label>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <label for="funjobplace" class="form-label">Local</label>
                    <input type="string" class="form-control" name="funjobplace"
                        value="{{ $employee->jobplace ?: 'Empresa' }}">
                </div>

            </div>

            <div class="col-12 mb-5">
                <button class="btn btn-primary" type="submit">Gravar pessoa</button>
                <a class="btn btn-secondary" href="/registers/employee">Cancelar</a>
            </div>

        </form>
    </div>
@endsection
