console.log("Cargado script local");

// Ejemplo de comentario JSDoc:

/**
 * Calculates the area of a rectangle
 * @param {number} length - The length of the rectangle
 * @param {number} width - The width of the rectangle
 * @returns {number} - The area of the rectangle
 */

const closeAdIcon = document.getElementById("close-ad-icon");
const adContainer = document.getElementById("ad-container");

// Permitimos ocultar la publicidad al hacer clic en el icono "X"
closeAdIcon.addEventListener("click", function () {
  adContainer.classList.add("d-none");
});

/**
 * Ajusta el tamaño de los botones con la clase `responsive-btn` en función del ancho de la ventana.
 *
 * - Añade la clase `btn-sm` a los botones si el ancho de la ventana es menor a 576px.
 * - Elimina la clase `btn-sm` de los botones si el ancho de la ventana es mayor a 576px.
 *
 * Bootstrap utiliza un breackpoint 'sm' para anchos de ventana >=576px, coincidiendo así el uso de 'btn-sm' con tamaños 'sm' e inferiores.
 *
 * @returns {void} No retorna nada.
 */
function updateButtonsSize() {
  let buttons = document.querySelectorAll(".responsive-btn");

  buttons.forEach((button) => {
    if (window.innerWidth < 576) {
      button.classList.add("btn-sm");
    } else {
      button.classList.remove("btn-sm");
    }
  });
}

// Mediante EventListeners inicializamos los tamaños de los botones al cargar la página y los actualizamos al cambiar el tamaño de la ventana
// Sobre el evento DOMContentLoaded: https://developer.mozilla.org/en-US/docs/Web/API/Document/DOMContentLoaded_event
// Sobre el evento resize: https://developer.mozilla.org/en-US/docs/Web/API/Window/resize_event
document.addEventListener("DOMContentLoaded", updateButtonsSize);
window.addEventListener("resize", updateButtonsSize);
