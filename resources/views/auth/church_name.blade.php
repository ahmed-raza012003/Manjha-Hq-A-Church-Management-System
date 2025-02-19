<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Provide Church Name</title>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Mulish:wght@400;500;600;700&display=swap" rel="stylesheet" />
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" />
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
            color: #5541D7;
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
        .form-link {
            color: #9A9AB0;
            text-decoration: none;
            font-size: 0.9rem;
        }
        .form-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h3 class="form-title">Provide Your <span>Church Name</span></h3>
        <form method="POST" action="{{ route('auth.church_name.store') }}">
            @csrf
            <div class="mb-3">
                <label for="church_name" class="form-label">Church Name</label>
                <input type="text" name="church_name" class="form-control" placeholder="Enter your church name" required />
            </div>
            <button type="submit" class="btn btn-primary w-100">Submit</button>
        </form>
    </div>
</body>
</html>
