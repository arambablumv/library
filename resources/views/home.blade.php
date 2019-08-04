@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">Dashboard</div>
                    @if(auth()->user()->role=='librarian')
                        <a class="badge badge" style="background-color: blue;
    margin-top: 25px;
    margin-left: 410px;
    float: right;
    color: white;
    width: 44px;"
                           href="{{route('home.create')}}">Add</a>
                    @endif
                    <div class="card-body">

                        @if(\Illuminate\Support\Facades\Session::has('error'))
                            <div class="alert alert-danger">
                                <ul>
                                    <li>                            {{\Illuminate\Support\Facades\Session::get('error')}}
                                        ;
                                    </li>
                                </ul>
                            </div>
                        @endif
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <div class="col-lg-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    @if ($errors->any())
                                        <div class="alert alert-danger">
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div><br/>
                                    @endif
                                    <div class="table-responsive">
                                        <table class="table table-hover">
                                            <thead>
                                            <tr>
                                                <th>Title</th>
                                                <th>Description</th>
                                                <th>Created At</th>
                                                <th>Author</th>
                                                <th>Status</th>

                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($query as $key=> $book)
                                                <tr>

                                                    <td>{{$book->title}}</td>
                                                    <td>{{$book->description}}</td>
                                                    <td>{{$book->created_at}}</td>
                                                    <td>
                                                        @foreach($book->author as $key=> $author)
                                                            <a href="{{ route('author.show', $author->id)}}">{{$author->name}}</a>
                                                            <br>
                                                        @endforeach
                                                    </td>
                                                    <td>

                                                        @if($book->status==0)
                                                            <form id="edit" action="{{ url('home',$book->id) }}"
                                                                  method="POST">
                                                                <button type="submit" class="badge badge"
                                                                        style="background-color: limegreen"
                                                                        name="status" value="1">Take
                                                                </button>
                                                                <input type="hidden" name="_method" value="PUT">
                                                                <input type="hidden" name="path" value="home">
                                                                @csrf
                                                            </form>
                                                        @else
                                                            @if(auth()->user()->role=='librarian')
                                                                <form id="edit" action="{{ url('home',$book->id) }}"
                                                                      method="POST">
                                                                    <button type="submit" class="badge badge-danger"
                                                                            name="status" value="0">Tooked
                                                                    </button>
                                                                    <input type="hidden" name="_method" value="PUT">
                                                                    <input type="hidden" name="path" value="home">
                                                                    @csrf
                                                                </form>
                                                                <p>{{$book->user->name}}</p>


                                                            @else
                                                                <button class="badge badge-danger" name="status"
                                                                        value="0">Tooked
                                                                </button>
                                                            @endif
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div style="float:right">{{ $query->links() }}</div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
