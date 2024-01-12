class ProductSearch {
    constructor() {
      this.searchInput = document.querySelector('.search');
      this.categories = document.querySelectorAll('.category');
      this.itemsContainer = document.querySelector('.itemsContainer');
      this.category = null;
  
      // Inicializar el objeto cuando se crea una instancia
      this.init();
    }

    init() {

      this.fetchProducts("");
  
      // Agregar event listeners
      this.searchInput.addEventListener('change', (event) => this.fetchProducts(event.target.value));
      this.searchInput.addEventListener('keyup', (event) => this.fetchProducts(event.target.value));

      this.categories.forEach(element => {
        element.addEventListener('click', () => {
          this.handleCategoryClick(element);
        });
      });
    }

    generateProductHTML(product) {
      const productName = product.name;
      const productPrice = product.price;
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
        let response;
        if (this.category !== null) {
          response = await fetch(`ajax.php?page=Product&action=fetchProducts&condition=${condition}&category=${this.category}`);
        } else {
          response = await fetch(`ajax.php?page=Product&action=fetchProducts&condition=${condition}`);
        }

        if (!response.ok) {
            throw new Error(`HTTP error! Status: ${response.status}`);
        }
        
        const responseData = await response.json();

        console.log("ResponseData: " + responseData);  // Imprime la respuesta para verificar su contenido
        if (responseData.length > 0) {
          const productsJSON = responseData.map(product => {
              return {
                  code: product.code,
                  codecategory: product.codecategory,
                  name: product.name,
                  price: product.price,
                  sold: product.sold,
                  image: product.image,
                  stock: product.stock,
                  status: product.status
              };
          });
          const htmlCode = productsJSON.map(product => this.generateProductHTML(product)).join('');
          document.getElementById('itemsContainer').innerHTML = htmlCode;
        } else {
          console.warn('El array de productos está vacío.');
          document.getElementById('itemsContainer').innerHTML = "<p>No hay resultados que coincidan con tu busqueda</p>";
        }
      } catch (error) {
          console.error('Error fetching or generating HTML:', error.message);
      }
    }
  
    handleCategoryClick(element) {
      let selectedCategory = document.querySelector('.selectedCategory');
      console.log("Categoria previa: " + selectedCategory);
      if (selectedCategory !== null) {
        selectedCategory.classList.remove('selectedCategory');
        if (element.id === selectedCategory.id) {
          this.category = null;
        } else {
          element.classList.add('selectedCategory');
          this.category = element.id;
        }
      } else {
        element.classList.add('selectedCategory');
        this.category = element.id;
      }
      console.log("Categoria posterior: " + this.category);
      this.fetchProducts(this.searchInput.value);
    }
  }
  
  // Crear una instancia de la clase ProductSearch cuando el DOM esté cargado
  document.addEventListener('DOMContentLoaded', () => {
    const productSearch = new ProductSearch();
  });
  