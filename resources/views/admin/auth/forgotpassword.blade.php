<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quên mật khẩu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f1f5f9;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .forgot-card {
            width: 100%;
            max-width: 420px;
            background: white;
            border-radius: 20px;
            box-shadow: 0 30px 60px rgba(15, 23, 42, 0.08);
            overflow: hidden;
            border: 1px solid rgba(148, 163, 184, 0.16);
        }

        .forgot-header {
            padding: 36px 30px 22px;
            text-align: center;
        }

        .forgot-header h1 {
            margin-bottom: 8px;
            font-size: 28px;
            font-weight: 700;
            color: #111827;
        }

        .forgot-body {
            padding: 0 30px 30px;
        }

        .form-label {
            font-weight: 600;
            color: #334155;
        }

        .form-control {
            border-radius: 12px;
            border: 1px solid #cbd5e1;
            padding: 14px 16px;
            box-shadow: none;
        }

        .btn-back,
        .btn-send {
            border-radius: 12px;
            padding: 12px 20px;
            font-weight: 700;
            min-width: 120px;
        }

        .btn-back {
            background: #fbbf24;
            border: none;
            color: #0f172a;
        }

        .btn-send {
            background: #2563eb;
            border: none;
            color: white;
        }

        .btn-send:hover {
            background: #1d4ed8;
        }

        .btn-back:hover {
            background: #f59e0b;
        }

        .footer-actions {
            display: flex;
            gap: 12px;
            margin-top: 18px;
            flex-wrap: wrap;
        }

        .alert-success {
            border-radius: 14px;
            padding: 18px 20px;
            border: 1px solid rgba(16, 185, 129, 0.2);
            background-color: #d1fae5;
            color: #115e59;
            font-weight: 600;
            margin-bottom: 20px;
        }

        .text-muted-small {
            color: #64748b;
            font-size: 14px;
            margin-top: 10px;
        }

        @media (max-width: 480px) {
            .forgot-card {
                border-radius: 18px;
            }

            .forgot-header,
            .forgot-body {
                padding-left: 20px;
                padding-right: 20px;
            }
        }
    </style>
</head>
<body>
    <div class="forgot-card">
        <div class="forgot-header">
            <h1>Quên mật khẩu</h1>
        </div>

        <div class="forgot-body">
            @if (session('message'))
                <div class="alert alert-success">{{ session('message') }}</div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            @endif

            <form action="{{ route('admin.forgotpass.post') }}" method="POST">
                @csrf

                <div class="mb-4">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" name="email" id="email" placeholder="Nhập email của bạn" value="{{ old('email') }}" required>
                    @if ($errors->has('email'))
                        <div class="text-danger mt-2">{{ $errors->first('email') }}</div>
                    @endif
                </div>

                <div class="footer-actions">
                    <a href="{{ route('admin.login') }}" class="btn btn-back">Quay lại đăng nhập</a>
                    <button type="submit" class="btn btn-send">Gửi</button>
                </div>
            </form>

            <p class="text-muted-small">Nhập email đã đăng ký để nhận mật khẩu mới qua mail.</p>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
