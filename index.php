<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Armario</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
			padding: 5px 15px 5px 15px;
        }

        .category-container {
            margin-bottom: 10px;
        }

        .category-title {
            font-size: 24px;
            margin-bottom: 10px;
        }

        .slider-container {
            overflow-x: scroll;
            white-space: nowrap;
        }

        .item {
            display: inline-block;
            margin-right: 20px;
			cursor: pointer;
        }

        .item img {
            max-width: 150px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .item-title {
            font-size: 16px;
            font-weight: bold;
            margin-top: 5px;
        }

        .item-subtitle {
            font-size: 14px;
            color: #666;
        }
		.item.selected {
			border: 2px solid #007bff; /* Cambia el estilo de borde al seleccionar */
		}		

		
		.button-container {
    text-align: center;
    position: fixed;
    bottom: 0;
    left: 0;
    width: 100%;
    background-color: #fff; /* Color de fondo para destacar el botón */
    padding: 10px 0; /* Espaciado vertical para el botón */
    box-shadow: 0 -1px 5px rgba(0, 0, 0, 0.2); /* Sombra bajo el contenedor */
}

/* Estilos para el botón */
#share-button {
    background-color: #18416c; /* Color de fondo del botón */
    color: #fff; /* Color del texto del botón */
    padding: 10px 20px; /* Espaciado interno del botón */
    font-size: 16px; /* Tamaño de fuente del botón */
    border: none;
    border-radius: 5px; /* Bordes redondeados del botón */
    cursor: pointer;
    transition: background-color 0.3s; /* Transición suave de color de fondo */

    /* Estilos para hacer que el botón sea fácil de tocar en dispositivos móviles */
    -webkit-tap-highlight-color: transparent; /* Evita el resaltado de clic en iOS */
    touch-action: manipulation; /* Mejora la respuesta táctil */
}

/* Estilos de hover para el botón */
#share-button:hover {
    background-color: #0056b3; /* Cambia el color de fondo al pasar el mouse */
}

span.button-text {
    padding-left: 31px;
}
		
    </style>
</head>
<body>

    <div class="category-container">
        <div class="category-title">Partes de arriba</div>
        <div class="slider-container">
            <?php
                $pantalones = fopen('1arriba.csv', 'r');
                if ($pantalones !== false) {
                    while (($row = fgetcsv($pantalones, 1000, ';')) !== false) {
                        echo '<div class="item">';
                        echo '<img src="' . $row[0] . '" alt="' . $row[1] . '">';
                        echo '<div class="item-title">' . $row[1] . '</div>';
                        echo '<div class="item-subtitle">' . $row[2] . '</div>';
                        echo '</div>';
                    }
                    fclose($pantalones);
                }
            ?>
        </div>
    </div>

    <div class="category-container">
        <div class="category-title">Partes de abajo</div>
        <div class="slider-container">
            <?php
                $camisetas = fopen('2abajo.csv', 'r');
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
        <div class="category-title">Calzado</div>
        <div class="slider-container">
            <?php
                $zapatillas = fopen('3calzado.csv', 'r');
                if ($zapatillas !== false) {
                    while (($row = fgetcsv($zapatillas, 1000, ';')) !== false) {
                        echo '<div class="item">';
                        echo '<img src="' . $row[0] . '" alt="' . $row[1] . '">';
                        echo '<div class="item-title">' . $row[1] . '</div>';
                        echo '<div class="item-subtitle">' . $row[2] . '</div>';
                        echo '</div>';
                    }
                    fclose($zapatillas);
                }
            ?>        </div>
    </div>
	
	<div class="button-container">
		<button id="share-button">Compartir selección con enlace</button>
		<span class="button-text">v1.1.1 © JMDV.es 2023</span>
	</div>
	

<script>
document.addEventListener('DOMContentLoaded', function () {
    // Objeto para almacenar elementos seleccionados
    const selectedItems = {};

    // Función para actualizar la selección
    function toggleSelection(category, itemTitle, itemSubtitle) {
        const itemId = `${category}-${itemTitle}-${itemSubtitle}`;
        if (selectedItems[itemId]) {
            delete selectedItems[itemId];
        } else {
            selectedItems[itemId] = {
                category,
                itemTitle,
                itemSubtitle
            };
        }
    }

    // Función para generar el enlace compartido
    function generateShareLink() {
        const selectedItemsArray = Object.values(selectedItems);
        const selectedItemsJSON = JSON.stringify(selectedItemsArray);
        const base64SelectedItems = btoa(selectedItemsJSON);
        const shareLink = `${window.location.href.split('?')[0]}?items=${base64SelectedItems}`;
		
        // Verificar si la API Web Share es compatible (solo en dispositivos iOS)
        if (navigator.share) {
            // Objeto de datos a compartir
            const shareData = {
                title: 'Comparte este look de mi armario',
                text: 'He hecho esta selección en el armario! Échale un ojo:',
                url: shareLink,
            };

            // Llamar a la API Web Share para abrir la hoja de intercambio
            navigator.share(shareData)
                .then(() => {
                    console.log('Contenido compartido con éxito.');
                })
                .catch((error) => {
                    console.error('Error al compartir contenido:', error);
                });
			
// Copiar el enlace al portapapeles			
		} else {const tempInput = document.createElement('input');
			tempInput.style.position = 'absolute';
			tempInput.style.left = '-1000px';
			tempInput.value = shareLink;
			document.body.appendChild(tempInput);
			tempInput.select();
			document.execCommand('copy');
			document.body.removeChild(tempInput);
        
        alert("El enlace se ha copiado en el portapapeles."); 
        }		

    }

    // Evento al hacer clic en un elemento
    const items = document.querySelectorAll('.item');
    items.forEach(item => {
        item.addEventListener('click', () => {
            const category = item.closest('.category-container').querySelector('.category-title').textContent;
            const itemTitle = item.querySelector('.item-title').textContent;
            const itemSubtitle = item.querySelector('.item-subtitle').textContent;
            toggleSelection(category, itemTitle, itemSubtitle);
            item.classList.toggle('selected');
        });
    });

    // Evento para generar el enlace compartido y copiarlo al portapapeles
    const shareButton = document.getElementById('share-button');
    shareButton.addEventListener('click', generateShareLink);
    
    // Leer los parámetros de la URL
    const urlParams = new URLSearchParams(window.location.search);
    const itemsParam = urlParams.get('items');

    if (itemsParam) {
        // Si hay parámetros, decodifica y restaura la selección
        const decodedItems = JSON.parse(atob(itemsParam));
        decodedItems.forEach(item => {
            const category = item.category;
            const itemTitle = item.itemTitle;
            const itemSubtitle = item.itemSubtitle;
            toggleSelection(category, itemTitle, itemSubtitle);

            // Encuentra y resalta los elementos seleccionados
            const selectedElement = Array.from(items).find(element => {
                const elementCategory = element.closest('.category-container').querySelector('.category-title').textContent;
                const elementTitle = element.querySelector('.item-title').textContent;
                const elementSubtitle = element.querySelector('.item-subtitle').textContent;
                return category === elementCategory && itemTitle === elementTitle && itemSubtitle === elementSubtitle;
            });

            if (selectedElement) {
                selectedElement.classList.add('selected');
            }
        });
    }
});

</script>


</body>
</html>