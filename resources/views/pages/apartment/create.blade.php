@extends('layouts.main-layout')

@section('title')
    Nuovo appartamento
@endsection


@section('content')
    <form 
    enctype="multipart/form-data" 
    action="{{ route('apartment.store') }}" 
    method="POST">

        @method('POST')
        @csrf

        <h1>Inserisci nuovo appartamento</h1>

        <label for="title">Title:</label>
        <input type="text" name="title" placeholder="Titolo"> <br>
        
        <label for="description">Description:</label>
        <input type="text" name="description" placeholder="Descrizione"><br>
        
        <label for="rooms">Rooms:</label>
        <input type="number" name="rooms" value="0" min="0"><br>

        <label for="beds">Beds:</label>
        <input type="number" name="beds" value="0" min="0"><br>
        
        <label for="bathrooms">Bathrooms:</label>
        <input type="number" name="bathrooms" value="0" min="0"><br>
        
        <label for="sq">Square:</label>
        <input type="number" name="sq" value="0" min="0"><br>

        <label for="images">Images:</label>
        <input type="file" name="images"><br>

        <label for="address">Address:</label>
        <input type="text" name="address" placeholder="Address"><br>

        <input type="submit" value="create">

    </form>

    <a href="{{ route('home') }}">BACK</a>
@endsection