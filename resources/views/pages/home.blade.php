@extends('layouts.main-layout')

@section('title')
    Bool-BnB
@endsection

@section('content')

<table>
    <tr>
        <th>
            Titolo
        </th>
        <th>
            Descrizione
        </th>
        <th>
            Stanze
        </th>
        <th>
            Letti
        </th>
        <th>
            Bagni
        </th>
        <th>
            Square
        </th>
        <th>
            Indirizzo
        </th>
        <th>
            img
        </th>
    </tr>

        @foreach ($apartments as $apartment)
        <tr>
            <td>
                {{ $apartment -> title }}
            </td>       
            <td>
                {{ $apartment -> description }}
            </td>  
            <td>
                {{ $apartment -> rooms }}
            </td>  
            <td>
                {{ $apartment -> beds }}
            </td>   
            <td>
                {{ $apartment -> bathrooms }}
            </td> 
            <td>
                {{ $apartment -> sq }}
            </td>  
            <td>
                {{ $apartment -> address }}
            </td>  
            <td>
                {{ $apartment -> images }}
            </td> 
        </tr> 
        @endforeach

</table>
    
@endsection