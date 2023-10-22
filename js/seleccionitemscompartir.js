document.addEventListener('DOMContentLoaded', function() {
  // Seleccionar y deseleccionar ítems al hacer clic en ellos
  const items = document.querySelectorAll('.item');
  items.forEach(item => {
    item.addEventListener('click', function() {
      item.classList.toggle('selected');
    });
  });

  // Generar un enlace codificado en base64 de la selección al hacer clic en el botón
  const shareButton = document.getElementById('share-button');
  shareButton.addEventListener('click', function() {
    const selectedItems = document.querySelectorAll('.item.selected');
    const selectedItemsData = Array.from(selectedItems).map(item => {
      const imgSrc = item.querySelector('img').src;
      const title = item.querySelector('.item-title').textContent;
      const subtitle = item.querySelector('.item-subtitle').textContent;
      return { imgSrc, title, subtitle };
    });
    const selectedItemsJSON = JSON.stringify(selectedItemsData);
    const base64Data = btoa(selectedItemsJSON);
    const shareLink = getBaseURL() + '/?selection=' + base64Data;
 

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
	} else {
		copyToClipboard(shareLink);
		alert('Enlace copiado al portapapeles.');
	}

 });



  // Función para copiar texto al portapapeles
  function copyToClipboard(text) {
    const tempTextArea = document.createElement('textarea');
    tempTextArea.value = text;
    document.body.appendChild(tempTextArea);
    tempTextArea.select();
    document.execCommand('copy');
    document.body.removeChild(tempTextArea);
  }
  // Obtener la URL base de la página
  function getBaseURL() {
    const pathArray = window.location.pathname.split('/');
    const host = window.location.host;
    let baseURL = 'http://' + host;
    for (let i = 0; i < pathArray.length; i++) {
      if (pathArray[i]) {
        baseURL += '/' + pathArray[i];
      }
    }
    return baseURL;
  }

  // Cargar selección a partir del enlace
  const urlParams = new URLSearchParams(window.location.search);
  const selectionParam = urlParams.get('selection');
  if (selectionParam) {
    try {
      const decodedSelection = atob(selectionParam);
      const selectedItemsData = JSON.parse(decodedSelection);
      selectedItemsData.forEach(data => {
        const item = Array.from(items).find(item => {
          const imgSrc = item.querySelector('img').src;
          const title = item.querySelector('.item-title').textContent;
          const subtitle = item.querySelector('.item-subtitle').textContent;
          return data.imgSrc === imgSrc && data.title === title && data.subtitle === subtitle;
        });
        if (item) {
          item.classList.add('selected');
        }
      });
    } catch (error) {
      console.error('Error al cargar la selección desde el enlace:', error);
    }
  }
});
