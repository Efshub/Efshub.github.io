<?php
require 'database.php';
$id = null;
if (!empty($_GET['id'])) {
	$id = $_REQUEST['id'];
}
 
if (null == $id) {
	header("Location: index.php");
} else {
	$pdo = Database::connect();
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$sql = "SELECT * FROM resultado_mbti where Matricula = ?";
	$q = $pdo->prepare($sql);
	$q->execute(array($id));
	$data = $q->fetch(PDO::FETCH_ASSOC);
	Database::disconnect();
}

$suma_total = $data['SumaExtroversion'] + $data['SumaIntroversion'] + $data['SumaSensorial'] + $data['SumaIntuitivo'] + $data['SumaRacional'] + $data['SumaEmocional'] + $data['SumaCalificador']; 


$dataPoints = array( 
	array("label"=>"Introversión", "y" => $data['SumaIntroversion']/$suma_total*100),
	array("label"=>"Extroversión", "y"=> $data['SumaExtroversion']/$suma_total*100),
	array("label"=>"Sensorial", "y"=> $data['SumaSensorial']/$suma_total*100),
	array("label"=>"Intuitivo", "y"=> $data['SumaIntuitivo']/$suma_total*100),
	array("label"=>"Racional", "y"=> $data['SumaRacional']/$suma_total*100),
	array("label"=>"Emocional", "y"=> $data['SumaEmocional']/$suma_total*100),
	array("label"=>"Calificador", "y"=> $data['SumaCalificador']/$suma_total*100)
);

$funcion1 = "";
$funcion2 = "";
$funcion3 = "";
$funcion4 = "";

$resultado_array = str_split($data['Resultado']);

foreach($resultado_array as $char)
{
    switch($char)
    {
        case("E"):
            $funcion1 .= "Extrovertido";
            break;
        case("I"):
            $funcion1 .= "Introvertido";
            break;
        case("S"):
            $funcion2 .= "Sensorial";
            break;
        case("N"):
            $funcion2 .= "Intuitivo";
            break;
        case("T"):
            $funcion3 .= "Racional";
            break;
        case("F"):
            $funcion3 .= "Emocional";
            break;
        case("J"):
            $funcion4 .= "Calificador";
            break;
        case("P"):
            $funcion4 .= "Perceptivo";
            break;
    }
}

define("ISFJ_pp","Pueden ser algo pesimistas acerca del futuro.<br>Pueden ser considerados insuficientemente sólidos cuando someten sus puntos de vista a otros.<br>Pueden ser subvalorados por su estilo tranquilo y algo retraído.<br>Pueden no ser tan flexibles como la situación u otros requieran.");
define("ISFJ_sd","Deben aprender a divulgar y llamar más la atención hacia sus propios logros.<br>Deben tratar de evitar cierta suspicacia hacia su propia intuición o imaginación y tomarlas más en serio.");

define("ISFP_pp","Pueden ser demasiado confiados y crédulos.<br>Pueden no criticar a otros cuando es necesario.<br>Pueden ser heridos con facilidad y hasta retirarse.<br>Pueden sentir un contraste tal entre sus elevador ideales internos y sus realizaciones reales, que asuman un cierto sentido de inadecuación, aún cuando estén siendo tan efectivos como los demás.");
define("ISFP_sd","Deben desarrollar más escepticismo y un método para analizar la información en lugar de simplemente aceptarla como buena.<br>Deben elevar más el aprecio a sus propios logros.");

define("ISTJ_pp","Pueden tener problemas si esperan que todo el mundo sea tan lógico y analítico como ellos.<br>Pueden ignorar las implicaciones de largo alcance por priorizar operaciones de carácter cotidiano.<br>Pueden descuidar las relaciones interpersonales.<br>Pueden tornarse rígidos en su comportamiento y ser considerados inflexibles.");
define("ISTJ_sd","Deben prestar atención también a las amplias ramificaciones de problemas, además de a las realidades presentes.");

define("ISTP_pp","Pueden guardarse cosas importantes para sí y parecer no estar preocupados.<br>Pueden seguir adelante con el trabajo, antes de esperar que el esfuerzo previo rinda los frutos necesarios.<br>Pueden parecer indecisos y no dirigidos.");
define("ISTP_sd","Pueden abrirse y compartir preocupaciones e información con otras personas.<br>Pueden necesitar desarrollar perseverancia.<br>Pueden necesitar planificar y dedicar el esfuerzo necesario para lograr los resultados deseados.");

define("INFJ_pp","Pueden creer, aunque no sea realidad, que sus ideas son pasadas por alto y/o subestimadas.<br>Pueden no ser francos y directos con la crítica.<br>Pueden ser reacios a inmiscuirse en la vida de otros y, por lo tanto, mantenerse demasiado para sí.<br>Pueden operar con concentración en un sólo asunto, ignorando otras tareas que necesiten ser realizadas.");
define("INFJ_sd","Pueden necesitar desarrollar habilidades políticas e impositivas para luchar por sus ideales.<br>Pueden necesitar aprender a dar retroalimentación constructiva a otros oportunamente.<br>Pueden necesitar encontrar otras alternativas que pueden ser logradas también.");

define("INFP_pp","Pueden demorar la terminación de tareas debido al perfeccionismo.<br>Pueden tratar de agradar a demasiada gente al mismo tiempo.<br>Pueden dedicar más tiempo a la reflexión que a la acción.");
define("INFP_sd","Deben desarrollar más dureza y disposición a decir que 'no'.<br>Deben desarrollar la capacidad para trabajar con la realidad más que buscar la respuesta perfecta.");

define("INTJ_pp","Pueden parecer tan inflexibles que otro teman acercárseles o discrepar.<br>Pueden tener dificultades en deshacerse de ideas impracticables.<br>Pueden ignorar el impacto de sus ideas o estilo sobre otros.");
define("INTJ_sd","Deben esforzarse por oír las ideas de otros.<br>Deben esforzarse por detectas las situaciones que puedan entrar en conflicto con el objetivo que persiguen.");

define("INTP_pp","Pueden ser demasiado abstractos y, por tanto, no muy realistas en cuanto al seguimiento necesario.<br>Pueden resultar demasido teóricos en sus explicaciones.<br>Pueden concentrarse demasiado en inconsistencias menores sin tomar en cuenta el trabajo en equipo y la armonía.");
define("INTP_sd","Deben concentrarse en detalles prácticos y desarrollar el seguimiento, así como hacer esfuerzos para expresar las cosas de manera más simple.<br>Deben esforzarse por conocer los aspectos personales y profesionales de los restantes integrantes del grupo.");

define("ESFJ_pp","Pueden ocultar algún problema por evitar un conflicto.<br>Pueden no valorar suficientemente sus propias prioridades debido a su deseo de agradar a los demás.<br>Pueden no siempre detenerse y ver el cuadro completo.<br>Pueden asumir, sin suficientes elementos, lo que es mejor para otros o para la organización.");
define("ESFJ_sd","Deben incluir sus propias necesidades.<br>Deben escuchar bien lo que los otros realmente necesitan o quieren.");

define("ESFP_pp","Pueden sobre-enfatizar información no objetiva.<br>Pueden no reflexionar antes de 'lanzarse'.<br>Pueden invertir demasiado tiempo a ser sociables y descuidar alguna tarea.<br>Puede que no terminen siempre lo que empiezan.");
define("ESFP_sd","Pueden necesitar incluir implicaciones lógicas en su toma de decisiones.<br>Pueden necesitar planificar previamente cuando administran proyectos.<br>Pueden necesitar balancear el esfuerzo por las tareas con el trato social.<br>Pueden necesitar trabajar en una mejor administración del tiempo.");

define("ESTJ_pp","Pueden ser sorprendidos por sus sentimientos y valores si los ignora durante mucho tiempo.<br>Pueden decidir demasiado rápidamente.<br>Pueden no ver la necesidad de cambio.<br>Pueden pasar por alto las sutilezas al tratar de que se haga el trabajo.");
define("ESTJ_sd","Deben considerar todos los aspectos, incluyendo el elemento humano, antes de decidir.<br>Deben esforzarse para ver los beneficios del cambio.");

define("ESTP_pp","Pueden parecer bruscos, e incluso insensibles, cuando actúan rápidamente.<br>Pueden descansar demasiado en la improvisación y perder de vista las implicaciones más amplias de sus acciones.<br>Pueden sacrificar el seguimiento de cualquier situación ante el siguiente problema inmediato.");
define("ESTP_sd","Deben dominar su excesiva confianza e incluir los sentimientos de otras personas en sus análisis.<br>Deben tratar de ver más allá de lo inmediato y planificar con antelación.<br>Deben desarrollar más su perseverancia.");

define("ENFJ_pp","Pueden idealizar a otros y sufrir de 'lealtad ciega'.<br>Pueden 'barrer los problemas debajo de la alfombra' cuando están en conflicto.<br>Puede no priorizar las tareas a favor de cuestiones de relaciones humanas.<br>Puede interpretar la crítica de forma personal.");
define("ENFJ_sd","Deben hacer un esfuerzo especial para admitir las limitaciones de la gente que quiere.<br>Pueden necesitar aprender a manejar los conflictos en forma productiva.<br>Pueden requerir prestar igual atención a los detalles de la tarea tanto como a los de la gente.");

define("ENFP_pp","Pueden pasar a nuevas ideas y proyectos sin completar los ya iniciados.<br>Pueden pasar por alto detalles importantes.<br>Pueden tratar de abarcar demasiado.<br>Pueden demorarse.");
define("ENFP_sd","Deben fijar prioridades y dar seguimiento completo a los asuntos.<br>Deben buscar detalles importantes.<br>Deben seleccionar proyectos en lugar de hacer todo lo que sea inicialmente atractivo.");

define("ENTJ_pp","Pueden ignorar las necesidades de la gente al enfocar la tarea.<br>Pueden ignorar las consideraciones y limitantes prácticas.<br>Pueden decidir demasiado rápidamente y aparecer impacientes y prepotentes.<br>Pueden ignorar y reprimir sus propios sentimientos.");
define("ENTJ_sd","Deben esforzarse por incluir el elemento humano y apreciar las contribuciones de otros.<br>Deben chequear los recurso prácticos, personales y situaciones disponibles, antes de seguir adelante.");

define("ENTP_pp","Pueden 'perderse' en el model, olvidando las realidades presentes.<br>Pueden ser competitivos y no apreciar la contribución de otros.<br>Pueden sobre-extenderse.<br>Pueden no adaptarse bien a los procedimientos establecidos.");
define("ENTP_sd","Deben prestar atención a la realidad presente.<br>Deben esforzarse por reconocer y validar la contribución de otros.");

$p_potenciales = "";
$s_desarrollo = "";

switch($data['Resultado'])
{
    case("ISFJ"):
        $p_potenciales = ISFJ_pp;
        $s_desarrollo = ISFJ_sd;
        break;
    case("ISFP"):
        $p_potenciales = ISFP_pp;
        $s_desarrollo = ISFP_sd;
        break;
    case("ISTJ"):
        $p_potenciales = ISTJ_pp;
        $s_desarrollo = ISTJ_sd;
        break;
    case("ISTP"):
        $p_potenciales = ISTP_pp;
        $s_desarrollo = ISTP_sd;
        break;
    case("INFJ"):
        $p_potenciales = INFJ_pp;
        $s_desarrollo = INFJ_sd;
        break;
    case("INFP"):
        $p_potenciales = INFP_pp;
        $s_desarrollo = INFP_sd;
        break;
    case("INTJ"):
        $p_potenciales = INTJ_pp;
        $s_desarrollo = INTJ_sd;
        break;
    case("INTP"):
        $p_potenciales = INTP_pp;
        $s_desarrollo = INTP_sd;
        break;
    case("ESFJ"):
        $p_potenciales = ESFJ_pp;
        $s_desarrollo = ESFJ_sd;
        break;
    case("ESFP"):
        $p_potenciales = ESFP_pp;
        $s_desarrollo = ESFP_sd;
        break;
    case("ESTJ"):
        $p_potenciales = ESTJ_pp;
        $s_desarrollo = ESTJ_sd;
        break;
    case("ESTP"):
        $p_potenciales = ESTP_pp;
        $s_desarrollo = ESTP_sd;
        break;
    case("ESFJ"):
        $p_potenciales = ESFJ_pp;
        $s_desarrollo = ESFJ_sd;
        break;
    case("ENFP"):
        $p_potenciales = ENFP_pp;
        $s_desarrollo = ENFP_sd;
        break;
    case("ENTJ"):
        $p_potenciales = ENTJ_pp;
        $s_desarrollo = ENTJ_sd;
        break;
    case("ENTP"):
        $p_potenciales = ENTP_pp;
        $s_desarrollo = ENTP_sd;
        break;
    
}
 
?>
<!DOCTYPE HTML>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no,
        initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU"
        crossorigin="anonymous">
    <!-- <link rel="stylesheet" href="css/fontawesome.min.css"> -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
    <link rel="stylesheet" href="./css/estilos.css">
    <link rel="stylesheet" href="./css/datatables.min.css">
    <link rel="shortcut icon" href="./img/fs.ico" type="image/x-icon">
    <title>Resultados - Test de Personalidad MBTI</title>
    <script>
        window.onload = function() {
         
         
        var chart = new CanvasJS.Chart("chartContainer", {
            animationEnabled: true,
            title: {
                text: "Distribución de factores de personalidad individual."
            },
            subtitles: [{
                text: "Facultad de Sistemas VARK-MBTI"
            }],
            data: [{
                type: "pie",
                yValueFormatString: "#,##0.00\"%\"",
                indexLabel: "{label} ({y})",
                dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
            }]
        });
        chart.render();
         
        }
        </script>
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container">
                <a class="navbar-brand" href="#">
                    <a href="index.php"><img src="./img/logo.png" alt=""></a>
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse btns" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto w-100 justify-content-end">
                        <li class="nav-item">
                            <a class="nav-link" href="index.php">Inicio</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="test_launcher.php">Realizar Test</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="contact.php">Contacto</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="dashboard.php">Dashboard</a>
                        </li>
                        <?php
                            if(isset($_SESSION["expediente"]) || isset($_SESSION["admin"]))
                            {
                                echo '<li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>';
                            }
                            else
                            {
                                echo '<li class="nav-item"><a class="nav-link" href="login.php">Login</a></li>';
                            }
                        ?>

                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <div class="container">
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th>Extrovertido</th>
                    <th>Introvertido</th>
                    <th>Sensorial</th>
                    <th>Intuitivo</th>
                    <th>Racional</th>
                    <th>Emocional</th>
                    <th>Calificador</th>
                    <th>Perceptivo</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <?php echo $data['SumaExtroversion']?>
                    </td>
                    <td>
                        <?php echo $data['SumaIntroversion']?>
                    </td>
                    <td>
                        <?php echo $data['SumaSensorial']?>
                    </td>
                    <td>
                        <?php echo $data['SumaIntuitivo']?>
                    </td>
                    <td>
                        <?php echo $data['SumaRacional']?>
                    </td>
                    <td>
                        <?php echo $data['SumaEmocional']?>
                    </td>
                    <td>
                        <?php echo $data['SumaCalificador']?>
                    </td>
                    <td>
                        <?php echo $data['SumaPerceptivo']?>
                    </td>
                </tr>
            </tbody>

        </table>
        <div class="text-center">
            <h1><b>Su resultado fue:
                    <?php echo $data['Resultado']?></b></h1>

            <ul class="list-group">
                <li class="list-group-item">
                    <?php echo $funcion1?>
                </li>
                <li class="list-group-item">
                    <?php echo $funcion2?>
                </li>
                <li class="list-group-item">
                    <?php echo $funcion3?>
                </li>
                <li class="list-group-item">
                    <?php echo $funcion4?>
                </li>
            </ul>
            
            
        </div>

    </div>

    <div id="chartContainer" style="height: 370px; width: 100%;" class="mt-3"></div>
    <div class="container text-center">
    <div class="card mt-3 text-white bg-danger">
            <div class="card-header">Peligros potenciales:</div>
            <div class="card-body">
                <?php echo $p_potenciales?>
            </div>
        </div>

        <div class="card mt-3 text-white bg-success">
            <div class="card-header">Sugerencias para el desarrollo:</div>
            <div class="card-body">
                <?php echo $s_desarrollo?>
            </div>
        </div>
        <button class="btn btn-primary mt-3" onclick="location.href='index.php';">Regresar</button>
    </div>
    
    <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
    <footer>
        <div class="footer-content mt-3">
            <div class="container">
                <div class="row border-top">
                    <div class="col-md-8 footer-item">
                        <h3 class="titulo">Facultad de Sistemas</h3>
                        <a href="contact.php" class="btn btn-link">Contacto</a>
                        <a href="about.php" class="btn btn-link">Acerca de</a>
                    </div>
                    <div class="col-md-4 footer-item">
                        <a href="#" class="btn btn-link">Subir en Página</a>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <script src="./js/jquery-3.3.1.min.js"></script>
    <script src="./js/popper.min.js"></script>
    <script src="./js/bootstrap.min.js"></script>
    <script src="./js/datatables.min.js"></script>

</body>

</html>