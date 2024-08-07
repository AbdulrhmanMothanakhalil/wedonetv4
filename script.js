// Function to handle form submission
document.getElementById('userForm')?.addEventListener('submit', function(event) {
    event.preventDefault();
    
    // Get form values
    const name = document.getElementById('name').value;
    const email = document.getElementById('email').value;
    
    // Save to localStorage
    localStorage.setItem('name', name);
    localStorage.setItem('email', email);
    
    // Redirect to dashboard
    window.location.href = 'index.html';
});

// Function to display data on the dashboard
window.onload = function() {
    const name = localStorage.getItem('name');
    const email = localStorage.getItem('email');
    
    if (name && email) {
        document.getElementById('nameDisplay').textContent = name;
        document.getElementById('emailDisplay').textContent = email;
    }
};
