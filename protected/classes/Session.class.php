<?php

class Session {
  public function __construct() {
    global $config;

    if(array_key_exists('SESSION_URL', $config)) {
      $session_url = $config['SESSION_URL'];
    } else {
      $host = $_SERVER['HTTP_HOST'];
      $hostparts = explode(':', $host);
      if(stristr($host, 'localhost') || strstr($host, '127.0.0.1')) {
        $session_url = '';
      } else {
        $session_url = '.' . $hostparts[0];
      }
    }

    // fall back to using URL for session ID when cookies disabled
    ini_set('session.use_trans_sid', '1');
    session_set_cookie_params(0 , '/', $session_url);
    $this->start();
  }

  public function __get($key) {
    if(array_key_exists($key, $_SESSION)) {
      return $_SESSION[$key];
    } else {
      return FALSE;
    }
  }

  public function __set($key, $value) {
    $_SESSION[$key] = $value;
  }

  public function remove($key) {
    unset($_SESSION[$key]);
  }

  public function getAll() {
    return $_SESSION;
  }

  public function reset() {
    session_destroy();
  }

  public function start() {
    session_start();
  }
}
