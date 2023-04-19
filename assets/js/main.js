let addBtn = document.getElementById("add");
let deleteBtn = document.getElementById("delete-product-btn");
let deleteForm = document.getElementById("delete_form");


addBtn.onclick = function () {
    window.location.href = "add-product";
};

deleteBtn.onclick = function (){
    deleteForm.submit();
}