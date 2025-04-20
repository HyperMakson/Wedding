async function getRecaptchaToken(siteKey = '', actionCaptcha = 'submit') {
    return new Promise((resolve, reject) => {
        if (!siteKey) {
            return reject(new Error("reCAPTCHA не инициализирована"));
        }

        grecaptcha.ready(function () {
            grecaptcha.execute(siteKey, {
                action: actionCaptcha
            }).then(resolve);
        });
    });
}

function setModalResult(success = false, modalTitleContent = "", modalBodyContent = "", customStatus = "") {
    let myModalContainer = $("#form-modal");
    let modalTitle = myModalContainer.find(".modal-title");
    let modalBody = myModalContainer.find(".modal-body");
    let status = success ? "success" : "danger";
    if (customStatus) {
        status = customStatus;
    }

    modalTitle.html(modalTitleContent);
    modalBody.html(`<div class="alert alert-${status}" role="alert">${modalBodyContent}</div>`);
}

// Плавная анимация
AOS.init();

$(document).ready(function () {
    // Ленивая загрузка
    const images = [].slice.call(document.querySelectorAll("img.lazy-image"));
    if ("IntersectionObserver" in window) {
        const observerLazyImage = new IntersectionObserver((entries, observer) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    const img = entry.target;
                    img.src = img.dataset.src;

                    img.onload = () => {
                        img.classList.add("loaded");
                    }

                    observer.unobserve(img);
                }
            });
        });

        images.forEach((img) => {
            observerLazyImage.observe(img);
        });
    } else {
        images.forEach((img) => {
            img.src = img.dataset.src;
            lazyImage.classList.add("loaded");
        });
    }

    // Слайдер галереи
    const swiperGallery = new Swiper('#main-content .swiper', {
        slidesPerView: 1,
        spaceBetween: 10,
        centeredSlides: true,
        loop: false,
        autoplay: true,
        speed: 700,
        pagination: {
            el: '#main-content .swiper-pagination',
            clickable: true,
        },
        navigation: {
            nextEl: '#main-content .swiper-button-next',
            prevEl: '#main-content .swiper-button-prev',
        },
        breakpoints: {
            768: {
                slidesPerView: 2,
                spaceBetween: 20,
                loop: false,
            },
            992: {
                slidesPerView: 3,
                spaceBetween: 32,
                loop: true,
            }
        }
    });

    // Слайдер программы
    const swiperProgram = new Swiper('#program .swiper', {
        slidesPerView: 1.075,
        spaceBetween: 10,
        initialSlide: 1,
        centeredSlides: true,
        loop: false,
        autoplay: false,
        pagination: {
            el: '#program .swiper-pagination',
            clickable: true,
        },
        navigation: {
            nextEl: '#program .swiper-button-next',
            prevEl: '#program .swiper-button-prev',
        },
        breakpoints: {
            768: {
                slidesPerView: 2,
                spaceBetween: 20,
                initialSlide: 0,
                centeredSlides: false,
            },
            992: {
                slidesPerView: 3,
                spaceBetween: 32,
                initialSlide: 0,
                centeredSlides: false,
            }
        }
    });

    Fancybox.bind('[data-fancybox="gallery-main-content"]', {
        // Your custom options
    });

    // Отсчёт до даты
    let datetime = Date.parse('2025-08-23T08:40:00Z') / 1000;

    const flipdown = new FlipDown(datetime, {
        theme: "green",
        headings: ["Дни", "Часы", "Минуты", "Секунды"],
    });
    flipdown.start();

    // Показ верхнего меню на мобилке
    $("#header .menu-mobile__open").on("click", function () {
        $(".menu-mobile__popup-container").slideDown();
    });

    // Скрытие верхнего меню на мобилке
    $("#header .menu-mobile__close").on("click", function () {
        $(".menu-mobile__popup-container").slideUp();
    });

    // Скролл до блоков при клике по меню
    $("#header .menu-item").on("click", function () {
        let heightHeader = $("#header").outerHeight(true);
        let targetId = $(this).attr("data-target-link");
        let target = $("#" + targetId);

        $("#header .menu-mobile__close").trigger("click");
        $("html, body").animate({
            scrollTop: target.offset().top - heightHeader,
        }, 0);
    });

    // Форма
    let myModalContainer = $("#form-modal");
    let myModal = new bootstrap.Modal(myModalContainer[0]);
    let validClass = "is-valid";
    let invalidClass = "is-invalid";

    // Маска для ввода телефона
    $("#form-phone").mask("+7 (999) 999-99-99");

    // Конфетти
    const jsConfetti = new JSConfetti();

    // Отправка формы
    $("#feedback-form").on("submit", async function (e) {
        e.preventDefault();

        try {
            let form = $(this);
            form.siblings(".loader-block").fadeIn();

            const token = await getRecaptchaToken(siteKey, 'submit');
            document.getElementById("g-recaptcha-response").value = token;

            let inputs = form.find("input, select, button, textarea");
            let serializedData = form.serializeArray();

            $.ajax({
                url: "/ajax/feedback.php",
                type: "POST",
                data: serializedData,
                dataType: "json",
                beforeSend: function () {
                    inputs.prop("disabled", true);
                },
                success: function (response) {
                    console.log(response);

                    let modalTitleContent = "Произошла ошибка";
                    let modalBodyContent = "Произошла неизвестная ошибка";
                    let customStatus = "";

                    if (response.hasOwnProperty("data")) {
                        $.each(response.data, function (key, value) {
                            let validationClass = value ? validClass : invalidClass;
                            let formInput = form.find(`[name="${key}"]`);
                            if (formInput) {
                                formInput.removeClass([validClass, invalidClass]);
                                formInput.addClass(validationClass);
                            }
                        });
                    }

                    if (!response.hasOwnProperty("success")) {
                        setModalResult(false, modalTitleContent, modalBodyContent);
                        myModal.show();
                        return;
                    }

                    if (!response.success) {
                        if (response.hasOwnProperty("error")) {
                            modalBodyContent = "";
                            $.each(response.error, function (key, value) {
                                modalBodyContent += `Ошибка: ${value}<br>`;
                            });
                        }

                        setModalResult(response.success, modalTitleContent, modalBodyContent);
                        myModal.show();
                        return;
                    }

                    if (response.success) {
                        modalTitleContent = "Приглашение принято";
                        modalBodyContent = "С нетерпением ждём Вас на нашем празднике :)";

                        if (response.hasOwnProperty("presense")) {
                            if (!response.presense) {
                                modalBodyContent = "Очень грустно, что не сможете прийти :(";
                                customStatus = "warning";
                            }
                        }
                    }

                    setModalResult(response.success, modalTitleContent, modalBodyContent, customStatus);
                    myModal.show();

                    if (response.success && response.presense) {
                        jsConfetti.addConfetti();
                    }
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    let modalTitleContent = "Произошла ошибка";
                    let modalBodyContent = `Ошибка: ${textStatus}`;

                    setModalResult(false, modalTitleContent, modalBodyContent);
                    myModal.show();
                },
                complete: function () {
                    inputs.prop("disabled", false);
                    form.siblings(".loader-block").fadeOut();
                }
            });
        } catch (err) {
            let modalTitleContent = "Произошла ошибка";
            let modalBodyContent = `Ошибка: ${err}`;

            setModalResult(false, modalTitleContent, modalBodyContent);
            myModal.show();
        }
    });
});

// Убрать прелоадер
$(window).on("load", function () {
    $(".loader").fadeOut();
});