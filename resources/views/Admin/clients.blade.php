@extends('admin')

@section('content')
    @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ $errors->first() }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session()->get('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
        @if(count($clients)>0)
            <div class="table-responsive">
                <table class="table table-hover table-striped">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Surname</th>
                        <th scope="col">Email</th>
                        <th scope="col">Customer Type</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($clients as $client)
                        <tr>
                            <th scope="row">{{ $client->id }}</th>
                            <td><a href ="{{ route('clients.edit', $client->id) }}">{{ $client->name }}</a></td>
                            <td>{{ $client->surname }}</td>
                            <td>{{ $client->email }}</td>
                            <td>{{ $client->customer_type }}</td>
                            <form id="#" action="{{ route('clients.destroy', $client->id) }}"
                                  method="POST" style="display: none;">
                                @method('DELETE')
                                @csrf
                                <td>
                                    <button type="submit" class="btn btn-danger">Delete</button></td>
                            </form>
                        </tr>
                    </tbody>
                    @endforeach
                </table>
            </div><!-- ./table-responsive-->
            {{ $clients->withQueryString()->links('pagination::bootstrap-4') }}
        @else
            <p>Записей не обнаруженно</p>
    @endif

@endsection
