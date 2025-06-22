@extends('layouts.app')

@section('content')
<div class="container" style="max-width: 500px;">
    <h2 class="mb-4">Admin Sign Up</h2>

    <form id="registerForm">
        <div class="mb-3">
            <label for="name" class="form-label">Full Name</label>
            <input type="text" id="name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email address</label>
            <input type="email" id="email" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="role" class="form-label">User Role</label>
            <input type="text" id="role" class="form-control" required value="admin">
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" id="password" class="form-control" required minlength="6">
        </div>

        <div class="mb-3">
            <label for="password_confirmation" class="form-label">Confirm Password</label>
            <input type="password" id="password_confirmation" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-success w-100">Register & Continue</button>
    </form>
</div>

<script>
    document.getElementById('registerForm').addEventListener('submit', function (e) {
        e.preventDefault();

        fetch('/api/register', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                name: document.getElementById('name').value,
                email: document.getElementById('email').value,
                password: document.getElementById('password').value,
                password_confirmation: document.getElementById('password_confirmation').value,
                role : document.getElementById('role').value
            })
        })
        .then(async res => {
    const data = await res.json();

    if (res.ok && data.token) {
        localStorage.setItem('token', data.token);
        document.cookie = "jwt_token=" + data.token + "; path=/;";
        window.location.href = '/school-partners';
    } else {
        if (data.errors) {
            let messages = Object.values(data.errors).flat().join('\n');
            alert(messages);
        } else if (data.message) {
            alert(data.message);
        } else {
            alert('Registration failed.');
        }
    }
    })
    .catch(err => {
        alert('Something went wrong.');
        console.error(err);
    });
    });
</script>
@endsection