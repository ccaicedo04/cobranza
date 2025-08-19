<?php
class AuthController
{
    public function showLogin(): void
    {
        if (Auth::check()) {
            Response::redirect(View::route('dashboard'));
        }
        View::render('auth/login', [
            'title' => 'Login',
            'styles' => ['css/auth/login.css'],
            'scripts' => ['js/auth/login.js']
        ]);
    }

    public function login(): void
    {
        if (!CSRF::verify($_POST['_token'] ?? '')) {
            http_response_code(419);
            exit('Invalid CSRF token');
        }
        $errors = Validation::make($_POST, [
            'email' => 'required|email',
            'password' => 'required'
        ]);
        if ($errors) {
            View::render('auth/login', [
                'title' => 'Login',
                'errors' => $errors,
                'email' => $_POST['email'] ?? '',
                'styles' => ['css/auth/login.css'],
                'scripts' => ['js/auth/login.js']
            ]);
            return;
        }
        $email = $_POST['email'];
        $password = $_POST['password'];
        if (Auth::attempt($email, $password)) {
            Response::redirect(View::route('dashboard'));
        }
        View::render('auth/login', [
            'title' => 'Login',
            'error' => 'Credenciales inválidas',
            'email' => $email,
            'styles' => ['css/auth/login.css'],
            'scripts' => ['js/auth/login.js']
        ]);
    }

    public function logout(): void
    {
        Auth::logout();
        Response::redirect(View::route('login'));
    }
}
