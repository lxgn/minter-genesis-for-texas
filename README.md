# minter-genesis-for-texas

## 1. Создание genesis.json с помощью Exporter Tool

Инструкция по созданию genesis файла по этой ссылке (https://gist.github.com/danil-lashin/99618f9ac245444d3ecf5362f2f6d5d2) 

## 2. Входные данные:

В файле genesis.json находится файл снимка сети на определенный блок, созданный в предыдущем пункте

В файле changes.txt находятся данные с со списка валидаторов (https://docs.google.com/document/d/1rOpGUEi1u1T4OeWhpBZn_Wguince8lk-TVUSiCmT3ME/edit?usp=sharing)

## 3. Команда для запуска

```bash
php changer.php
```
или
```bash
./changer.php
```

В файле можно изменить время старта сети.

## 4. Результат работы скрипта

Измененный файл в формате genesis.YYYY-MM-DD-HH-MM-SS.json

Пример - genesis.2020-02-15-20-14-15.json

## 5. Как работает

Для исключения дубликатов - обратабатывается файл валидаторов, меняются адреса с маиннета, на указанные для тестнета, и наоборот.


## 6. Результат вывода на экран

```bash
./changer.php


Validator: Genesis Lab
Validator: Monster Node 2.0
Validator: Rundax
Validator: Minter Center
Validator: StakeHolder
Validator: PRO-BLOCKCHAIN
Validator: ONLY1
Validator: The Node
Validator: U-node
Validator: CAT
Validator: Validator.center
Validator: Minter Capital
Validator: ConsulNode
Validator: BTC.Secure

```

и созданный файл

## 7. Список валидаторов, которые стартуют новый техас с включенным валидатором

В файле status_nodes_autostart.txt список валидаторов в форамет <публичный ключ><space><комментарий-название валидатора>
