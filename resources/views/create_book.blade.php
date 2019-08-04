@extends('layouts.app')

@section('content')
    <style>
        .uper {
            margin-top: 40px;
        }
    </style>
    <div class="container">
        <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card-header">Book
        </div>
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div><br />
            @endif
            <form method="post" action="{{ route('home.store') }}">
                <div class="form-group">
                    @csrf
                    <label for="name">Book Title:</label>
                    <input type="text" class="form-control" name="title"/>
                </div>
                <div class="form-group">
                    <label for="price">Book Description :</label>
                    <input type="text" class="form-control" name="description"/>
                </div>
                    <div class="form-group">
                        <div class="fvrduplicate">
                            <div class="form-group">
                                <label for="exampleInputName2">Nome</label>
                                <input type="text" class="form-control" id="exampleInputName2" name="author[][name]" placeholder="Jane Doe">
                            </div>
                        </div>
                    </div>
                <button type="submit" class="btn btn-primary btn-lg btnenviar">Add</button>
            </form>
        </div>
    </div>
    </div>
    </div>

@endsection