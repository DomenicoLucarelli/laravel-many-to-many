@extends('layouts/admin')

@section('content')
<h1 class="text-center mb-5 text-uppercase">Aggiungi un progetto</h1>
<div class="container d-flex flex-column">
    
    <form class="d-flex flex-column align-items-center gap-2" action="{{route('admin.works.store')}}" method="POST">

        @csrf
        <label for="title">Inserisci il titolo</label>
        <input class="form-control @error('title') is-invalid @enderror" type="text" id="title" name="title" placeholder="Inserisci il titolo" value="{{old('title')}}">

        @error('title')
        <div class="invalid-feedback">

            {{$message}}

        </div>
        @enderror
            
        <label for="description">Inserisci descrizione</label>
        <input class="form-control @error('description') is-invalid @enderror" type="text" id="description" name="description" placeholder="Inserisci descrizione" value="{{old('description')}}">

        @error('description')
        <div class="invalid-feedback">

            {{$message}}

        </div>
        @enderror
            
        <label for="image">Inserisci src immagine</label>
        <input class="form-control @error('image') is-invalid @enderror" type="text" id="image" name="image" placeholder="Inserisci src immagine" value="{{old('image')}}">

        @error('image')
        <div class="invalid-feedback">

            {{$message}}

        </div>
        @enderror

        <label for="date">Inserisci data</label>
        <input class="form-control @error('date') is-invalid @enderror" type="date" id="date" name="date" placeholder="Inserisci descrizione" value="{{old('date')}}">

        @error('date')
        <div class="invalid-feedback">

            {{$message}}

        </div>
        @enderror

        <label for="type_id">Inserisci Categoria</label>
        <select name="type_id" id="type_id" class="form-select @error('type_id') is-invalid @enderror">

            <option value="">Nessuno</option>
            
            @foreach ($types as $type)
            
            <option value="{{$type->id}}" {{$type->id == old('type_id') ? 'selected' : ''}}>{{$type->name}}</option>
                
            @endforeach
        </select>

        @error('type_id')
        <div class="invalid-feedback">

            {{$message}}

        </div>
        @enderror
        
        <h6>Inserisci tecnologia/e</h6>
        
        <div class="d-flex gap-2 form-check">

            @foreach ($technologies as $technology)
                
                <label for="tech-{{$technology->id}}">{{$technology->name}}</label>
                <input type="checkbox" name="technologies[]" id="tech-{{$technology->id}}" value="{{$technology->id}}" @checked(in_array($technology->id, old('technologies', [])))>
    
            @endforeach

            
        </div>
        @error('technologies') 
            <div class="text-danger">
            {{$message}}
            </div>
        @enderror

            
        <label for="git_url">Inserisci src GITHUB</label>
        <input class="form-control @error('git_url') is-invalid @enderror" type="text" id="git_url" name="git_url" placeholder="Inserisci src immagine" value="{{old('git_url')}}">

        @error('git_url')
        <div class="invalid-feedback">

            {{$message}}

        </div>
        @enderror
            
        
            

        <button class="btn btn-primary" type="submit">Crea</button>
    </form>
</div>

@endsection