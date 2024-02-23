const savedTheme = localStorage.getItem('theme');
const initialTheme = savedTheme || 'light';
localStorage.setItem('theme', initialTheme);

// $(document).ready(function () {
//     $("body").attr('data-bs-theme', initialTheme);
// });