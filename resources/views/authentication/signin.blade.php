<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Sign In Form</title>
    <!-- Google Fonts - Mulish -->
    <link href="https://fonts.googleapis.com/css2?family=Mulish:wght@400;500;600;700&display=swap" rel="stylesheet" />
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" />
    <!-- Font Awesome CDN -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet" />
    <style>
      body {
        background-color: #f8f9fa;
        font-family: 'Mulish', sans-serif;
        min-height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
        margin: 0;
      }
      .form-container {
        max-width: 400px;
        width: 100%;
        background: white;
        border-radius: 12px;
        padding: 2rem;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
      }
      .form-title {
        font-weight: 700;
        font-size: 1.5rem;
        text-align: center;
        margin-bottom: 1.5rem;
        color: #333;
      }
      .form-title span {
        color: #5541D7; /* Purple for "ManjaHQ" */
      }
      .form-control {
        border-radius: 8px;
        height: 48px;
        font-size: 0.9rem;
      }
      .btn-primary {
        background-color: #6c63ff;
        border-color: #6c63ff;
        border-radius: 8px;
        font-size: 1rem;
        font-weight: 500;
        height: 48px;
      }
      .btn-primary:hover {
        background-color: #5b54e5;
      }
      .btn-outline-primary {
        color: #6c63ff;
        border-color: #6c63ff;
        border-radius: 8px;
        font-size: 1rem;
        font-weight: 500;
        height: 48px;
      }
      .btn-outline-primary:hover {
        background-color: #6c63ff;
        color: #fff;
      }
      .form-link {
        color: #9A9AB0;
        text-decoration: none;
        font-size: 0.9rem;
      }

      .form-link2 {
        color: #5541D7;
        text-decoration: none;
        font-size: 0.9rem;
      }
      .form-link:hover {
        text-decoration: underline;
      }
      .divider {
        text-align: center;
        margin: 1rem 0;
        color: #777;
      }
      
      .input-group .form-control {
        border-top-right-radius: 0;
        border-bottom-right-radius: 0;
      }
      .input-group .input-group-text {
        border-top-left-radius: 0;
        border-bottom-left-radius: 0;
        cursor: pointer;
      }
    </style>
  </head>
  <body>
    <div class="form-container mt-5">
      <h3 class="form-title">Sign in to <span>ManjaHQ</span></h3>
      <form>
        <!-- Email Input -->
        <div class="mb-3">
          <label for="email" class="form-label">Email</label>
          <input type="email" class="form-control" placeholder="Input your email in here" required />
        </div>

        <!-- Password Input with Eye Icon -->
        <div class="mb-3">
          <label for="password" class="form-label">Password</label>
          <div class="input-group">
            
            <input type="password" id="password" class="form-control" placeholder="Input your password in here" required />
            <span class="input-group-text" id="togglePassword"><i class="fas fa-eye"></i></span>
          </div>
        </div>

        <!-- Forgot Password Link -->
        <div class="d-flex justify-content-end mb-3">
          <a href="#" class="form-link">Forgot password?</a>
        </div>
        <br>

        <!-- Sign In Button -->
        <button type="submit" class="btn btn-primary w-100 mb-3">Sign in</button>

        

        <!-- Google Sign In -->
        <button type="button" class="btn btn-outline-primary w-100 mb-3">Sign in with Google</button>

        <!-- Facebook Sign In -->
        <button type="button" class="btn btn-outline-primary w-100">Sign in with Facebook</button>
      </form>

      <!-- Divider -->
      <div class="divider">Or</div>

      <!-- Sign Up Link -->
      <div class="text-center mt-3">
        <p class="mb-0">
          Don't have an account? <a href="#" class="form-link2">Sign up now</a>
        </p>
      </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Password Visibility Toggle Script -->
    <script>
      const togglePassword = document.getElementById('togglePassword')
      const passwordInput = document.getElementById('password')
      
      togglePassword.addEventListener('click', function () {
        // Toggle the type attribute
        const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password'
        passwordInput.setAttribute('type', type)
      
        // Toggle the eye slash icon
        this.querySelector('i').classList.toggle('fa-eye-slash')
      })
    </script>
  </body>
</html>