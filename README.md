## Description
Cette application web est développée avec le framework Laravel et offre une interface permettant aux administrateurs de visualiser l'historique des opérations CRUD (Create, Read, Update, Delete). L'application enregistre les actions effectuées par les utilisateurs, y compris qui a fait quoi, et fournit un moyen transparent de suivre les modifications apportées aux données.

## Fonctionnalités

## Suivi des opérations CRUD : 
L'application enregistre les opérations de création, lecture, mise à jour et suppression effectuées sur les données.
Historique utilisateur : Les administrateurs peuvent consulter l'historique des actions effectuées par chaque utilisateur.
Filtres avancés : Possibilité de filtrer l'historique par utilisateur, type d'action, date, etc.
Interface conviviale : Une interface utilisateur intuitive permettant une navigation facile dans l'historique des opérations.

## Installation

Clonez le dépôt depuis GitHub :

```bash
git clone  https://github.com/Christhino/Audit_logs.git
```

### Installez les dépendances PHP avec Composer :

Installer:

```bash
composer install
``` 

Copiez:

Copiez le fichier .env.example en tant que .env et configurez vos paramètres de base de données : 

```bash
cp .env.example .env
```
Générez une clé d'application Laravel : 



```bash
php artisan key:generate
```
Exécutez les migrations et les seeders pour créer les tables et les données initiales :4
```bash
php artisan migrate --seed
```
## Testing

```bash
composer test

