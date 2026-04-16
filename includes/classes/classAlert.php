<?php

class Alert
{

    public $_title;
    public $_text;
    public $_redirect;
    public $_type;
    public $_icon;

    function __construct($title, $text, $iconUrl, $type)
    {
       $this->title = ($title);
       $this->text = ($text);
       $this->iconUrl = ($iconUrl);
       $this->type = ($type);
    }

    function get()
    {
        $output = "<div class='alert-block ".$this->type."'>";
        $output .="<img class='alert-icon' src='".get_template_directory_uri()."/img/".$this->iconUrl."'/>";
        $output .="<p class='alert-title'>".$this->title."</p>";
        $output .="<p class='alert-text'>".$this->text."</p>";
        $output .= "</div>";
        return $output;
    }
}