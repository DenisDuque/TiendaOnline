class ProductSearch {
    constructor() {
      this.searchInput = document.querySelector('.search');
      this.categories = document.querySelectorAll('.category');
      this.itemsContainer = document.querySelector('.itemsContainer');
      this.data = null;
      this.totalData = null;
  
      // Inicializar el objeto cuando se crea una instancia
      this.init();
    }

    init() {
      // Obtener el elemento script que contiene el JSON
      const scriptElement = document.getElementById('productData');

      this.fetchProducts("");
  
      // Agregar event listeners
      this.searchInput.addEventListener('change', this.fetchProducts.bind(this));
      this.searchInput.addEventListener('keyup', this.fetchProducts.bind(this));
  
      this.categories.forEach(element => {
        element.addEventListener('click', () => {
          this.handleCategoryClick(element);
        });
      });
    }
  
    findMatches(wordToMatch, data) {
      try {
        const regex = new RegExp(wordToMatch, 'gi');
        const filteredData = data.filter(element => {
          const productNameMatch = element.productName && element.productName.match(regex);
          const idMatch = element.productCode && element.productCode.match(regex);
          return productNameMatch || idMatch;
        });
        return filteredData;
      } catch (error) {
        console.error('Error during filtering:', error);
        return [];
      }
    }

    generateProductHTML(product) {
      const productName = product.productName;
        const productPrice = product.productPrice;
        const inWishlist = product.inWishlist ? 'inWishlist.png' : 'defaultHeart.png';
        const productImage = product.productImage;
        return `
          <article>
            <img src="views/assets/images/utils/${inWishlist}" alt="Wishlist">
            <img src="views/assets/images/products/${productImage}" alt="ProductImage">
            <p>${productName}</p>
            <p>${productPrice}</p>
          </article>`
    }
  
    async fetchProducts(condition) {
      try {
          // Hacer una solicitud al servidor para obtener los datos
          const response = await fetch(`ajax.php?page=Product&action=searchProducts&condition=${condition}`);
          
          if (!response.ok) {
              throw new Error(`HTTP error! Status: ${response.status}`);
          }
  
          // Obtener los datos en formato JSON
          const products = await response.json();
          console.log(products);
          // Generar HTML utilizando los datos obtenidos
          const htmlCode = products.map(generateProductHTML).join('');
          
          // Insertar el HTML generado en el DOM o hacer lo que necesites
          // Ejemplo de inserción en un elemento con id "productContainer":
          document.getElementById('productContainer').innerHTML = htmlCode;
      } catch (error) {
          console.error('Error fetching or generating HTML:', error.message);
      }
    }
    displayMatches() {
      const matchArray = this.findMatches(this.searchInput.value, this.data);
      const html = matchArray.map(element => {
        const productName = element.productName;
        const productPrice = element.productPrice;
        const inWishlist = element.inWishlist ? 'inWishlist.png' : 'defaultHeart.png';
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
      this.itemsContainer.innerHTML = html;
    }
  
    handleCategoryClick(element) {
      let category = document.querySelector('.selectedCategory');
  
      if (category !== null) {
        category.classList.remove('selectedCategory');
        this.data = (category === element) ? this.totalData : this.categoryMatches(element);
      } else {
        this.data = this.categoryMatches(element);
      }
      this.displayMatches();
    }
  
    categoryMatches(element) {
      element.classList.add('selectedCategory');
  
      try {
        const filteredData = this.totalData.filter(item => {
          return item.productCategory === parseInt(element.id);
        });
        return filteredData;
      } catch (error) {
        console.error('Error during filtering:', error);
        return [];
      }
    }
  }
  
  // Crear una instancia de la clase ProductSearch cuando el DOM esté cargado
  document.addEventListener('DOMContentLoaded', () => {
    const productSearch = new ProductSearch();
  });
  