<html>
<head></head>
<body>
<h1>Admin Dashboard</h1>
<p>Logged in as: <?= session()->get('email') ?></p>
<a href="/logout">Logout</a>
</body>
</html>