@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Add School Partner</h2>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
        </div>
    @endif
    <form method="POST" action="{{ route('school-partners.store') }}">
        @include('school_partners._form')
    </form>
</div>
@endsection