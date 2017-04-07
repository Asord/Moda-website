@echo off
cls

REM php vendor\doctrine\orm\bin\doctrine orm:schema-tool:create

REM create database
REM .\vendor\bin\doctrine orm:schema-tool:create

REM update database
.\vendor\bin\doctrine orm:schema-tool:update --force --dump-sql

REM create products
REM php create_product.php ORM
REM php create_product.php DBAL

REM Drop table
REM .\vendor\bin\doctrine orm:schema-tool:drop --force