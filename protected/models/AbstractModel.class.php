<?php

class AbstractModel {

  public $id;

  private static function conditionBuilder($query) {
    if(is_string($query)) {
      return " WHERE " . $query;
    }
    
    if (!empty($query)) {
      $conditions = array();

      foreach ($query as $key => $value) {
        $conditions [] = "{$key} = " . DB::quote($value);
      }

      return " WHERE " . implode(" AND ", $conditions);
    }
    return "";
  }

  public static function count($query = array()) {
    $table = static::getTable();

    $sql = "SELECT COUNT(*) FROM {$table}";
    $sql .= self::conditionBuilder($query);

    $stmt = DB::prepare($sql);
    $stmt->execute();

    $stmt->setFetchMode(PDO::FETCH_NUM);

    $res = $stmt->fetch();

    return intval($res[0]);
  }

  public static function findByQuery($query, $fetchOne = FALSE, $order = array(), $params = array()) {
    $table = static::getTable();

    $sql = "SELECT * FROM {$table}";

    $sql .= self::conditionBuilder($query);

    if (!empty($order)) {
      $orders = array();

      foreach ($order as $key => $dir) {
        $dir = strtoupper($dir);
        $orders[] = "{$key} {$dir}";
      }

      $sql .= " ORDER BY " . implode(", ", $orders);
    }
    
    $stmt = DB::prepare($sql);
    $stmt->execute($params);

    $stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, static::getClass());

    if ($fetchOne) {
      $res = $stmt->fetch();
      return $res;
    } else {
      $res = $stmt->fetchAll();
      if (!is_array($res)) {
        return array($res);
      } else {
        return $res;
      }
    }
  }

  public static function findAll($query = array(), $order = array()) {
    return self::findByQuery($query, FALSE, $order);
  }

  public static function find($id) {
    return self::findByQuery(array('id' => $id), TRUE);
  }

  public static function getColumnNames() {
    $cols = DB::getColumns(static::getTable());

    $colnames = array();

    foreach ($cols as $key => $value) {
      $colnames [] = $key;
    }
    return $colnames;
  }

  public function updateAttributes($attrs = array(), $query = array()) {
    $table = static::getTable();
    $sql = "UPDATE {$table} SET";
    $cols = self::getColumnNames();

    foreach ($attrs as $key => $value) {
      if (in_array($key, $cols)) {
        $sql .= ' ' . $key . " = " . DB::quote($value) . ',';
      }
    }

    $sql = preg_replace('/,$/', '', $sql);
    $query['id'] = $this->id;

    $sql .= self::conditionBuilder($query);


    $res = DB::exec($sql);
    if ($res > 0) {
      // TODO try find a way to avoid assume ID will not change
      return self::find($this->id);
    }
  }

  public static function create($attrs = array()) {
    $table = static::getTable();
    $sql = "INSERT INTO {$table}";
    $cols = self::getColumnNames();
    
    $keys = array();
    $values = array();

    $wilds = array();

    foreach(array_keys($attrs) as $key) {
      if(in_array($key, $cols)) {
        $keys[] = $key;
        $values[] = $attrs[$key];
        $wilds[] = ':' . $key;
      }
    }

    $sql .= "(". implode(', ', $keys) . ") VALUES (" . implode(', ', $wilds) . ")";

    $stmt = DB::prepare($sql);
    $stmt->execute($attrs);

    $id = DB::lastInsertId();

    return self::find($id);
  }

}
