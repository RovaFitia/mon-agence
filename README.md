# Mon Agence immobilier

[Description brève de votre projet]

## Installation

Avant de commencer, assurez-vous d'avoir [Composer](https://getcomposer.org/) installé sur votre machine.

1. Clonez le projet depuis GitHub :

   ```bash
   git clone https://github.com/RovaFitia/mon-agence.git

2. Installez les dépendances avec Composer

   ```bash
   composer install

3. Copiez le fichier .env et configurez les variables d'environnement :

   ```bash
   cp .env.dist .env

4. Générez les clés SSH pour JWT (si votre projet utilise JWT) :

   ```bash
   php bin/console lexik:jwt:generate-keypair

## Base de données

1. Créez la base de données :

   ```bash
   php bin/console doctrine:database:create

2. Appliquez les migrations :

    ```bash
    php bin/console doctrine:migrations:migrate

## Lancement du Projet 

Lancez le serveur de développement Symfony :

    ```bash
    symfony serve

Le projet sera accessible à l'adresse http://localhost:8000.

## Tests 

Exécutez les tests avec PHPUnit :

  ```bash
    php bin/phpunit
  
