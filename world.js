document.addEventListener('DOMContentLoaded', () => {
    const countryInput = document.getElementById('country');
    const lookupBtn    = document.getElementById('lookup');
    const citiesBtn    = document.getElementById('lookup-cities');
    const resultDiv    = document.getElementById('result');

    function fetchData(url) {
        fetch(url)
            .then(response => response.text())
            .then(data => {
                resultDiv.innerHTML = data;
            })
            .catch(err => {
                resultDiv.innerHTML = "<p style='color:red;'>Error: " + err + "</p>";
            });
    }

    lookupBtn.addEventListener('click', () => {
        const country = countryInput.value;
        fetchData(`world.php?country=${encodeURIComponent(country)}`);
    });

    citiesBtn.addEventListener('click', () => {
        const country = countryInput.value;
        fetchData(`world.php?country=${encodeURIComponent(country)}&lookup=cities`);
    });
});