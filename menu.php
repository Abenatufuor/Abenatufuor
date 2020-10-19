<?php
include_once "menu_item.php";
class menu {
    //My menu class
    private $menus;
    public $user_role;
    //If i dont enter any parameter it goes straight to home
    function __construct ($text="Home",$user_role=3){
    
        
        //initializing parameters
        $this->text = $text;
        $this->user_role = $user_role;
        $this->menus = [
            new Menu_Item("Home","/",3,"Opening Screen"),
            new Menu_Item("Dashboard","dashboard.php",3,"Your Dashboard"),
            new Menu_Item("Mark","mark_attendance.php",3,"Mark Attendance"),
            new Menu_Item("Past","attendance_log.php",3,"Past Attendance"),
            new Pull_Down_Menu_Item("Manage",[new Menu_Item("Add Student","add_student.php",2,"Add A student to the system"),
            new Menu_Item("Sessions","manage_sessions.php",2,"Add, Remove, Edit upcoming class sessions")
        ],2,"Manage Class"),
            new Menu_Item("Logout","../login/logout.php",3,"Logout of system")
        ];
        foreach($this->menus as $menu){
            $menu->active= ($menu->text ==$text);
        }


    }
    function get_html(){
        $menu_html = "";
        //This whole function loop through the menu arrays
        foreach ($this->menus as $menu) {
        
         if($menu->role_can_view($this->user_role)) {
            $menu_html.= $menu->get_html();
        }
    }
   return $menu_html;
    }
    //Creating a method , it is an array of objects
    function add_menu_item($Menu_Item) {
       array_push($this->menus,$Menu_Item);
    }
    function get_menu_item($single){
        foreach($this->menus as $i){

          if($i->text==$single){
               return $i;
          }

      }
        return null;

    }

    function delete_menu_item($now_single){
        for($i=0;$i<count($this->menus);$i++){
            if($this->menus[$i]->text==$now_single){
                array_splice($this->menus,$i,$i);
            }
        }

    }
}