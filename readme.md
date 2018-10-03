Slevoking - Vstupní test
========================

Realizace zadání z pohovoru na pozici PHP programátora.

Instalace
---------
1. Stažení repozitáře\
`git clone https://github.com/hladpe/Slevoking-pohovor.git slevoking-pohovor`

2. Instalace závislostí přes Composer\
`cd slevoking-pohovor`\
`composer install`

3. Instalace závilostí přes Bower\
`cd www`\
`bower install`

4. Nastavení lokálního konfiguračního souboru\
Přejmenovat soubor `app/config/config.local.neon.dist` na `app/config/config.local.neon`, případně nastavit příslušné konfigurační direktivy, viz [Konfigurace frameworku | Nette Framework](https://doc.nette.org/cs/2.4/configuring).

5. Nastavení oprávnění v souborovém systému\
Nastavte oprávnění pro zápis uživatele apache do adresářů `log` a `temp`. 

6. Spuštění aplikace
- Na adrese `http://localhost/slevoking-pohovor/www/`
- Alternativně po nastavení Apache Virtual Host
