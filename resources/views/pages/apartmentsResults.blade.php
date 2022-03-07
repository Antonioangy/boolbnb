@extends('layouts.main-layout')

@section('title')
Ricerca appartamenti
@endsection

@section('content')

<div class="container-fluid">

    {{-- componete vue per ricerca appartamenti --}}
    <apartments-search first-query="{{ $addressQuery }}"></apartments-search>
</div>
    
@endsection