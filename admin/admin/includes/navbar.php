<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard Navbar</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #6a11cb;
            --secondary-color: #2575fc;
            --navbar-bg: #ffffff;
            --text-color: #333;
            --hover-color: #5d3fd3;
        }

        body {
            font-family: 'Arial', sans-serif;
        }

        .main-header {
            background-color: var(--navbar-bg);
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
        }

        .navbar-nav .nav-item .nav-link {
            color: var(--text-color);
            position: relative;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 0.5rem 1rem;
            border-radius: 50%;
            margin: 0 5px;
        }

        .navbar-nav .nav-item .nav-link:hover {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
            transform: scale(1.1) rotate(360deg);
        }

        .navbar-nav .nav-item .nav-link i {
            font-size: 1.2rem;
            transition: transform 0.3s ease;
        }

        .navbar-nav .nav-item .nav-link:hover i {
            transform: rotate(360deg);
        }

        @keyframes pulse {
            0% {
                transform: scale(1);
            }
            50% {
                transform: scale(1.05);
            }
            100% {
                transform: scale(1);
            }
        }

        .navbar-nav .nav-item .nav-link.active,
        .navbar-nav .nav-item .nav-link:focus {
            animation: pulse 1s infinite;
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
        }

        /* Responsive adjustments */
        @media (max-width: 576px) {
            .navbar-nav .nav-item .nav-link {
                padding: 0.3rem 0.5rem;
            }
        }
    </style>
</head>
<body>
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button">
                    <i class="fas fa-bars"></i>
                </a>
            </li>
        </ul>

        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">
            <!-- Navbar Search -->
            <li class="nav-item">
                <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                    <i class="fas fa-expand-arrows-alt"></i>
                </a>
            </li>
        </ul>
    </nav>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>