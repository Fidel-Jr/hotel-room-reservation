document.addEventListener('DOMContentLoaded', function() {
    const stars = document.querySelectorAll('.star');
    const ratingValue = document.getElementById('rating');
    const input = document.getElementById('input-rating');
    let currentRating = 0;

    stars.forEach(star => {
        star.addEventListener('click', setRating);
        star.addEventListener('mouseover', addHoverEffect);
        star.addEventListener('mouseout', removeHoverEffect);
    });

    function setRating(e) {
        currentRating = e.target.getAttribute('data-value');
        ratingValue.innerText = currentRating;
        input.value = currentRating;
        stars.forEach(star => {
            star.classList.remove('selected');
            if(star.getAttribute('data-value') <= currentRating) {
                star.classList.add('selected');
            }
        });
    }

    function addHoverEffect(e) {
        stars.forEach(star => {
            star.classList.remove('hover');
            if(star.getAttribute('data-value') <= e.target.getAttribute('data-value')) {
                star.classList.add('hover');
            }
        });
    }

    function removeHoverEffect() {
        stars.forEach(star => {
            star.classList.remove('hover');
        });
    }
});