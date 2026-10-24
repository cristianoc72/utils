Getting Started
===============

.. _StringUtils: classes/Susina-Utils-StringUtils.html
.. _File: classes/Susina-Utils-File.html
.. _toKebabCase: classes/Susina-Utils-StringUtils.html#method_toKebabCase
.. _toSnakeCase: classes/Susina-Utils-StringUtils.html#method_toSnakeCase
.. _toStudlyCase: classes/Susina-Utils-StringUtils.html#method_toStudlyCase
.. _toCamelCase: classes/Susina-Utils-StringUtils.html#method_toCamelCase
.. _toPascalCase: classes/Susina-Utils-StringUtils.html#method_toPascalCase
.. _ensureStart: classes/Susina-Utils-StringUtils.html#method_ensureStart
.. _ensureEnd: classes/Susina-Utils-StringUtils.html#method_ensureEnd
.. _collapseSpaces: classes/Susina-Utils-StringUtils.html#method_collapseSpaces     
.. _makeRelative: classes/Susina-Utils-File.html#method_makeRelative
.. _constructor: classes/Susina-Utils-File.html#method__construct
.. _isAbsolute: classes/Susina-Utils-File.html#method_isAbsolute
.. _getContents: classes/Susina-Utils-File.html#method_getContents
.. _putContents: classes/Susina-Utils-File.html#method_putContents
.. _appendContents: classes/Susina-Utils-File.html#method_appendContents

Install the library via `composer <http://getcomposer.org>`_:

.. code:: bash
    composer require susina/utils


and you're ready to go!

The library provides two classes: `StringUtils`_ and `File`_. 
The first one is a utility class for string manipulation, while the second one is a utility class for file handling.

Let's explore them in detail.


StringUtils class
-----------------

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


File class
----------

`File`_ class is an extension of the standard PHP `SplFileInfo <https://www.php.net/manual/en/class.splfileinfo.php>`_ ,
providing additional utility methods for file handling and supporting relative paths.

Let's get a look in detail.


Relative paths
^^^^^^^^^^^^^^

Relative paths can be set into the `constructor`_ or using the `makeRelative`_ method.

The class constructor accepts two parameters: the *file path* and the *relative path*. If the relative path is not set, the file path is considered relative 
to the root directory, which is the same behavior of the base `SplFileInfo::_construct() <https://www.php.net/manual/en/splfileinfo.construct.php>`_.

.. code:: php
    use Susina\Utils\File;

    // only one argument: same behavior as standard PHP SplFileInfo
    $file = new File('var/www/html/index.php');

    // index.php is relative to /home/james
    $relativeFile = new File('index.php', '/home/james');


Now you can access the relative path and relative pathname of the file, via the specific methods **getRelativePath** and **getRelativePathname**, 
while the **getPath** and **getPathname** will return the absolute path. In example:

.. code:: php
    use Susina\Utils\File;

    $file = new File('index.php', '/home/james');

    $file->getRelativePath(); // /home/james/ (please, note the trailing slash)

    $file->getRelativePathname(); // index.php

    $file->getPath(); // /home/james

    $file->getPathname() // /home/james/index.php

You can make a file relative to a directory by using **makeRelativeTo** method:

.. code:: php
    use Susina\Utils\File;

    $file = new File('/home/james/index.php');
    $file->getRelativePath(); // ''
    $file->getRelativePathname(); // /home/james/index.php
    $file->getPath(); // /home/james
    $file->getPathname() // /home/james/index.php

    // makeRelativeTo returns a File object
    $relativeFile = $file->makeRelativeTo('/home/james');

    $relativeFile->getRelativePath(); // /home/james/
    $relativeFile->getRelativePathname(); // index.php
    $relativeFile->getPath(); // /home/james
    $relativeFile->getPathname() // /home/james/index.php


The File class also provides the `isAbsolute`_ method which try to determine if a path is absolute by using the following these rules:

- If the path contains a colon, it is considered absolute (Windows absolute paths have the form ``C:\my_path``).
- If the realpath of the path is the same as the path, it is considered absolute.
- If the path starts with a slash, it is considered absolute (Unix absolute paths).
- If the path starts with a backslash, it is considered absolute (Windows UNC).

.. code:: php
    use Susina\Utils\File;

    $file = new File('/my/path')->isAbsolute(); // true
    $file = new File('C:\my\path')->isAbsolute(); // true
    $file = new File('\my\path')->isAbsolute(); // true
    $file = new File('my/path')->isAbsolute(); // false


Content manipulation methods
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^
    
The File class also ships three methods to manipulate the file content:

- `getContents`_ to read the file content into a string.
- `putContents`_ to write a string into the file, **overwriting** it. If the file does not exist, this method creates it.
- `appendContents`_ to append a string at the end of the file. If the file does not exist, this method creates it.

When an error occurs, these methods throw a `RuntimeException <https://www.php.net/manual/en/class.runtimeexception.php>`_ 
instead of returning ``false`` as the standard PHP functions do.

.. note::
    The `getContents`_ method reads the **full** content of the file. If you want to read only a certain number
    of bytes, you can use the native `\SplObject::fread() <https://www.php.net/manual/en/splfileobject.fread.php>`_ instead.


Example 1) read the full content of the file:

.. code:: php
    use Susina\Utils\File;

    $file = new File('myfile.txt');
    $content = $file->getContents();

    // if any errors, a RuntimeException is thrown


Example 2) read only the first 100 bytes of the file, by using the standard fread method:
     
.. code:: php
    use Susina\Utils\File;
    
    $file = new File('myfile.txt');
    $content = $file->openFile('r')->fread(100);
    
    // if any errors, no exception is thrown and $contents contains the boolean `false`

