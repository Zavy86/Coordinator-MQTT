<?php
/**
 * MQTT - Send
 *
 * @package Coordinator\Modules\MQTT
 * @author  Manuel Zavatta <manuel.zavatta@gmail.com>
 * @link    http://www.coordinator.it
 */
 api_checkAuthorization("mqtt-send","dashboard");
 // include module template
 require_once(MODULE_PATH."template.inc.php");
 // set application title
 $app->setTitle(api_text("messages_send"));
 // build messages form
 $form=new strForm("?mod=".MODULE."&scr=submit&act=message_send&tab=".TAB,"POST",null,null,"messages_send");
 $form->addField("text","topic",api_text("messages_send-ff-topic"),"/test",api_text("messages_send-ff-topic-placeholder"),null,null,null,"required");
 $form->addField("text","payload",api_text("messages_send-ff-payload"),null,api_text("messages_send-ff-payload-placeholder"));
 $form->addField("checkbox","retain");
 $form->addFieldOption(1,api_text("messages_send-fo-retain"));
 // form controls
 $form->addControl("submit",api_text("form-fc-submit"));
 $form->addControl("reset",api_text("form-fc-reset"));
 $form->addControl("button",api_text("form-fc-cancel"),"?mod=".MODULE."&scr=dashboard");
 // build grid object
 $grid=new strGrid();
 $grid->addRow();
 $grid->addCol($form->render(),"col-xs-12");
 // add content to application
 $app->addContent($grid->render());
 // renderize application
 $app->render();
 // debug
 api_dump($messages_obj,"messages");
?>