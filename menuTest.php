<?php declare(strict_types=1);
use PHPUnit\Framework\TestCase;
include_once "menu.php";
final class menuTest extends TestCase {
    public function testMenuClassExists(): void {
        $this->assertTrue(class_exists('Menu'));
    }
    public function testMenuClassCreatesDefault(): void {
        $this->assertInstanceOf(Menu::class,new Menu());
    }
    public function testMenuClassDefaultActiveIsHome(): void {
        $menu = new Menu();
        $home = $menu->get_menu_item("Home");
        $this->assertTrue($home->active);
    }
    public function testMenuClassDefaultRoleIs3(): void {
        $menu = new Menu();
        $this->assertEquals(3,$menu->user_role);
    }

    public function testMenuClassCanSetDashboardAsActiveInConstructor(): void {
        $menu = new Menu("Dashboard");
        $dash = $menu->get_menu_item("Dashboard");
        $this->assertTrue($dash->active);
    }
    public function testMenuClassCanSetRoleTo1InConstructor(): void {
        $menu = new Menu("Home",1);
        $this->assertEquals(1,$menu->user_role);
    }
    public function testMenuClassCanAddItem(): void {
        $menu = new Menu();
        $newItem = new Menu_Item("Test","test.php",2,"Test Help");
        $notThereBefore= $menu->get_menu_item("Test")==null;
        $menu->add_menu_item($newItem);
        $addedItem = $menu->get_menu_item($newItem->text)!=null;
        $this->assertTrue($notThereBefore,"was there before");
        $this->assertTrue($addedItem,"was not added");
    }
    public function testReturnsHtmlOfStudentMenus(): void {
        $studentMenuText=["Home","Dashboard","Mark","Past","Logout"];
        $studentHtml="";
        $menu = new Menu("Home",3);
        foreach ($studentMenuText as $menuText) {
            $mi = $menu->get_menu_item($menuText);
            $this->assertTrue($mi!=null,"Doesn't have a $menuText menuitem");
            $studentHtml.=$mi!=null ? $mi->get_html() : "";
        }
        $this->assertEquals($studentHtml,$menu->get_html());
    }
    public function testReturnsHtmlOfFacultyMenus(): void {
        $facultyMenuText=["Home","Dashboard","Mark","Past","Manage","Logout"];
        $facultyHtml="";
        $menu = new Menu("Home",1);
        foreach ($facultyMenuText as $menuText) {
            $mi = $menu->get_menu_item($menuText);
            $this->assertTrue($mi!=null,"Doesn't have a $menuText menuitem");
            $facultyHtml.=$mi!=null ? $mi->get_html() : "";
        }
        $this->assertEquals($facultyHtml,$menu->get_html());
    
    }
    public function testCanRemoveMenuItems(): void {
        $menu = new Menu("Home");
        $addRemoveItem = new Menu_Item("Test","test_link");
        // make sure it's not in the menu yet
        $this->assertTrue($menu->get_menu_item($addRemoveItem->text)==null,"Test Menu is already a menu item");
        $menu->add_menu_item($addRemoveItem);
        $this->assertTrue($menu->get_menu_item($addRemoveItem->text)!=null,"Couldn't add Test Menu");
        $menu->delete_menu_item($addRemoveItem->text);
        $this->assertTrue($menu->get_menu_item($addRemoveItem->text)==null,"Test Menu was not deleted");
    }
    public function testUserRoleCanChange(): void {
        $menu = new Menu("Home",3);
        $studentHtml = $menu->get_html();
        $menu->user_role = 1;
        $facultyHtml = $menu->get_html();
        $this->assertTrue(strlen($facultyHtml)>strlen($studentHtml),"faculty do not have access to more menus than students when role property is changed");
    }

}