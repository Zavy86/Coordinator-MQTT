<?php
/**
 * Coordinator MQTT - Submit
 *
 * @package Coordinator\Modules\MQTT
 * @author  Manuel Zavatta <manuel.zavatta@gmail.com>
 * @link    http://www.coordinator.it
 */
// check for actions
if(!defined('ACTION')){die("ERROR EXECUTING SCRIPT: The action was not defined");}
// switch action
switch(ACTION){
 // settings
 case "settings_save":settings_save();break;
 // default
 default:
  api_alerts_add(api_text("alert_submitFunctionNotFound",array(MODULE,SCRIPT,ACTION)),"danger");
  api_redirect("?mod=".MODULE);
}

/**
 * Settings Save
 */
function settings_save(){
 // debug
 api_dump($_REQUEST);
 // acquire variables
 $r_tab=$_REQUEST['tab'];
 // definitions
 $settings_array=array();
 $availables_settings_array=array(
  /* general */
  "engine","hostname","hostport","username",
  /* tokens */
  "token"
 );
 // cycle all form fields and set availables
 foreach($_REQUEST as $setting=>$value){if(in_array($setting,$availables_settings_array)){$settings_array[$setting]=$value;}}
 // save password only if change
 if(isset($settings_array['username'])){if($settings_array['username']){if($_REQUEST['password']){$settings_array['password']=$_REQUEST['password'];}}else{$settings_array['password']=null;}}
 // debug
 api_dump($settings_array);
 // cycle all settings
 foreach($settings_array as $setting=>$value){
  // buil setting query
  $query="INSERT INTO `mqtt__settings` (`setting`,`value`) VALUES ('".$setting."','".$value."') ON DUPLICATE KEY UPDATE `setting`='".$setting."',`value`='".$value."'";
  // execute setting query
  $GLOBALS['database']->queryExecute($query,$GLOBALS['debug']);
  api_dump($query);
 }
 // redirect
 api_alerts_add(api_text("mqtt_alert-settingsUpdated"),"success");
 api_redirect("?mod=mqtt&scr=settings_edit&tab=".$r_tab);
}

?>