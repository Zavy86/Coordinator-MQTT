<?php
/**
 * MQTT - Template
 */
 $html=new cHTML($module_name);
 // build navbar object
 $nav=new cNav("nav-tabs");
 $nav->addItem("Test","?mod=mqtt&scr=test");
 // add nav to html
 $html->addContent($nav->render(false));
?>