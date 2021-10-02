# Simple App
### Setup for first
1. Clone this repository.
2. Run composer from project root folder.
3. Create a `.env` file in project root dir. Example content:
```
DB_DSN = mysql:host=localhost;port=3306;dbname=simple_app
DB_USER = root
DB_PASSWORD = root
```
4. I hope you have the RabbIT Simple App describtion, and you have set up the 
database based on that. Migration files are not attached.
5. Run this in console: `php -S localhost:8080`
6. Be happy about your site

### Folder structure
```
-simplae_app
  -controllers //Controllers to your need
  -core //contains all core functionality
  -models //all models representing a database table
  -public //all publicly available files and assets
  -vendor //all vendor files
  -views //the view files
```

### Active record
The applications uses a so called Active Record pattern.

All models represent a database table. A model must have all the columns from table as a property with the same name.

Basically all the models returned from 
either `model::getAll()` or `model::getId()` will return a populated result set. 

Any model that represent a database table must extend the `app\core\ActiveRecord` class, and must
implement the `getTable` function.

You can override the default primary column name by overriding the `getPrimaryKey()` function

### __get Override
I have overridden the magic method called __get(). With this functionality you can override getters.

**Why it is useful**?

With this (source: `app\core\BaseModel`) when you use non-existing property on any model,
it will first try to call the getter of that non-property with the same name.
You can then override that getter in the model class. 

Example: 
```
//The Advrtisement class has a getUser() function implemented, that queries for the
//related user in db and the returns the user object.

$ad = Advertisement::getById(1)

echo $ad->user->name; //this will print the related user's name. 
```

### Notes
I used no framework or CMS, but I used composer for autoload and dotenv.

The base of the structure (controllers, rendering, routing) is based on tutorials I used for self-educating. You may find similiraities to
existing frameworks because of this.

I did not implement any logging with a reason. File logging is nowadays are not popular due to containerasition, 
and put it into DB seems like an overkill. Of course, in any real application a decent logging is mandatory.

I used the PHP default built-in web-server. THat's why i did not attached any webserrver config file.
In theory, I would never allow anyone to access any folder except `/public`.


