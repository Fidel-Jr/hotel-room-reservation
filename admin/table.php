<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Star Rating</title>
    <link rel="stylesheet" href="styles.css">

<style>
    .rating {
    display: flex;
    direction: row-reverse;
    justify-content: center;
}

.star {
    font-size: 2rem;
    color: #ddd;
    cursor: pointer;
    transition: color 0.2s;
}

.star:hover,
.star:hover ~ .star {
    color: gold;
}

.star.selected,
.star.selected ~ .star {
    color: gold;
}

#rating-value {
    margin-top: 1rem;
    font-size: 1.5rem;
}
</style>

</head>
<body>
    <div class="rating">
        <span class="star" data-value="5">&#9733;</span>
        <span class="star" data-value="4">&#9733;</span>
        <span class="star" data-value="3">&#9733;</span>
        <span class="star" data-value="2">&#9733;</span>
        <span class="star" data-value="1">&#9733;</span>
    </div>
    <div id="rating-value"></div>
    <!-- <input type="text" id="value-rating"> -->
    <script src="script.js"></script>
</body>
</html>

<script>

document.addEventListener('DOMContentLoaded', () => {
    const stars = document.querySelectorAll('.star');
    const ratingValue = document.getElementById('rating-value');
    // const value = document.getElementById('value-rating');
    let selectedRating = 0;

    stars.forEach(star => {
        star.addEventListener('click', () => {
            selectedRating = star.getAttribute('data-value');
            ratingValue.textContent = `You rated this ${selectedRating} out of 5 stars.`;
            // value.value = selectedRating;

            stars.forEach(s => s.classList.remove('selected'));
            star.classList.add('selected');
            let prevSibling = star.previousElementSibling;
            while (prevSibling) {
                prevSibling.classList.add('selected');
                prevSibling = prevSibling.previousElementSibling;
            }

        });
    });
});

</script>