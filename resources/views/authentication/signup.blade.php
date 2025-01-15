<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Sign Up Form</title>
    <!-- Google Fonts - Mulish -->
    <link
      href="https://fonts.googleapis.com/css2?family=Mulish:wght@400;500;600;700&display=swap"
      rel="stylesheet"
    />
    <!-- Bootstrap CSS -->
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css"
      rel="stylesheet"
    />
    <!-- Font Awesome CDN -->
    <link
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
      rel="stylesheet"
    />
    <style>
      body {
        background-color: #f8f9fa;
        font-family: "Mulish", sans-serif;
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
      .form-label {
        font-weight: 500;
        margin-left: 10px;
      }
      .form-title {
        font-weight: 700;
        font-size: 1.5rem;
        text-align: center;
        margin-bottom: 1.5rem;
        color: #333;
      }
      .form-control {
        border-radius: 8px;
        height: 48px;
        font-size: 0.9rem;
      }
      .btn-primary {
        background-color: #5541d7;
        border-color: #5541d7;
        border-radius: 8px;
        font-size: 1rem;
        font-weight: 500;
        height: 48px;
      }
      .btn-primary:hover {
        background-color: #5b54e5;
      }
      .btn-outline-primary {
        color: #5541d7;
        border-color: #5541d7;
        border-radius: 8px;
        font-size: 1rem;
        font-weight: 500;
        height: 48px;
      }
      .btn-outline-primary:hover {
        background-color: #5541d7;
        color: #fff;
      }
      .form-link {
        color: #5541d7;
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
      <h3 class="form-title">Create your account</h3>
      <form>
        <!-- Church Name -->
        <div class="mb-3">
          <label for="churchName" class="form-label">Church Name</label>
          <input
            type="text"
            id="churchName"
            class="form-control"
            placeholder="input your church name in here"
            required
          />
        </div>

        <!-- Email -->
        <div class="mb-3">
          <label for="email" class="form-label">Email</label>
          <input
            type="email"
            id="email"
            class="form-control"
            placeholder="input your email in here"
            required
          />
        </div>

        <!-- First Name -->
        <div class="mb-3">
          <label for="firstName" class="form-label">First Name</label>
          <input
            type="text"
            id="firstName"
            class="form-control"
            placeholder="input your first name in here"
            required
          />
        </div>

        <!-- Password -->
        <div class="mb-3">
          <label for="password" class="form-label">Password</label>
          <div class="input-group">
            <input
              type="password"
              id="password"
              class="form-control"
              placeholder="input your password in here"
              required
            />
            <span class="input-group-text" id="togglePassword">
              <i class="fas fa-eye"></i>
            </span>
          </div>
        </div>

        <!-- Confirm Password -->
        <div class="mb-3">
          <label for="confirmPassword" class="form-label"
            >Confirm Password</label
          >
          <div class="input-group">
            <input
              type="password"
              id="confirmPassword"
              class="form-control"
              placeholder="input your password in here"
              required
            />
            <span class="input-group-text" id="toggleConfirmPassword">
              <i class="fas fa-eye"></i>
            </span>
          </div>
        </div>

        <!-- Sign Up Button -->
        <button type="submit" class="btn btn-primary w-100 mb-3 mt-3">
          Sign up
        </button>
        <div class="divider">Or</div>

        <!-- Google Sign Up -->
        <button type="button" class="btn btn-outline-primary w-100 mb-3">
          Sign up with Google
        </button>

        <!-- Facebook Sign Up -->
        <button type="button" class="btn btn-outline-primary w-100">
          Sign up with Facebook
        </button>
      </form>

      <!-- Sign In Link -->
      <div class="text-center mt-3">
        <p class="mb-0">
          Don't have an account? <a href="#" class="form-link">Sign in now</a>
        </p>
      </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Password Visibility Toggle Script -->
    <script>
      const togglePassword = document.getElementById("togglePassword");
      const passwordInput = document.getElementById("password");
      togglePassword.addEventListener("click", function () {
        const type =
          passwordInput.getAttribute("type") === "password"
            ? "text"
            : "password";
        passwordInput.setAttribute("type", type);
        this.querySelector("i").classList.toggle("fa-eye-slash");
      });

      const toggleConfirmPassword = document.getElementById(
        "toggleConfirmPassword"
      );
      const confirmPasswordInput = document.getElementById("confirmPassword");
      toggleConfirmPassword.addEventListener("click", function () {
        const type =
          confirmPasswordInput.getAttribute("type") === "password"
            ? "text"
            : "password";
        confirmPasswordInput.setAttribute("type", type);
        this.querySelector("i").classList.toggle("fa-eye-slash");
      });
    </script>
  </body>
</html>
