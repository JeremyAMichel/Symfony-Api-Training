## Objectif

Ecrire une **API REST JSON** qui rend la monnaie à un client.

La monnaie rendue doit **toujours être optimale** (par exemple, 1 x 10 au lieu de 5 x 2).

Le service doit être capable de gérer **plusieurs monnaies différentes**, pour l'instant **Euro** & **Yen**.


## Résultat attendu

Vous devrez **écrire deux classes** implémentant l'interface `App\CashMachine\CashMachine` :
- `App\CashMachine\EuroCashMachine` rendu en [Euro](https://fr.wikipedia.org/wiki/Euro)
- `App\CashMachine\YenCashMachine` rendu en [Yen](https://fr.wikipedia.org/wiki/Yen)

Il faudra également **écrire une classe** implémentant l'interface `App\CashMachine\CashMachineRegistry`.

Enfin, vous devrez **écrire un controller** pour implémenter l'API.
