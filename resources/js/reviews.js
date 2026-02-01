document.addEventListener('DOMContentLoaded', function() {
    const stars = document.querySelectorAll('.star');
    const input = $("#estimation");
    var review = null

    stars.forEach(star => {
        star.addEventListener('mouseover', function() {
            const value = this.getAttribute('data-value');
            highlightStars(value);
        });

        star.addEventListener('mouseout', function() {
            resetStars();
        });

        star.addEventListener('click', function() {
            const value = this.getAttribute('data-value');
            setRating(value);
        });
    });

    function highlightStars(value) {
        stars.forEach(star => {
            if (star.getAttribute('data-value') <= value) {
                star.firstChild.src = resouce("/img/system/star.svg");
            } else {
                star.firstChild.src = resouce("/img/system/gray_star.svg");
            }
        });
    }

    function resetStars() {
        stars.forEach(star => {
            if (star.getAttribute('data-value') <= review) {
                star.firstChild.src = resouce("/img/system/star.svg");
            } else {
                star.firstChild.src = resouce("/img/system/gray_star.svg");
            }
        });
    }

    function setRating(val) {
        // Здесь можно добавить логику для сохранения выбранной оценки
        review = val;
        if (input != null) { input.val(review) }
        console.log(`Выбрана оценка: ${val}`);
    }
});