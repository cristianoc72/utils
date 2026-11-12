StringUtils Class
=================

.. _StringUtils: classes/Susina-Utils-StringUtils.html
.. _Doctrine Inflector: https://www.doctrine-project.org/projects/inflector.html
.. _toKebabCase: classes/Susina-Utils-StringUtils.html#method_toKebabCase
.. _toSnakeCase: classes/Susina-Utils-StringUtils.html#method_toSnakeCase
.. _toStudlyCase: classes/Susina-Utils-StringUtils.html#method_toStudlyCase
.. _toCamelCase: classes/Susina-Utils-StringUtils.html#method_toCamelCase
.. _toPascalCase: classes/Susina-Utils-StringUtils.html#method_toPascalCase
.. _ensureStart: classes/Susina-Utils-StringUtils.html#method_ensureStart
.. _ensureEnd: classes/Susina-Utils-StringUtils.html#method_ensureEnd
.. _collapseSpaces: classes/Susina-Utils-StringUtils.html#method_collapseSpaces
.. _pluralize: classes/Susina-Utils-StringUtils.html#method_pluralize
.. _singularize: classes/Susina-Utils-StringUtils.html#method_singularize  

``Susina\Utils\StringUtils`` class provides utility static methods to manipulate strings, 
not included into the standard PHP functions list.

- `toKebabCase method`_: Converts a string to kebab-case.
- `toSnakeCase  method`_: Converts a string to snake_case.
- `toStudlyCase method`_: Converts a string to StudlyCase.
- `toCamelCase method`_: Converts a string to camelCase.
- `toPascalCase method`_: alias of `toStudlyCase`_ method.
- `ensureStart method`_: Ensures that a string starts with a specific character.
- `ensureEnd method`_: Ensures that a string ends with a specific character.
- `collapseSpaces method`_: Collapses multiple spaces into a single space.
- `pluralize method`_: Converts a singular word to its plural form.
- `singularize method`_: Converts a plural word to its singular form.

Why static methods? Starting from PHP 8.5, the language has introduced the new `pipe operator <https://www.php.net/manual/en/language.operators.functional.php>`_, 
allowing chaining functions and methods in a more functional programming style.
The static methods of this library are designed to be used with this new operator, 
enabling a more concise and expressive way to manipulate strings.

If you prefer the object-oriented fluent api approach, you can use the ``Text`` class, included into `phootwork/lang <https://github.com/phootwork/lang>`_ package, 
or the ``UnicodeString`` class, from `symfony/string <https://github.com/symfony/string>`_ library, instead.


toKebabCase method
^^^^^^^^^^^^^^^^^^

`toKebabCase`_ method converts a string to kebab-case, which is a lowercase 
string with words separated by hyphens.

.. code:: php
    use Susina\Utils\StringUtils;

    $kebabCase = StringUtils::toKebabCase('Hello World'); // hello-world
    $kebabCase = StringUtils::toKebabCase('HelloWorld'); // hello-world
    $kebabCase = StringUtils::toKebabCase('hello_world'); // hello-world
    $kebabCase = StringUtils::toKebabCase('hello world'); // hello-world
    $kebabCase = StringUtils::toKebabCase('helloWorld'); // hello-world


toSnakeCase  method
^^^^^^^^^^^^^^^^^^

`toSnakeCase`_ method converts a string to snake_case, 
which is a lowercase string with words separated by underscores.

.. code:: php
    use Susina\Utils\StringUtils;

    $snakeCase = StringUtils::toSnakeCase('Hello World'); // hello_world
    $snakeCase = StringUtils::toSnakeCase('HelloWorld'); // hello_world
    $snakeCase = StringUtils::toSnakeCase('hello-world'); // hello_world
    $snakeCase = StringUtils::toSnakeCase('hello world'); // hello_world
    $snakeCase = StringUtils::toSnakeCase('helloWorld'); // hello_world


toStudlyCase  method
^^^^^^^^^^^^^^^^^^^

`toStudlyCase`_ method converts a string to StudlyCase,
which is a string with the first letter of each word capitalized and no spaces or separators.

.. code:: php
    use Susina\Utils\StringUtils;

    $studlyCase = StringUtils::toStudlyCase('hello world'); // HelloWorld
    $studlyCase = StringUtils::toStudlyCase('hello-world'); // HelloWorld
    $studlyCase = StringUtils::toStudlyCase('hello_world'); // HelloWorld
    $studlyCase = StringUtils::toStudlyCase('helloWorld'); // HelloWorld


toPascalCase method
^^^^^^^^^^^^^^^^^^^^

Alias of `toStudlyCase method`_.


toCamelCase method
^^^^^^^^^^^^^^^^^^

`toCamelCase`_ method converts a string to camelCase,
which is a string with the first letter of the first word in lowercase and the first letter of each subsequent word capitalized, 
with no spaces or separators.

.. code:: php
    use Susina\Utils\StringUtils;

    $camelCase = StringUtils::toCamelCase('hello world'); // helloWorld
    $camelCase = StringUtils::toCamelCase('hello-world'); // helloWorld
    $camelCase = StringUtils::toCamelCase('hello_world'); // helloWorld
    $camelCase = StringUtils::toCamelCase('HelloWorld'); // helloWorld


ensureStart method
^^^^^^^^^^^^^^^^^^

`ensureStart`_ method ensures that a string starts with a specific character or string.

.. code:: php
    use Susina\Utils\StringUtils;
    
    // Adds the leading slash
    $var = StringUtils::ensureStart('my/personal/path', '/'); // /my/personal/path
    
    // Does not add the leading slash, as it is already present
    $var = StringUtils::ensureStart('/my/personal/path', '/'); // /my/personal/path


ensureEnd method
^^^^^^^^^^^^^^^

`ensureEnd`_ method ensures that a string ends with a specific character or string.

.. code:: php
    use Susina\Utils\StringUtils;
    
    // Adds the trailing slash
    $var = StringUtils::ensureEnd('my/personal/path', '/'); // my/personal/path/
    
    // Does not add the trailing slash, as it is already present
    $var = StringUtils::ensureEnd('my/personal/path/', '/'); // my/personal/path/


collapseSpaces method
^^^^^^^^^^^^^^^^^^^^

`collapseSpaces`_ method collapses multiple spaces into a single space.

.. code:: php
    use Susina\Utils\StringUtils;

    $var = StringUtils::collapseSpaces('  hello       world     '); // hello world


pluralize method
^^^^^^^^^^^^^^^^^

`pluralize`_ method converts a singular word to its plural form.

.. code:: php
    use Susina\Utils\StringUtils;

    $var = StringUtils::pluralize('cat'); // cats
    $var = StringUtils::pluralize('dog'); // dogs
    $var = StringUtils::pluralize('child'); // children
    $var = StringUtils::pluralize('person'); // people


singularize method
^^^^^^^^^^^^^^^^^^^

`singularize`_ method converts a plural word to its singular form.

.. code:: php
    use Susina\Utils\StringUtils;

    $var = StringUtils::singularize('cats'); // cat
    $var = StringUtils::singularize('dogs'); // dog
    $var = StringUtils::singularize('children'); // child
    $var = StringUtils::singularize('people'); // person


.. tip::
    Both `pluralize`_ and `singularize`_ methods use `Susina\\Utils\\Inflector\\SimpleInflector` by default.
    *SimpleInflector* is a standard English pluralizer/singularizer, if you need to use an inflector supporting other languages
    you can pass an instance of a class implementing `Susina\\Utils\\Inflector\\InflectorInterface` methods as second argument.
    You can find some examples of how to use the `Doctrine Inflector`_ class with `StringUtils`_ in the `How To`_ section of this documentation.
