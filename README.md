Whats the purpose of this project?
------------------

This project was created to allow PHP to create forms which applied to Twitter Bootstrap's standards without having to manually create a lot of markup.

To Do
------------------

* Move hidden inputs from their own class to a Form class method to create the hidden inputs at the beginning of the form.
* Do something with the Help class, it seems silly to have it in it's own class
* Upgrade to Bootstrap 2.2.2

Updates
------------------

* 1/12/2013
 * Fixed bug with inputs not having spacing between them if they were inline
 * All form inputs now are children of the FormInput class to handle code rendering
 * Added Hidden input
 * Added Textarea input
 * Added markdown to README
 * Updated example page to show PHP code for each form