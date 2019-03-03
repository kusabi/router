This library implements a HTTP router.

It is designed to be extensible.

# Basic usage

Basic usage is very simple.

```php
// Instantiate the router
$router = new \Kusabi\Router\Router();

// Read a user
$router->get('users/{id}', function(int $id) {
    return "Showing user {$id}";
});

// Create a user
$router->post('users', function() {
    return "Creating new user";
});

// Update a user
$router->put('users/{id}', function(int $id) {
    return "Updating user {$id}";
})

// Get the results
echo $router->run('get', 'users/123');
```

The example above returns `Showing user 123`

### Forcing the data types

You can ensure a certain data type was passed in with either raw regex or one of the preset variable types provided.

```php

// Instantiate the router
$router = new \Kusabi\Router\Router();

// Force ID to be integer
$router->get('users/{:int}', function(int $id) {
    return "Showing user {$id}";
});

// Force ID to be float
$router->get('users/{:float}', function(int $id) {
    return "Showing user {$id}";
});

// Force ID to be any number format
$router->get('users/{:number}', function(int $id) {
    return "Showing user {$id}";
});

// Force ID to be any aplha set
$router->get('users/{:alpha}', function(int $id) {
    return "Showing user {$id}";
});

// Force ID to be any aplha-numeric set
$router->get('users/{:alpha-numeric}', function(int $id) {
    return "Showing user {$id}";
});

// Wildcard the rest of the route (note that this would match 'users/21/edit/fluff'
$router->get('users/{:any}', function(int $id) {
    return "Showing user {$id}";
});

// Custom regex (matches ID like '12345-6789-123')
$router->get('users/(\d+-\d+-\d+)', function(int $id) {
    return "Showing user {$id}";
});

```

# Advanced usage

The key to this library is the ability to create your own plugins. 

Don't like the way it parses routes? Change it.

Don't like how it handles responses? Change it.

Not happy with the verbs available? Add more (`// @todo allow adding of more verbs`)

### Adding a controller dispatcher

Create a controller dispatcher.

Please note that this dispatcher may be added in the future, or possibly in an extended library.

```php
<?php

use Kusabi\Router\DispatcherInterface;

class ControllerDispatcher implements DispatcherInterface
{
    protected $action;

    public function __construct(string $action)
    {
        $this->action = $action;
    }

    public function dispatch(...$params)
    {
        list($controller, $method) = explode('@', $this->action);
        $c = new $controller();
        return $c->$method(...$params);
    }
}
```

Next extend the factory to include your dispatcher as a possibility

```php
<?php

class CustomActionFactory extends \Kusabi\Router\Factories\ActionFactory
{
    public function createDispatcher($action): \Kusabi\Router\DispatcherInterface
    {
        // Does it match the pattern 'controller@action'?
        if (is_string($action) && preg_match("/^(\w+?)@(\w+)$/", $action)) {
            return new ControllerDispatcher($action);
        }
        
        // Fallback to default behaviour
        return parent::createDispatcher($action);
    }
}
```

Finally, when instantiating the router, give it your version of the factory.

```php

// Instantiate the router with my custom factory
$router = new \Kusabi\Router\Router(
    null,
    new CustomActionFactory()
);

// Read a user
$router->get('users/{id}', 'UserController@show');

// Create a user
$router->post('users', 'UserController@create');

// Update a user
$router->put('users/{id}', 'UserController@update');

// Get the results
echo $router->run('get', 'users/123');
```
