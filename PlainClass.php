<?php

Class PlansApi {
  public static $paramsDB; 
  public static $params;
  public static $connect;
  public static $result = [];

  public function __construct($paramsDB = array()) {
    if (!empty($paramsDB))
      $this->connected($paramsDB);
    else
      die('error init Class');
  }

  public static function connected($paramsDB = array()) {

    self::$connect = mysqli_connect($paramsDB['host'], $paramsDB['user'], $paramsDB['password'], $paramsDB['database']);
    if (mysqli_connect_error()) {
        self::$result['error'] = "Connection Error.";
    }

    if (in_array('error',self::$result)) {
      die(json_encode(self::$result,true));
    }
    
  }

  public static function addPlan($data) {

    $name = $data['name'];
    $type = $data['type'];
    $description = $data['description'];
    $price = $data['price'];
    // is_archive boolean
    $is_archive = (!empty($data['archive'])) ? $data['archive'] : false;
    $description = $this->sendRequiredText($description);

    // type int foreign key 1,2,3 .
    $sql = "INSERT INTO 'Tarif_plan' ('type', 'name', 'description', 'price', 'is_archive') 
    VALUES ('".intval($type)."','".$name."','".$description."','".$price."','".$is_archive."')";

    $query = mysqli_query(self::$connect, $sql);

    $response = mysqli_result($query);
    if (!empty(mysqli_error(self::$connect))) {
      self::$result['error'] = mysqli_error(self::$connect);
    } else {
      self::$result['add'] = $response;
    }

    return json_encode(self::$result, true);
  }

  public static function getTypes() {
    $sql = "SELECT * FROM Tarif_type";
    $query = mysqli_query(self::$connect,$sql);
    while ($row = mysqli_fetch_assoc($query)) {
      self::$result['types'][] = $row;
    }
    return json_encode(self::$result,true);
  }

  public function getPlan($idPlan) {
    $sql = "SELECT * FROM Tarif_plan WHERE id=".$idPlan;
    $query = mysqli_query(self::$connect,$sql);
    while ($row = mysqli_fetch_assoc($query)) {
      self::self::$result['plan'][] = $row;
    }
    return json_encode(self::self::$result,true);
  }

  public function getListPlans() {

    $sql = "SELECT Tarif_plan.id, Tarif_type.name AS 'type_tarif',Tarif_plan.description, Tarif_plan.price,Tarif_plan.is_archive 
    FROM Tarif_plan JOIN Tarif_type ON Tarif_plan.type=Tarif_type.id_type ORDER BY Tarif_plan.id";
    $query = mysqli_query(self::$connect,$sql);

    while ($row = mysqli_fetch_assoc($query)) {
      self::$result['plans'][$row['id']] = $row;
    }
    
    return json_encode(self::$result,true);

  }

  public function sendRequiredText($text) {

    require_once $_SERVER['DOCUMENT_ROOT'].'/Censures.php';

    $censures = new ObsceneCensorRus();
    $censures_text  = $censures::getFiltered($text);

    $text = str_replace('*', '', $censures_text);

    if (stristr($text,'<img') != false) {
      $rest_text = preg_replace("/<img[^>]+\>/i", " ", $text);
      $rest_text = htmlspecialchars_decode($rest_text);
    } else {
      $rest_text = htmlspecialchars_decode($text);
    }

    if (stristr($rest_text, 'http:/') != false) {
      $rest_text = preg_replace('(http://[\w+?\.\w+]+[a-zA-Z0-9\~\!\@\#\$\%\^\&amp;\*\(\)_\-\=\+\\\/\?\:\;\'\.\/]+[\.]*[a-zA-Z0-9\/]+)', "<a href='$0' target='_blank'>$0</a>", $text);
    } elseif (stristr($rest_text, 'https:/') != false) {
      $rest_text = preg_replace('(https://[\w+?\.\w+]+[a-zA-Z0-9\~\!\@\#\$\%\^\&amp;\*\(\)_\-\=\+\\\/\?\:\;\'\.\/]+[\.]*[a-zA-Z0-9\/]+)', "<a href='$0' target='_blank'>$0</a>", $text);
    }

    return $rest_text;

  }

  public function removePlan($idPlan) {
    //$query = "DELETE ";

  }

}