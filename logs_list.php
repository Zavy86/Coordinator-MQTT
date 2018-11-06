<?php
/**
 * Coordinator MQTT - Logs List
 *
 * @package Coordinator\Modules\MQTT
 * @author  Manuel Zavatta <manuel.zavatta@gmail.com>
 * @link    http://www.zavynet.org
 */
 $authorization="mqtt-logs";
 // include module template
 require_once(MODULE_PATH."template.inc.php");
 // definitions
 $logs_array=array();
 // set html title
 $html->setTitle(api_text("logs_list"));
 // build filter
 $filter=new cFilter();
 $filter->addSearch(array("topic","message","client","ip"));
 // build query object
 $query=new cQuery("mqtt__logs",$filter->getQueryWhere());
 $query->addQueryOrderField("timestamp","DESC");
 // build pagination object
 $pagination=new cPagination($query->getRecordsCount());
 // cycle all results
 foreach($query->getRecords($pagination->getQueryLimits()) as $result_f){$logs_array[$result_f->id]=new cMqttLog($result_f);}
 // build table
 $table=new cTable(api_text("logs_list-tr-unvalued"));
 $table->addHeader($filter->link(api_icon("fa-filter"),api_text("filters-modal-link"),"hidden-link"),null,16);
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
  $table->addRowField(api_link("?mod=mqtt&scr=logs_list&act=log_view&idLog=".$log_obj->id,api_icon("fa-search",null,"hidden-link"),api_text("logs_list-td-view")));
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
  $log_dl=new cDescriptionList("br","dl-horizontal");
  $log_dl->addElement(api_text("logs_view_logs_modal-dt-topic"),$selected_log->topic);
  $log_dl->addElement(api_text("logs_view_logs_modal-dt-payload"),nl2br($selected_log->payload));
  $log_dl->addElement(api_text("logs_view_logs_modal-dt-timestamp"),api_timestamp_format($selected_log->timestamp,api_text("datetime")));
  $log_dl->addElement(api_text("logs_view_logs_modal-dt-client"),$selected_log->client);
  $log_dl->addElement(api_text("logs_view_logs_modal-dt-ip"),$selected_log->ip);
  // build log view modal window
  $log_modal=new cModal(api_text("logs_view_logs_modal-title",$selected_log->id),null,"logs_view_logs");
  $log_modal->setBody($log_dl->render());
  // add modal to html object
  $html->addModal($log_modal);
  // jQuery scripts
  $html->addScript("/* Modal window opener */\n$(function(){\$('#modal_logs_view_logs').modal('show');});");
 }
 // build grid object
 $grid=new cGrid();
 $grid->addRow();
 $grid->addCol($filter->render(),"col-xs-12");
 $grid->addRow();
 $grid->addCol($table->render(),"col-xs-12");
 $grid->addRow();
 $grid->addCol($pagination->render(),"col-xs-12");
 // add content to html
 $html->addContent($grid->render());
 // renderize html
 $html->render();
 // debug
 api_dump($query,"query");
?>