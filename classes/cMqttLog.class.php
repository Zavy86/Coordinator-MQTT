<?php
/**
 * Coordinator MQTT - Log
 *
 * @package Coordinator\Modules\MQTT
 * @author  Manuel Zavatta <manuel.zavatta@gmail.com>
 * @link    http://www.coordinator.it
 */

/**
 * MQTT Log class
 */
class cMqttLog{

 /** Properties */
 protected $id;
 protected $timestamp;
 protected $topic;
 protected $payload;
 protected $client;
 protected $ip;

 /**
  * Debug
  *
  * @return object Companies Company object
  */
 public function debug(){return $this;}

 /**
  * MQTT Log class
  *
  * @param integer $log Companies Company object or ID
  * @return boolean
  */
 public function __construct($log){
  // get object
  if(is_numeric($log)){$log=$GLOBALS['database']->queryUniqueObject("SELECT * FROM `mqtt__logs` WHERE `id`='".$log."'");}
  if(!$log->id){return false;}
  // set properties
  $this->id=(int)$log->id;
  $this->timestamp=(int)$log->timestamp;
  $this->topic=stripslashes($log->topic);
  $this->payload=stripslashes($log->payload);
  $this->client=stripslashes($log->client);
  $this->ip=stripslashes($log->ip);
  // return
  return true;
 }

 /**
  * Get
  *
  * @param string $property Property name
  * @return string Property value
  */
 public function __get($property){return $this->$property;}

}
?>