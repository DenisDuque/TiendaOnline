document.addEventListener('DOMContentLoaded', function () {
    var swiper = new Swiper('.swiper-container', {
        loop: false,
        slidesPerView: 1,
        spaceBetween: 0,
        navigation: false,
        autoplay: {
            delay: 7000,
        },
        on: {
            slideChange: function () {
                var currentIndex = swiper.activeIndex;
                updateButtonStyles(currentIndex);
            },
        },
    });

    var buttons = document.querySelectorAll('.swiper-button');

    buttons.forEach(function (button, index) {
        button.dataset.index = index; // Añadir índice a través de dataset
        button.addEventListener('click', function () {
            var targetIndex = parseInt(button.dataset.index);
            swiper.slideTo(targetIndex);
            resetTimer();
        });
    });

    function resetTimer() {
        swiper.autoplay.stop();
        swiper.autoplay.start();
    }

    function updateButtonStyles(index) {
        buttons.forEach(function (button, buttonIndex) {
            if (buttonIndex === index) {
                button.classList.add('swiper-button-active');
            } else {
                button.classList.remove('swiper-button-active');
            }
        });
    }

    updateButtonStyles(0); // Establecer el estilo del primer botón al cargar la página
});
