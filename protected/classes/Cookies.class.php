<?php

class Cookies {
  public function __get($key) {
    if(array_key_exists($key, $_COOKIE)) {
      return $_COOKIE[$key];
    } else {
      return FALSE;
    }
  }

  public function __set($key, $value) {
    $_COOKIE[$key] = $value;
    setcookie($key, $value);
  }

  public function remove($key) {
    unset($_COOKIE[$key]);
  }

  public function getAll() {
    return $_COOKIE;
  }

}
