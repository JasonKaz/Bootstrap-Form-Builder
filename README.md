Whats the purpose of this project?
------------------

This project was created to allow PHP to create forms which applied to Twitter Bootstrap's standards without having to manually create a lot of markup.

Examples
------------------

[Project Example Page](http://pendarenstudios.com/projects/bootstrap-form-builder/examples.php)

To Do
------------------

* Do something with the Help class, it seems silly to have it in it's own class

Updates
------------------

* 1.0.1 - 1/24/2013
 * Added newlines to end of class files
 * Added missing attributes (readonly, autofocus) to FormUtils
 * Made attributes follow HTML5 standards
 * Added wrapper class for general inputs to reduce code size in the future

* 1.0.0 - 1/13/2013
 * Updated to Twitter Bootstrap 2.2.2 - Still works with 2.1.1
 * Modified examples slightly
 * Created Form->hidden() function to handle hidden inputs within the form - Hidden object now deprecated

* 1/12/2013
 * Fixed bug with inputs not having spacing between them if they were inline
 * All form inputs now are children of the FormInput class to handle code rendering
 * Added Hidden input
 * Added Textarea input
 * Added markdown to README
 * Updated example page to show PHP code for each form