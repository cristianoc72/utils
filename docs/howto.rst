How To
======

.. _StringUtils: classes/Susina-Utils-StringUtils.html
.. _Doctrine Inflector: https://www.doctrine-project.org/projects/inflector.html
.. _SimpleInflector: classes/Susina-Utils-Inflector-SimpleInflector.html
.. _InflectorInterface: classes/Susina-Utils-Inflector-InflectorInterface.html
.. _pluralize: classes/Susina-Utils-StringUtils.html#method_pluralize
.. _singularize: classes/Susina-Utils-StringUtils.html#method_singularize  
.. _PHP Anonimous classes: https://www.php.net/manual/en/language.oop5.anonymous.php

In this section you will find some examples of how to use the library.


How to use Doctrine Inflector with StringUtils
-----------------------------------------------

The `StringUtils`_ class uses `SimpleInflector`_ by default to pluralize/singularize strings. 
It's a very handy and thiny library but sometimes you could need something more featured and advanced, 
for example supporting multiple languages. In this case you can use the `Doctrine Inflector`_ class.

`pluralize`_ and `singularize`_ methods of `StringUtils`_ accept an optional second argument, 
which is an instance of a class implementing the `InflectorInterface`_ interface.

`Doctrine Inflector`_ class already exposes ``pluralize`` and ``singularize`` methods, but it does not implement the `InflectorInterface`_ 
interface, so we need to create an empty class implementing the interface and extending the `Doctrine Inflector`_:

.. code:: php
    use Doctrine\Inflector\Inflector;
    use Susina\Utils\Inflector\InflectorInterface;

    class DoctrineInflector extends Inflector implements InflectorInterface
    {
        // empty class, just to implement the interface
    }

Now, we can use the `DoctrineInflector` class with `StringUtils`_ :

.. code:: php
    use Doctrine\Inflector\CachedWordInflector;
    use Doctrine\Inflector\Rules\Italian;
    use Doctrine\Inflector\RulesetInflector;
    use Susina\Utils\StringUtils;

    $inflector = new DoctrineInflector(
        new CachedWordInflector(new RulesetInflector(
            Italian\Rules::getSingularRuleset()
        )),
        new CachedWordInflector(new RulesetInflector(
            Italian\Rules::getPluralRuleset()
        ))
    );

    $word = 'susina';
    $plural = StringUtils::pluralize($word, $inflector);

    echo "Pluralize '$word' results in '$plural'.\n";
    // Output: Pluralize 'susina' results in 'susine'.

Thanks to `PHP Anonimous classes`_ we can also write the previous example 
in a more compact way, without creating a new class:

.. code:: php
    use Doctrine\Inflector\CachedWordInflector;
    use Doctrine\Inflector\Rules\Italian;
    use Doctrine\Inflector\RulesetInflector;
    use Susina\Utils\StringUtils;
    use Susina\Utils\Inflector\InflectorInterface;

    $inflector = new class(
        new CachedWordInflector(new RulesetInflector(Italian\Rules::getSingularRuleset())),
        new CachedWordInflector(new RulesetInflector(Italian\Rules::getPluralRuleset()))
    ) extends Inflector implements InflectorInterface {};

    $word = 'susina';
    $plural = StringUtils::pluralize($word, $inflector);

    echo "Pluralize '$word' results in '$plural'.\n";
    // Output: Pluralize 'susina' results in 'susine'.