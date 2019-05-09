# Framework PHP

Piccolo framework PHP per gestire progetti semplici

## Creazione migrazioni

```
boot/phinx create Chats --configuration ./etc/phinx.php
```

## Eseguire le migrazioni

```
boot/phinx migrate --configuration ./etc/phinx.php --environment local
```
