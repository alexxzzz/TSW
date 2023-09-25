const addSwitch = document.querySelector("#addSwitch");
const modalWindow = document.querySelector("#modalWindow");
const close = document.querySelector("#close");
const createSwitch = document.querySelector("#createSwitch");

addSwitch.addEventListener("click", () => {
  modalWindow.classList.add("show");
});

close.addEventListener("click", () => {
  modalWindow.classList.remove("show");
});

createSwitch.addEventListener("click", () => {
  modalWindow.classList.remove("show");
  alert("switch creado");
});
