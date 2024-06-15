const clientSelect = document.querySelector('#client-select');

function loadClientData() {
    const selectedClient = clientSelect.options[clientSelect.selectedIndex];
    const id = selectedClient.value;

    const firstNameField = document.querySelector('input[name="first-name"]');
    const lastNameField = document.querySelector('input[name="last-name"]');
    const cityField = document.querySelector('input[name="city"]');
    const streetField = document.querySelector('input[name="street"]');
    const houseNumberField = document.querySelector('input[name="house-number"]');
    const postalCodeField = document.querySelector('input[name="postal-code"]');
    const phoneField = document.querySelector('input[name="phone"]');
    const emailField = document.querySelector('input[name="email"]');

    if (id === '') {
        return;
    }
    
    fetch(`/clientDetail/${id}?type=json`
    ).then((response) => {
        return response.json();
    }).then(data => {
        firstNameField.value = data.firstName;
        lastNameField.value = data.lastName;
        cityField.value = data.city;
        streetField.value = data.street;
        houseNumberField.value = data.houseNumber;
        postalCodeField.value = data.postalCode;
        phoneField.value = data.phone;
        emailField.value = data.email;
    });
}

clientSelect.addEventListener('change', loadClientData);