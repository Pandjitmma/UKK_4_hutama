<?php

namespace App\auth;

class guard
{
    public static $adminSession = 'role';

    private static function sesStart()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    public static function isLogin(): bool
    {
        self::sesStart();
        return isset($_SESSION['login']) && $_SESSION['login'] === true;
    }

    public static function gate()
    {
        if (!self::isLogin()) {
            header("Location: ../login.php");
            exit;
        }
    }

    public static function adminOnly()
    {
        self::gate();

        if($_SESSION[self::$adminSession] != 'admin'){
            die("<h1>Akses ditolak!</h1><p>Oops! sepertinya Anda tidak memiliki akses ke halaman ini.</p>");
        }
    }

     public static function isSigned()
    {
        if (self::isLogin()) {
            if ($_SESSION[self::$adminSession] != 'admin') {
                header("Location: public/test.php");
            exit;
            } else {
                header("Location: public/admin/dashboard_admin.php");
            exit;
            }
            
        }
    }
}