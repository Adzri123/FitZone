<html>
<head></head>
<body>
<h1>Welcome, Member!</h1>
<p>Hello <?= session()->get('email') ?></p>
<a href="/logout">Logout</a>
</body>
</html>
