let form = document.querySelector("#product_form");
let cancelBtn = document.getElementById("cancel");


cancelBtn.onclick = function () {
    window.location.href = "../";
};


// create book-details element
let bookDetails = document.createElement("div");
bookDetails.classList.add("details" , "book-details");
bookDetails.innerHTML = `<label for="weight">weight (KG)</label>
                        <input type="number" name="weight" id="weight" onblur="validateWeight()">`;
let bookMessage = document.createElement("p");
bookMessage.innerHTML = "please, provide weight";

// create furniture-details element
let furnitureDetails = document.createElement("div");
furnitureDetails.classList.add( "details", "furniture-details");
furnitureDetails.innerHTML = `<div class="width">
                                    <label for="width">width (CM)</label>
                                    <input type="number" name="width" id="width" onblur="validateWidth()">
                                </div>
                                <div class="height">
                                    <label for="height">height (CM)</label>
                                    <input type="number" name="height" id="height" onblur="validateHeight()">
                                </div>
                                <div class="length">
                                    <label for="length">length (CM)</label>
                                    <input type="number" name="length" id="length" onblur="validateLength()">
                                </div>`;
let furnitureMessage = document.createElement("p");
furnitureMessage.innerHTML = "please, provide dimensions";

// create DVD-details element
let DVDDetails = document.createElement("div");
DVDDetails.classList.add("details", "DVD-details");
DVDDetails.innerHTML = `<label for="size">size (MB)</label>
                        <input type="number" name="size" id="size" onblur="validateSize()">`;
let DVDMessage = document.createElement("p");
DVDMessage.innerHTML = "please, provide size";

let select = document.querySelector("select");

window.onload = function () {
    select.value = "";
};

select.onchange = function (){

    // remove type-message if exists
    if(document.querySelector("form p")){
        document.querySelector("form p").remove(); 
    }

    // remove DVD-details element if exist
    if(document.querySelector(".DVD-details")){
        document.querySelector(".DVD-details").remove();
    }
    // remove DVD-details element if exist
    if(document.querySelector(".furniture-details")){
        document.querySelector(".furniture-details").remove();
    }
    // remove DVD-details element if exist
    if(document.querySelector(".book-details")){
        document.querySelector(".book-details").remove();
    }
    // check if the selected type is book 
    if(select.value === "Book"){
        // append book-details element
        form.appendChild(bookDetails);
        form.appendChild(bookMessage);
    }
    // check if the selected type is furniture 
    if(select.value === "Furniture"){
        // append furniture-details element
        form.appendChild(furnitureDetails);
        form.appendChild(furnitureMessage);
    }
    // check if the selected type is DVD 
    if(select.value === "DVD"){
        // append DVD-details element
        form.appendChild(DVDDetails);
        form.appendChild(DVDMessage);
    }
};



// start validation 

let inputsErrors = []; // array to store the input that has error

// function to check if the input is not empty
function required( input , message){
    if(input.value === ""){
        inputsErrors.push(`${input.id}`) // there is error -> push the input to the inputs-errors array 
        // create error span to display
        let error = document.createElement("span"); 
        error.classList.add("error");
        error.innerHTML = `${input.id} ${message}`;
        input.parentElement.appendChild(error);
    }
}

// function to check if the input is number
function numeric(input , message){

    if(isNaN(input.value)){
        inputsErrors.push(`${input.id}`) // there is error -> push the input to the inputs-errors array 
        // create error span to display
        let error = document.createElement("span");
        error.classList.add("error");
        error.innerHTML = `${input.id} ${message}`;
        input.parentElement.appendChild(error);
    }
}

// function to check if the input is unique
function unique(input , prohibited_values, message){
    if(prohibited_values.includes(input.value)){
        inputsErrors.push(`${input.id}`); // there is error -> push the input to the inputs-errors array 
        // create error span to display
        let error = document.createElement("span");
        error.classList.add("error");
        error.innerHTML = `${input.id} ${message}`;
        input.parentElement.appendChild(error);
    }
}

// function to validate sku input
function validateSku(){

    // if error span exists -> remove it -> then start validation again
    if(document.querySelector(".sku .error")){
        document.querySelector(".sku .error").remove();
        let index = inputsErrors.indexOf("sku");  // remove input from inputsErrors array
        inputsErrors.splice(index , 1);
    }
    // start validation
    let skuInput = document.getElementById("sku");
    required(skuInput , "is required");
    unique(skuInput , allSku , "must be unique");

}

// function to validate name input
function validateName(){

    // if error span exists -> remove it -> then start validation again
    if(document.querySelector(".name .error")){
        document.querySelector(".name .error").remove();
        let index = inputsErrors.indexOf("name");  // remove input from inputsErrors array
        inputsErrors.splice(index , 1);
    }
    // start validation
    let nameInput = document.getElementById("name");
    required(nameInput , "is required");
}

// function to validate price input
function validatePrice(){

    // if error span exists -> remove it -> then start validation again
    if(document.querySelector(".price .error")){
        document.querySelector(".price .error").remove();
        let index = inputsErrors.indexOf("price");  // remove input from inputsErrors array
        inputsErrors.splice(index , 1);
    }
    // start validation
    let priceInput = document.getElementById("price");
    required(priceInput , "is required");
    numeric(priceInput , "must be number");
}

// function to validate type input
function validateType(){

    // if error span exists -> remove it -> then start validation again
    if(document.querySelector(".type .error")){
        document.querySelector(".type .error").remove();
        let index = inputsErrors.indexOf("type");   // remove input from inputsErrors array
        inputsErrors.splice(index , 1);
    }
    // start validation
    let typeInput = document.getElementById("productType");
    required(typeInput , "is required");
}

// function to validate weight input
function validateWeight(){

    if(document.getElementById("weight")){
        // if error span exists -> remove it -> then start validation again
        if(document.querySelector(".details .error")){
            document.querySelector(".details .error").remove();
            let index = inputsErrors.indexOf("weight");  // remove input from inputsErrors array
            inputsErrors.splice(index , 1);
        }
        // start validation
        let weightInput = document.getElementById("weight");
        required(weightInput , "is required");
        numeric(weightInput , "must be number");
    }
}

// function to validate size input
function validateSize(){

    if(document.getElementById("size")){
        // if error span exists -> remove it -> then start validation again
        if(document.querySelector(".details .error")){
            document.querySelector(".details .error").remove();
            let index = inputsErrors.indexOf("size");  // remove input from inputsErrors array
            inputsErrors.splice(index , 1);
        }
        // start validation
        let sizeInput = document.getElementById("size");
        required(sizeInput , "is required");
        numeric(sizeInput , "must be number");

    }
}

// function to validate width input
function validateWidth(){

    if(document.getElementById("width")){
        // if error span exists -> remove it -> then start validation again
        if(document.querySelector(".width .error")){
            document.querySelector(".width .error").remove();
            let index = inputsErrors.indexOf("width");   // remove input from inputsErrors array
            inputsErrors.splice(index , 1);
        }
        // start validation
        let widthInput = document.getElementById("width");
        required(widthInput , "is required");
        numeric(widthInput , "must be number");

    }
}

// function to validate length input
function validateLength(){

    if(document.getElementById("length")){
        // if error span exists -> remove it -> then start validation again
        if(document.querySelector(".length .error")){
            document.querySelector(".length .error").remove();
            let index = inputsErrors.indexOf("length");   // remove input from inputsErrors array
            inputsErrors.splice(index , 1);
        }
        // start validation
        let lengthInput = document.getElementById("length");
        required( lengthInput , "is required");
        numeric(lengthInput , "must be number");
    }
}

// function to validate height input
function validateHeight(){

    if(document.getElementById("height")){
        // if error span exists -> remove it -> then start validation again
        if(document.querySelector(".height .error")){
            document.querySelector(".height .error").remove();
            let index = inputsErrors.indexOf("height");  // remove input from inputsErrors array
            inputsErrors.splice(index , 1);
        }
        // start validation
        let heightInput = document.getElementById("height");
        required(heightInput , "is required");
        numeric(heightInput , "must be number");
    }
}


let saveBtn = document.getElementById("save");
saveBtn.onclick = function () {

    // check input validation after save button clicked
    validateSku();
    validateName();
    validatePrice();
    validateType();
    validateWeight();
    validateSize();
    validateWidth();
    validateHeight();
    validateLength();

    // if no inputs errors after validation -> submit form
    if(inputsErrors.length === 0 ){
        form.submit();
    }
}