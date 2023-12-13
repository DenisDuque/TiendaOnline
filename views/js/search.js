document.addEventListener('DOMContentLoaded', function() {
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
      return data.filter(element => {
        // here we need to figure out if the city or state matches what was searched
        const regex = new RegExp(wordToMatch, 'gi');
        return element.productName.match(regex) || element.id.match(regex)
      });
    }

  function displayMatches() {
      const matchArray = findMatches(this.value, data);
      const html = matchArray.map(element => {
          const regex = new RegExp(this.value, 'gi');
          const productName = element.productName.replace(regex, `${this.value}`);
          const productPrice = element.productPrice.replace(regex, `${this.value}`);
          const inWishlist = element.inWishlist ? "inWishlist.png" : "defaultHeart.png";
          const productImage = element.productImage.replace(regex, `${this.value}`);
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