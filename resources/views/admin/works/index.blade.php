@extends('layouts/admin')

@section('content')

<h1 class="text-center">I miei lavori</h1>
<div class="container d-flex justify-content-center gap-4 mt-5">
  @foreach ($works as $work)
  
    {{-- @dd($work->technologies[0]->name) --}}
        
    <div class="card" style="width: 18rem;">
      <img src="{{asset('storage/' . $work->image)}}" class="card-img-top" alt="...">
      <div class="card-body">
        <h5 class="card-title"><b>{{$work->title}}</b></h5>
        <p class="card-text">{{$work->description}}</p>
      </div>
      <ul class="list-group list-group-flush">
        <li class="list-group-item"><b>Date: </b>{{$work->date}}</li>
        <li class="list-group-item"><b>Categoria:</b> {{$work->type->name ?? 'nessuna'}} </li>
      </ul>
      <div class="card-body ">

        <b>Tecnologia:</b>
        @if ($work->technologies->isEmpty())
        <span>nessuna</span>
        @else
        
        @foreach ($work->technologies as $tech)
            
        <span class="badge rounded-pill mx-1" style="background-color: {{$tech->color}}">{{$tech->name}}</span>
        @endforeach
        
        @endif
        
      </div>
      <div class="card-body text-center">
        <a href="{{$work->git_url}}" ><i class="fa-brands fa-github fs-1 "></i></a> 
      </div>
      <div class="card-body text-center fs-3 d-flex justify-content-center gap-3">
        <a href="{{route('admin.works.show', $work)}}" ><i class="fa-solid fa-magnifying-glass"></i></a>
        <a href="{{route('admin.works.edit', $work)}}" ><i class="fa-regular fa-pen-to-square text-success"></i></a>
        <button type="button" class="-btn-" data-bs-toggle="modal" data-bs-target="#exampleModal">
          <i class="fa-regular fa-trash-can text-danger"></i>
        </button>       

      </div>
    </div>
  @endforeach
</div>

 <!-- Modal -->
 <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Sei sicuro di voler eliminare {{$work->title}}?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annulla</button>
        <form id="delete" action="{{route('admin.works.destroy', $work)}}" method="post">
          @csrf
          @method('DELETE')

          <button class=" btn btn-danger" type="submit">Elimina</button>
            
        </form>
      </div>
    </div>
  </div>
</div>

  <div class="-container- d-flex justify-content-center my-5">

    <a  href="{{route('admin.works.create')}}"><button class="btn btn-primary">Aggiungi un progetto</button></a>

  </div>
@endsection