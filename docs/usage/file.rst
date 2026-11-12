File Class
==========

.. _File: classes/Susina-Utils-File.html
.. _makeRelativeTo: classes/Susina-Utils-File.html#method_makeRelativeTo
.. _constructor: classes/Susina-Utils-File.html#method__construct
.. _isAbsolute: classes/Susina-Utils-File.html#method_isAbsolute
.. _getContents: classes/Susina-Utils-File.html#method_getContents
.. _putContents: classes/Susina-Utils-File.html#method_putContents
.. _appendContents: classes/Susina-Utils-File.html#method_appendContents


`File`_ class is an extension of the standard PHP `SplFileInfo <https://www.php.net/manual/en/class.splfileinfo.php>`_ ,
providing additional utility methods for file handling and supporting relative paths.

Let's get a look in detail.


Relative paths
^^^^^^^^^^^^^^

Relative paths can be set into the `constructor`_ or using the `makeRelativeTo`_ method.

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


The File class also provides the `isAbsolute`_ method which try to determine if a path is absolute by using the following rules:

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
    of bytes, you can use the native `\SplFileObject::fread() <https://www.php.net/manual/en/splfileobject.fread.php>`_ instead.


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
