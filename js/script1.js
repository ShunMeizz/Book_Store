/*---------------------Header UserBox------------------------*/
let userBox = document.querySelector(".header .header-2 .user-box");

document.querySelector("#user-btn").onclick = () => {
  userBox.classList.toggle("active");
  navbar.classList.remove("active");
};

let navbar = document.querySelector(".header .header-2 .navbar");

document.querySelector("#menu-btn").onclick = () => {
  navbar.classList.toggle("active");
  userBox.classList.remove("active");
};
document.querySelector(".header .header-2").classList.add("active");

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
  updateTotal();
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

/*function addItem(dataTarget) {
  updateTotal();
}*/

/*-----------------------FoR The YourCart, Functions inside our YourCart Container-----------------------*/

let yourCartContainer = document.querySelector(".yourcart_container");
yourCartContainer.style.display = "none";
let mainBarContainer = document.querySelector(".mainbar_container");

function YourCartFunction() {
  mainBarContainer.style.width = "83%";
  yourCartContainer.style.display = "flex";
  yourCartContainer.style.position = "fixed";
  localStorage.setItem("yourCartContainer", "open");
}
document.addEventListener("DOMContentLoaded", function () {
  var cartState = localStorage.getItem("cartState");
  if (cartState === "open") {
    // If the cart state is 'open', display the cart container
    mainBarContainer.style.width = "83%";
    yourCartContainer.style.display = "flex";
    yourCartContainer.style.position = "fixed";
  }
});

document.querySelector(".fas.fa-window-close").onclick = () => {
  yourCartContainer.style.display = "none";
  mainBarContainer.style.width = "100%";
  document.querySelector("#order-overlay-container").style.display = "none";
};

//attempts to convert the cleaned string to a number
function convertToNumber(value) {
  return Number(value.replace(/[^\d.]/g, ""));
}

function updateQuantity(change, quantity, cartID, initialPrice) {
  let parentElement = event.target.parentElement.parentElement; // Get the parent element of the quantity container
  let quantityValue = parentElement.querySelector(".quantity-value");
  let priceValue = parentElement.querySelector(".price");

  let currentQuantity = parseInt(quantityValue.textContent);
  let newQuantity = Math.max(0, currentQuantity + change);

  // When Quantity reaches zero, delete the item from the database and remove the yourcart_products element
  if (newQuantity === 0) {
    document.getElementById("delete_form_" + cartID).submit();
  } else {
    quantityValue.textContent = newQuantity;
    let newTotalCost = newQuantity * initialPrice;
    priceValue.textContent = newTotalCost.toFixed(2);
    updateTotal();

    // Send AJAX request to update quantity in the database
    fetch("cart.php", {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify({
        cartID: cartID,
        newQuantity: newQuantity,
        cost: initialPrice,
      }),
    })
      .then((response) => {
        if (!response.ok) {
          throw new Error("Network response was not ok");
        }
        return response.text();
      })
      .then((data) => {
        console.log(data);
      })
      .catch((error) => {
        console.error("A problem with fetch operation:", error);
      });
  }
}

let itemCount;
let itemCountValue;
let total_payment;

function updateTotal() {
  let totalValue = document.querySelector(".total");
  let allPrices = document.querySelectorAll(".yourcart_products .price");
  let total = Array.from(allPrices).reduce((sum, priceElement) => {
    return sum + convertToNumber(priceElement.textContent);
  }, 0);
  totalValue.textContent = total.toFixed(2);
  /*if (totalValue != 0) {
    // Store the total value in local storage, para inig refresh ma retain ra
    localStorage.setItem("totalValue", total.toFixed(2));
  }*/
  itemCount = allPrices.length;
  total_payment = total;
}
//Ensuring that the current totalValue will be displayed even though the page reloads
/*window.addEventListener("load", () => {
  let storedTotalValue = localStorage.getItem("totalValue");
  if (storedTotalValue) {
    document.querySelector(".total").textContent = storedTotalValue; //in the total portion in YourCart area sidebar
    document.querySelector(".subtotal-amount").textContent = storedTotalValue; //in the total portion in Order Summary
  }
});*/

/*-----------------------FoR Order Section-----------------------*/
function setOrderCheckout() {
  document.querySelector("#order-overlay-container").style.display = "block";
  //item count
  itemCountValue = document.querySelector(".item-number");
  itemCountValue.textContent = itemCount;

  //net order subtotal
  payment = document.querySelector(".subtotal-amount");
  payment.textContent = total_payment;

  //total
  let final_amount = total_payment + 80;
  let total = document.querySelector(".order-summary-total");
  total.textContent = final_amount;

  document.getElementById("total_payment_amount").value = final_amount;
}

function cancelOrder() {
  document.querySelector("#order-overlay-container").style.display = "none";
}

/*-----------------------To Change Autofill Address in Order Section to Fillable-----------------------*/
function addAddress() {
  let oldAddressElements = document.querySelectorAll(
    ".address-autofill-row1, .address-autofill-row2"
  );
  oldAddressElements.forEach(function (element) {
    element.style.display = "none";
  });
  let newAddressElements = document.querySelectorAll(
    ".address-new-row1, .address-new-row2"
  );
  newAddressElements.forEach(function (element) {
    element.style.display = "flex";
  });
  let addNewAddressButton = document.querySelector(".newAddress");
  if (addNewAddressButton) {
    addNewAddressButton.remove();
  }
  let btnSave = document.querySelector('.buttons.button3[name="btnSave"]');
  btnSave.style.visibility = "visible";
}
