const searchInput = document.querySelector('.search');
const itemsContainer = document.querySelector('.itemsContainer');
searchInput.addEventListener('change', displayMatches);
searchInput.addEventListener('keyup', displayMatches);

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
        const inWishlist = element.productPrice == false ? "defaultHeart.png" : "inWishlist.png";
        const productImage = element.productPrice.replace(regex, `${this.value}`);
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