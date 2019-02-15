<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Movie;
use Notification;

class CatalogController extends Controller
{
  public function getIndex(){
    $peliculas = Movie::all();
    return view('catalog.index', array('arrayPeliculas' => $peliculas));
  }

  public function getShow($id){
    $pelicula = Movie::findOrFail($id);
    return view('catalog.show', array('pelicula' => $pelicula));
  }

  public function getCreate(){
    return view('catalog.create');
  }

  public function getEdit($id){
    $pelicula = Movie::findOrFail($id);
    return view('catalog.edit', array('pelicula' => $pelicula));
  }

  public function postCreate(Request $request){
    $pelicula = new Movie();
    $pelicula->title = $request->title;
    $pelicula->year = $request->year;
    $pelicula->director = $request->director;
    $pelicula->poster = $request->poster;
    $pelicula->synopsis = $request->synopsis;
    if($pelicula->save()){
      Notification::success('La pelicula fue agregada con éxito');
    }
    else{
      Notification::error('ERROR: La pelicula NO se agregó');
    }
    return view('catalog.show', array('pelicula' => $pelicula));
  }

  public function putEdit(Request $request, $id){
    $pelicula = Movie::findOrFail($id);
    $pelicula->title = $request->title;
    $pelicula->year = $request->year;
    $pelicula->director = $request->director;
    $pelicula->poster = $request->poster;
    $pelicula->synopsis = $request->synopsis;
    if($pelicula->save()){
      Notification::success('La pelicula fue modificada con éxito');
    }
    else{
      Notification::error('ERROR: La pelicula NO se modificó');
    }
    return view('catalog.edit', array('pelicula' => $pelicula));
  }

  public function putRent($id){
    $pelicula = Movie::findOrFail($id);
    $pelicula->rented = true;
    if($pelicula->save()){
      Notification::success('La pelicula fue alquilada con éxito');
    }
    else{
      Notification::error('ERROR: No se pudo realizar la solicitud');
    }
    return view('catalog.show', array('pelicula' => $pelicula));
  }

  public function putReturn($id){
    $pelicula = Movie::findOrFail($id);
    $pelicula->rented = false;
    if($pelicula->save()){
      Notification::success('La pelicula fue devuelta con éxito');
    }
    else{
      Notification::error('ERROR: No se pudo realizar la solicitud');
    }
    return view('catalog.show', array('pelicula' => $pelicula));
  }

  public function deleteMovie($id){
    $pelicula = Movie::findOrFail($id);
    if($pelicula->delete()){
      Notification::success('La pelicula fue eliminada con éxito');
    }
    else{
      Notification::error('ERROR: La pelicula NO pudo ser eliminada');
    }
    $peliculas = Movie::all();
    return view('catalog.index', array('arrayPeliculas' => $peliculas));
  }

}
