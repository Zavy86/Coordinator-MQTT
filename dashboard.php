<?php
/**
 * Coordinator MQTT - Dashboard
 *
 * @package Coordinator\Modules\MQTT
 * @author  Manuel Zavatta <manuel.zavatta@gmail.com>
 * @link    http://www.zavynet.org
 */
 // include module template
 require_once(MODULE_PATH."template.inc.php");
 // set html title
 $html->setTitle(api_text("mqtt"));
 // build dashboard object
 $dashboard=new cDashboard();
 $dashboard->addTile("?mod=".MODULE."&scr=logs_list",api_text("dashboard-logs-list"),api_text("dashboard-logs-list-description"),(api_checkAuthorization("mqtt-logs")),"1x1","fa-book");
 $dashboard->addTile("?mod=".MODULE."&scr=messages_send",api_text("dashboard-messages-send"),api_text("dashboard-messages-send-description"),(api_checkAuthorization("mqtt-send")),"1x1","fa-send");
 $dashboard->addTile("?mod=".MODULE."&scr=settings_edit",api_text("dashboard-settings-edit"),api_text("dashboard-settings-edit-description"),(api_checkAuthorization("mqtt-manage")),"1x1","fa-toggle-on");
 // build grid object
 $grid=new cGrid();
 $grid->addRow();
 $grid->addCol($dashboard->render(),"col-xs-12");
 // add content to html
 $html->addContent($grid->render());
 // renderize html page
 $html->render();
?>