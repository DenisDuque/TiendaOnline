document.addEventListener('DOMContentLoaded', function() {
  console.log("Script search cargado.");
  const searchInput = document.querySelector('.search');
  const categories = document.querySelectorAll('.category');
  const categoriesArray = Array.from(categories);
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
      window.totalData = data;
      window.data = data;

      // Llamar a displayMatches inicialmente
      displayMatches();
  }
  function filterByCategory() {
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
                  <img src="views/assets/images/utils/${inWishlist}" alt="Wishlist">
                  <img src="views/assets/images/products/${productImage}" alt="ProductImage">
                  <p>${productName}</p>
                  <p>${productPrice}</p>
              </article>
          `;
      }).join('');
      itemsContainer.innerHTML = html;
  }

    categoriesArray.forEach(element => {
        element.addEventListener('click', function() {
            console.log("Categoria clickada: " + this.id);

            let category = this.querySelector(".selectedCategory");

            if (category !== null) {
                category.classList.remove('selectedCategory');
                window.data = window.totalData;
            } else {
                this.classList.add("selectedCategory");

                try {
                    const filteredData = window.totalData.filter(item => {
                        const categoryMatch = item.category === this.id; // Asegúrate de ajustar esto según tu estructura de datos
                        return categoryMatch;
                    });
                    window.data = filteredData;
                } catch (error) {
                    console.error('Error during filtering:', error);
                    return [];
                }
            }
        });
    });

});