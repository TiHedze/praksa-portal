document.addEventListener('DOMContentLoaded', () => {
    const buttons = document.getElementsByTagName("button");
    for (let button of buttons) {
        button.addEventListener('click',)
    }
})

const applyToAd = (event) => {
    if (event.target.disabled === true) {
        return;
    }

    const adId = event.target.parentNode.parentNode.getAttribute('id');
    const userId = event.target.getAttribute('id');

    const request = new Request('./../../index.php?rt=ad/apply', { method: 'POST', body: JSON.stringify({ userId, adId }) });

    fetch(request)
        .then(response => {
            const successAlert = document.createElement('div');
            successAlert.classList.add('alert', 'alert-success', 'd-flex', 'flex-row', 'justify-content-center');
            successAlert.textContent = 'Successfully applied to the job!';
            event.target.parentNode.appendChild(successAlert);
        })
        .catch(err => {
            const errorAlert = document.createElement('div');
            errorAlert.classList.add('alert', 'alert-danger', 'd-flex', 'flex-row', 'justify-content-center');
            errorAlert.textContent = err;
            event.target.parentNode.appendChild(errorAlert);
        });

    return;
}