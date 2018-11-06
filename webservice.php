<?php
/**
 * Coordinator MQTT - Web Service
 *
 * @package Coordinator\Modules\MQTT
 * @author  Manuel Zavatta <manuel.zavatta@gmail.com>
 * @link    http://www.coordinator.it
 */
// check for actions
if(!defined('ACTION')){die("ERROR EXECUTING WEB SERVICE: The action was not defined");}

// build return class
$return=new stdClass();
$return->ok=false;
$return->results=array();
$return->errors=array();

// switch action
switch(ACTION){
 // select2 option values
 case "publish":publish($return);break;
 // default
 default:
  // action not found
  $return->ok=false;
  $return->errors[]=array("Action not found"=>"The action \"".ACTION."\" was not found in \"".MODULE."\" web service");
}

// encode and return
echo json_encode($return);

/**
 * MQTT Publish
 */
function publish(&$return){
 // debug
 api_dump($_REQUEST,"_REQUEST");
 // get settings
 $mqtt_settings=new cMqttSettings();
 // check token
 if($mqtt_settings->token!==$_REQUEST['token']){
  // token error
  $return->ok=false;
  $return->errors[]=array("TOKEN_INVALID"=>"The entered token is not valid!");
  return $return;
 }
 // publish message
 if(!mqtt_publish($_REQUEST['topic'],$_REQUEST['payload'],$_REQUEST['retain'])){
  // publish error
  $return->ok=false;
  $return->errors[]=array("PUBLISH_FAILED"=>"The was an error publishing message on topic ".$_REQUEST['topic']);
  return $return;
 }
 // ok
 $return->ok=true;
 $return->results=array("OK"=>"Message published!");
 // debug
 api_dump($return,"return");
 // return
 return $return;
}

?>