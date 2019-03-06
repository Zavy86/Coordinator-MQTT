<?php
/**
 * Coordinator MQTT - Template
 *
 * @package Coordinator\Modules\MQTT
 * @author  Manuel Zavatta <manuel.zavatta@gmail.com>
 * @link    http://www.zavynet.org
 */
 // build html object
 $html=new cHTML($module_name);
 // build nav object
 $nav=new cNav("nav-tabs");
 $nav->setTitle(api_text(MODULE));
// dashboard
 $nav->addItem(api_icon("fa-th-large",null,"hidden-link"),"?mod=".MODULE."&scr=dashboard");
 // logs
 if(substr(SCRIPT,0,4)=="logs"){
  $nav->addItem(api_text("nav-logs-list"),"?mod=".MODULE."&scr=logs_list");
 }
 // messages
 if(substr(SCRIPT,0,8)=="messages"){
  $nav->addItem(api_text("nav-messages-send"),"?mod=".MODULE."&scr=messages_send");
 }
 // settings
 if(substr(SCRIPT,0,8)=="settings"){
  // edit
  $nav->addItem(api_text("nav-settings-edit"),"?mod=".MODULE."&scr=settings_edit");
 }
 // add nav to html
 $html->addContent($nav->render(false));
?>