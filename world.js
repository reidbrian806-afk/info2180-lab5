document.addEventListener('DOMContentLoaded', () => {
    const countryInput = document.getElementById('country');
    const lookupBtn    = document.getElementById('lookup');
    const citiesBtn    = document.getElementById('lookup-cities');
    const resultDiv    = document.getElementById('result');

    // Exercise 3 — Lookup countries
    lookupBtn.addEventListener('click', () => {
        const country = countryInput.value;
        fetch(`world.php?country=${encodeURIComponent(country)}`)
            .then(response => response.text())
            .then(data => { resultDiv.innerHTML = data; })
            .catch(err => { resultDiv.innerHTML = "Error: " + err; });
    });

    // Exercise 5 — Lookup cities
    citiesBtn.addEventListener('click', () => {
        const country = countryInput.value;
        fetch(`world.php?country=${encodeURIComponent(country)}&lookup=cities`)
            .then(response => response.text())
            .then(data => { resultDiv.innerHTML = data; })
            .catch(err => { resultDiv.innerHTML = "Error: " + err; });
    });
});