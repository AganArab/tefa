<!DOCTYPE html>
<html>
<head>
  <title>Login Admin</title>
  <style>
    body { font-family: Arial; background: #000; color: white; display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0; }
    .box { background: #111; padding: 30px; border-radius: 10px; width: 300px; text-align: center; }
    input { width: 100%; padding: 10px; margin: 10px 0; border: none; border-radius: 5px; background: #333; color: white; }
    button { width: 100%; padding: 10px; background: #007bff; border: none; border-radius: 5px; color: white; cursor: pointer; }
    .error { color: red; margin: 10px 0; }
  </style>
</head>
<body>
  <div class="box">
    <h2>LOGIN ADMIN</h2>
    
    @if(session('error'))
      <div class="error">{{ session('error') }}</div>
    @endif

    <form method="POST" action="/login">
      @csrf
      <input type="text" name="username" placeholder="Username" required>
      <input type="password" name="password" placeholder="Password" required>
      <button type="submit">MASUK</button>
    </form>
  </div>
</body>
</html>