<?php
/**
 * Coordinator MQTT - Template
 *
 * @package Coordinator\Modules\MQTT
 * @author  Manuel Zavatta <manuel.zavatta@gmail.com>
 * @link    http://www.zavynet.org
 */
 // check authorizations /** @todo fare API */
 if($authorization){if(!api_checkAuthorization(MODULE,$authorization)){api_alerts_add(api_text("alert_unauthorized",array(MODULE,$authorization)),"danger");api_redirect("?mod=settings&scr=dashboard");}}
 // build html object
 $html=new cHTML($module_name);
 // build nav object
 $nav=new cNav("nav-tabs");
 $nav->setTitle(api_text("mqtt"));
 // dashboard
 $nav->addItem(api_icon("fa-th-large",null,"hidden-link"),"?mod=mqtt&scr=dashboard");
 // settings
 if(substr(SCRIPT,0,8)=="settings"){
  // edit
  $nav->addItem(api_text("nav-settings-edit"),"?mod=mqtt&scr=settings_edit");
 }
 // add nav to html
 $html->addContent($nav->render(false));
?>