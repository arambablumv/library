@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">Dashboard</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <div class="col-lg-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-hover">
                                            <thead>
                                            <tr>
                                                <th>Author</th>
                                                <th>Books</th>
                                            </tr>
                                            </thead>
                                            <tbody>

                                                <tr>

                                                    <td>{{$query->name}}</td>
                                                    <td>
                                                        @foreach($query->library as $key=> $books)
                                                            <a href="{{ route('home.show', $books->id)}}">{{$books->title}}</a><br>
                                                        @endforeach
                                                    </td>

                                                </tr>
                                            </tbody>
                                        </table>

                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
