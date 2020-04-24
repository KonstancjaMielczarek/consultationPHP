const bar = document.querySelector('.fa-bars');
const closeNav = document.querySelector('.fa-times');
const nav = document.querySelector('nav');

bar.addEventListener('click', () => {
    nav.style.top = '0'
    bar.style.display = 'none';
});
closeNav.addEventListener('click', () => {
    nav.style.top = '-50px'
    bar.style.display = 'block';
});