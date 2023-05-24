@extends('layouts/admin')

@section('content')
    <div class="container">
        <h1 class="text-center text-uppercase  pt-5">{{$work->title}}</h1>
        <div class="text-center">
            <img src="{{$work->image}}" class=" w-25 pt-5" alt="...">
          </div>
    </div>
@endsection