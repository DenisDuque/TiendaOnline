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
  
      // Verificar si el elemento script existe
      if (scriptElement) {
        // Obtener el contenido JSON
        const jsonContent = scriptElement.textContent || scriptElement.innerText;
  
        // Convertir el JSON a un objeto JavaScript
        this.data = JSON.parse(jsonContent);
        this.totalData = this.data;
        console.log(this.data);
  
        // Llamar a displayMatches inicialmente
        this.displayMatches();
      }
  
      // Agregar event listeners
      this.searchInput.addEventListener('change', this.displayMatches.bind(this));
      this.searchInput.addEventListener('keyup', this.displayMatches.bind(this));
  
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
  