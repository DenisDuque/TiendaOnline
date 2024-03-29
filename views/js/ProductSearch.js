class ProductSearch {
    constructor() {
      this.searchInput = document.querySelector('.search');
      this.categories = document.querySelectorAll('.category');
      this.itemsContainer = document.querySelector('.itemsContainer');
      this.category = null;
      this.sortInput = document.querySelector('#sortInput');
      this.sort = null;
  
      // Inicializar el objeto cuando se crea una instancia
      this.init();
    }

    init() {

      this.executeAsyncFunctions("");
  
      // Agregar event listeners
      this.searchInput.addEventListener('change', (event) => this.executeAsyncFunctions(event.target.value));
      this.searchInput.addEventListener('keyup', (event) => this.executeAsyncFunctions(event.target.value));
      this.sortInput.addEventListener('change', (event) => {
        this.sort = event.target.value;
        this.executeAsyncFunctions(this.searchInput.value);
      });
    

      this.categories.forEach(element => {
        element.addEventListener('click', () => {
          this.handleCategoryClick(element);
        });
      });
    }

    generateProductHTML(product) {
      console.log("Codigo producto: " + product.code);
      const productCode = product.code;
      const productName = product.name;
      const productPrice = product.price;
      const inWishlist = product.inWishlist ? 'inWishlist.png' : 'defaultHeart.png';
      const productImage = product.image;
      return `
        <article id="${productCode}" class="product-article">
          <img src="views/assets/images/utils/${inWishlist}" alt="Wishlist">
          <img src="views/assets/images/products/${productImage}.png" alt="ProductImage">
          <p>${productName}</p>
          <p>${productPrice}</p>
        </article>`
    }

    async executeAsyncFunctions(condition) {
      document.getElementById('itemsContainer').innerHTML = await this.fetchProducts(condition);
      const result2 = await this.fetchData2();

      // Mostrar el resultado de la segunda promesa
      console.log(result2);
    }
    
    async fetchProducts(condition) {
      return new Promise(async (resolve, reject) => {
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
              console.log("Sort: " + this.sort);
              console.log("ResponseData: " + responseData);
  
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
  
                  switch (this.sort) {
                      case "high-low":
                          productsJSON.sort((a, b) => b.price - a.price);
                          break;
  
                      case "low-high":
                          productsJSON.sort((a, b) => a.price - b.price);
                          break;
  
                      default:
                          break;
                  }
  
                  const htmlCode = productsJSON.map(product => this.generateProductHTML(product)).join('');
                  resolve(htmlCode);
              } else {
                  resolve("<p>No hay resultados que coincidan con tu búsqueda</p>");
              }
          } catch (error) {
              console.error('Error fetching or generating HTML:', error.message);
              reject(error.message);
          }
      });
    }
  

    async fetchData2() {
      return new Promise(resolve => {
          setTimeout(() => {
              resolve("Otros Datos (fetchData2)");
          }, 4000);  // Simulando un tiempo de ejecución de 4 segundos
      });
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
      this.executeAsyncFunctions(this.searchInput.value);
    }
  }
  
  // Crear una instancia de la clase ProductSearch cuando el DOM esté cargado
  document.addEventListener('DOMContentLoaded', () => {
    const productSearch = new ProductSearch();
  });
  