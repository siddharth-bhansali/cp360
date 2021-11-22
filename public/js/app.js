// Logout Button
const logoutBtn = document.getElementById('logout-button'),
    logoutForm = document.getElementById('logout-form');

if(logoutBtn && logoutForm) {
    logoutBtn.addEventListener('click', (event) => {
        event.preventDefault();
        logoutForm.submit()
    });
}
