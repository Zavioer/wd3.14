document.querySelectorAll('.message-box').forEach((box) => {
    setTimeout(() => {
        box.classList.add('fade-out');
        setTimeout(() => {
            box.remove();
        }, 500);
    }, 5000);
});

document.querySelectorAll('.m-close-btn').forEach((btn) => {
    btn.addEventListener('click', (event) => {
        let box = event.target.closest('.message-box');
        box.classList.add('fade-out');
        setTimeout(() => {
            box.remove();
        }, 500);
    });
});