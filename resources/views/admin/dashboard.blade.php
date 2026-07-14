<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            display: flex;
            flex-direction: column;
            height: 100vh;
        }

        .navbar {
            flex-shrink: 0;
        }

        .main-container {
            display: flex;
            flex: 1;
            overflow: hidden;
        }

        .sidebar {
            width: 250px;
            overflow-y: auto;
        }

        .content {
            flex: 1;
            overflow-y: auto;
            padding: 20px;
        }

        .nav-link:hover {
            background-color: #495057;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    @include('admin.partials.header')

    <div class="main-container">
        @include('admin.partials.sidebar')

        <div class="content">
            <h2>My Dashboard</h2>
            <p>Chào mừng bạn đến với Admin Panel!</p>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
