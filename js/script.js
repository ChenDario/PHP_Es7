function updateImage(selectElement, imageId) {
    const selectedValue = selectElement.value;
    const imageElement = document.getElementById(imageId);
    
    if (selectedValue) {
        imageElement.src = selectedValue;  // Cambia l'immagine in base alla selezione
        imageElement.alt = selectElement.options[selectElement.selectedIndex].text;
    } else {
        imageElement.src = "";
        imageElement.alt = "Nessuna immagine";  // Testo di fallback quando non viene selezionata nessuna immagine
    }
}