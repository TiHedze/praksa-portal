document.addEventListener('DOMContentLoaded', () => {
    const buttons = document.getElementsByTagName("button");
    for (let button of buttons) {
        button.addEventListener('click', applyToAd)
    }
})

const applyToAd = async (event) => {
    if (event.target.disabled === true) {
        return;
    }

    const adId = event.target.parentNode.parentNode.getAttribute('id');
    const userId = event.target.getAttribute('value');

    const request = new Request('./index.php?rt=ad/apply', { method: 'POST', body: JSON.stringify({ userId, adId }) });

    fetch(request)
        .then(async(response) => {
            //console.log(response.json());
            if( response.status !== 200)
            {
                const errorAlert = document.createElement('div');
                errorAlert.classList.add('alert', 'alert-danger', 'd-flex', 'flex-row', 'justify-content-center');
                errorAlert.textContent = await response.json().then(data => data.error);
                event.target.parentNode.appendChild(errorAlert);
            }
            else
            {
                const successAlert = document.createElement('div');
                successAlert.classList.add('alert', 'alert-success', 'd-flex', 'flex-row', 'justify-content-center');
                successAlert.textContent = 'Successfully applied to the job!';
                event.target.parentNode.appendChild(successAlert);
            }
        })
        .catch(err => {
            const errorAlert = document.createElement('div');
            errorAlert.classList.add('alert', 'alert-danger', 'd-flex', 'flex-row', 'justify-content-center');
            errorAlert.textContent = err;
            event.target.parentNode.appendChild(errorAlert);
        });

    return;
}