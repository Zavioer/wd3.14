const clientSelect = document.querySelector('#client-select');
console.log(clientSelect);

function loadClientData() {
    const selectedClient = clientSelect.options[clientSelect.selectedIndex];
    const id = selectedClient.value;
    console.log(selectedClient.value);

    const clientIdField = document.querySelector('input[name="client-id"');
    const firstNameField = document.querySelector('input[name="first-name"]');
    const lastNameField = document.querySelector('input[name="last-name"]');
    const cityField = document.querySelector('input[name="city"]');
    const streetField = document.querySelector('input[name="street"]');
    const houseNumberField = document.querySelector('input[name="house-number"]');
    const postalCodeField = document.querySelector('input[name="postal-code"]');

    if (id === '') {
        return;
    }
    
    fetch(`/clientDetail/${id}?type=json`
    ).then((response) => {
        return response.json();
    }).then(data => {
        console.log(data);
        console.log(data.first_name)
        firstNameField.value = data.first_name;
        lastNameField.value = data.last_name;
        cityField.value = data.city;
        streetField.value = data.street;
        houseNumberField.value = data.house_number;
        postalCodeField.value = data.postal_code;

        clientIdField.value = data.id;
    });
}

clientSelect.addEventListener('change', loadClientData);