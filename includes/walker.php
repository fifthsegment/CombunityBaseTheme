<?php
class Walker_Simple_Example extends Walker {
 
    // Set the properties of the element which give the ID of the current item and its parent
    var $db_fields = array( 'parent' => 'primary', 'id' => 'primary-menu' );
    
    private $args = array();
    private $ele_count = 1;
    function __construct( $args ){
        $this->args2 = $args;
    }

    // Displays start of a level. E.g '<ul>'
    // @see Walker::start_lvl()
    function start_lvl(&$output, $depth=0, $args=array()) {

        $output .= "";
    }
 
    // Displays end of a level. E.g '</ul>'
    // @see Walker::end_lvl()
    function end_lvl(&$output, $depth=0, $args=array()) {
        $output .= "";
    }
 
    // Displays start of an element. E.g '<li> Item Name'
    // @see Walker::start_el()
    function start_el(&$output, $item, $depth=0, $args=array(), $current_object_id = 0) {
        if (!isset($item->post_title))
            return;

        if (isset($item->post_title) && strlen($item->post_title)==0)
            return;
        if ($this->ele_count > 4)
            return;
        // var_dump( $item );
        $output.= "<li class='".$this->args2["li-classes"]."'>".
            "<a href='".$item->url."'>".esc_attr($item->post_title) . "</a>";
        $this->ele_count++;
    }
 
    // Displays end of an element. E.g '</li>'
    // @see Walker::end_el()
    function end_el(&$output, $item, $depth=0, $args=array()) {
        $output .= "</li>\n";
    }
}