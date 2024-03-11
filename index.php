<?php
ini_set('error_reporting', E_ALL);
ini_set('display_errors', true);

require_once $_SERVER['DOCUMENT_ROOT'].'/PlainClass.php';
if ($_SERVER['REQUEST_METHOD'] == 'GET' && !empty($_GET)) {

  $DB = [
    'host' => 'localhost',
    'user' => 'shuman_api',
    'password' => '4ZcnDR%2',
    'database' => 'shuman_api',
  ];
  
  $PlanApi = new PlansApi($DB);
  // $txt = "gdththdgf see wfesfse <img alt='' src='/fsfrgers' /> fuck";
  // echo $PlanApi->sendRequiredText($txt);
  
  if ($_GET['get'] == 'Types' && !empty($_GET['get']))
    echo $PlanApi->getTypes();
  elseif ($_GET['get'] == 'plans' && !empty($_GET['get']))
    echo $PlanApi->getPlans();
  elseif ($_GET['get'] == 'plan' && !empty($_GET['id']) && !empty($_GET['get']))
    echo $PlanApi->getPlan($_GET['id']);
  elseif ($_GET['add'] == '1' && !empty($_GET['add']))
    echo $PlanApi->addPlan($_GET);
  elseif ($_GET['remove'] == '1' && !empty($_GET['remove']) && !empty($_GET['id']))
    echo $PlanApi->removePlan($_GET['id']);
  else
    echo 'Not params this GET';
}
?>