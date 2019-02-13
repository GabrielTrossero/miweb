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
      <button type="button" class="btn btn-danger">Devolver</button>
    @else
      Pelicula disponible
      <br><br>
      <button type="button" class="btn btn-primary">Alquilar</button>
    @endif
    <a class="btn btn-warning" href="{{ url('/catalog/edit/' . $pelicula->id) }}" role="button">Editar pelicula</a>
  </div>
</div>


@stop
