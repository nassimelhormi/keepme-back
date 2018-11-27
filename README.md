# KEEPME API (back)

Prérequis :

`Pensez un importer la base de données du projet pour ceux qui ne l'ont pas fait.`

Installation :
```
composer install
```

Réinstallation (après modification des dépendances dans `composer.json`) :
```
rm -rf vendor/ composer.lock
composer install
```

Pour lancer le serveur php en local :
```
composer start >&/dev/null &
```
<!-- php -S localhost:7777 -t public public/index.php -->


On accède via :
```
http://localhost:7777/
```

