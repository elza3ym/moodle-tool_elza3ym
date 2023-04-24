<?php
namespace tool_elza3ym\output;

use renderer_base;

class index_page implements \renderable, \templatable {
  var $sometext = null;

  public function __construct($sometext) {
    $this->sometext = $sometext;
  }

  public function export_for_template(renderer_base $output) {
    $data = new \stdClass();
    $data->sometext = $this->sometext;
    return $data;
  }
}