# Projet Brico'brac

## Contexte
-----
Vous avez intégré une entreprise de vente de matériel de bricolage et souhaitez créer un site pour vendre le matériel en ligne.

Le client vous demande de réaliser une première maquette avec les fonctionnalités suivantes :
- Disposer d'une page d'accueil indiquant un message de bienvenue
- Disposer d'un menu général permettant la navigation d'une page à l'autre
- Disposer d'une page affichant la totalité des articles en vente avec leur nom, leur prix et leur référence
- Disposer d'une page permettant d'ajouter un nouvel article
- Disposer d'une page permettant de modifier un article existant
- Disposer d'une page permettant de supprimer un article existant

Dans un second temps des améliorations pourront être apportées pour enrichir le site.

<br>

## Exercice
-----
1) Réaliser un ensemble de pages permettant de répondre au besoin énoncé par le client.  
La base de données des produits à vendre est disponible dans le fichier "Bricobrac_donnees.sql" (il contient également la liste des clients et de leurs villes).

<br>

2) Ajouter des fonctionnalités d'UX (User experience, c'est à dire d'ergonomie).  
Nous souhaitons rendre le site plus confortable pour la navigation. Nous allons ajouter des messages pour faire des retours à l'utilisateur, notament :
- Indiquer un message lorsqu'un nouvel article a été créé
- Indiquer un message lorsqu'un article a été modifié
- Indiquer un message lorsqu'un article a été supprimé
- Indiquer un message lors d'une erreur d'ajout, modification ou suppression

<br>

3) Ajouter une vérification des données entrées dans les formulaires pour s'assurer qu'elles correspondent bien à ce qui est attendu (par exemple un prix doit être un nombre).

<br>

4) Ajouter une fonctionnalité permettant d'ajouter des articles à un panier.  
Une page doit permettre au client de visualiser son panier, de supprimer des produits, modifier la quantité ou le vider entièrement.  
Depuis cette même page, un bouton doit permettre au client de passer commande (à ce stade du projet, le bouton vide le panier et un message "Votre commande a bien été validée" s'affiche).  
Afficher également des messages pour les actions suivantes :  
- Indiquer un message lorsqu'un article a été ajouté au panier "L'article XXXXX a bien été ajouté au panier"
- Indiquer un message lorsque la quantité d'un article a été modifiée dans le panier : "La quantité de l'article XXXXX a été modifiée à X"
- Indiquer un message lorsqu'un article est supprimé du panier : "L'article XXXXX a été supprimé de votre panier".

<br>

5) Ajouter un système de comptes utilisateurs.  
Chaque utilisateur doit pouvoir se connecter avec son adresse email et son mot de passe.  
Un utilisateur peut être soit un client, soit un administrateur. 

Un administrateur peut :
- Accéder aux fonctionnalités d'ajout, modification, suppression d'article

Un client peut :
- Accéder à l'historique de ses commandes
- Accéder à ses informations personnelles et les modifier

Les utilisateurs doivent pouvoir également se déconnecter de leur compte.

Attention, il sera peut-être nécessaire d'apporter des modifications à la structure des tables de la base de données pour cette partie du projet.