

    
const addPortfolio = document.getElementById('addPortfolio');
addPortfolio.addEventListener('click', showModalPortfolio);

const deleteModalPortfolio = document.getElementsByName('deletePortfolio');
console.log(deleteModalPortfolio);
deleteModalPortfolio.forEach((item) => {
    item.addEventListener('click', showModalDeletePortfolio);
});

function showModalPortfolio() {
    const modal = document.getElementById('modalPortfolio');
    modal.style.display = 'unset';

    const modalClose = document.getElementById('closeModalPortfolio');
    modalClose.addEventListener('click', closeModalPortfolio);
}
function closeModalPortfolio() {
    const modal = document.getElementById('modalPortfolio');
    modal.style.display = 'none';
}

function showModalDeletePortfolio() {
    const modal = this.attributes[1].value;
    const modalDeletePortfolio = document.getElementById(modal);
    modalDeletePortfolio.style.display = 'unset';

    const modalClose = document.getElementsByName('closeModalDeletePortfolio');
    modalClose.forEach((item) => {
        item.addEventListener('click', closeModalDeletePortfolio);
    });
}
function closeModalDeletePortfolio() {
    const modals = document.getElementsByName('modalDeletePortfolio');
    modals.forEach((item) => {
        item.style.display = 'none';
    });
}