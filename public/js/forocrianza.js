console.log("Cargado script local");

const closeAdIcon = document.getElementById("close-ad-icon");
const adContainer = document.getElementById("ad-container");

// Permitimos ocultar la publicidad al hacer clic en el icono "X" gracias a las clases de Bootstrap
if (closeAdIcon && adContainer) {
  closeAdIcon.addEventListener("click", function () {
    adContainer.classList.add("d-none");
  });
}

/**
 * Ajusta el tamaño de los botones con la clase responsive-btn en función del ancho de la ventana.
 *
 * - Añade la clase btn-sm a los botones si el ancho de la ventana es menor a 576px.
 * - Elimina la clase btn-sm de los botones si el ancho de la ventana es mayor a 576px.
 *
 * Bootstrap utiliza un breackpoint sm para anchos de ventana >=576px, coincidiendo así el uso de btn-sm con tamaños sm e inferiores.
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

// Muestra feedback de errores en los formularios con clase `needs-valdiation` y desactiva el formulario para su envío mientras no se corrijan: https://getbootstrap.com/docs/5.3/forms/validation/#custom-styles
(() => {
  "use strict";

  // Fetch all the forms we want to apply custom Bootstrap validation styles to
  const forms = document.querySelectorAll(".needs-validation");

  // Loop over them and prevent submission
  Array.from(forms).forEach((form) => {
    form.addEventListener(
      "submit",
      (event) => {
        if (!form.checkValidity()) {
          event.preventDefault();
          event.stopPropagation();
        }

        form.classList.add("was-validated");
      },
      false
    );
  });
})();


// Formulario creación tema:
// Ejemplo de comentario JSDoc:

/**
 * Calculates the area of a rectangle
 * @param {number} length - The length of the rectangle
 * @param {number} width - The width of the rectangle
 * @returns {number} - The area of the rectangle
 */