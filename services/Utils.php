<?php

/**
 * Classe utilitaire : cette classe ne contient que des méthodes statiques qui peuvent être appelées
 * directement sans avoir besoin d'instancier un objet Utils.
 * Exemple : Utils::redirect('home'); 
 */
class Utils {

    /**
     * Cette méthode permet d'afficher un lien de tri sur une colonne d'un tableau.
     * @param string $sort : la colonne sur laquelle on veut trier.
     * @param string $currentSort : la colonne actuellement triée.
     * @param string $order : le sens du tri.
     * @return string : le lien de tri.
     */
    public static function displaySortLink(string $sort, string $currentSort, string $order) : string
    {
        if ($sort === $currentSort) {
            if ($order === 'asc') {
                $newOrder = 'desc';
            } else {
                $newOrder = 'asc';
            }
        } else {
            $newOrder = 'desc';
        }
        return "index.php?action=monitoring&sort=$sort&order=$newOrder";
    }

    /**
     * Cette méthode permet d'afficher un caractère fléché vers le haut ou vers le bas
     * en fonction de la colonne qui est triée
     * @param string $sort : la colonne sur laquelle le trie est demandé.
     * @param string $currentSort : la colonne actuellement triée
     * @param string $order : le sens du tri.
     * @return string : la classe à ajouter à la balise <i> pour afficher la flèche.
     */
    public static function displayCaret(string $sort, string $currentSort, string $order) : string
    {
        if ($sort === $currentSort) {
            if ($order === 'asc') {
                return 'fa-caret-up';
            } else {
                return 'fa-caret-down';
            }
        } else {
            return '';
        }
    }

    /**
    * Tri un tableau d'objets en fonction de la colonne et du sens de tri.
    * @param array $array : le tableau d'objets à trier.
    * @param string $sort : la colonne sur laquelle trier.
    * @param string $order : le sens du tri.
    * @return array : le tableau trié.
    */
    public static function sortArray (array $array, string $sort, string $order) : array
    {
        usort($array, function($a, $b) use ($sort, $order) {
            //On récupère le nom de la méthode à appeler pour obtenir la valeur de la colonne.
            $method = self::toCamelCase("get_$sort");
            if ($order === 'desc') {
                return $b->$method() <=> $a->$method();
            } else {
                return $a->$method() <=> $b->$method();
            }
        });
        return $array;
    }

    /** 
    * méthode pour convertir snake_case en PascalCase
    * @param string $string : la chaine à convertir.
    * @return string : la chaine convertie.
    */
    public static function toCamelCase (string $string) : string
    {
        return str_replace(' ', '', ucwords(str_replace('_', ' ', $string)));
    }


    /**
     * Convertit une date vers le format de type "Samedi 15 juillet 2023" en francais.
     * @param DateTime $date : la date à convertir.
     * @return string : la date convertie.
     */
    public static function convertDateToFrenchFormat(DateTime $date) : string
    {
        // Attention, s'il y a un soucis lié à IntlDateFormatter c'est qu'il faut
        // activer l'extention intl_date_formater (ou intl) au niveau du serveur apache. 
        // Ca peut se faire depuis php.ini ou parfois directement depuis votre utilitaire (wamp/mamp/xamp)
        $dateFormatter = new IntlDateFormatter('fr_FR', IntlDateFormatter::FULL, IntlDateFormatter::FULL);
        $dateFormatter->setPattern('EEEE d MMMM Y');
        return $dateFormatter->format($date);
    }

    /**
     * Redirige vers une URL.
     * @param string $action : l'action que l'on veut faire (correspond aux actions dans le routeur).
     * @param array $params : Facultatif, les paramètres de l'action sous la forme ['param1' => 'valeur1', 'param2' => 'valeur2']
     * @return void
     */
    public static function redirect(string $action, array $params = []) : void
    {
        $url = "index.php?action=$action";
        foreach ($params as $paramName => $paramValue) {
            $url .= "&$paramName=$paramValue";
        }
        header("Location: $url");
        exit();
    }

    /**
     * Cette méthode retourne le code js a insérer en attribut d'un bouton.
     * pour ouvrir une popup "confirm", et n'effectuer l'action que si l'utilisateur
     * a bien cliqué sur "ok".
     * @param string $message : le message à afficher dans la popup.
     * @return string : le code js à insérer dans le bouton.
     */
    public static function askConfirmation(string $message) : string
    {
        return "onclick=\"return confirm('$message');\"";
    }

    /**
     * Cette méthode protège une chaine de caractères contre les attaques XSS.
     * De plus, elle transforme les retours à la ligne en balises <p> pour un affichage plus agréable. 
     * @param string $string : la chaine à protéger.
     * @return string : la chaine protégée.
     */
    public static function format(string $string) : string
    {
        // Etape 1, on protège le texte avec htmlspecialchars.
        $finalString = htmlspecialchars($string, ENT_QUOTES);

        // Etape 2, le texte va être découpé par rapport aux retours à la ligne, 
        $lines = explode("\n", $finalString);

        // On reconstruit en mettant chaque ligne dans un paragraphe (et en sautant les lignes vides).
        $finalString = "";
        foreach ($lines as $line) {
            if (trim($line) != "") {
                $finalString .= "<p>$line</p>";
            }
        }
        
        return $finalString;
    }

    /**
     * Cette méthode permet de récupérer une variable de la superglobale $_REQUEST.
     * Si cette variable n'est pas définie, on retourne la valeur null (par défaut)
     * ou celle qui est passée en paramètre si elle existe.
     * @param string $variableName : le nom de la variable à récupérer.
     * @param mixed $defaultValue : la valeur par défaut si la variable n'est pas définie.
     * @return mixed : la valeur de la variable ou la valeur par défaut.
     */
    public static function request(string $variableName, mixed $defaultValue = null) : mixed
    {
        return $_REQUEST[$variableName] ?? $defaultValue;
    }

}