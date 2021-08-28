@extends('layouts.main')

@section('content')


    <div class="container">

        <h1 class="display-6 mb-5"> Configurações do sistema</h1>


        <form class="" method="POST" autocomplete="off">
            @csrf
            @method('PUT')
            <div class="col-12 g-3 mb-4 border p-3 shadow-hover">
                <h5 class="card-title">Dados gerais</h5>

                <div class="row mb-3">

                    <div class="col-md-3">
                        <label for="app_name" class="form-label">Nome do aplicativo</label>
                        <input type="text" class="form-control" name="app_name" value="{{ $configs->app_name }}" required>
                    </div>
                    <div class="col-md-3">
                        <label for="app_debug" class="form-label">Modo debug</label>
                        <div class="form-control">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="app_debug" id="app_debug1" value="S" @if ($configs->app_debug == true) checked @endif>
                                <label class="form-check-label" for="transportticket1">Sim</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="app_debug" id="app_debug2" value="N" @if ($configs->app_debug == false) checked @endif>
                                <label class="form-check-label" for="app_debug2">Não</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label for="timezone" class="form-label">Horário global</label>
                        <input type="text" class="form-control" name="timezone" value="{{ $configs->timezone }}" required>
                    </div>
                    <div class="col-md-3">
                        <label for="timezone" class="form-label">IP Externo</label>
                        <input type="text" class="form-control" name="timezone" value="{{ $configs->externalip }}" required>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-3">
                        <label for="teams_manager" class="form-label">Manager</label>
                        <select class="form-control" name="teams_manager" id="teams_manager" aria-label="teams_manager"
                            required>
                            @foreach ($teams as $team)
                                <option value="{{ $team->id }}" @if ($team->id == $configs->teams_manager) selected @endif>
                                    {{ $team->name }}</option>
                            @endforeach
                        </select>

                    </div>
                    <div class="col-md-3">
                        <label for="teams_finance" class="form-label">Finance</label>
                        <select class="form-control" name="teams_finance" id="teams_finance" aria-label="teams_finance"
                            required>
                            @foreach ($teams as $team)
                                <option value="{{ $team->id }}" @if ($team->id == $configs->teams_finance) selected @endif>
                                    {{ $team->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label for="teams_teacher" class="form-label">Teacher</label>
                        <select class="form-control" name="teams_teacher" id="teams_teacher" aria-label="teams_teacher"
                            required>
                            @foreach ($teams as $team)
                                <option value="{{ $team->id }}" @if ($team->id == $configs->teams_teacher) selected @endif>
                                    {{ $team->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label for="teams_sales" class="form-label">Sales</label>
                        <select class="form-control" name="teams_sales" id="teams_sales" aria-label="teams_sales" required>
                            @foreach ($teams as $team)
                                <option value="{{ $team->id }}" @if ($team->id == $configs->teams_sales) selected @endif>
                                    {{ $team->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-12 g-3 mb-4 border p-3 shadow-hover">
                <h5 class="card-title">Base de dados</h5>

                <div class="row mb-3">
                    <div class="col-md-2">
                        <label for="db_host" class="form-label">Host</label>
                        <input type="text" class="form-control" name="db_host" value="{{ $configs->db_host }}" required>
                    </div>
                    <div class="col-md-2">
                        <label for="db_port" class="form-label">Porta</label>
                        <input type="text" class="form-control" name="db_port" value="{{ $configs->db_port }}" required>
                    </div>
                    <div class="col-md-2">
                        <label for="db_database" class="form-label">Database</label>
                        <input type="text" class="form-control" name="db_database" value="{{ $configs->db_database }}"
                            required>
                    </div>
                    <div class="col-md-2">
                        <label for="db_username" class="form-label">Usuário</label>
                        <input type="text" class="form-control" name="db_username" value="{{ $configs->db_username }}"
                            required>
                    </div>
                    <div class="col-md-2">
                        <label for="db_username" class="form-label">Usuário</label>
                        <input type="text" class="form-control" name="db_username" value="{{ $configs->db_username }}"
                            required>
                    </div>
                    <div class="col-md-2">
                        <label for="db_password" class="form-label">Senha</label>
                        <input type="password" class="form-control" name="db_password" value="">
                    </div>
                </div>
            </div>
            <div class="col-12 g-3 mb-4 border p-3 shadow-hover">
                <h5 class="card-title">Envio de emails</h5>
                <div class="row">
                    <div class="col-md-5 mb-3">
                        <label for="mail_host" class="form-label">Host</label>
                        <input type="text" class="form-control" name="mail_host" value="{{ $configs->mail_host }}"
                            required>
                    </div>
                    <div class="col-md-2 mb-3">
                        <label for="mail_port" class="form-label">Porta</label>
                        <input type="text" class="form-control" name="mail_port" value="{{ $configs->mail_port }}"
                            required>
                    </div>
                    <div class="col-md-5 mb-3">
                        <label for="mail_username" class="form-label">Usuário</label>
                        <input type="text" class="form-control" name="mail_username"
                            value="{{ $configs->mail_username }}" required>
                    </div>
                    <div class="col-md-2 mb-3">
                        <label for="mail_password" class="form-label">Senha</label>
                        <input type="password" class="form-control" name="mail_password" value="">
                    </div>
                    <div class="col-md-5 mb-3">
                        <label for="mail_from_address" class="form-label">Remetente</label>
                        <input type="text" class="form-control" name="mail_from_address"
                            value="{{ $configs->mail_from_address }}" required>
                    </div>
                    <div class="col-md-5 mb-3">
                        <label for="mail_cc" class="form-label">Cópia para</label>
                        <input type="text" class="form-control" name="mail_cc" value="{{ $configs->mail_cc }}" required>
                    </div>
                </div>

            </div>

            <div class="col-12 g-3 mb-4 border p-3 shadow-hover">
                <h5 class="card-title">Popular tabelas</h5>
                

                    <a class="btn btn-primary" href="/seed/country">Países</a>
                    <a class="btn btn-primary" href="/seed/state">Estados</a>
                    <a class="btn btn-primary" href="/seed/city">Cidades</a>
                    <a class="btn btn-primary" href="/seed/cnae">CNAE</a>
                    <a class="btn btn-primary" href="/seed/cfps_cst">CFPS x CST</a>
                
            </div>

            <div class="col-12 mb-5">
                <!--
                    <button class="btn btn-primary" type="submit">Gravar configurações</button>
                    -->
                <a class="btn btn-secondary" href="/">Cancelar</a>
            </div>

        </form>

    </div>


@endsection
