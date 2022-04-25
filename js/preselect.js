// Preselects checkboxes for "Add or Change Sauce" on individual sandwich page

const sandwichInfo = document.getElementsByClassName('woocommerce-product-details__short-description')[0].innerText.toLowerCase();
//const sandwichInfoWords = productInfo.split(' ');

const checkboxes = document.getElementsByClassName('wc-pao-addon-add-or-change-sauce')[0].children;
const checkboxesRemoveFirst = Array.from(checkboxes).slice(1);
//console.log(checkboxesRemoveFirst)

for(var i = 0; i < checkboxesRemoveFirst.length; i++){
    const checkboxesValue = checkboxesRemoveFirst[i].innerText.toLowerCase();
    let compare = sandwichInfo.includes(checkboxesValue);

    if(compare === true) {
        const getInputValue = document.querySelector(`input[value=${checkboxesValue}]`);
        getInputValue.checked = true;
    }
}
