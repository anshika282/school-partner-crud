@extends('layouts.app')

@section('content')
<div class="container">
    <h2>School Partner Details</h2>

    <div class="card">
        <div class="card-body">
            <p><strong>School Name:</strong> {{ $schoolPartner->school_name }}</p>
            <p><strong>Contact Person:</strong> {{ $schoolPartner->contact_person }}</p>
            <p><strong>Email:</strong> {{ $schoolPartner->email }}</p>
            <p><strong>Number of Students:</strong> {{ $schoolPartner->num_students }}</p>
            <p><strong>Status:</strong> {{ ucfirst($schoolPartner->status) }}</p>
            <p><strong>Created At:</strong> {{ $schoolPartner->created_at->format('d M Y, h:i A') }}</p>
        </div>
    </div>

    <a href="{{ route('school-partners.index') }}" class="btn btn-secondary mt-3">← Back to List</a>
</div>
@endsection