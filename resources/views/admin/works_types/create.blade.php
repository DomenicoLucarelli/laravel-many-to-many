@extends('layouts/admin')

@section('content')

<div class="container text-center py-5">

    <form action="{{route('admin.types.store')}}" method="POST">
    
        @csrf

        <label for="name">Inserisci nome categoria</label>
        <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{old('name')}}">

        @error('name')
        <div class="invalid-feedback">

            {{$message}}

        </div>
        @enderror

        <button class='btn btn-primary my-3' type="submit">Aggiungi</button>
    
    </form>

</div>
@endsection