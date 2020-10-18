<?php
include_once "menu_item.php";

function get_menus($user_role,$active_menu) {
   $menus = [
       new Menu_Item("Home","/",3,"Opening Screen"),
       new Menu_Item("Dashboard","dashboard.php",3,"Your Dashboard"),
       new Menu_Item("Mark","mark_attendance.php",3,"Mark Attendance"),
       new Menu_Item("Past","attendance_log.php",3,"Past Attendance"),
       new Pull_Down_Menu_Item("Manage",[new Menu_Item("Add Student","add_student.php",2,"Add A student to the system"),
       new Menu_Item("Sessions","manage_sessions.php",2,"Add, Remove, Edit upcoming class sessions")
   ],2,"Manage Class"),
       new Menu_Item("Logout","../login/logout.php",3,"Logout of system")
   ];

   $menu_html = "";
    foreach ($menus as $menu) {
        $menu->active = $menu->text == $active_menu;
        if($menu->role_can_view($user_role)) {
            $menu_html.= $menu->get_html();
        }
    }
   return $menu_html;
}