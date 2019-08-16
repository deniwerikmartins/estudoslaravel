@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">

        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                     @if($errors->any())
                         @foreach($errors->all() as $error)      {{ $error }} @endforeach 
                     @elseif(session()->has('success'))
                           {{ session('success') }}
                     @endif

                    <form action="./contato" method="post" enctype="multipart/form-data">

                        {{ csrf_field() }}

                        <div class="form-group">
                            <label for="nome"></label>
                            Nome
                            <input type="text" class="form-control" name="nome" id="nome">
                        </div>

                        <div class="form-group">
                            <label for="organizacao"></label>
                            Organização
                            <input type="text" class="form-control" name="organizacao" id="organizacao">
                        </div>

                        <div class="form-group">
                            <label for="telefone"></label>
                            telefone
                            <input type="phone" class="form-control" name="telefone" id="telefone">
                        </div>

                        <div class="form-group">
                            <label for="email"></label>
                            email
                            <input type="email" class="form-control" name="email" id="email">
                        </div>

                        <div class="form-group">
                            <label for="grupo"></label>
                            grupo
                            <input type="text" class="form-control" name="grupo" id="grupo">
                        </div>

                        <div class="form-group">
                            <label for="endereco"></label>
                            endereco
                            <input type="text" class="form-control" name="endereco" id="endereco">
                        </div>

                        <div class="form-group">
                            <input type="file" class="form-control-file" name="file" id="file">
                        </div>

                        <button type="submit" class="btn btn-primary">Submit</button>

                    </form>

                </div>
            </div>
        </div>

    </div>
</div>

@endsection
