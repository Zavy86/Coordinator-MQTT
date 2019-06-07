<?php
/**
 * Coordinator MQTT - Logs List
 *
 * @package Coordinator\Modules\MQTT
 * @author  Manuel Zavatta <manuel.zavatta@gmail.com>
 * @link    http://www.coordinator.it
 */
 api_checkAuthorization("mqtt-logs","dashboard");
 // include module template
 require_once(MODULE_PATH."template.inc.php");
 // definitions
 $logs_array=array();
 // set application title
 $app->setTitle(api_text("logs_list"));
 // build filter
 $filter=new strFilter();
 $filter->addSearch(array("topic","message","client","ip"));
 // build query object
 $query=new cQuery("mqtt__logs",$filter->getQueryWhere());
 $query->addQueryOrderField("timestamp","DESC");
 // build pagination object
 $pagination=new strPagination($query->getRecordsCount());
 // cycle all results
 foreach($query->getRecords($pagination->getQueryLimits()) as $result_f){$logs_array[$result_f->id]=new cMqttLog($result_f);}
 // build table
 $table=new strTable(api_text("logs_list-tr-unvalued"));
 $table->addHeader($filter->link(api_icon("fa-filter",api_text("filters-modal-link"),"hidden-link")),"text-center",16);
 $table->addHeader(api_text("logs_list-th-timestamp"),"nowrap");
 $table->addHeader(api_text("logs_list-th-topic"),"nowrap");
 $table->addHeader(api_text("logs_list-th-payload"),null,"100%");
 $table->addHeader(api_text("logs_list-th-client"),"nowrap text-right");
 // cycle all logs
 foreach($logs_array as $log_obj){
  // make row class
  if($log_obj->id==$_REQUEST['idLog']){$tr_class="info";}else{$tr_class=null;}
  // make log row
  $table->addRow($tr_class);
  $table->addRowField(api_link("?mod=".MODULE."&scr=logs_list&act=log_view&idLog=".$log_obj->id,api_icon("fa-search",null,"hidden-link"),api_text("logs_list-td-view")));
  $table->addRowField(api_timestamp_format($log_obj->timestamp,api_text("datetime")),"nowrap");
  $table->addRowField($log_obj->topic,"nowrap");
  $table->addRowField($log_obj->payload,"truncate-ellipsis");
  $table->addRowField($log_obj->client,"nowrap text-right");
 }
 // check for view action
 if(ACTION=="log_view"){
  // get selected log
  $selected_log=new cMqttLog($_REQUEST['idLog']);
  // build log description list
  $log_dl=new strDescriptionList("br","dl-horizontal");
  $log_dl->addElement(api_text("logs_view_logs_modal-dt-topic"),$selected_log->topic);
  $log_dl->addElement(api_text("logs_view_logs_modal-dt-payload"),nl2br($selected_log->payload));
  $log_dl->addElement(api_text("logs_view_logs_modal-dt-timestamp"),api_timestamp_format($selected_log->timestamp,api_text("datetime")));
  $log_dl->addElement(api_text("logs_view_logs_modal-dt-client"),$selected_log->client);
  $log_dl->addElement(api_text("logs_view_logs_modal-dt-ip"),$selected_log->ip);
  // build log view modal window
  $log_modal=new strModal(api_text("logs_view_logs_modal-title",$selected_log->id),null,"logs_view_logs");
  $log_modal->setBody($log_dl->render());
  // add modal to application
  $app->addModal($log_modal);
  // jQuery scripts
  $app->addScript("/* Modal window opener */\n$(function(){\$('#modal_logs_view_logs').modal('show');});");
 }
 // build grid object
 $grid=new strGrid();
 $grid->addRow();
 $grid->addCol($filter->render(),"col-xs-12");
 $grid->addRow();
 $grid->addCol($table->render(),"col-xs-12");
 $grid->addRow();
 $grid->addCol($pagination->render(),"col-xs-12");
 // add content to application
 $app->addContent($grid->render());
 // renderize application
 $app->render();
 // debug
 api_dump($query,"query");
?>