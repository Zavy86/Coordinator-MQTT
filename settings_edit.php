<?php
/**
 * MQTT - Settings
 *
 * @package Coordinator\Modules\MQTT
 * @author  Manuel Zavatta <manuel.zavatta@gmail.com>
 * @link    http://www.zavynet.org
 */
 api_checkAuthorization("mqtt-manage","dashboard");
 // get object
 $settings_obj=new cMqttSettings();
 // check actions
 if(ACTION=="token_randomize"||!$settings_obj->token){$settings_obj->token=md5(date("YmdHis").rand(1,99999));}
 // include module template
 require_once(MODULE_PATH."template.inc.php");
 // set html title
 $html->setTitle(api_text("settings_edit"));
 // check for tab
 if(!defined(TAB)){define("TAB","generals");}
 // script tabs
 $tabs=new cNav("nav-pills");
 $tabs->addItem(api_text("settings_edit-tab-generals"),"?mod=".MODULE."&scr=settings_edit&tab=generals");
 $tabs->addItem(api_text("settings_edit-tab-tokens"),"?mod=".MODULE."&scr=settings_edit&tab=tokens");
 // build settings form
 $form=new cForm("?mod=".MODULE."&scr=submit&act=settings_save&tab=".TAB,"POST",null,"settings_edit");
 /**
  * Generals
  */
 if(TAB=="generals"){
  /*$form->addField("radio","engine",api_text("settings_edit-ff-engine"),(int)$settings_obj->engine,null,null,"radio-inline");
  $form->addFieldOption(1,api_text("settings_edit-fo-engine-enabled"));
  $form->addFieldOption(0,api_text("settings_edit-fo-engine-disabled"));*/
  $form->addField("text","hostname",api_text("settings_edit-ff-hostname"),$settings_obj->hostname,api_text("settings_edit-ff-hostname-placeholder"));
  $form->addField("text","hostport",api_text("settings_edit-ff-hostport"),$settings_obj->hostport,api_text("settings_edit-ff-hostport-placeholder"));
  $form->addField("splitter");
  $form->addField("text","username",api_text("settings_edit-ff-username"),$settings_obj->username,api_text("settings_edit-ff-username-placeholder"));
  $form->addField("text","password",api_text("settings_edit-ff-password"),null,api_text("settings_edit-ff-password-placeholder"));
 }
 /**
  * Tokens
  */
 if(TAB=="tokens"){
  $form->addField("text","token",api_text("settings_edit-ff-token"),$settings_obj->token,api_text("settings_edit-ff-token-placeholder"));
  $form->addFieldAddonButton("?mod=".MODULE."&scr=settings_edit&tab=tokens&act=token_randomize",api_text("settings_edit-ff-token-randomize"));
 }
 // form controls
 $form->addControl("submit",api_text("form-fc-submit"));
 $form->addControl("reset",api_text("form-fc-reset"));
 $form->addControl("button",api_text("form-fc-cancel"),"?mod=".MODULE."&scr=dashboard");
 // build grid object
 $grid=new cGrid();
 $grid->addRow();
 $grid->addCol($form->render(),"col-xs-12");
 // add content to html
 $html->addContent($tabs->render(false));
 $html->addContent($grid->render());
 // renderize html page
 $html->render();
 // debug
 api_dump($settings_obj,"settings");
?>