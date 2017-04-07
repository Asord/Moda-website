REM Batch script created by PERCHE Killian @ 10-2-2017
REM désactive les lignes de commandes inutiles et efface la fenètre
@echo off
cls

REM Installation de composer dans le répertoire courant
php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
php -r "if (hash_file('SHA384', 'composer-setup.php') === '55d6ead61b29c7bdee5cccfb50076874187bd9f21f65d8991d46ec5cc90518f447387fb9f76ebae1fbbacf329e583e30') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
php composer-setup.php
php -r "unlink('composer-setup.php');"

REM Crée un fichier composer.bat qui servira à executer l'installateur
echo @php "%~dp0composer.phar" %*>composer.bat

REM Crée un fichier composer.json qui indiquera quoi installer à composer
echo { >composer.json
echo     ^"require^": { >>composer.json
echo         ^"doctrine/orm^": ^"3.4.*^", >>composer.json
echo 		 ^"symphony/yaml^": ^"2.*^" >>composer.json
echo     }, >>composer.json
echo 	 ^"autoload^": { >> composer.json
echo 		 ^"psr-0^": { ^"^": ^"src/^" } >>composer.json
echo 	 } >>composer.json
echo } >>composer.json

REM Installation via composer de  doctrine et symphony
composer install