<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Reset Password</title>
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
    <!-- Font Awesome -->
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
        padding: 20px;
      }
      .form-container {
        max-width: 500px;
        width: 100%;
        background: white;
        border-radius: 12px;
        padding: 3rem;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
        text-align: left;
      }
      .back-btn {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem; /* Spacing between icon and text */
        font-family: "Mulish", sans-serif;
        font-size: 1rem;
        font-weight: 500;
        color: #333;
        text-decoration: none;
        /* padding: 0.5rem 1rem; */
        /* border: 1px solid #ddd; */
        border-radius: 8px;
        background-color: #ffffff;
        transition: all 0.3s ease;
      }

      .back-btn .back-icon {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 32px;
        height: 32px;
        background-color: #f2f2f2;
        border-radius: 10%;
        transition: all 0.3s ease;
      }

      .back-btn:hover .back-icon {
        background-color: #e0e0e0;
      }

      .back-btn .back-icon i {
        font-size: 1.2rem;
        color: #333;
      }
      .form-title {
        font-weight: 700;
        font-size: 1.6rem;
        color: #333;
        text-align: center;
        margin-bottom: 1.5rem;
      }
      .form-control {
        border-radius: 8px;
        height: 48px;
        font-size: 0.9rem;
      }
      .form-label {
        margin-left: 10px;
        font-weight: 600;
      }
      .btn-primary {
        background-color: #5541d7;
        border-color: #5541d7;
        border-radius: 8px;
        font-size: 1rem;
        font-weight: 500;
        padding: 0.75rem 1rem;
        margin-top: 1.5rem;
      }
      .btn-primary:hover {
        background-color: #4736b5;
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
      .input-group-text i {
        font-size: 1rem;
        color: #666;
      }
    </style>
  </head>
  <body>
    <div class="form-container">
      <!-- Back Button -->
      <a href="#" class="back-btn">
        <div class="back-icon">
          <i class="fas fa-chevron-left"></i>
        </div>
        <span>BACK</span>
      </a>
      <div class="container mb-5"></div>

      <!-- Title -->
      <h1 class="form-title">Reset Password</h1>

      <div class="container mb-5"></div>

      <!-- Form -->
      <form>
        <!-- New Password -->
      
        <div class="mb-3">
            <label for="password" class="form-label">New Password</label>
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

        <div class="container mb-5"></div>

        <!-- Submit Button -->
        <button type="submit" class="btn btn-primary w-100">
          Reset Password
        </button>
      </form>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Font Awesome -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>
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
