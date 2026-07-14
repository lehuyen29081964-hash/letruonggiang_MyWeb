document.querySelectorAll('.img-input').forEach(input => {
    input.addEventListener('change', function () {
        const imgGroup = this.closest('.img-group');
        const preview = imgGroup.querySelector('.img-preview');
        preview.innerHTML = '';

        if (this.files && this.files[0]) {
            const file = this.files[0];
            const img = document.createElement('img');
            img.src = URL.createObjectURL(file);
            img.style.width = '150px';
            img.style.margin = '5px';
            img.classList.add('img-thumbnail');
            preview.appendChild(img);
        }
    });
});
