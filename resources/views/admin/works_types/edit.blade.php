@extends('layouts/admin')

@section('content')

<div class="container text-center py-5">

    <form action="{{route('admin.types.update', $type)}}" method="POST">
    
        @csrf
        @method('PUT')

        <label for="name">Modifica nome categoria</label>
        <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{old('name') ?? $type->name}}">

        @error('name')
        <div class="invalid-feedback">

            {{$message}}

        </div>
        @enderror

        <button class='btn btn-primary my-3' type="submit">Modifica</button>
    
    </form>

</div>
@endsection