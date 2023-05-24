@extends('layouts/admin')

@section('content')
    
<div class="container text-center my-5">
   
    <table class="table">
        <thead>
          <tr>
            <th scope="col">Name</th>
            <th scope="col">Color</th>
            <th scope="col">Slug</th>
            <th></th>
            <th></th>

          </tr>
        </thead>
        <tbody>
            @foreach ($technologies as $tech)
        
            <tr>          
              <td>{{$tech->name}}</td>
              <td ><span class="badge rounded-pill mx-1" style="background-color: {{$tech->color}}">{{$tech->color}}</span></td>
              <td>{{$tech->slug}}</td>
              <td><a href="{{route('admin.technologies.edit', $tech)}}"><i class="fa-regular fa-pen-to-square text-success"></a></td>
              <td>
                <button type="button" class="-btn-" data-bs-toggle="modal" data-bs-target="#exampleModal">
                  <i class="fa-regular fa-trash-can text-danger"></i>
                </button>
              </td>
              
            </tr>
            @endforeach
          
        </tbody>
      </table>

      <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              Sei sicuro di voler eliminare {{$tech->name}}?
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annulla</button>
              <form id="delete" action="{{route('admin.technologies.destroy', $tech)}}" method="post">
                @csrf
                @method('DELETE')
    
                  <button class=" btn btn-danger" type="submit">Elimina</button>
                  {{-- <a href="" onclick="document.getElementById('delete').submit();"><i class="fa-regular fa-trash-can text-danger"></i></a> --}}
              </form>
            </div>
          </div>
        </div>
      </div>

    <a href="{{route('admin.technologies.create')}}"><button class="btn btn-primary">Aggiungi</button></a>
</div>

@endsection