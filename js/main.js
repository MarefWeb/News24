window.addEventListener('DOMContentLoaded', () => {
    const nav = document.querySelector('#nav');
    const prenav = document.querySelector('#prenav');

    const editBtn = document.querySelector('#edit-btn span');
    const editForm = document.querySelector('#edit-form');
    const newsForHide = document.querySelector('#news-for-hide');

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

        if(target.classList.contains('edit-btn')) {
            editBtn.classList.toggle('active');

            editBtn.innerText = editBtn.classList.contains('active') ? "Відмінити" : "Редагувати";

            editForm.classList.toggle('hidden');
            resizeTextareas();
            newsForHide.classList.toggle('hidden');
        }
    });
});

function resizeTextareas() {
    const textareas = document.querySelectorAll('textarea');
    
    textareas.forEach(el => {
        el.style.height = "1px";
        el.style.height = (2 + el.scrollHeight)+"px";
    });
}