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
        @if(count($sellers)>0)
            <div class="table-responsive">
                <table class="table table-hover table-striped">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Company Name</th>
                        <th scope="col">Website</th>
                        <th scope="col">Email</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($sellers as $seller)
                        <tr>
                            <th scope="row">{{ $seller->id }}</th>
                            <td><a href ="{{ route('sellers.edit', $seller->id) }}">{{ $seller->companyName }}</a></td>
                            <td>{{ $seller->website }}</td>
                            <td>{{ $seller->email }}</td>
                            <form id="#" action="{{ route('sellers.destroy', $seller->id) }}"
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
            {{ $sellers->withQueryString()->links('pagination::bootstrap-4') }}
        @else
            <p>Записей не обнаруженно</p>
    @endif

@endsection
