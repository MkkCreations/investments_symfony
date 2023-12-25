

const buttonBalance = document.getElementById('addBalance');
buttonBalance.addEventListener('click', showModalBalance);

function showModalBalance() {
    const modal = document.getElementById('modalBalance');
    console.log('show modal');
    modal.style.display = 'unset';

    const modalClose = document.getElementById('closeModalBalance');
    modalClose.addEventListener('click', closeModalBalance);
}

function closeModalBalance() {
    const modal = document.getElementById('modalBalance');
    modal.style.display = 'none';
}