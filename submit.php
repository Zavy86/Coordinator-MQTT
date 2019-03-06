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
 // message send
 case "message_send":message_send();break;
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
 // check authorizations
 api_checkAuthorization("mqtt-manage","dashboard");
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
 api_redirect("?mod=".MODULE."&scr=settings_edit&tab=".$r_tab);
}

/**
 * Message Send
 */
function message_send(){
 // debug
 api_dump($_REQUEST);
 // check authorizations
 api_checkAuthorization("mqtt-send","dashboard");
 // acquire variables
 $r_topic=$_REQUEST['topic'];
 $r_payload=$_REQUEST['payload'];
 $r_retain=$_REQUEST['retain'];
 // publish to mqtt
 $return=mqtt_publish($r_topic,$r_payload,($r_retain?true:false));
 // check
 if($return){api_alerts_add(api_text("mqtt_alert-messageSend"),"success");}
 else{api_alerts_add(api_text("mqtt_alert-messageError"),"success");}
 // redirect
 api_redirect("?mod=".MODULE."&scr=messages_list");
}

?>