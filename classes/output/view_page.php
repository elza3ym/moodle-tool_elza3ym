<?php
namespace tool_elza3ym\output;
use renderer_base;

class view_page implements \renderable, \templatable {
  var $text_input_from_view = null;
  public function __construct($input_from_view) {
    $this->text_input_from_view = $input_from_view;
  }

  public function export_for_template(renderer_base $output) {
    $data = new \stdClass();
    $data->text_input_from_view = $this->text_input_from_view;
    return $data;
  }
}