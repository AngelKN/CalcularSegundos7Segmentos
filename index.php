<!DOCTYPE html>
<html>

<head>
    <title>Reloj Digital</title>
    <!-- estilos del reloj -->
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <h1>Reloj Digital</h1>

    <div class="reloj">
        <!-- Funcionalidad del reloj digital -->
        <?php
        $segundos = 0;
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $segundos = intval($_POST["segundos"]);
            $horas = floor($segundos / 3600);
            $segundos %= 3600;
            $minutos = floor($segundos / 60);
            $segundos %= 60;
            echo "$horas:$minutos:$segundos";
        }
        ?>
    </div>

    <?php
    //Calculo de los segmentos
    function calcularSegmentosEncendidos($segundos)
    {
        $segmentosPorNumero = array(
            0 => 6,
            1 => 2,
            2 => 5,
            3 => 5,
            4 => 4,
            5 => 5,
            6 => 6,
            7 => 3,
            8 => 7,
            9 => 6
        );

        $totalSegmentos = 0;

        $horas = floor($segundos / 3600);
        $minutos = floor(($segundos % 3600) / 60);
        $segundosRestantes = $segundos % 60;

        $totalSegmentos += $segmentosPorNumero[intval($horas / 10)];
        $totalSegmentos += $segmentosPorNumero[$horas % 10];
        $totalSegmentos += $segmentosPorNumero[intval($minutos / 10)];
        $totalSegmentos += $segmentosPorNumero[$minutos % 10];
        $totalSegmentos += $segmentosPorNumero[intval($segundosRestantes / 10)];
        $totalSegmentos += $segmentosPorNumero[$segundosRestantes % 10];

        return $totalSegmentos;
    }
    $totalSegmentos = 0;
    for ($i = 0; $i <= $segundos; $i++) {
        $totalSegmentos += calcularSegmentosEncendidos($i);
    }

    echo "<div class='resultado'>Se han encendido $totalSegmentos segmentos de LED de 7 segmentos.</div>";
    ?>

    <form method="post">
        <label for="segundos">Ingrese la cantidad de segundos:</label>
        <input type="number" name="segundos" id="segundos" required>
        <button type="submit">Mostrar</button>
    </form>

</body>

</html>
