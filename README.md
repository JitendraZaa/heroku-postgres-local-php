# Accessing Heroku Postgres Database from local PHP

## Prerequisite 
In Order to use Heroku from local PHP server, it must be *ssl* enabled. [Dcoker](https://github.com/JitendraZaa/heroku-postgres-local-php/blob/master/Dockerfile) file contains all needed configuration to spin off self signed ssl PHP server with Postgres extension.

## Steps
1. Install Docker
2. Clone [this](https://github.com/JitendraZaa/heroku-postgres-local-php) repository on your local system 
3. Create an application in [Heroku](https://dashboard.heroku.com/apps) and enable Postgres SQL addon
4. Copy `DataBase_URL` config variable from Settings section of your Heroku app
5. Update `$dbconn` variable in [index.php](https://github.com/JitendraZaa/heroku-postgres-local-php/blob/master/src/index.php) file as by copied value. Make sure to extract host, port, dbname, user & password. 
6. Run below command in terminal so that docker can install all the dependencies
```
docker-compose build
```
7. Now start docker using below command
```
docker-compose up
```

After you run the command above you should be able to access http://localhost
and https://localhost
 
### Thanks
* [nezhar](https://github.com/nezhar) for Docker configurations of self signed SSL PHP Server
