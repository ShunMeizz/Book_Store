let updatePreviewContainer = document.querySelector(
  ".updates-preview-container"
);
let updatePreviewBoxes =
  updatePreviewContainer.querySelectorAll(".update-preview");

document
  .querySelectorAll(".productlist_container .product")
  .forEach((product) => {
    product.onclick = () => {
      updatePreviewContainer.style.display = "flex";
      let name = product.getAttribute("data-name");
      updatePreviewBoxes.forEach((preview) => {
        let target = preview.getAttribute("data-target");
        if (name === target) {
          preview.style.display = "block";
        } else {
          preview.style.display = "none";
        }
      });
    };
  });

function cancelButton() {
  let updatePreviewContainer = document.querySelector(
    ".updates-preview-container"
  );
  updatePreviewContainer.style.display = "none";
}
