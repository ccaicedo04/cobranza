<?php
class CSRF
{
    public static function token(): string
    {
        if (!Session::get('_token')) {
            Session::set('_token', bin2hex(random_bytes(32)));
        }
        return Session::get('_token');
    }

    public static function input(): string
    {
        return '<input type="hidden" name="_token" value="' . self::token() . '">';
    }

    public static function verify(string $token): bool
    {
        return hash_equals(Session::get('_token'), $token);
    }
}
