class Slider {
    constructor(containerId, slidesInWindow1 = 1, width_threshold = 500, slidesInWindow2 = 1) {
        this.container = document.getElementById(containerId);

        // Проверка, найден ли контейнер
        if (!this.container) {
            console.error(`Контейнер с id "${containerId}" не найден.`);
            return;
        }

        this.slides = this.container.querySelector('.slides');
        this.prevButton = this.container.querySelector('.prev');
        this.nextButton = this.container.querySelector('.next');

        // Проверка, найдены ли элементы внутри контейнера
        if (!this.slides || !this.prevButton || !this.nextButton) {
            console.error('Не удалось найти элементы слайдера внутри контейнера.');
            return;
        }

        this.slidesInWindow1 = slidesInWindow1;
        this.slidesInWindow2 = slidesInWindow2;
        this.widthThreshold = width_threshold;
        this.actualSlidesInWindow = this.slidesInWindow1;
        this.slideCount = this.slides.children.length;
        this.currentIndex = 0;
        this.startX = 0; // Начальная позиция касания
        this.currentX = 0; // Текущая позиция касания
        this.isDragging = false; // Флаг, указывающий, происходит ли перетаскивание

        this.prevButton.addEventListener('click', () => this.prevSlide());
        this.nextButton.addEventListener('click', () => this.nextSlide());

        // Добавляем обработчики для свайпа
        this.slides.addEventListener('touchstart', (e) => this.handleTouchStart(e));
        this.slides.addEventListener('touchmove', (e) => this.handleTouchMove(e));
        this.slides.addEventListener('touchend', () => this.handleTouchEnd());
    }

    handleTouchStart(e) {
        this.startX = e.touches[0].clientX; // Запоминаем начальную позицию касания
        this.currentX = this.startX;
        this.isDragging = true;
    }

    handleTouchMove(e) {
        if (!this.isDragging) return;

        this.currentX = e.touches[0].clientX; // Обновляем текущую позицию касания
        const diff = this.currentX - this.startX; // Разница между начальной и текущей позицией

        // Применяем смещение к слайдам
        const offset = -this.currentIndex * 100 + (diff / this.container.offsetWidth) * 100;
        this.slides.style.transform = `translateX(${offset}%)`;
    }

    handleTouchEnd() {
        if (!this.isDragging) return;

        this.isDragging = false;
        const diff = this.currentX - this.startX; // Разница между начальной и конечной позицией
        const threshold = this.container.offsetWidth * 0.2; // Порог для смены слайда (20% ширины контейнера)

        if (diff > threshold) {
            // Свайп вправо -> предыдущий слайд
            this.prevSlide();
        } else if (diff < -threshold) {
            // Свайп влево -> следующий слайд
            this.nextSlide();
        } else {
            // Возвращаемся к текущему слайду
            this.updateSlider();
        }
    }

    prevSlide() {
        if (this.currentIndex > 0) {
            this.currentIndex--;
        } else {
            this.currentIndex = this.slideCount - this.actualSlidesInWindow; // Переход к последнему слайду
        }
        this.updateSlider();
    }

    nextSlide() {
        if (this.currentIndex < this.slideCount - this.actualSlidesInWindow) {
            this.currentIndex++;
        } else {
            this.currentIndex = 0; // Переход к первому слайду
        }
        this.updateSlider();
    }

    updateSlider() {
        this.updateSlidesInWindow()
        const offset = -this.currentIndex * (100 / this.actualSlidesInWindow);
        this.slides.style.transform = `translateX(${offset}%)`;
    }

    updateSlidesInWindow() {
        if (this.container.offsetWidth < this.widthThreshold) {
            this.actualSlidesInWindow = this.slidesInWindow2
        } else {
            this.actualSlidesInWindow = this.slidesInWindow1
        }
    }
}