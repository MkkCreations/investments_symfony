/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import './styles/app.scss';

// start the Stimulus application
import './bootstrap';


const buttonBalance = document.getElementById('buttonBalance');
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