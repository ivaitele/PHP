
const headerLogoConatiner = document.querySelector('.main-header__logo-container')

headerLogoConatiner.addEventListener('click', () => {
    location.href = '../src/html/persons.html'
})


document.addEventListener('DOMContentLoaded', function() {
    var elems = document.querySelectorAll('.tooltipped');
    var instances = M.Tooltip.init(elems);
});