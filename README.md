# EMCX
## Module Loader pour ClientX

EMCX est un ML (Module Loader) perméttant de créer,utiliser et mettre en ligne ses propres module.

- Simple d'utilisation
- Assistance discord
- 100% Gratuit*
- ✨Open Source

## Fonctionnalités

- Importer ses propres modules
- Utiliser des serveurs en ligne pour télécharger et utiliser des modules communautaire.
- Créer ses propres module plus facilement que ClientX

## Installation

Aucune dépendances n'est requise à EMCX.

Pour installer EMCX, une modification de code seras demandé pour le bon fonctionnement de celui-ci.

Pour commencer, télécharger la dernière "Release" et unzipper dans le dossier "/src/" de votre ClientX

Une fois fait, rendez-vous dans "/public/index.php" de votre ClientX et remplacer la ligne :
```php
//A SUPPRIMER
$container = $app->getContainer();

//A REMPLACER
$container = (new EMCXLoader($app))->inject();
```

Parfait ! Vous y etes preque !

Aller dans "/src/ClientX/App.php"
```php
//A SUPPRIMER

    /**
     * Container d'injection de dépendance
     * @var ContainerInterface
     */
    private $container;

//A RAJOUTER 

    public $container;
    public ContainerBuilder $builder;

    public function __construct()
    {
        $this->builder = new ContainerBuilder(); // LIGNE A RAJOUTER DANS "__construct()"
    }
    
        public function getContainer(): ContainerInterface
    {
        $builder = $this->builder; // LIGNE A RAJOUTER DANS "getContainer"
    }
```

## Liste des modules officiel


| Module | Repo |
| ------ | ------ |
| ExempleModule | [EMCXLocal][PlDb] |

## Liste des répertoires certifiés
| Nom | Nbre modules |
| ------ | ------ |
| EMCX | 0 |


## License

MIT

*= Gratuit sauf les modules défini comme payant par l'auteur.
