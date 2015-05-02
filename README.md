# schwang

A simplistic PHP framework.

## Requirements

- PHP 5.4 or higher
- Server running apache
- Mysql server

## Connecting to a Database

First thing you want to do is tell schwang what database it's going to connect to. You can do this by editing the database details in `index.php` to suit your environment.

## Controllers - Defining Site Structure

Controllers are how you tell schwang what to show depending on the URL you visit. Create a controller in `app/controllers` and give a suitable name. Make sure it's lowercase. Let's say we want to make one for users, so we create `users.php`.

Inside the file we want to set it up as a controller. Declare the controller class inside the file using whatever you called the file but uppercase, followed by `Controller`. Have it extend the class `Controller` too.

Now we need to define a route for the controller. This is achieved by defining a function inside the controller. An index route can also be defined, which can be useful if you don't want any routes.

Our user controller looks like this:

```
<?php

class UsersController extends Controller
{
    public function index()
    {

    }

    public function view()
    {

    }
}

?>
```

By the way, `IndexController` is a special one that requires no initial parameter. The homepage uses that!

## Views - Rending Site Content

I take it you'd want to show some HTML, right? This is done with views. Create a view in `app/views` and store it in a folder that's the same as the controller filename (without the .php part, duh). Next, make a .phtml file inside that folder that's the same as the function name inside the controller.

You don't need to give it your typical header and footer stuff, that's all sorted in `app/views/header.phtml` and `app/views/footer.pthml`. Put what you want in there. schwang comes with Bootstrap 3 and jQuery 1.11 loaded, but you can always take them out if they aren't your cup of tea.

Back in your controller functions, to actually show the HTMl you need to put `$this->render()` inside. Now when you visit the desired page, it'll show the HTML you wrote. Nice!

#### Talking Between Controllers and Views

Typically, you don't put any logic in the view and you don't put any rendering in the controller. You can pass variables from the controller using the array `$this->data`. Any parameter you store in there will be passed as a variable to the view. So if I stored `$this->data['message'] = 'Hello World!';`, it would show the message on the view if I put the variable `$message`. The header and footer can also access these variables.

#### URL Parameters

To get a URL parameter, call the function `$this->url->shift()`. This returns the next URL parameter everytime you call it. We could get the user's ID by using this.

## Models - Talking with the Database

schwang uses models to pass data back and forth from the database using the fabulous Medoo framework. If you want to access a resource from the database, you need to make a model in `app/models`. Make a php file (e.g. `users.php`), define a model class in a similar way to the controller, but appending `Model` to the class name. Define the table name too using `$this->table` in the constructor. You should get something like this:

```
<?php

class UsersModel extends Model
{
    public function __construct()
    {
        $this->table = 'users';
    }
}

?>
```

Now in each of your controllers, you can access the model by using `$this->{modelname}`. In our user example, it would be `$this->users`. Simple, huh? Models have a bunch of useful functions you can use to talk with rows. Check out `app/core/model.php` for the full list. You'll need to use the Medoo WHERE syntax for the where parameter - you can [find that here](http://medoo.in/api/where). A typical request looks like this:

```
$this->data['users'] = $this->users->select( 'name' )->where( [ 'active' => '1' ] )->get();
```

## Helpers and Classes

It's best practice to make some helpers and classes for your PHP adventures. You can chuck any you make in `app/classes` and `app/helpers` and it'll autoload them in. Typically I make a class for each resource and a helper for functions I reuse.

## External Libraries

schwang loads in Medoo from the `lib` directory, but it does not autoload anything else from there. You can use it to store your stuff, but you'll have to load it in yourself in the controllers.

## Other Info

schwang is a little framework I wrote because I wanted to practice my PHP skill. It came out OK, but this isn't a proper framework like Laravel - this is just a little hobby project. It's nowhere near as feature rich as others, but it does the job, simply.

If you want to contribute to the framework, please do! I put spaces between brackets and comment everything I can, so if you can do the same then it's all hunky dory.
