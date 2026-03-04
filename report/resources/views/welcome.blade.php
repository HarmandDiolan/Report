<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="Login to OJT Report" />
    <meta name="author" content="Report System" />
    <title>Login &mdash; OJT Report</title>

    <!-- Styles -->
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet" />

    <!-- Font Awesome -->
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>

    <style>
        body {
            /* optional background if you add login-bg.jpg later */
            /* background: url('{{ asset('assets/img/login-bg.jpg') }}') no-repeat center center fixed; */
            /* background-size: cover; */
        }
    </style>
</head>
<body class="bg-primary">
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <main>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-5">
                            <div class="card shadow-lg border-0 rounded-lg mt-5">
                                <div class="card-header text-center">
                                    {{-- Optional Logo --}}
                                    {{-- <img src="{{ asset('assets/img/logo.png') }}" alt="Logo" style="height:50px;" class="mb-2"> --}}
                                    <h3 class="text-center font-weight-light my-2">Welcome Back</h3>
                                    <p class="small text-muted">Sign in to continue to OJT Report</p>
                                </div>
                                <div class="card-body">
                                    <form method="POST" action="{{ route('login') }}">
                                        @csrf

                                        @if($errors->any())
                                            <div class="alert alert-danger">
                                                <ul class="mb-0">
                                                    @foreach($errors->all() as $error)
                                                        <li>{{ $error }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif

                                        <div class="form-floating mb-3">
                                            <input
                                                class="form-control @error('email') is-invalid @enderror"
                                                id="inputEmail"
                                                type="email"
                                                name="email"
                                                value="{{ old('email') }}"
                                                placeholder="name@example.com"
                                                required autofocus
                                            />
                                            <label for="inputEmail"><i class="fas fa-envelope me-1"></i>Email address</label>
                                            @error('email')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-floating mb-3 position-relative">
                                            <input
                                                class="form-control @error('password') is-invalid @enderror"
                                                id="inputPassword"
                                                type="password"
                                                name="password"
                                                placeholder="Password"
                                                required
                                            />
                                            <label for="inputPassword"><i class="fas fa-lock me-1"></i>Password</label>
                                            <span class="position-absolute" style="top:50%; right:1rem; transform:translateY(-50%); cursor:pointer;" onclick="togglePassword()">
                                                <i id="pw-icon" class="fas fa-eye"></i>
                                            </span>
                                            @error('password')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-check mb-3">
                                            <input class="form-check-input" id="inputRememberPassword" type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }} />
                                            <label class="form-check-label" for="inputRememberPassword">Remember Me</label>
                                        </div>

                                        <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                            @if (Route::has('password.request'))
                                                <a class="small" href="{{ route('password.request') }}">Forgot Password?</a>
                                            @endif
                                            <button type="submit" class="btn btn-primary">Login</button>
                                        </div>
                                    </form>
                                </div>

                                <div class="card-footer text-center py-3">
                                    <div class="small">Don't have an account? Contact administrator to create one.</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>

        <div id="layoutAuthentication_footer">
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">&copy; {{ date('Y') }} OJT Report</div>
                        <div>
                            <a href="#">Privacy Policy</a>
                            &middot;
                            <a href="#">Terms &amp; Conditions</a>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="{{ asset('js/scripts.js') }}"></script>
    <script>
        function togglePassword() {
            const pw = document.getElementById('inputPassword');
            const icon = document.getElementById('pw-icon');
            if (pw.type === 'password') {
                pw.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                pw.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        }
    </script>
</body>
</html>