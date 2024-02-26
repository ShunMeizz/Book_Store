/*-----------------------FoR The Preview of Books-----------------------*/
let previewContainer = document.querySelector(".products-preview");
let previewBox = previewContainer.querySelectorAll(".preview");

document
  .querySelectorAll(".productlist_container .product")
  .forEach((product) => {
    product.onclick = () => {
      previewContainer.style.display = "flex";
      let name = product.getAttribute("data-name");
      previewBox.forEach((preview) => {
        let target = preview.getAttribute("data-target");
        if (name == target) {
          preview.classList.add("active");
        }
      });
    };
  });

previewBox.forEach((close) => {
  close.querySelector(".fa-times").onclick = () => {
    close.classList.remove("active");
    previewContainer.style.display = "none";
  };
});

/*-----------------------FoR The Changes of AddedButton-AddtoCartButton and viceversa-----------------------*/
function AddedButton(dataTarget) {
  /*-------------Triggered when we click the AddtoCart Button in our main html-----------*/
  removeAddtoCartButton(dataTarget);
  let addButton = document.createElement("button");
  addButton.textContent = "Added ✔";
  addButton.classList.add("buttons", "button6", "addedbutton");
  addButton.setAttribute("data-target", dataTarget);

  let prevButtonSelector = `.preview[data-target="${dataTarget}"] .prevbutton`;
  let prevButton = document.querySelector(prevButtonSelector);
  prevButton.appendChild(addButton);
  YourCartFunction();
  addItem(dataTarget);
}
function removeAddtoCartButton(dataTarget) {
  let addtocartButtonSelector = `.preview[data-target="${dataTarget}"] .addtocartbutton`;
  let addtocartButton = document.querySelector(addtocartButtonSelector);
  if (addtocartButton) {
    addtocartButton.style.display = "none";
  }
}

function AddtoCartButton(currentDataTarget) {
  /*-------------Triggered when quantity reaches 0, here in our inner html-----------*/
  let addedButtonSelector = `.preview[data-target="${currentDataTarget}"] .addedbutton`;
  let addedButton = document.querySelector(addedButtonSelector);
  if (addedButton) {
    addedButton.remove();
  }
  let tocartSelector = `.preview[data-target="${currentDataTarget}"] .addtocartbutton`;
  let tocartButton = document.querySelector(tocartSelector);
  if (tocartButton) {
    tocartButton.style.display = "flex";
  }
}

function addItem(dataTarget) {
  let addedItemDiv = document.createElement("div");
  addedItemDiv.className = "yourcart_products";

  // Define the item details based on the data-target in our HTML
  let itemDetails = {
    imageSrc: document.querySelector(
      `.preview[data-target="${dataTarget}"] img`
    ).src,
    title: document.querySelector(`.preview[data-target="${dataTarget}"] h3`)
      .textContent,
    price: convertToNumber(
      document.querySelector(`.preview[data-target="${dataTarget}"] .price`)
        .textContent
    ), //convert this to num
  };

  addedItemDiv.innerHTML = `
        <img src="${itemDetails.imageSrc}" alt="${itemDetails.title} cover" />
        <div class="details">
            <span class="title">${itemDetails.title}</span>
            <div class="price">${itemDetails.price.toFixed(2)}</div>
            <div class="quantity"> 
                <button onclick="updateQuantity(-1, this, ${
                  itemDetails.price
                }, '${dataTarget}')">-</button>
                <span class="quantity-value">1</span>
                <button onclick="updateQuantity(1, this, ${
                  itemDetails.price
                }, '${dataTarget}')">+</button>
            </div>
        </div>
    `;
  document.querySelector(".yourcart_list").appendChild(addedItemDiv);
  updateTotal();
}

/*-----------------------FoR The YourCart, Functions inside our YourCart Container-----------------------*/

let yourCartContainer = document.querySelector(".yourcart_container");
yourCartContainer.style.display = "none";
let mainBarContainer = document.querySelector(".mainbar_container");

function YourCartFunction() {
  mainBarContainer.style.width = "85%";
  yourCartContainer.style.display = "flex";
  yourCartContainer.style.position = "fixed";
}

document.querySelector(".fa-times").onclick = () => {
  yourCartContainer.style.display = "none";
  mainBarContainer.style.width = "100%";
};

//attempts to convert the cleaned string to a number
function convertToNumber(value) {
  return Number(value.replace(/[^\d.]/g, ""));
}

/* I attempt to have initialPrice as a parameter rather than var within the updateQuantity func
    to ensure that each book retains its specific initial price*/

function updateQuantity(change, button, initialPrice, currentDataTarget) {
  let quantityContainer = button.parentElement; //reference to the parent element
  let quantityValue = quantityContainer.querySelector(".quantity-value");
  let priceValue = quantityContainer.parentElement.querySelector(".price");
  let addedItemDiv = quantityContainer.parentElement.parentElement; //base sa innerHTML, quantity->details->addedItemDiv

  let currentQuantity = parseInt(quantityValue.textContent);
  let newQuantity = Math.max(0, currentQuantity + change);

  //When Quantity reaches zero, we remove the addedItemDiv and reset the Added button to addToCart button
  if (newQuantity === 0) {
    addedItemDiv.remove();
    AddtoCartButton(currentDataTarget);
    console.log("Data target: ", currentDataTarget);
  }
  quantityValue.textContent = newQuantity;

  let newPrice = newQuantity * initialPrice;
  console.log("New Quantity: ", newQuantity);
  console.log("Initial Price: ", initialPrice);
  console.log("New Price: ", newPrice);
  priceValue.textContent = newPrice.toFixed(2);
  updateTotal();
}
function updateTotal() {
  let totalValue = document.querySelector(".total");
  let allPrices = document.querySelectorAll(".yourcart_products .price");
  let total = Array.from(allPrices).reduce((sum, priceElement) => {
    return sum + convertToNumber(priceElement.textContent);
  }, 0);
  totalValue.textContent = total.toFixed(2);
}
