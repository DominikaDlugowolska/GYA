// Element vi behöver
const eGeoModal = document.querySelector("#geoModal");

// Starta modal (koppla till js-biblioteket)
var myModal = new bootstrap.Modal(eGeoModal, {
    keyboard: false
});

// Lyssna på när eGeoModal öppnas
// och byta ut texten
eGeoModal.addEventListener("show.bs.modal", function () {
    console.log("Yeeeey, det funkar att visa upp modal");

    // Byt ut innehållet
    const eModalBody = eGeoModal.querySelector(".modal-body");
});