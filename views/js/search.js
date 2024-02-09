class BaseProductSearch {
    constructor() {
      this.categories = document.querySelectorAll('.category');
      this.itemsContainer = document.querySelector('.itemsContainer');
      this.category = null;
      this.condition = "";

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
      const productDescription = product.description;
      const inWishlist = product.inWishlist ? 'inWishlist.png' : 'defaultHeart.png';
      const productImage = product.image.replace(/\s/g, '');
      return `
        <article id="${product.code}" class="product-article">
          <img class="product-heart" src="views/assets/images/utils/${inWishlist}" alt="Wishlist">
          <img src="views/assets/images/products/${productImage}.png" alt="${productDescription}">
          <p>${productName}</p>
          <p>${productPrice}</p>
        </article>`;
    }
  
    async executeAsyncFunctions() {
      document.getElementById('itemsContainer').innerHTML = await this.fetchProducts();
      const result2 = await this.fetchData2();

      const productArticles = document.querySelectorAll('.product-article');

      productArticles.forEach(article => {
        article.addEventListener('click', function () {
          const productId = this.id;
          console.log(`Producto con ID ${productId} ha sido clickeado.`);
          // Crear una etiqueta meta con la propiedad 'http-equiv' para la redirección
          const metaTag = document.createElement('meta');
          metaTag.httpEquiv = 'refresh';
          metaTag.content = '0;url=index.php?page=Product&action=showProduct&code=' + productId;

          document.head.appendChild(metaTag);

        });
      });
  
      // Mostrar el resultado de la segunda promesa
      console.log(result2);
    }
  
    async fetchProducts() {
        return new Promise(async (resolve, reject) => {
            try {
                console.log("Condition:", this.condition);
                console.log("Category:", this.category);
                let response;
                if (this.category !== null) {
                    response = await fetch(`ajax.php?page=Product&action=fetchProducts&condition=${this.condition}&category=${this.category}`);
                } else {
                    response = await fetch(`ajax.php?page=Product&action=fetchProducts&condition=${this.condition}`);
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
                            description: product.description,
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
      this.executeAsyncFunctions();
    }
  }
  
  class ProductSearch extends BaseProductSearch {
    constructor() {
      super();
      this.searchInput = document.querySelector('.search');
      this.sortInput = document.querySelector('#sortInput');
      this.sort = null;
      this.searchInput.addEventListener('change', (event) => {
        console.log("CHANGE event triggered");
        this.condition = event.target.value;
        this.executeAsyncFunctions();
      });
      
      this.searchInput.addEventListener('keyup', (event) => {
          console.log("KEYUP event triggered");
          this.condition = event.target.value;
          this.executeAsyncFunctions();
      });
    
      this.sortInput.addEventListener('change', (event) => {
        this.sort = event.target.value;
        this.executeAsyncFunctions();
      });
    }
  }
  
document.addEventListener('DOMContentLoaded', () => {

  this.categoriesContainer = document.getElementById('categories');
  this.categoriesShown = document.getElementById('categories-show');

  this.categoriesShown.addEventListener('click', () => {
      console.log("Mostrar más/menos categorias");
      $(this.categoriesContainer).toggleClass('show-more-categories');
      $(this.categoriesShown).toggleClass('show-less-categories');
  });
});