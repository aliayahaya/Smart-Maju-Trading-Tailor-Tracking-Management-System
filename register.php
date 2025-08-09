<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Registration</title>
    <link rel="stylesheet" href="register.css">
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
    <h2>User Registration</h2>
    <form action="register_user.php" method="POST">
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>
        </div>
        <div class="form-group">
            <label for="phone">Phone:</label>
            <input type="text" id="phone" name="phone" required>
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
        </div>
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
            <input type="text" id="role" name="role" required>
        </div>
        <button type="submit">Register</button>
    </form>
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

