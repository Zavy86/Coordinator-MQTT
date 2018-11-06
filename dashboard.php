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
 $dashboard->addTile("?mod=mqtt&scr=settings_edit",api_text("dashboard-settings-edit"),api_text("dashboard-settings-edit-description"),(api_checkAuthorization(MODULE,"mqtt-manage")),"1x1","fa-toggle-on");
 // build grid object
 $grid=new cGrid();
 $grid->addRow();
 $grid->addCol($dashboard->render(),"col-xs-12");
 // add content to html
 $html->addContent($grid->render());
 // renderize html page
 $html->render();
?>