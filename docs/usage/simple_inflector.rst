SimpleInflector class
=====================

.. _SimpleInflector: classes/Susina-Utils-Inflector-SimpleInflector.html
.. _InflectorInterface: classes/Susina-Utils-Inflector-InflectorInterface.html
.. _pluralize: classes/Susina-Utils-Inflector-SimpleInflector.html#method_pluralize
.. _singularize: classes/Susina-Utils-Inflector-SimpleInflector.html#method_singularize
.. _isPlural: classes/Susina-Utils-Inflector-SimpleInflector.html#method_isPlural
.. _isSingular: classes/Susina-Utils-Inflector-SimpleInflector.html#method_isSingular


`SimpleInflector`_  is a class to pluralize/singularize strings in standard English.

It implements the `InflectorInterface`_ interface, which defines the methods to pluralize/singularize strings;
besides, it provides two additional methods to check if a string is plural or singular.

The exposed methods are: `pluralize`_, `singularize`_, `isPlural`_ and `isSingular`_.

Pluralize method
----------------

The `pluralize`_ method converts a singular word to its plural form.

.. code:: php
    use Susina\Utils\Inflector\SimpleInflector;

    $inflector = new SimpleInflector();
    
    $var = $inflector->pluralize('cat'); // cats
    $var = $inflector->pluralize('dog'); // dogs
    $var = $inflector->pluralize('child'); // children
    $var = $inflector->pluralize('person'); // people
    $var = $inflector->pluralize('apples'); // apples (already plural, returns the same string)



Singularize method
------------------

`singularize`_ method converts a plural word to its singular form.

.. code:: php
    use Susina\Utils\Inflector\SimpleInflector;

    $inflector = new SimpleInflector();

    $var = $inflector->singularize('cats'); // cat
    $var = $inflector->singularize('dogs'); // dog
    $var = $inflector->singularize('children'); // child
    $var = $inflector->singularize('people'); // person
    $var = $inflector->singularize('apricot'); // apricot (already singular, returns the same string)


isPlural method
----------------

`isPlural`_ method checks if a word is plural.

.. code:: php
    use Susina\Utils\Inflector\SimpleInflector;
    
    $inflector = new SimpleInflector();

    $var = $inflector->isPlural('cats'); // true
    $var = $inflector->isPlural('dogs'); // true
    $var = $inflector->isPlural('children'); // true
    $var = $inflector->isPlural('people'); // true
    $var = $inflector->isPlural('cat'); // false
    $var = $inflector->isPlural('dog'); // false
    $var = $inflector->isPlural('child'); // false
    $var = $inflector->isPlural('person'); // false


isSingular method
--------------------

`isSingular`_ method checks if a word is singular.

.. code:: php
    use Susina\Utils\Inflector\SimpleInflector;

    $inflector = new SimpleInflector();

    $var = $inflector->isSingular('cats'); // false
    $var = $inflector->isSingular('dogs'); // false
    $var = $inflector->isSingular('children'); // false
    $var = $inflector->isSingular('people'); // false
    $var = $inflector->isSingular('cat'); // true
    $var = $inflector->isSingular('dog'); // true
    $var = $inflector->isSingular('child'); // true
    $var = $inflector->isSingular('person'); // true