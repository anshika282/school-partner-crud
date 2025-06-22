@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit School Partner</h2>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
        </div>
    @endif
    <form method="POST" action="{{ route('school-partners.update', $schoolPartner) }}">
        @method('PUT')
        @include('school_partners._form')
    </form>
</div>
@endsection