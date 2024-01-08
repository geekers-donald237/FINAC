Pour le module de gestion des armureries, voici les fonctions à implémenter, en se basant sur les éléments répertoriés dans le cahier de charge :

1. **Inscription d'une armurerie** :
    - Permettre à une armurerie de s'inscrire sur la plateforme en fournissant des informations telles que le nom, la région, le secteur, et l'agréément/licence le cas échéant.

2. **Connexion d'une armurerie** :
    - Permettre aux armureries inscrites de se connecter à la plateforme en utilisant leur nom d'utilisateur et leur mot de passe.

3. **Gestion de l'armurerie** :
    - Permettre à une armurerie de gérer son propre profil, y compris la modification des informations telles que le nom, la région, le secteur, l'agréément, la licence, etc.

4. **Enregistrement des armes vendues** :
    - Permettre à une armurerie d'enregistrer les armes vendues, y compris les détails de l'arme (type d'arme, numéro de série) et les détenteurs d'armes associés.

5. **Soumission des fiches personnelles des propriétaires d'armes** :
    - Permettre à l'armurerie de soumettre des fiches personnelles des propriétaires d'armes aux administrations en charge de la validation des autorisations de port.

6. **Mise à jour des stocks des armureries** :
    - Mettre à jour automatiquement les stocks d'armes de l'armurerie en fonction des ventes et des achats effectués.

7. **Recherche des armureries officiellement reconnues** :
    - Fournir un annuaire qui permet aux utilisateurs de rechercher des armureries officiellement reconnues par l'État.

8. **Vérification des informations d'agréément et de licence** :
    - Assurer la vérification des informations d'agréément et de licence des armureries pour garantir leur conformité aux réglementations.

9. **Génération des autorisations de port** :
    - Générer automatiquement les autorisations de port (code FINAC) après la validation de la demande de port par les administrations compétentes.

10. **Gestion des armes égarées** :
    - Activer un système d'alerte lorsque l'armurerie ou le détenteur signale qu'une arme a été égarée, ce qui doit entraîner une mise à jour du statut de l'arme dans le système.

11. **Garantir la sécurité des données** :
    - Assurer la sécurité des données en utilisant des mécanismes d'authentification et d'autorisation appropriés, ainsi que des protocoles de sécurité pour protéger les informations sensibles.

Ces fonctions permettront à l'armurerie de s'inscrire, de gérer son profil, d'enregistrer les ventes d'armes, de soumettre des fiches personnelles, de mettre à jour ses stocks et de suivre les règles et réglementations en matière d'armes, tout en garantissant la sécurité des données.

php artisan vendor:publish --tag="newsletter-config"
