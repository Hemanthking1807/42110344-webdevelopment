document.addEventListener('DOMContentLoaded', function() {
    const dropdown = document.getElementById('category-dropdown');
    dropdown.addEventListener('change', function() {
        const category = dropdown.value;
        if (category) {
            window.location.href = `Cricket_Show.php?category=${category}`;
        }
    });
});
