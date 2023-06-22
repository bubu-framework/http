<?php

namespace Bubu\Http\Session;

use Bubu\Http\Session\Exception\SessionException;

class Session
{
    public function __construct(?int $sessionCache = null, ?int $sessionLifetime = null)
    {
        if (session_status() !== PHP_SESSION_ACTIVE) {

            if (is_null($sessionLifetime)) $sessionLifetime = $_ENV['SESSION_DURATION'] ?? 0;

            ini_set('session.gc_maxlifetime', $sessionLifetime * 60 * 60 * 24);
            session_set_cookie_params($sessionLifetime * 60 * 60 * 24);

            if (is_null($sessionCache))  $sessionCache = $_ENV['HTTP_EXPIRES'] ?? 0;

            session_cache_expire($sessionCache);
            session_cache_limiter($_ENV['SESSION_CACHE_LIMITER'] ?? 'private');
            session_start();
        }
    }

    /**
     * start a new session
     *
     * @param integer|null $sessionCache
     * @param integer|null $sessionLifetime
     * @return Session
     */
    public static function start(?int $sessionCache = null, ?int $sessionLifetime = null): Session
    {
        return new Session($sessionCache, $sessionLifetime);
    }

    /**
     * Verify if a key is registre
     *
     * @param string $key
     * @return boolean
     */
    public static function exists(string $key): bool
    {
        self::start();
        if (isset($_SESSION[$key])) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * get a value for key
     *
     * @param string $key
     * @return mixed
     */
    public static function get(string $key): mixed
    {
        self::start();
        if (isset($_SESSION[$key])) {
            return $_SESSION[$key];
        } else {
            throw new SessionException('Undefined key', 404);
        }
    }

    /**
     * get a value for key without error
     *
     * @param string $key
     * @return mixed
     */
    public static function getSafe(string $key): mixed
    {
        self::start();
        if (isset($_SESSION[$key])) return $_SESSION[$key];
        else return null;
    }

    /**
     * return all session
     *
     * @return array
     */
    public static function getAll(): array
    {
        self::start();
        return $_SESSION;
    }

    /**
     * Set new value / create key
     *
     * @param string $key
     * @param mixed $data
     * @return void
     */
    public static function set(string $key, mixed $data): void
    {
        self::start();
        $_SESSION[$key] = $data;
    }

    /**
     * Add value for array
     *
     * @param string $key
     * @param mixed $data
     * @return void
     */
    public static function add(string $key, mixed $data): void
    {
        self::start();
        $_SESSION[$key][] = $data;
    }

    /**
     * Push value in array (array_merge_recursive)
     *
     * @param string $key
     * @param mixed $data
     * @return void
     */
    public static function push(string $key, mixed $data): void
    {
        self::start();
        if (!array_key_exists($key, $_SESSION)) $_SESSION[$key] = [];
        $_SESSION[$key] = array_merge_recursive($_SESSION[$key], $data);
    }

    /**
     * Delete value
     *
     * @param string $key
     * @return void
     */
    public static function delete(string $key): void
    {
        self::start();
        unset($_SESSION[$key]);
    }

    /**
     * Change lifetime of a session
     *
     * @param integer $newLifetime
     * @return void
     */
    public static function changeSessionLifetime(int $newLifetime)
    {
        $tempSession = $_SESSION;
        $cacheExpire = session_cache_expire();
        self::destroy();
        self::start($cacheExpire, $newLifetime);
        session_regenerate_id(true);
        $_SESSION = $tempSession;
    }

    /**
     * Clean session data
     *
     * @return void
     */
    public static function clean(): void
    {
        self::start();
        foreach ($_SESSION as $key => $value) unset($_SESSION[$key]);
    }

    /**
     * Destroy a session
     *
     * @return void
     */
    public static function destroy(): void
    {
		self::clean();
        session_reset();
        session_unset();
        session_destroy();
        setcookie('PHPSESSID', '', 1);
    }
}
