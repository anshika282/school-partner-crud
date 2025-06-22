@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Login</h2>
    <form id="loginForm">
        <div class="mb-3">
            <label>Email:</label>
            <input type="email" id="email" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Password:</label>
            <input type="password" id="password" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Login</button>
    </form>
</div>

<script>
    document.getElementById('loginForm').addEventListener('submit', function (e) {
        e.preventDefault();

        fetch('/api/login', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                email: document.getElementById('email').value,
                password: document.getElementById('password').value
            })
        })
        .then(res => res.json())
        .then(data => {
            if (data.token) {
                localStorage.setItem('token', data.token);
                document.cookie = "jwt_token=" + data.token + "; path=/;";
                window.location.href = '/school-partners';
            } else {
                alert('Login failed');
            }
        });
    });
</script>
@endsection
