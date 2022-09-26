<?php

declare(strict_types=1);

namespace Light\Cookie;

/**
 * Class Cookie
 * @package Light
 */
class Cookie
{
  /**
   * @param string $name
   * @param mixed $value
   *
   * @return bool
   */
  public static function set(string $name, $value): bool
  {
    return self::_set($name, base64_encode(serialize($value)));
  }

  /**
   * @param string $name
   * @param string $value
   *
   * @return bool
   */
  private static function _set(string $name, string $value): bool
  {
    $_COOKIE[$name] = $value;
    return setcookie($name, $value, time() * 2, '/');
  }

  /**
   * @param string $name
   * @return mixed
   */
  public static function get(string $name)
  {
    if ($value = self::_get($name)) {
      return unserialize(base64_decode($value));
    }

    return null;
  }

  /**
   * @param string $name
   * @return string|null
   */
  private static function _get(string $name): string|null
  {
    return $_COOKIE[$name] ?? null;
  }

  /**
   * @param string $name
   * @return bool
   */
  public static function remove(string $name)
  {
    unset($_COOKIE[$name]);
    return setcookie($name, '', 1, '/');
  }
}
