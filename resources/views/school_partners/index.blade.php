@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
      <h2>School Partners</h2>
        <div>
            <span class="me-3">Welcome, {{ Auth::user()->name }}</span>
            <form method="POST" action="{{ route('logout') }}" class="d-inline">
                @csrf
                <button type="submit" class="btn btn-outline-danger btn-sm">Logout</button>
            </form>
        </div>
    </div>
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert" id="success-alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>

    
    <form method="POST" action="{{ route('logout') }}" class="d-inline">
        @csrf
        <button type="submit" class="btn btn-outline-danger btn-sm">Logout</button>
    </form>
@endif

    <form method="GET" action="{{ route('school-partners.index') }}" class="mb-3">
        <div class="input-group">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Search..." class="form-control" />
            <button type="submit" class="btn btn-primary">Search</button>
            @if(request('search'))
                <a href="{{ route('school-partners.index') }}" class="btn btn-outline-secondary">Clear</a>
            @endif
            <a href="{{ route('school-partners.export') }}" class="btn btn-success mb-3 mx-4 px-4 rounded-pill">⬇️ Export</a>
        </div>
    </form>

    <a href="{{ route('school-partners.create') }}" class="btn btn-primary mb-3">+ Add New</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>School Name</th>
                <th>Contact</th>
                <th>Email</th>
                <th>Students</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($partners as $partner)
                <tr>
                    <td>{{ $partner->school_name }}</td>
                    <td>{{ $partner->contact_person }}</td>
                    <td>{{ $partner->email }}</td>
                    <td>{{ $partner->num_students }}</td>
                    <td>{{ ucfirst($partner->status) }}</td>
                    <td>
                        <a href="{{ route('school-partners.show', $partner->id) }}" class="btn btn-sm btn-info">View</a>
                        <a href="{{ route('school-partners.edit', $partner) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('school-partners.destroy', $partner) }}" method="POST" style="display:inline;">
                            @csrf @method('DELETE')
                            <button onclick="return confirm('Are you sure?')" class="btn btn-sm btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="6">No records found.</td></tr>
            @endforelse
        </tbody>
    </table>

    {{ $partners->withQueryString()->onEachSide(1)->links('pagination::bootstrap-5') }}
</div>

@endsection