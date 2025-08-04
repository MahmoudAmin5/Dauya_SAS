<!DOCTYPE html>
<html>
<head>
    <title>Customer Dashboard</title>
</head>
<body>
    <h2>Welcome, {{ Auth::guard('customer')->user()->name }}</h2>

    <p>You are logged in as a customer.</p>

    <form method="POST" action="{{ route('customer.logout') }}">
        @csrf
        <button type="submit">Logout</button>
    </form>
</body>
</html>
