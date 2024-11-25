Services
Documents
CalculatorPHP 2000.md
Preview as
Export as
Save to
Import from
Document Name
CalculatorPHP 2000.md
MarkdownPreviewToggle
Mode<h1 class="code-line" data-line-start=0 data-line-end=1 ><a id="CalculatorPHP_2000_0"></a>CalculatorPHP 2000</h1>
<h1 class="code-line" data-line-start=2 data-line-end=3 ><a id="Description_2"></a>Description</h1>
<p class="has-line-data" data-line-start="3" data-line-end="5">Ce projet est une calculatrice en ligne de commande (CLI) qui permet d’évaluer des expressions mathématiques simples ou complexes, soit directement depuis l’entrée standard (STDIN), soit via un fichier contenant des expressions.<br>
Le projet gère les priorités opératoires et inclut une gestion avancée des erreurs, comme la division par zéro ou les expressions invalides.</p>
<h1 class="code-line" data-line-start=6 data-line-end=7 ><a id="Fonctionnalits_6"></a>Fonctionnalités</h1>
<p class="has-line-data" data-line-start="7" data-line-end="12">Calcul d’expressions mathématiques : Évalue les expressions contenant +, -, *, /, avec gestion des priorités et des parenthèses.<br>
Support des fichiers : Permet de traiter un fichier contenant plusieurs expressions ligne par ligne.<br>
Entrée directe depuis la ligne de commande : Possibilité de passer une expression ou un fichier en argument lors de l’exécution.<br>
Mode interactif : Permet d’entrer les expressions dynamiquement.<br>
Gestion des erreurs : Détecte et gère les erreurs comme la division par zéro ou les arguments invalides.</p>
<h1 class="code-line" data-line-start=13 data-line-end=14 ><a id="Installation_13"></a>Installation</h1>
<ol>
<li class="has-line-data" data-line-start="14" data-line-end="17">Prérequis<br>
PHP version 7.4 ou ultérieure.<br>
Un terminal ou une console pour exécuter le script.</li>
<li class="has-line-data" data-line-start="17" data-line-end="20">Cloner le projet<br>
Clonez le projet sur votre machine locale :</li>
</ol>
<p class="has-line-data" data-line-start="20" data-line-end="22">git clone <a href="https://github.com/Dxvy/CalculatorPHP.git">https://github.com/Dxvy/CalculatorPHP.git</a><br>
cd CalculatorPHP</p>
<ol start="3">
<li class="has-line-data" data-line-start="22" data-line-end="41">
<p class="has-line-data" data-line-start="22" data-line-end="23">Structure du projet</p>
<p class="has-line-data" data-line-start="24" data-line-end="40">CalculatorPHP/<br>
├── classes/<br>
│   ├──operation/<br>
│   │   └── Addition.php<br>
│   │   └── Cosinus.php<br>
│   │   └── Division.php<br>
│   │   └── Multiplication.php<br>
│   │   └── Sinus.php<br>
│   │   └── Soustraction.php<br>
│   │   └── Tangente.php<br>
│   ├── parser/<br>
│   │   └── Parser.php           # Classe pour évaluer les expressions<br>
│   ├── readerFile/<br>
│   │   └── ProcessFile.php      # Classe pour traiter les fichiers d’expressions<br>
├── includes/<br>
├── Test/ # Dossier contenant les fichiers de test<br>
├── index.php                    # Point d’entrée principal<br>
├── <a href="http://README.md">README.md</a>                    # Documentation du projet</p>
</li>
</ol>
<h1 class="code-line" data-line-start=41 data-line-end=42 ><a id="Utilisation_41"></a>Utilisation</h1>
<ol>
<li class="has-line-data" data-line-start="42" data-line-end="48">Exécuter une expression directement depuis la ligne de commande<br>
Pour évaluer une expression, utilisez la commande suivante :<br>
php index.php “2+2”<br>
Exemple :<br>
php index.php “(3 + 5) * 2”</li>
</ol>
<p class="has-line-data" data-line-start="48" data-line-end="49">#Output: Result: 16</p>
<ol start="2">
<li class="has-line-data" data-line-start="49" data-line-end="52">Traiter un fichier contenant des expressions<br>
Créez un fichier texte avec une expression par ligne, comme Test/test.txt :</li>
</ol>
<p class="has-line-data" data-line-start="52" data-line-end="56">3 + 5<br>
10 / 2<br>
(2 + 3) * 4<br>
Puis exécutez le script avec le chemin du fichier comme argument :</p>
<p class="has-line-data" data-line-start="57" data-line-end="59">php index.php Test/test.txt<br>
Exemple de sortie :</p>
<p class="has-line-data" data-line-start="60" data-line-end="64">Processing results for file ‘Test/test.txt’:<br>
Result for ‘3 + 5’: 8<br>
Result for ‘10 / 2’: 5<br>
Result for ‘(2 + 3) * 4’: 20</p>
<ol start="3">
<li class="has-line-data" data-line-start="64" data-line-end="67">Mode interactif<br>
Lancez le script sans argument pour passer en mode interactif :</li>
</ol>
<p class="has-line-data" data-line-start="67" data-line-end="69">php index.php<br>
Exemple :</p>
<p class="has-line-data" data-line-start="70" data-line-end="76">Enter an expression or file path (or ‘exit’ to quit): 2 + 2<br>
Result: 4<br>
Enter an expression or file path (or ‘exit’ to quit): exit<br>
Exiting calculator.<br>
Gestion des erreurs<br>
Le programme gère plusieurs types d’erreurs :</p>
<p class="has-line-data" data-line-start="77" data-line-end="82">Division par zéro : Affiche un message d’erreur clair.<br>
Argument invalide : Détecte les expressions mal formées.<br>
Fichier inexistant : Vérifie si le fichier spécifié existe.<br>
Contributions<br>
Les contributions sont les bienvenues !</p>
<p class="has-line-data" data-line-start="83" data-line-end="89">Forkez le dépôt, développez de nouvelles fonctionnalités ou corrigez des bugs.<br>
Créez une pull request pour proposer vos modifications.<br>

<br>  Auteurs<br>
Nom : [MARTHELY Davy]<br>
Email : [d.marthely@ynov.com]<br>
GitHub : [Dxvy]</p>