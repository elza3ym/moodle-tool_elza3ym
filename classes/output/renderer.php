<?php
namespace tool_elza3ym\output;

defined('MOODLE_INTERNAL') || die;

class renderer extends \plugin_renderer_base {
  public function render_index_page(index_page $page) {
    $data = $page->export_for_template($this);
    return parent::render_from_template('tool_elza3ym/index_page', $data);
  }

  public function render_view_page(view_page $page) {
    $data = $page->export_for_template($this);
    return parent::render_from_template('tool_elza3ym/view_page', $data);
  }
}