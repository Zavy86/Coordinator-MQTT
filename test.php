<?php
 // include module template
 require_once(MODULE_PATH."template.inc.php");
 // set html title
 $html->setTitle("MQTT tester");


require("modules/mqtt/phpMQTT.php");
$server = "localhost";     // change if necessary
$port = 1883;                     // change if necessary
$username = "test";                   // set your username
$password = "test";                   // set your password
$client_id = "phpMQTT-subscriber"; // make sure this is unique for connecting to sever - you could use uniqid()
/*$mqtt = new phpMQTT($server, $port, $client_id);
if(!$mqtt->connect(true, NULL, $username, $password)) {
	exit(1);
}
$topics['test'] = array("qos" => 0, "function" => "procmsg");
$mqtt->subscribe($topics, 0);
while($mqtt->proc()){

}
$mqtt->close();
function procmsg($topic, $msg){
		echo "Msg Recieved: " . date("r") . "\n";
		echo "Topic: {$topic}\n\n";
		echo "\t$msg\n\n";
}
*/

 api_dump("test","label");


 // build grid object
 /*$grid=new cGrid();
 $grid->addRow();
 $grid->addCol($dl->render(),"col-12 col-sm-12 text-justify");
 $grid->addCol($dl_horizontal->render(),"col-12 col-sm-12 text-justify");
 // add content to html
 $html->addContent($grid->render());*/
 // renderize html
 $html->render();
?>