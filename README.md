![izidore](https://user-images.githubusercontent.com/79584353/122038278-b8f93500-cdd5-11eb-8f94-f35c5a212177.gif)

# Test technique - Izidore 


## Description

  - Récréer une page précise (avec base de données) du site originel -> [ici](http://get.talentdetection.com/lnk/AUgAADGE94kAAchh2oQAALrnLjoAAABElewAAAAAAAw5JABgtkIMX4MZB7lJQpSxWxyEJO62zQAAanQ/1/J0mGRYqQpITAPLwDRvG8_Q/aHR0cHM6Ly9pemlkb3JlLmNvbS92aWRlLWFwcGFydC9hcHBhcnRlbWVudC1qdW5oYWMvMTg2NTA")
  - Utilisation de PHP, Symfony, Twig, Boostrap.
  - Implémentation d'une nouvelle fonctionnalité : possibilité de laisser des avis aux vendeurs en tant que client et de les afficher.

  
 ## Installation
 
 ### Faire les commandes suivantes :
 
   - Lancer `composer install`
   - Lancer `yarn install` ou `npm install`
   - Lancer `npm run dev`
   - Copier le fichier .env et le renommer en .env.local -> changer db_user, db_password et db_name
   - Lancer `php bin/console doctrine:database:create`
   - Lancer `php bin/console m:mig`
   - Lancer `php bin/console d:m:m`
   - Lancer `php bin/console d:f:l`
   - Lancer `php bin/console server:start`
   - Dans le navigateur, taper l'adresse : https://localhost:8000/
  
 
   
  

