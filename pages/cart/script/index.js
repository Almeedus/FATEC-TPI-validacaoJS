function toggleDetails(detailId) {
    const detailsElement = document.getElementById('details' + detailId);
    detailsElement.style.display = detailsElement.style.display === 'none' ? 'table-row' : 'none';
}