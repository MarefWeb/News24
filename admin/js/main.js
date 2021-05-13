let createForm = document.querySelector('#createForm');
let editForm = document.querySelector('#editForm');

document.addEventListener('click', (e) => {
    const target = e.target;

    if (target.classList.contains('editBtn')) {
        let idField = editForm.querySelector('.id');
        let titleField = editForm.querySelector('.news-title');
        let textField = editForm.querySelector('.text');
        let categoryFields = editForm.querySelectorAll('input[name="category"]');
        let tagsField = editForm.querySelector('.tags');

        let tr = target.parentNode.parentNode.parentNode;
        let id = tr.querySelector('.id').innerText;
        let title = tr.querySelector('.news-title').innerText;
        let text = tr.querySelector('.text').innerText;
        let category = tr.querySelector('.category').innerText;
        let tags = tr.querySelector('.tags').innerText;

        idField.value = id;
        titleField.value = title;
        textField.value = text;
        tagsField.value = tags;

        categoryFields.forEach(el => {
            console.log(`${el.value} == ${category}`);
            if(el.value == category) {
                el.checked = true;
                console.log(el);
            }
        });

        editForm.classList.add('active');
        smoothScroll(target.dataset.target);
    }

    if(target.classList.contains('manage-btn')) {
        const manageTargetId = target.dataset.target;
        const manageTarget = document.querySelector(`#${manageTargetId}`);

        target.classList.toggle('active');
        manageTarget.classList.toggle('active');
    }
});

function smoothScroll(id) {
    let target = document.querySelector(`#${id}`);

    window.scroll({
        left: 0,
        top: target.offsetTop,
        behavior: 'smooth',
    });
}

function emptyCheck(field) {
    if (field.value === '') {
        field.classList.add('field_error');
        return true;
    } else {
        field.classList.remove('field_error');
        return false;
    }
}
