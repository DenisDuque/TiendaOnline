class ProductSearch {
    constructor() {
      this.categories = document.querySelectorAll('.category');
      this.itemsContainer = document.querySelector('.itemsContainer');
      this.category = null;
  
      // Inicializar el objeto cuando se crea una instancia
      this.init();
    }

    init() {

      this.executeAsyncFunctions();
    

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
      const productImage = product.image;
      return `
        <article>
          <img src="views/assets/images/utils/${inWishlist}" alt="Wishlist">
          <img src="views/assets/images/products/${productImage}.png" alt="ProductImage">
          <p>${productName}</p>
          <p>${productPrice}</p>
        </article>`
    }

    async executeAsyncFunctions() {
      document.getElementById('itemsContainer').innerHTML = await this.fetchProducts();
      const result2 = await this.fetchData2();

      // Mostrar el resultado de la segunda promesa
      console.log(result2);
    }
    
    async fetchProducts() {
      return new Promise(async (resolve, reject) => {
          try {
              let response;
              if (this.category !== null) {
                  response = await fetch(`ajax.php?page=Product&action=fetchProducts&condition=&category=${this.category}`);
              } else {
                  response = await fetch(`ajax.php?page=Product&action=fetchProducts&condition=`);
              }
  
              if (!response.ok) {
                  throw new Error(`HTTP error! Status: ${response.status}`);
              }
  
              const responseData = await response.json();
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
      this.executeAsyncFunctions();
    }
  }
  
  // Crear una instancia de la clase ProductSearch cuando el DOM esté cargado
  document.addEventListener('DOMContentLoaded', () => {
    const productSearch = new ProductSearch();
  });
  