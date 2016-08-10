<?php
/**
 * Created by PhpStorm.
 * User: sid
 * Date: 8/3/16
 * Time: 5:10 PM
 */

class Layout {

    private $_ctrl;
    private $_layout;
    private $_header;
    private $_footer;
    private $_title;
    private $_css = array();
    private $_js = array();

    public function __construct()
    {
        $this->_ctrl = &get_instance();
        $this->_layout = 'layout';
    }
    public function render($view = '', $data = null, $return = false) {
        $data['site'] = $this->_ctrl->site;
        $data['content']['header'] = '<!DOCTYPE html><html><head>';
        $data['content']['header'] .= "<title>$this->_title</title>";
        // adding css
        foreach($this->_css as $css) {
            $data['content']['header'] .= sprintf('<link rel="stylesheet" type="text/css" href="%s">', $css);
        }
        // adding js
        foreach($this->_js as $js) {
            $data['content']['header'] .= sprintf('<script src="%s"></script>',$js);
        }
        $data['content']['header'] .= '</head><body>';
        $data['content']['header'] .= $this->_ctrl->load->view($this->_header,$data, true);
        if(strlen($view) > 100) {
            $data['content']['main'] = $view;
        } else {
            $data['content']['main'] = $this->_ctrl->load->view($view, $data, true);
        }
        $data['content']['footer'] = $this->_ctrl->load->view($this->_footer, $data, true);
        $data['content']['footer'] .= '</body></html>';
        $this->_ctrl->load->view($this->_layout, $data);
    }
    public function setLayout($layout) {
        $this->_layout = $layout;
    }
    public function setHeader($header) {
        $this->_header = $header;
    }
    public function setFooter($footer) {
        $this->_footer = $footer;
    }
    public function setTitle($title) {
        $this->_title = $title;
    }
    public function setCss($css) {
        $this->_css[] = $css;
    }
    public function setDefaultCss($css = array()) {
        $this->_css = array_merge($this->_css, $css);
    }
    public function setDefaultJs($js = array()) {
        $this->_js = array_merge($this->_js, $js);
    }
    public function setJs($js) {
        $this->_js[] = $js;
    }
}