<?php
/**
 * Coordinator MQTT Functions
 *
 * @package Coordinator\Modules\MQTT
 * @author  Manuel Zavatta <manuel.zavatta@gmail.com>
 * @link    http://www.zavynet.org
 */

// include classes
require_once(ROOT."modules/mqtt/classes/cMqttSettings.class.php");
require_once(ROOT."modules/mqtt/classes/cMqttLog.class.php");

/**
 * MQTT - Log
 *
 * @param type $topic Topic
 * @param type $payload Payload
 * @param type $client Client
 * @return boolean
 */
function api_mqtt_log($topic,$payload=null,$client=null){
 // check parameters
 if(!$topic){return false;}
 // get remote ip address
 $ip=$_SERVER['REMOTE_ADDR'];
 if(array_key_exists('HTTP_X_FORWARDED_FOR',$_SERVER)){$ip=array_pop(explode(',',$_SERVER['HTTP_X_FORWARDED_FOR']));}
 // build company event query objects
 $log_qobj=new stdClass();
 $log_qobj->timestamp=time();
 $log_qobj->topic=$topic;
 $log_qobj->payload=$payload;
 $log_qobj->client=$client;
 $log_qobj->ip=$ip;
 // debug
 api_dump($log_qobj,"mqtt log query object");
 // insert event
 $log_qobj->id=$GLOBALS['database']->queryInsert("mqtt__logs",$log_qobj);
 // check and return
 if($log_qobj->id){return true;}
 else{return false;}
}

/**
 * MQTT - Publish
 *
 * @param type $topic MQTT Topic
 * @param type $payload MQTT Payload
 * @return boolean
 */
function mqtt_publish($topic,$payload,$retain=false){
 // check parameters
 if(!$topic){return false;}
 //if(!$payload){return false;}
 // require phpMQTT
 require("modules/mqtt/helpers/phpMQTT.php");
 // get settings
 $mqtt_settings=new cMqttSettings();
 // engine
 $mqtt=new phpMQTT($mqtt_settings->hostname,$mqtt_settings->hostport,$_SERVER['SERVER_NAME']);
 // check connection
 if($mqtt->connect(true,null,$mqtt_settings->username,$mqtt_settings->password)){
  // publish
  $mqtt->publish($topic,$payload,true,$retain);
  // close connection
  $mqtt->close();
  // log
  api_mqtt_log($topic,$payload,$_SERVER['SERVER_NAME']);
  // published
  return true;
 }else{
  // error
  return false;
 }
}

?>