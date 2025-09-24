// Modal que muestra planificar vuelo

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

// Buscador dinamico de vuelos

document.addEventListener("DOMContentLoaded", function () {
    const searchInput = document.getElementById("search");
    const resultsDiv = document.getElementById("flight-results");

    function loadFlights(query = "") {
        fetch("search_flights.php?search=" + encodeURIComponent(query))
            .then(response => response.text())
            .then(data => {
                resultsDiv.innerHTML = data;
            });
    }

    // Cargar todos los vuelos al inicio
    loadFlights();

    // Cada vez que escriba, buscar dinámicamente
    searchInput.addEventListener("keyup", function () {
        loadFlights(this.value);
    });
});

