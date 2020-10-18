<?php
class Menu_Item
{
    public $min_role;
    public $text;
    public $link;
    public $tool_tip;
    public $active=false;
    function __construct($text, $link, $role=3, $tool_tip=null) {
        $this->text = $text;
        $this->link = $link;
        $this->min_role = $role;
        $this->tool_tip = $tool_tip==null ? $tool_tip : $text . "Menu Item";
        
    }
    function get_html() {
        $active_class = $this->active ? " class=\"active-menu\" " : "";
        return <<<__MENU
        <div class="menu-item"><span class="tooltip">$this->tool_tip</span><A id="mi-$this->text" $active_class href="$this->link" target="_self" >$this->text</A>
        </div>
        __MENU;
    }
    function role_can_view($user_role) {
        return $user_role<=$this->min_role;
    }
}

class Pull_Down_Menu_Item extends Menu_item
{
    public $sub_menus;
    function __construct($text, $sub_menus, $role, $tool_tip) {
        parent::__construct($text,"#",$role,$text);
        $this->sub_menus = $sub_menus;
    }
    function get_html() {
            $active_class = $this->active ? ' class="active-menu" ' : "";
        
            $html = '<div class="sub-menu"><div class="menu-item"><span class="tooltip">'.$this->tool_tip . '</span>';
            $html .= '<button id="mi"' . $this->text . '"' . $active_class . '">' . $this->text . '</button></div>';
            $html .='<div class="sub-menu-container">';
            foreach($this->sub_menus as $menu ) {
                $html .= $menu->get_html();
            }
            
            $html .= "</div></div>";  // close the sub-menu container and sub-menu div's
            return $html;
    }    
}

?>