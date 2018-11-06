<?php
/**
 * Coordinator MQTT - Settings
 *
 * @package Coordinator\Modules\MQTT
 * @author  Manuel Zavatta <manuel.zavatta@gmail.com>
 * @link    http://www.zavynet.org
 */

/**
 * Settings class
 */
class cMqttSettings{

 /** Properties */
 protected $settings_array;

 /**
  * Debug
  *
  * @return object Settings object
  */
 public function debug(){return $this;}

 /**
  * Settings class
  *
  * @return boolean
  */
 public function __construct(){
  // definitions
  $this->settings_array=array();
  // get settings and build object
  $settings_results=$GLOBALS['database']->queryObjects("SELECT * FROM `mqtt__settings` ORDER BY `setting` ASC",$GLOBALS['debug']);
  foreach($settings_results as $setting){$this->settings_array[$setting->setting]=$setting->value;}
  // return
  return true;
 }

/**
 * Get
 *
 * @param string $setting Setting name
 * @return string Setting value
 */
 public function __get($setting){
  // check if setting exist
  if(!array_key_exists($setting,$this->settings_array)){return false;}
  // return setting value
  return $this->settings_array[$setting];
 }

}
?>