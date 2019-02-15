@extends('layouts.master')


@section('content')

<div class="row">
  <div class="col-sm-4">
    {{ $pelicula->poster }}
  </div>
  <div class="col-sm-8">
    <h2> {{ $pelicula->title }} </h2>
    <h5><strong>Año:</strong> {{ $pelicula->year }} </h5>
    <h5><strong>Director:</strong> {{ $pelicula->director }} </h5>
    <br>
    <strong> <u>Resumen:</u></strong> {{ $pelicula->synopsis }}
    <br>
    <strong> <u>Estado:</u></strong>
    @if($pelicula->rented)
      Pelicula actualmente alquilada
      <br><br>
      <form action="{{action('CatalogController@putReturn', $pelicula->id)}}" method="POST" style="display:inline">
        {{ method_field('PUT') }}
        {{ csrf_field() }}
        <button type="submit" class="btn btn-primary" style="display:inline">
          Devolver película
        </button>
      </form>
    @else
      Pelicula disponible
      <br><br>
      <form action="{{action('CatalogController@putRent', $pelicula->id)}}" method="post" style="display:inline">
        {{ method_field('PUT') }}
        {{ csrf_field() }}
        <button type="submit" class="btn btn-success" style="display:inline">
          Alquilar película
        </button>
      </form>
    @endif
    <a class="btn btn-warning" href="{{ url('/catalog/edit/' . $pelicula->id) }}" role="button">Editar pelicula</a>
    <form action="{{action('CatalogController@deleteMovie', $pelicula->id)}}" method="post" style="display:inline">
      {{ method_field('delete') }}
      {{ csrf_field() }}
      <button type="submit" class="btn btn-danger" style="display:inline">
        Borrar película
      </button>
    </form>
  </div>
</div>


@stop
