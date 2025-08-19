<?php
class Auth
{
    public static function attempt(string $email, string $password): bool
    {
        $user = Usuario::findByEmail($email);
        if ($user && $user['activo'] && password_verify($password, $user['password_hash'])) {
            Session::set('user', [
                'id_usuario' => $user['id_usuario'],
                'nombre' => $user['nombre'],
                'email' => $user['email'],
                'id_colegio' => $user['id_colegio'],
                'id_sede' => $user['id_sede']
            ]);
            return true;
        }
        return false;
    }

    public static function user(): ?array
    {
        return Session::get('user');
    }

    public static function check(): bool
    {
        return self::user() !== null;
    }

    public static function logout(): void
    {
        Session::remove('user');
    }
}
