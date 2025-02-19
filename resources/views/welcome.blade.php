<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome | Subscription Success</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <style>
        body {
            background-color: #f8f9ff;
            font-family: "Work Sans", sans-serif;
        }

        .welcome-container {
            background-color: white;
            color: #5541d7;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
            max-width: 500px;
            margin: 100px auto;
        }

        .welcome-container h1 {
            font-size: 28px;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .success-icon {
            font-size: 50px;
            color: #28a745;
            margin-bottom: 15px;
        }

        .welcome-container p {
            font-size: 16px;
            color: #6c757d;
            margin-bottom: 20px;
        }

        .credentials {
            background-color: #f1f3ff;
            padding: 15px;
            border-radius: 8px;
            text-align: left;
            margin-bottom: 20px;
        }

        .dashboard-btn {
            background-color: #5541d7;
            color: white;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
            width: 100%;
        }

        .dashboard-btn:hover {
            background-color: #3f32c4;
        }
    </style>
</head>
<body>

<div class="welcome-container">
    <div class="success-icon">✔️</div>
    <h1>Subscription Successful!</h1>
    <p>Congratulations! You have successfully subscribed. Now you can manage your work from the dashboard.</p>

    @if(session('user_credentials'))
        <div class="credentials" style="display: none;">
            <p><strong>Email:</strong> {{ session('user_credentials.email') }}</p>
            <p><strong>Password:</strong> (Use your existing password)</p>
        </div>

        <form id="autoLoginForm" action="{{ route('auto.login') }}" method="POST">
            @csrf
            <input type="hidden" name="email" value="{{ session('user_credentials.email') }}">
            <button type="submit" class="dashboard-btn">Go to Dashboard</button>
        </form>
    @endif
</div>


</body>
</html>
