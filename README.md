# Framework PHP

Piccolo framework PHP per gestire progetti semplici

## Prima di iniziare

ricordati di copiare il file di configurazione
```
cp etc/.env.dist etc/.env
```

## Creazione migrazioni

```
boot/phinx create Chats --configuration ./etc/phinx.php
```

## Eseguire le migrazioni

```
boot/phinx migrate --configuration ./etc/phinx.php --environment local
```
