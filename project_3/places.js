document.addEventListener('DOMContentLoaded', async function() {
    // Get the container where places will be displayed.
    const placesContainer = document.querySelector('#places');

    // Display a loading message initially until the data is fetched.
    placesContainer.innerHTML = '<p>Loading...</p>';

    // Function to fetch data about places from the API.
    async function fetchPlaces() {
        try {
            const response = await fetch('https://starfruit.champlain.edu/webd330/week6/api/ajax/places/index.php');
            if (!response.ok) {
                throw new Error('Bad Network Response');
            }
            const data = await response.json();
            // Map through the array of places data and return HTML string for each place.
            const placesHTML = data.map(place => `
                <div class="col">
                    <div class="card shadow-sm">
                        <img src="${place.image}" class="card-img-top" alt="${place.loc}">
                        <div class="card-body">
                            <p class="card-text">${place.tagline}</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <small class="text-muted">${place.loc}</small>
                            </div>
                        </div>
                    </div>
                </div>`).join(''); // Join all elements in the array into a single string.
            
            // Insert the HTML into the container to update the page.
            placesContainer.innerHTML = placesHTML;
        } catch (error) {
            // Log any errors to the console and show an error message to the user.
            console.error('Error fetching data: ', error);
            placesContainer.innerHTML = '<p>Error loading places. Please try again!</p>';
        }
    }
  
    // Invoke the function to fetch and render places.
    fetchPlaces();
});