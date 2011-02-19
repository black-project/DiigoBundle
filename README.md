# A propos #
Un tout petit bundle de test pour Symfony2 dans le but de découvrir le framework.

Remerciements :

- [dator](http://www.github.com/dator "Le profil GitHub de Clément") : DIC
- [palleas](http://www.github.com/palleas "Le profil Github De Romain") : Son bundle et ses idées :)


# L'API Diigo #
L'API Diigo est encore très jeune et est basée sur REST. Pour pouvoir afficher les bookmarks d'un utilisateur et/ou envoyer un bookmark sur
compte il faut nécessairement passer par une authentification de type HTTP AUTH.

Il est possible de demander une clé API à Diigo mais cela ne sert pas pas vraiment encore. Ceci dit, tout est fait pour pouvoir évoluer
avec l'api.

# TODO #
Comme dis dans le "A propos", il s'agit d'un test alors la todolist est importante. A cours terme, il faut compléter la méthode saveBookmark() et
faire des tests unitaires.

# Dépendances #

- Zend_Http
- Curl

# Installation #

__Ajout du submodule__

    $ git submodule add git://github.com/pocky/DiigoBundle.git src/Blackroom/DiigoBundle

__Ajout du namespace__

`app/autoload.php`

    $loader->registerNamespaces(array(
        'Symfony'                        => __DIR__.'/../vendor_full/symfony/src',
        'Sensio'                         => __DIR__.'/../src',
        'Doctrine\\Common\\DataFixtures' => __DIR__.'/../vendor_full/doctrine-data-fixtures/lib',
        'Doctrine\\Common'               => __DIR__.'/../vendor_full/doctrine-common/lib',
        'Doctrine\\DBAL\\Migrations'     => __DIR__.'/../vendor_full/doctrine-migrations/lib',
        'Doctrine\\MongoDB'              => __DIR__.'/../vendor_full/doctrine-mongodb/lib',
        'Doctrine\\ODM\\MongoDB'         => __DIR__.'/../vendor_full/doctrine-mongodb-odm/lib',
        'Doctrine\\DBAL'                 => __DIR__.'/../vendor_full/doctrine-dbal/lib',
        'Doctrine'                       => __DIR__.'/../vendor_full/doctrine/lib',
        'Zend'                           => __DIR__.'/../vendor_full/zend/library',
        'Blackroom'                      => __DIR__.'/../src',
    ));

__Ajout de la config (exemple en yml)__

    diigo:
      key:              yourApiKey
      username:         yourUsername
      password:         youPassword


__Ajout de la route (exemple en yml)__
  
    diigo:
      resource: @DiigoBundle/Resources/config/routing.yml


# Utilisation #

Référrez vous à `/src/Blackroom/DiigoBundle/Controle/DiigoController.php`

