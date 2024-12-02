console.log("Cargado script local");

// Permitimos ocultar la publicidad al hacer clic en el icono
const closeAdIcon = document.getElementById("close-ad-icon");
const adContainer = document.getElementById("ad-container");

closeAdIcon.addEventListener("click", function () {
  adContainer.classList.add("d-none");
});
