<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Registration Complete</title>
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
      }
      .form-container {
        max-width: 500px;
        width: 100%;
        background: white;
        border-radius: 12px;
        padding: 4rem;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
        text-align: center;
      }
      .form-title {
        font-weight: 700;
        font-size: 1.8rem;
        color: #333;
        margin-bottom: 0.5rem;
      }
      .form-subtitle {
        font-weight: 400;
        font-size: 1rem;
        color: #666;
        margin-bottom: 1.5rem;
        width: 80%;
        margin-left: auto;
        margin-right: auto;
        text-align: center;
      }

      .option {
        display: flex;
        align-items: center;
        border: 2px solid #ddd;
        border-radius: 8px;
        padding: 1rem;
        margin-bottom: 1rem;
        cursor: pointer;
        transition: all 0.3s ease;
      }
      .option:hover {
        border-color: #5541d7;
        background-color: #f2f0ff;
      }
      .option.active {
        border-color: #5541d7;
        background-color: #f2f0ff;
      }
      .option .tick {
        width: 24px;
        height: 24px;
        border: 2px solid #5541d7;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-left: 1rem;
        flex-shrink: 0;
        background-color: transparent;
        transition: background-color 0.3s ease;
      }
      .option.active .tick {
        background-color: #5541d7;
        color: white;
      }
      .option .tick i {
        color: transparent;
        font-size: 14px;
      }
      .option.active .tick i {
        color: white;
      }
      .info {
        font-size: 0.9rem;
        color: #666;
        margin-bottom: 1.5rem;
        text-align: left;
      }
      .info i {
        color: #5541d7;
        margin-right: 0.5rem;
      }
      .btn-primary {
        background-color: #5541d7;
        border-color: #5541d7;
        border-radius: 8px;
        font-size: 1rem;
        font-weight: 500;
        padding: 0.75rem 1rem;
      }
      .btn-primary:hover {
        background-color: #5b54e5;
      }
      .option input[type="radio"] {
        display: none;
      }
    </style>
  </head>
  <body>
    <div class="form-container">
      <h1 class="form-title">Registration Complete!</h1> <br>
      <p class="form-subtitle">Please choose how would you like to proceed?</p>

      <!-- Form -->
      <form>
        <!-- Option 1 -->
        <label class="option active">
          <input type="radio" name="dataOption" value="demoData" checked />
          <div class="tick">
            <i class="fas fa-check"></i>
          </div>
          <span class="mx-3">Start With Demo Data</span>
        </label>

        <!-- Option 2 -->
        <label class="option">
          <input type="radio" name="dataOption" value="ownData" />
          <div class="tick">
            <i class="fas fa-check"></i>
          </div>
          <span class="mx-3">Use Your Own Data</span>
        </label>

        <!-- Information -->
        <div class="info">
          <i class="fas fa-info-circle"></i>
          Your account will contain a demo list of people and other data to try
          ManjaHQ with.
        </div>
        <br>

        <!-- Continue Button -->
        <button type="submit" class="btn btn-primary w-100">Continue</button>
      </form>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Font Awesome -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>
    <script>
      // Option Selection Script
      const options = document.querySelectorAll(".option");
      options.forEach((option) => {
        option.addEventListener("click", function () {
          options.forEach((opt) => opt.classList.remove("active"));
          this.classList.add("active");
          this.querySelector("input").checked = true;
        });
      });
    </script>
  </body>
</html>
