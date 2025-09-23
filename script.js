function planFlight(destination) {
    // Abrir modal
    document.getElementById("tripModal").style.display = "flex";

    // Personalizar título y campo oculto
    document.getElementById("modal-title").innerText =
      "Planifica tu viaje a " + destination;
    document.getElementById("modal-destination").value = destination;
}

function closeModal() {
    document.getElementById("tripModal").style.display = "none";
}
