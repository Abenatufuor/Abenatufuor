# php-class-0510

Demonstration of PHP Classes in October 5, 2020 Class

This is the repository that goes with Web Tech 2020 Classes 10 and 11 and serves as the basis of a short PHP assignment.

The [next section](#tutorial-from-lecture) has how to use this file to review what is in lecture.

The last section has [the assignment](#assignment-information) and it's instructions.

## Tutorial from Lecture

Using this file to review the tutorial in lecture.  **NOTE** this part is only for review of the lecture; not for completing the assignment.  skip to the last section on [the assignment](#assignment-information) to continue.

Only follow this section if you want to replicate the steps done in class.

```bash
git clone https://github.com/AshWeb2020/php-class-0510.git c:\xampp\htdocs\objects
```

the step directions assume you are running git with the current directory at the root of the repository on your local machines; e.g. `c:\xampp\htdocs\objects` for the case demonstrated above.

This will place it in the objects directory; and when xampp is running you can access the repository with <http://localhost/objects> which will open `index.php`. index.php and student.php are the two active files.

After step-0, only index.php is used. Steps after one use a url 'GET' parameter to determine which menus to show. For example, to show menus as a faculty member, navigate to <http://localhost/objects/index.php?role=1>

## Switching steps to earlier spots in class

The class slides have a series of steps. You can go to any of the steps in the coding using:

```bash
git checkout tags/<step#>
```

Once at that step, you are free to change code or try to move to the next step yourself. You can save your changes to merge in later with `git stash`; or you can git rid of them to switch to a later or earlier step with `git restore` and the files you modified; or `git restore .` in the root directory of the repository.

Here are the steps and what's happening at each one

### tag name: step-0 Separate Menus for Student and Faculty

command: `git checkout tags/step-0 -b master`

This is where we started in the class. files `index.php` with some static html menus for faculty and `student.php` with static files for the menus a student sees. Nothing special; and no php as part of the this step.

### tag name: step-1

command: `git checkout tags/step-1 -b master`

This step implements an initial `get_menus` function. It demonstrates the use of ["HERE DOCS"](https://www.php.net/manual/en/language.types.string.php) and a simple if statement.

### tag name: step-2

command: `git checkout tags/step-2 -b master`

Implements a base `MenuItem` class to display menus from get_menu. Creates an array and traverses it. Demonstrates the use of a `__constructor` function to pass parameters.

#### Tutorial Correction

One mistake; is the optional parameters should be initialized to null in order to work in this example; e.g. the constructor should change to:

```php
function __construct($text, $link, $role=3, $tool_tip=null) {
        $this->text = $text;
        $this->link = $link;
        $this->min_role = $role;
        $this->tool_tip = $tool_tip==null ? $tool_tip : $text . "Menu Item";
    }
```

### tag name: step-3

command: `git checkout tags/step-3 -b master`

Shows the addition of two methods, one to check roles; the other to output the html.

### tag name: step-4

command: `git checkout tags/step-4 -b master`

Adds support for activating a menu by applying css in the `get_html()` if the `active` property is set.

### tag name: step-5.1

command: `git checkout tags/step-4 -b master`

Adds a sub class to `Menu_Item` called `Pull_Down_Menu_Item` which demonstrates inheritance and polymorphism. 5.1 cleans up a CSS problem with the initial implementation.

This readme is in the "head" of the repository in the master branch. It's slightly beyond step 5.1. With fixes and other changes. **_Use master at the "head" as the basis for homework._**

## Assignment Information

Creating a `Menu` Class

For the assignment, you are going to create a new class that replaces the current `get_menu()` function. It is very important that your method, file, and property names match to get full credit for the assignment.

Clone the repository created for you by github classroom.  A good way to clone the repository under the `htdocs` directory of Apache. In the default XAMPP case on Windows, clone it to an 'objects' directory with the following command:

```bash
git clone ***link to my respository*** c:\xampp\htdocs\objects
```



### Create a class called `Menu`

Create a new class named Menu. Place this new class in a file called `menu.php`.

### `Menu` Class functions

Your menu class needs to implement the following functions:

- It should support all of our current menu items and permissions as the existing function. Those menu items will be “built in” to the object as a **private** member property only accessible to the class.
- Have a constructor that takes two parameters: one that matches the menu item \$text property that makes that menuitem “active”. For example, if “Dashboard” is passed, the Dashboard menuitem is marked active. The second parameter sets the user role level (1,2,3) in the constructor. The constructor can also be called without these parameters, such that the active menu is "Home" and the `user_role` level is 3 (See [above](#tutorial-correction) for how to do optional parameters).
- the property `user_role`, which can be set in the constructor, can also be dynamically changed. (for example from 3 to 1).
- a method on the Menu class, `get_html()` returns the html of the full menu always reflect what’s set in the user_role property.
- Create a method, named `add_menu_item` that takes a `Menu_Item` property to add to the private menuItem collection
- Create a method to `get_menu_item` that takes a single parameter with the text of the menu items, and returns a `Menu_Item` class that matches it; or `null` if no menu_item matches it.
- Create a method to remove a menu by passing a single parameter of the text name, called `delete_menu_item()`

The class can be tested to insure it works properly by running the unit test with `phpunit`. The test code that calls the test is in [`menuTest.php`](menuTest.php). You should be able to run the test with phpunit to verify your work. The code in `menuTest.php` can also help to answer questions as to how the class can be used.

Change INDEX.PHP to use the MenuClass to output the menu based on role and remove the get_menus.php function.

### Extra Credit

Bonus: Create a parent class called “Snippet” that Menu, and Menu_Item inherit from, that takes a string of html as input to the constructor; and has one method `get_html()` that returns the html passed. save that class in `snippet.php`
