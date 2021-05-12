window.addEventListener('DOMContentLoaded', () => {
    const nav = document.querySelector('#nav');
    const prenav = document.querySelector('#prenav');

    window.addEventListener('scroll', () => {
        if (prenav.getBoundingClientRect().top <= 0 && !nav.classList.contains('fixed')) nav.classList.add('fixed');
        else if (prenav.getBoundingClientRect().top > 0 && nav.classList.contains('fixed'))
            nav.classList.remove('fixed');
    });

    document.addEventListener('click', (e) => {
        const target = e.target;

        if(target.classList.contains('content-btn')) {
            e.preventDefault();
            target.classList.toggle('active');
        }
    });
});
