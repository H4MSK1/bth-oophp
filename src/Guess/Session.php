<?php
namespace H4MSK1\Guess;

/**
 * Session class
 */
class Session
{
    public function all()
    {
        return $_SESSION ?? null;
    }

    public function start($name = null)
    {
        if (session_status() === PHP_SESSION_NONE) {
            if (! is_null($name)) {
                session_name('moau17_oophp_redovisa_guess');
            }

            session_start();
        }
    }

    public function set($key, $value = null)
    {
        if (is_array($key)) {
            foreach ($key as $nkey => $nval) {
                $this->set($nkey, $nval);
            }
        } else {
            $_SESSION[$key] = $value;
        }

        return $this;
    }

    public function get($key, $default = null)
    {
        return array_key_exists($key, $_SESSION)
            ? $_SESSION[$key]
            : $default;
    }

    public function destroy()
    {
        $_SESSION = [];

        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();

            setcookie(
                session_name(),
                '',
                time() - 42000,
                $params["path"],
                $params["domain"],
                $params["secure"],
                $params["httponly"]
            );
        }

        session_destroy();
    }
}
