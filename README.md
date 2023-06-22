# Trouve mon école d'ingénieur

Une plateforme gratuite d'utilisation pour aider les étudiants et les lycéens
dans leur choix de formation d'ingénieur. La plateforme permet une recherche
guidée ou une recherche avancée.

La plateforme doit proposer des formations répondant aux besoins de
l'étudiant de manière impartiale.

Par ailleurs, la plateforme devrait permettre d'améliorer l'intégration des
femmes dans les formations d'ingénieurs.


## Prérequis

Pour lancer le projet en local, il est nécessaire d'avoir
[Docker](https://www.docker.com/) d'installé ainsi que
[Docker compose](https://docs.docker.com/compose/install/).

Les prérequis concernant PHP etc sont directement gérés par
la stack Docker. Il faut aussi pouvoir lancer les commandes du
Makefile idéalement, donc avoir un système Unix. WSL convient parfaitement
sous Windows.
## Installation

Pour installer le projet en local, il sufit de lancer la commande

```bash
cp .env.example .env
docker compose up -d
docker compose exec laravel.test composer install
docker compose down
sail up -d
sail npm install
npm run prepare:husky
sail artisan key:generate
sail artisan migrate
```
## Lancer les tests

Pour lancer l'ensemble des tests, lancer la commande

```bash
  make test
```
