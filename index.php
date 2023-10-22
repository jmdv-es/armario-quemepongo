<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Armario</title>
	<link rel="stylesheet" href="estilo.css">
</head>
<body>

    <div class="category-container">
        <div class="category-title">Camisetas</div>
        <div class="slider-container">
            <?php
                $camisetas = fopen('1camisetas.csv', 'r');
                if ($camisetas !== false) {
                    while (($row = fgetcsv($camisetas, 1000, ';')) !== false) {
                        echo '<div class="item">';
                        echo '<img src="' . $row[0] . '" alt="' . $row[1] . '">';
                        echo '<div class="item-title">' . $row[1] . '</div>';
                        echo '<div class="item-subtitle">' . $row[2] . '</div>';
                        echo '<div class="item-subtitle">' . $row[3] . '</div>';
                        if (!empty($row[4])){echo '<div class="item-subtitle"><a href="' . $row[4] . '" target="_blank">Enlace</a></div>';}
                        echo '</div>';
                    }
                    fclose($camisetas);
                }
            ?>
        </div>
    </div>
	
    <div class="category-container">
        <div class="category-title">Camisas</div>
        <div class="slider-container">
            <?php
                $camisas = fopen('2camisas.csv', 'r');
                if ($camisas !== false) {
                    while (($row = fgetcsv($camisas, 1000, ';')) !== false) {
                        echo '<div class="item">';
                        echo '<img src="' . $row[0] . '" alt="' . $row[1] . '">';
                        echo '<div class="item-title">' . $row[1] . '</div>';
                        echo '<div class="item-subtitle">' . $row[2] . '</div>';
                        echo '<div class="item-subtitle">' . $row[3] . '</div>';
                        if (!empty($row[4])){echo '<div class="item-subtitle"><a href="' . $row[4] . '" target="_blank">Enlace</a></div>';}
                        echo '</div>';
                    }
                    fclose($camisas);
                }
            ?>
        </div>
    </div>
	
    <div class="category-container">
        <div class="category-title">Jerséis</div>
        <div class="slider-container">
            <?php
                $jerseis = fopen('3jerseis.csv', 'r');
                if ($jerseis !== false) {
                    while (($row = fgetcsv($jerseis, 1000, ';')) !== false) {
                        echo '<div class="item">';
                        echo '<img src="' . $row[0] . '" alt="' . $row[1] . '">';
                        echo '<div class="item-title">' . $row[1] . '</div>';
                        echo '<div class="item-subtitle">' . $row[2] . '</div>';
                        echo '</div>';
                    }
                    fclose($jerseis);
                }
            ?>
        </div>
    </div>

    <div class="category-container">
        <div class="category-title">Polos</div>
        <div class="slider-container">
            <?php
                $polos = fopen('4polos.csv', 'r');
                if ($polos !== false) {
                    while (($row = fgetcsv($polos, 1000, ';')) !== false) {
                        echo '<div class="item">';
                        echo '<img src="' . $row[0] . '" alt="' . $row[1] . '">';
                        echo '<div class="item-title">' . $row[1] . '</div>';
                        echo '<div class="item-subtitle">' . $row[2] . '</div>';
                        echo '</div>';
                    }
                    fclose($polos);
                }
            ?>
        </div>
    </div>		

    <div class="category-container">
        <div class="category-title">Sudaderas</div>
        <div class="slider-container">
            <?php
                $sudaderas = fopen('5sudadera.csv', 'r');
                if ($sudaderas !== false) {
                    while (($row = fgetcsv($sudaderas, 1000, ';')) !== false) {
                        echo '<div class="item">';
                        echo '<img src="' . $row[0] . '" alt="' . $row[1] . '">';
                        echo '<div class="item-title">' . $row[1] . '</div>';
                        echo '<div class="item-subtitle">' . $row[2] . '</div>';
                        echo '</div>';
                    }
                    fclose($sudaderas);
                }
            ?>
        </div>
    </div>

    <div class="category-container">
        <div class="category-title">Abrigo</div>
        <div class="slider-container">
            <?php
                $abrigo = fopen('6abrigo.csv', 'r');
                if ($abrigo !== false) {
                    while (($row = fgetcsv($abrigo, 1000, ';')) !== false) {
                        echo '<div class="item">';
                        echo '<img src="' . $row[0] . '" alt="' . $row[1] . '">';
                        echo '<div class="item-title">' . $row[1] . '</div>';
                        echo '<div class="item-subtitle">' . $row[2] . '</div>';
                        echo '</div>';
                    }
                    fclose($abrigo);
                }
            ?>        </div>
    </div>

    <div class="category-container">
        <div class="category-title">Partes de abajo</div>
        <div class="slider-container">
            <?php
                $partesdeabajo = fopen('7pantalones.csv', 'r');
                if ($partesdeabajo !== false) {
                    while (($row = fgetcsv($partesdeabajo, 1000, ';')) !== false) {
                        echo '<div class="item">';
                        echo '<img src="' . $row[0] . '" alt="' . $row[1] . '">';
                        echo '<div class="item-title">' . $row[1] . '</div>';
                        echo '<div class="item-subtitle">' . $row[2] . '</div>';
                        echo '</div>';
                    }
                    fclose($partesdeabajo);
                }
            ?>        </div>
    </div>

    <div class="category-container">
        <div class="category-title">Calzado</div>
        <div class="slider-container">
            <?php
                $calzado = fopen('8calzado.csv', 'r');
                if ($calzado !== false) {
                    while (($row = fgetcsv($calzado, 1000, ';')) !== false) {
                        echo '<div class="item">';
                        echo '<img src="' . $row[0] . '" alt="' . $row[1] . '">';
                        echo '<div class="item-title">' . $row[1] . '</div>';
                        echo '<div class="item-subtitle">' . $row[2] . '</div>';
                        echo '</div>';
                    }
                    fclose($calzado);
                }
            ?>        </div>
    </div>
	
	<div class="button-container">
		<button id="share-button">Compartir selección</button>
		<span class="button-text">v1.1.2.1 ©JMDV.es</span>
	</div>


<script src="js/seleccionitemscompartir.js"></script>





</body>
</html>