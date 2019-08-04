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
                                                <th>Books</th>
                                                <th>Status</th>
                                            </tr>
                                            </thead>
                                            <tbody>

                                            <tr>

                                                <td>{{$query->title}}</td>
                                                <td>
                                                    @if($query->status==0)
                                                        <form id="edit" action="{{ url('home',$query->id) }}" method="POST">
                                                            <button type="submit" class="badge badge" style="background-color: limegreen" name="status"  value="1">Take</button>
                                                            <input type="hidden" name="_method" value="PUT">
                                                            @csrf
                                                        </form>
                                                    @else
                                                        <label class="badge badge-danger">Tooked</label>
                                                    @endif
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
