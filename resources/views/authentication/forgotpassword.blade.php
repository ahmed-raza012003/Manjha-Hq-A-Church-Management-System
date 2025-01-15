<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Forgot Password</title>
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
        padding: 2.5rem;
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
        margin-bottom: 1rem;
      }
      .form-subtitle {
        font-weight: 400;
        font-size: 0.8rem;
        color: #92929d;
        margin-bottom: 1.5rem;
        line-height: 1.5;
      }
      .form-control {
        border-radius: 8px;
        height: 48px;
        font-size: 0.9rem;
      }

      .form-label{
        font-weight: 600;
        margin-left: 10px;
      }
      .btn-primary {
        background-color: #5541d7;
        border-color: #5541d7;
        border-radius: 8px;
        font-size: 1rem;
        font-weight: 500;
        padding: 0.75rem 1rem;
        margin-top: 1rem;
      }
      .btn-primary:hover {
        background-color: #4736b5;
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

      <div class="container mb-5">
        
      </div>

      <!-- Title -->
      <h1 class="form-title">Forgot Password</h1>

      <!-- Subtitle -->
      <p class="form-subtitle">
        Enter the email address you used when you joined and we'll send you
        instructions to reset your password.
      </p>
      <p class="form-subtitle">
        For security reasons, we do NOT store your password. So rest assured
        that we will never send your password via email.
      </p>

      <!-- Form -->
      <form>
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
        <button type="submit" class="btn btn-primary w-100">Submit</button>
      </form>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Font Awesome -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>
  </body>
</html>
