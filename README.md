schwang
=====

Simplistic PHP Web Framework

Version: <code>0.1</code>

# Notes

- This is just a test framework I have been on and off with for a few months, spending a little bit of time expanding it whilst I learn more about PHP. Don't expect this to be the best framework you've come across, it's just something little and working that I built from scratch.
- This uses bootstrap for styles by default.

# Usage

## Database

A database is required to use this framework. In the <code>app/options.php</code> file you can specify your database details.

## Views

Any php file you put in the directory <code>app/views</code> will come up as a page when you visit the appropriate URL. For example, <code>/login</code> will show the page <code>app/views/login.php</code>.

You can go to the next part of a URL segment with the <code>Pages::get()</code> declaration. It will pop off the next element on the URL everytime you call it.

There's a basic navigation in <code>app/parts/nav.php</code> where you can put the names of views which show in the navbar. Specify the names in arrays in the following variables: <code>$disabledPages</code>, <code>$loggedInPages</code>, and <code>$loggedOutPages</code>. Disabled pages do not show at all, logged in pages only show when the user is logged in, and same with logged out pages. Any page not specified will show in the navigation.

## Forms

Anytime you want to make a <code>POST</code> request to the database via the site you can use the declaration <code>form_init()</code>. Make a file in the <code>app/submit</code> directory and specify that filename (excluding .php) in the <code>form_init()</code> declaration.