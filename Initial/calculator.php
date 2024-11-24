<?php

declare(strict_types=1);

//Mise en place initial de la classe principale dont découleront les opérations
abstract class Operation {
    public abstract function calculate(float $a, float $b): float;
}

//Classe de l'addition
class Addition extends Operation {
    public function calculate(float $a, float$b): float {
     return    $a + $b;
    }
}

//Classe de la soustraction
class Soustraction extends Operation {
    public function calculate(float $a, float $b): float
    {
     return $a - $b;
    }
}

//Classe de la multiplication
class Multiplication extends Operation{
    public function calculate(float $a, float $b): float
    {
     return $a * $b;
    }
}


//Classe de la division
class Division extends Operation{
    public function calculate(float $a, float $b): float
    {
        if ($b == 0) {
            throw new Exception("La division par 0 n'est pas possible désolé");
        } else
            return $a / $b;
    }
}


//Menu d'utilisation de la calculatrice Calculator 2000
class Menu {
    public function afficherMenu(): void
    {
        echo calculator . phpchr(27) . chr(91) .'H'.chr(27).chr(91).'J';
        echo "-------------------\n";
        echo "--Calculator 2000--\n";
        echo "-------------------\n";
        echo "--- 1. addition ---\n";
        echo "- 2. soustraction -\n";
        echo " 3. multiplication \n";
        echo "--- 4. division ---\n";
        echo " 5. Multi Opérator \n";
        echo "--- 0. Quitter ---\n";
        echo "-------------------\n";
        echo "Entrez votre choix:\n";
    }

    public function choixOperation($choix): void
    {
        switch ($choix) {
            case '1':
                echo "-- Réalise ton addition --\n";
                $this->effectuerOperation(new Addition());
                break;
            case '2':
                echo "-- Réalise ta soustraction --\n";
                $this->effectuerOperation(new Soustraction());
                break;
            case '3':
                echo "-- Réalise ta multiplication --\n";
                $this->effectuerOperation(new Multiplication());
                break;
            case '4':
                echo "-- Réalise ta division --\n";
                $this->effectuerOperation(new Division());
                break;
            case '5':
                echo "-- Réalise ta suite d'opération --\n";
                $operations = [new Addition(), new Soustraction(), new Multiplication(), new Division()];
                $this->suiteOperation($operations);
                break;
            case '0':
                echo "-- Fermeture de Calculator 2000 --\n";
                echo calculator . phpchr(27) . chr(91) .'H'.chr(27).chr(91).'J';
                exit;
            default:
                echo "-- Choix invalide --\n";
        }
    }

    //Fonction pour réaliser l'opération
    public function effectuerOperation(Operation $operation): void
    {
        echo "Entrez le premier nombre : ";
        $a = floatval(fgets(STDIN));
        echo "Entrez le deuxième nombre : ";
        $b = floatval(fgets(STDIN));

        $resultat = $operation->calculate($a, $b);
        echo "Le résultat est : " . $resultat . "\n\n\n";
    }

    //Fonction pour réaliser une suite d'opérations
    public function suiteOperation(array $operation): void
    {
        $resultat = 0;
        while (true){
            echo "Entrez l'opération à effectuer : 1. addition - 2.soustraction - 3. multiplication - 4. division - 5.Fin:\n";
            $choixOperator = fgets(STDIN);

            switch ($choixOperator) {
                case '1':
                    $operation = new Addition();
                    break;
                case '2':
                    $operation = new Soustraction();
                    break;
                case '3':
                    $operation = new Multiplication();
                    break;
                case '4':
                    $operation = new Division();
                    break;
                case '5':
                    return;
                default :
                    echo "Choix invalide";
                    break;
            }

            echo "Entrez le nombre :";
            $nbr = floatval(fgets(STDIN));

            try {
                $resultat = $operation->calculate($resultat, $nbr);
                echo "Résultat intermédiaire : " . $resultat . "\n\n\n";
            } catch (DivisionByZeroError $e) {
                echo "Erreur : " . $e->getMessage() . "\n\n\n";
                return; // Fin de la suite d'opérations en cas d'erreur
            }
        }
    }

    public function allInOneOperation($operation){
        $resulat = 0;

        switch ($symbol) {
            case '+':
                $operation = new Addition();
                break;
            case '-':
                $operation = new Soustraction();
                break;
            case '*':
                $operation = new Multiplication();
                break;
            case '/':
                $operation = new Division();
                break;
            default:
                continue;
        }
    }
}

//Instance de mise en place du Menu
$menu = new Menu();

//Affichage et gestion du menu
while(true) {
    //Affichage du menu
    $menu->afficherMenu();

    //Récupération du choix
    $choix = trim(fgets(STDIN));

    //Traitement du choix
    $menu->choixOperation($choix);
}

