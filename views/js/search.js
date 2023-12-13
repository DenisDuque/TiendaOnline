document.addEventListener('DOMContentLoaded', function() {
  console.log("Script search cargado.");
  const searchInput = document.querySelector('.search');
  const itemsContainer = document.querySelector('.itemsContainer');
  searchInput.addEventListener('change', displayMatches);
  searchInput.addEventListener('keyup', displayMatches);

  // Obtener el elemento script que contiene el JSON
  const scriptElement = document.getElementById('productData');

  // Verificar si el elemento script existe
  if (scriptElement) {
      // Obtener el contenido JSON
      const jsonContent = scriptElement.textContent || scriptElement.innerText;

      // Convertir el JSON a un objeto JavaScript
      const data = JSON.parse(jsonContent);

      // Almacenar la variable 'data' en el ámbito superior para que esté disponible en displayMatches
      window.data = data;

      // Llamar a displayMatches inicialmente
      displayMatches();
  }
  function findMatches(wordToMatch, data) {
    try {
        const regex = new RegExp(wordToMatch, 'gi');
        const filteredData = data.filter(element => {
            // Check if productName and id properties exist before calling match
            const productNameMatch = element.productName && element.productName.match(regex);
            const idMatch = element.id && element.id.match(regex);
            return productNameMatch || idMatch;
        });
        return filteredData;
    } catch (error) {
        console.error('Error during filtering:', error);
        return [];
    }
  }

  function displayMatches() {
      const matchArray = findMatches(this.value, data);
      const html = matchArray.map(element => {
          const productName = element.productName;
          const productPrice = element.productPrice;
          const inWishlist = element.inWishlist ? "inWishlist.png" : "defaultHeart.png";
          const productImage = element.productImage;
          return `
              <article>
                  <img src="${inWishlist}" alt="Wishlist">
                  <img src="${productImage}" alt="ProductImage">
                  <p>${productName}</p>
                  <p>${productPrice}</p>
              </article>
          `;
      }).join('');
      itemsContainer.innerHTML = html;
  }
});