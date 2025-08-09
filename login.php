

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Login</title>
    <link rel="stylesheet" href="login.css">
</head>
<body>
    <div data-animation="default" class="navbar w-nav" data-easing2="ease" data-easing="ease" data-collapse="medium" data-w-id="06ab6c64-468c-b44e-1b8c-856deb96ba7f" role="banner" data-no-scroll="1" data-duration="400" data-doc-height="1">
            <a href="/" aria-current="page" class="logo-link-wrapper w-nav-brand w--current">
                <img src="logo.jpg" alt="Logo" class="logo" style="width: auto; height: 100px; max-height: none;">
            </a>
            <div class="nav-container w-container">
                
            </div>
        </div>

<div class="form-container">
    
    <h2>Login</h2>
    <form action="process.php" method="POST">
        <div class="form-group">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>
        </div>
        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
        </div>
        <div class="form-group">
            <label for="role">Role:</label>
            <select name="role" id="role" required>
                <option value="">-- Select Type --</option>
                <option value="Admin">Admin</option>
                <option value="Tailor">Tailor</option>
            </select>
        </div>
        
        <button type="submit">Login</button>
    </form>
    <p>Don't have an account? <a href="register.php">Register here</a></p>
</div>
<script>
  document.getElementById('loginForm').addEventListener('submit', function(e) {
    e.preventDefault(); // Prevents the form from submitting the traditional way

    // Add your login/register logic here

    // After success, clear the form
    document.getElementById('loginForm').reset();  // This clears all the fields in the form
  });
</script>

</body>
</html>