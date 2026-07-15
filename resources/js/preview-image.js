document.addEventListener('DOMContentLoaded', function () {
    const inputs = document.querySelectorAll('.img-input');

    if (inputs.length === 0) {
        return;
    }

    inputs.forEach(input => {
        input.addEventListener('change', function () {
            const imgGroup = this.closest('.img-group');
            const preview = imgGroup ? imgGroup.querySelector('.img-preview') : null;

            if (!preview) {
                return;
            }

            preview.innerHTML = '';

            if (this.files && this.files[0]) {
                const file = this.files[0];
                const img = document.createElement('img');
                img.src = URL.createObjectURL(file);
                img.alt = 'Preview';
                img.style.width = '150px';
                img.style.maxWidth = '100%';
                img.style.borderRadius = '8px';
                img.classList.add('img-thumbnail');
                preview.appendChild(img);
            } else {
                preview.innerHTML = '<span class="text-muted-custom">Chưa chọn ảnh</span>';
            }
        });
    });
});
