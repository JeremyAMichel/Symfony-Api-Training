## Test technique


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


## Evaluation

Le projet est livré avec des tests unitaires et fonctionnel.
Ces tests peuvent servir de spécifications si vous doutez du comportement attendu, 
puisque ce sont eux qui valideront le code que vous aurez produit.

**ATTENTION :** Les tests ne doivent pas avoir été modifiés.


## Scripts

- **Installer le projet :** installer les dépendances `Composer` suffit
- **Jouer les tests unitaires et fonctionnels :** une fois le projet installé, c'est `PHPUnit` qui les joue

**NOTE :** Les commandes ne vous sont volontairement pas données, nous espérons que vous trouverez par vous même.
