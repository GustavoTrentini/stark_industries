@extends('master')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 p-4">
            <h2 class="title text-secondary text-center">Cadastro de clientes</h2>
        </div>
    </div>
    @if(session()->has('message'))
    <div class="row my-2">
        <div class="col-md-12">
            <div class="alert alert-{{session('type')}} alert-dismissible fade show" role="alert">
                {{session('message')}}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    </div>
    @endif
    <div class="row my-2">
        <div class="col-md-12 d-flex justify-content-between">
            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Procurar</button>
            <a href="{{route('clientes.create')}}" class="btn btn-success">Novo cliente</a>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 my-2">
            <table class="table table-light table-bordered table-striped">
                <thead class="thead-light">
                    <tr>
                        <th>ID</th>
                        <th>FOTO</th>
                        <th>NOME</th>
                        <th>CPF</th>
                        <th>RG</th>
                        <th>DATA DE NASC.</th>
                        <th>AÇÕES</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($clientes as $cliente)
                    <tr>
                        <td>{{$cliente->id}}</td>
                        <td><img class="rounded-circle" width="30px" height="30px" src="{{asset($cliente->foto ? $cliente->foto : 'images/user.jpg')}}"></td>
                        <td>{{$cliente->nome}}</td>
                        <td>{{$cliente->cpf}}</td>
                        <td>{{$cliente->rg}}</td>
                        <td>{{$cliente->data_nasc->format("d/m/Y")}}</td>
                        <td class="d-flex justify-content-around">
                            <a href="{{route('clientes.show', ['id' => $cliente->id])}}" class="btn btn-sm btn-primary ml-1">Ver</a>
                            <a href="{{route('clientes.edit', ['id' => $cliente->id])}}" class="btn btn-sm btn-warning ml-1">Editar</a>

                            <form action="{{route('clientes.delete', ['id' => $cliente->id])}}" method="POST">
                                @method('DELETE')
                                @csrf
                                <button type="submit" class="btn btn-sm btn-danger ml-1">Deletar</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{route('clientes.search')}}" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Procurar Cliente - Filtros</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row my-2">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="nome">Nome</label>
                                <input class="form-control" value="{{$nome ?? ''}}" type="text" id="nome" name="nome" placeholder="Nome do cliente" aria-label="Nome">
                            </div>
                        </div>
                    </div>

                    <div class="row my-2">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="cpf">CPF</label>
                                <input class="form-control" value="{{$cpf ?? ''}}" data-mask="000.000.000-00" type="text" id="cpf" name="cpf" placeholder="CPF do cliente" aria-label="Documento">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="rg">RG</label>
                                <input class="form-control" value="{{$rg ?? ''}}" data-mask="00.000.000-0" type="text" id="rg" name="rg" placeholder="RG do cliente" aria-label="Documento">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer d-flex justify-content-between">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Fechar</button>
                    <button type="submit" class="btn btn-primary">Procurar</button>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection
