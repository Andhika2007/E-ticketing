<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        
        <!-- Font Awesome -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

        <!-- Google Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <!-- Custom Styles -->
        <style>
            body {
                font-family: 'Nunito', sans-serif;
                background: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)),
                            url('/assets/img/hero-bg.jpg') no-repeat center center fixed;
                background-size: cover;
                min-height: 100vh;
                display: flex;
                align-items: center;
            }

            .card {
                backdrop-filter: blur(10px);
                background-color: rgba(255, 255, 255, 0.95);
                border: none;
                border-radius: 15px;
            }

            .card-header {
                background: #5e72e4;
                border-radius: 15px 15px 0 0 !important;
                border-bottom: 0;
            }

            .form-control {
                border-radius: 10px;
                padding: 12px;
                border: 1px solid #e2e8f0;
            }

            .form-control:focus {
                border-color: #5e72e4;
                box-shadow: 0 0 0 0.2rem rgba(94, 114, 228, 0.25);
            }

            .btn-primary {
                background-color: #5e72e4;
                border-color: #5e72e4;
                padding: 12px 25px;
                border-radius: 10px;
                font-weight: 600;
                transition: all 0.3s ease;
            }

            .btn-primary:hover {
                transform: translateY(-2px);
                box-shadow: 0 4px 15px rgba(94, 114, 228, 0.4);
                background-color: #4757c4;
            }

            .form-floating > label {
                padding: 12px;
            }

            .form-check-input:checked {
                background-color: #5e72e4;
                border-color: #5e72e4;
            }

            .text-decoration-none {
                color: #5e72e4;
                transition: all 0.3s ease;
            }

            .text-decoration-none:hover {
                color: #4757c4;
            }

            .invalid-feedback {
                color: #fb6340;
            }
        </style>
    </head>
    <body>
        {{ $slot }}

        <!-- Bootstrap Bundle with Popper -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>
