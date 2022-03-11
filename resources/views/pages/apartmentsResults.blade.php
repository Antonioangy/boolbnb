@extends('layouts.main-layout')

@section('title')
Ricerca appartamenti
@endsection

@section('content')

{{-- componente vue per ricerca appartamenti --}}
<apartments-search first-query="{{ $addressQuery }}"></apartments-search>
    
@endsection