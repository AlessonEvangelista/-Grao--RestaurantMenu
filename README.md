# - Grao-RestaurantMenu

[Desafio técnico][MVP] -Menu para Restaurantes MM (Main Menu)

-----------------------
## PATH'S

  - #### [docker] - build's conf's to aplications 
  - #### [laravel-api] - Path to API
  - #### [Design] - Path with Diagrams and Figma
  - #### [Routes] - Export to json Route to Insomnia
    - #### [Design-architeture] - Path with plaining design archituture implements
    - #### [Design-uml] - Path with Diagram's to plataform 
    - #### [Figma] - Figma images
  - #### [Front] - Path with front plataform(web or app) to chose

-----------------------
## RUN
  > [API] - Runing API
1. docker-compose build
    - ( Build a API project using :: 
    - 1: PHP-FPM
    - 2: NGINX Server-side
    - 3: Mysql (relational DB) )
    2. ( Configure on Dockerfile, necessarie updates and instalations; build config's to server-side and php.ini
        and runing composer for downnload package to build project )
2. docker-compose up -d 
    - ( expose ports:
    - Mysql: 3308 -> 3306  expose 3308 to don't have conflict with another database;
    - API: 127.0.0.1:89 )

## SCRIBE API DOCS
> Using for APi Documentation


        
# HOSTS CONFIGURATION
  ### If need i explain that
