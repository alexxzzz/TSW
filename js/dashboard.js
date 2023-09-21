const addSwitch = document.querySelector('#addSwitch');
const modalWindow = document.querySelector('#modalWindow');
const close = document.querySelector('#close');


addSwitch.addEventListener('click', () => {
    modalWindow.classList.add('show');
});

close.addEventListener('click', () => {
    modalWindow.classList.remove('show');
});