@extends('master')
@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12 p-4">
            <h2 class="title">Cliente: {{$cliente->nome}}</h2>
            <h6 class="title">Código: {{$cliente->id}}</h6>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 d-flex">
            <a href="{{route('clientes.index')}}" class="btn btn-warning btn-sm">Voltar</a>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <form action="{{route('clientes.store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-12 text-center">
                        <div class="p-2">
                            <h4 class="text-secondary">Foto de perfil</h4>
                            <img width="180" class="rounded-circle" height="180" src="{{asset($cliente->foto ? $cliente->foto : 'images/user.jpg')}}">
                        </div>
                    </div>
                </div>
                <div class="row my-4">
                    <div class="col-md-12">
                        <h4 class="title text-secondary">Dados de pessoais</h4>
                        <hr>
                    </div>
                </div>
                <div class="row my-2">

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="nome">Nome *</label>
                            <input class="form-control" disabled value="{{$cliente->nome}}" type="text" id="nome" name="nome" placeholder="Nome do cliente" required aria-label="Nome">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="cpf">CPF *</label>
                            <input class="form-control" disabled value="{{$cliente->cpf}}" data-mask="000.000.000-00" type="text" required id="cpf" name="cpf" placeholder="CPF do cliente" aria-label="Documento">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="rg">RG *</label>
                            <input class="form-control" disabled value="{{$cliente->rg}}" data-mask="00.000.000-0" type="text" required id="rg" name="rg" placeholder="RG do cliente" aria-label="Documento">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="data_nasc">Data Nasc. *</label>
                            <input class="form-control" disabled type="date" value="{{$cliente->data_nasc->format('Y-m-d')}}" required id="data_nasc" name="data_nasc" max="{{date('Y-m-d')}}" placeholder="dd/mm/yyyy" aria-label="data nascimento">
                        </div>
                    </div>
                </div>

                <div class="row my-4">
                    <div class="col-md-12">
                        <h4 class="title text-secondary">Dados de endereço</h4>
                        <hr>
                    </div>
                </div>

                <div class="row my-2">
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="cep">CEP *</label>
                            <input class="form-control" disabled type="text" id="cep" value="{{$cliente->cep}}" name="cep" data-mask="00000-000" required onchange="consultaCep(this.value)" placeholder="Cep do cliente" aria-label="Cep">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="logradouro">Logradouro *</label>
                            <input class="form-control" disabled type="text" id="logradouro" value="{{$cliente->logradouro}}" required name="logradouro" placeholder="Logradouro do cliente" aria-label="Logradouro">
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="bairro">Bairro *</label>
                            <input class="form-control" disabled type="text" id="bairro" value="{{$cliente->bairro}}" required name="bairro" placeholder="Bairro do cliente" aria-label="Bairro">
                        </div>
                    </div>
                </div>

                <div class="row my-2">
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="cidade">Cidade *</label>
                            <input class="form-control" disabled type="text" required id="cidade" value="{{$cliente->cidade}}" name="cidade" placeholder="Cidade do cliente" aria-label="Cidade">
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="uf">Estado (UF) *</label>
                            <input class="form-control" disabled type="text" required id="uf" name="uf" value="{{$cliente->uf}}" maxlength="2" placeholder="Estado do cliente" aria-label="Estado">
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="numero">Número *</label>
                            <input class="form-control" disabled type="text" required id="numero" value="{{$cliente->numero}}" name="numero" placeholder="Nº do cliente" aria-label="Número">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="complemento">Complemento</label>
                            <input class="form-control" disabled type="text" id="complemento" value="{{$cliente->complemento}}" name="complemento" placeholder="Complemento do cliente" aria-label="Complemento">
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
