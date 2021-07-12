@extends('admin')

@section('content')
    @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            @foreach($errors->all() as $errorText)
                {{ $errorText }}
            @endforeach
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
    <div class="col-md-12">
        <form method="POST" action="{{ route('clients.update', $client->id) }}">
            @method('PATCH')
            @csrf
            <h1>№{{ $client->id }}</h1>
            <div class="form-group row">
                <label for="inputEmail3" class="col-sm-2 col-form-label">Name</label>
                <div class="col-sm-10">
                    <input name="name" type="text" class="form-control" id="inputEmail3" placeholder="{{ $client->name }}">
                </div>
            </div>
            <div class="form-group row">
                <label for="inputEmail3" class="col-sm-2 col-form-label">Surname</label>
                <div class="col-sm-10">
                    <input name="surname" type="text" class="form-control" id="inputEmail3" placeholder="{{ $client->surname }}">
                </div>
            </div>
            <div class="form-group row">
                <label for="inputPassword3" class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-10">
                    <input name="email" type="email" class="form-control" id="inputPassword3" placeholder="{{ $client->email }}">
                </div>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="customer_type" value="wholesale">
                <label class="form-check-label" for="wholesale">
                    Wholesale
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="customer_type" value="retail">
                <label class="form-check-label" for="Retail">
                    Retail
                </label>
            </div>
            <div class="form-group row">
                <div class="col-sm-10">
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </div>
        </form>
    </div><!-- ./col-md-12-->


@endsection
