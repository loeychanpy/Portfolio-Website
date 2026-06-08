// Card lift animation
document.querySelectorAll('.card-lift').forEach(function (card) {
    card.addEventListener('mouseenter', function () {
        card.style.transform  = 'translateY(-2px)';
        card.style.transition = 'transform 0.3s cubic-bezier(0.4,0,0.2,1)';
    });
    card.addEventListener('mouseleave', function () {
        card.style.transform = 'translateY(0)';
    });
});

// Gallery image preview
var imageInput = document.getElementById('imageInput');
if (imageInput) {
    imageInput.addEventListener('change', function () {
        var file = this.files[0];
        var box  = document.getElementById('previewBox');
        var img  = document.getElementById('previewImg');
        var name = document.getElementById('previewName');
        if (file) {
            var reader = new FileReader();
            reader.onload = function (e) {
                img.src          = e.target.result;
                name.textContent = file.name + ' (' + (file.size / 1024).toFixed(1) + ' KB)';
                box.classList.remove('hidden');
                box.classList.add('flex');
            };
            reader.readAsDataURL(file);
        } else {
            box.classList.add('hidden');
            box.classList.remove('flex');
        }
    });
}
