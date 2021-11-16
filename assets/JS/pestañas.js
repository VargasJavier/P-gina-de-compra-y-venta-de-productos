let content = document.querySelectorAll('.main');
let list = document.querySelectorAll('.containerBar li');

function activarLink() {
    list.forEach((item) =>
        item.classList.remove('hovered'));
    this.classList.add('hovered');
}
list.forEach((item) =>
    item.addEventListener('click', activarLink));