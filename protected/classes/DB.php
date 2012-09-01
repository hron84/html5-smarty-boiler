<?php
/*
 * Database Singleton - USE this class for all database access
 *
 *	DB::exec("DELETE FROM Blah");
 *
 *	foreach( DB::query("SELECT * FROM Blah") as $row){
 *	        print_r($row);
 *	}
 *
 * Or...
 *  $db = DB::prepare("SELECT 1 FROM `bookmark` WHERE `userid` = ? AND (`url` = ? OR `name` = ?)");
 *  $db->execute(array($data['userid'], $data['url'], $data['name']));
 *  //if no rows returned, then return false
 *  if(!$db->fetchAll()) {
 *       return false;
 *  }
 *
 * Taken from: http://www.php.net/manual/en/book.pdo.php#93178
 *
 * @author Nathan Tsoi
 */
class DB {
  private static $objInstance;
  /*
   * Class Constructor - Create a new database connection if one doesn't exist
   * Set to private so no-one can create a new instance via ' = new DB();'
   */
  private function __construct() {}
  /*
   * Like the constructor, we make __clone private so nobody can clone the instance
   */
  private function __clone() {}
  /*
   * Returns DB instance or create initial connection
   * @param
   * @return $objInstance;
   */
  public static function getInstance(  ) {
    global $config;

    if(!self::$objInstance) {
      // Build a DSN from the specified informations
      $dbconfig = $config['db-params'][RUNTIME_ENV];
      $username = '';
      $password = '';
      if(isset($dbconfig['username'])) {
        $username = $dbconfig['username'];
        unset($dbconfig['username']);
      }
      if(isset($dbconfig['password'])) {
        $password = $dbconfig['password'];
        unset($dbconfig['password']);
      }
      if(isset($dbconfig['scheme'])) {
        $scheme = $dbconfig['scheme'];
        unset($dbconfig['scheme']);
      }
      $dsn = $scheme . ':';
      $dsnparts = array();
      foreach($dbconfig as $key => $value) {
        $dsnparts[] = "{$key}={$value}";
      }

      // PDO DSN http://www.php.net/manual/en/ref.pdo-mysql.php
      // Handling special case: SQLite database does not understand standard DSN
      if($scheme !== 'sqlite' && $scheme !== 'sqlite2') {
        $dsn .= implode(';', $dsnparts);
      } else {
        $dsn .= $dbconfig['database'];
      }

      self::$objInstance = new PDO($dsn, $username, $password);
      self::$objInstance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      // As we working with Smarty, we explicite need associative arrays
      self::$objInstance->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_NAMED);

      self::$objInstance->query("SET NAMES 'utf8'");
      self::$objInstance->query("SET CHARACTER SET 'utf8'");
    }
    return self::$objInstance;

  } # end method


  private static function mapColType($type) {
    // A dumb mapping to PHP value types
    $typemap = array(
      'varchar'   => 'string',
      'text'      => 'string',
      'longtext'  => 'string',
      'integer'   => 'int',
      'int'       => 'int',
      'smallint'  => 'int',
      'decimal'   => 'int',
      'double'    => 'int',
      'blob'      => 'string',
      'date'      => 'string', // TODO maybe we need
      'datetime'  => 'string', // introduce a date value type?
      'timestamp' => 'int',
    );
    
    
    $tparts = explode('(', $type);
    $t = strtolower($tparts[0]);
    if(array_key_exists($t, $typemap)) {
      return $typemap[$t];
    } else {
      // A fallback type :-)
      return 'string';
    }

  }
  public static function getColumns($table) {
    global $config;

    $scheme = $config['db-params']['scheme'];

    $cols = array();

    switch($scheme) {
    case 'mysql':
      $sql = "SHOW COLUMNS FROM {$table}";

      $stmt = self::prepare($sql);
      $stmt->execute();
      
      $coldata = $stmt->fetchAll();
      foreach($coldata as $col) {
        $cols[$col['Field']] = array(
          'pk' => $col['Key'] == 'PRI',
          'type' => self::mapColType($col['Type']),
        );
      }
      break;
    case 'sqlite':
    case 'sqlite2':
      $sql = "PRAGMA table_info({$table})";
      $stmt = self::prepare($sql);
      $stmt->execute();
      
      $coldata = $stmt->fetchAll();
      foreach($coldata as $col) {
        $cols[$col['name']] = array(
          'pk' => $col['pk'] == '1',
          'type' => self::mapColType($col['type']),
        );
      }
    }
    return $cols;
  }

  /*
   * Passes on any static calls to this class onto the singleton PDO instance
   * @param $chrMethod, $arrArguments
   * @return $mix
   */
  final public static function __callStatic( $chrMethod, $arrArguments ) {
    $objInstance = self::getInstance();
    return call_user_func_array(array($objInstance, $chrMethod), $arrArguments);
  } # end method
}
?>
