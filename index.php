<?php require $_SERVER["DOCUMENT_ROOT"] . "/local/template/header.php"; ?>

<div class="container main-content-container" id="main-content">
    <div class="wrapper">
        <h1 class="title-container" data-aos="fade-down">Максим и Вика</h1>
        <div class="gallery-container">
            <div class="swiper">
                <div class="swiper-wrapper">
                    <?php for ($i = 1; $i <= 8; $i++): ?>
                        <div class="swiper-slide">
                            <?php
                            $filePhotoPath = IMAGE_PATH . "slider/photo-slider-$i.webp";
                            $defaultPhotoPath = IMAGE_PATH . "no-image.webp";
                            ?>
                            <?php if (file_exists($_SERVER["DOCUMENT_ROOT"] . $filePhotoPath)): ?>
                                <a href="<?= $filePhotoPath; ?>" data-fancybox="gallery-main-content" data-caption="Наше фото">
                                    <img data-src="<?= $filePhotoPath; ?>" class="lazy-image" alt="Наше фото" title="Наше фото">
                                </a>
                            <?php else: ?>
                                <a href="<?= $defaultPhotoPath; ?>" data-fancybox="gallery-main-content" data-caption="Фото отсутствует">
                                    <img data-src="<?= $defaultPhotoPath; ?>" class="lazy-image" alt="Фото отсутствует" title="Фото отсутствует">
                                </a>
                            <?php endif; ?>
                        </div>
                    <?php endfor; ?>
                </div>
                <div class="swiper-pagination"></div>
                <div class="swiper-button-prev"></div>
                <div class="swiper-button-next"></div>
            </div>
        </div>
        <div class="date-container">
            <div class="date-main" data-aos="fade-up">
                <div class="date-background"><?= WEDDING_DAY; ?> / 08</div>
                <div class="date-front"><?= WEDDING_DAY; ?> августа</div>
            </div>
            <div class="date-year">2025</div>
        </div>
    </div>
</div>

<div class="container-fluid container--bg">
    <div class="wrapper">
        <div class="text-container" data-aos="fade-left">
            <span>Дорогие гости,</span><br>
            мы с огромной радостью будем ждать Вас на нашей свадьбе
        </div>
    </div>
</div>

<div class="container calendar-container" id="calendar">
    <div class="wrapper">
        <div class="calendar-wrapper">
            <h2 class="calendar-title"><span>Август</span> 2025</h2>
            <div class="calendar-main">
                <?php for ($i = 1; $i <= 4; $i++): ?>
                    <div class="calendar-day empty"></div>
                <?php endfor; ?>
                <?php for ($i = 1; $i <= 31; $i++): ?>
                    <div class="calendar-day<?= ($i === WEDDING_DAY) ? " active" : ""; ?>"><?= $i; ?></div>
                <?php endfor; ?>
            </div>
            <div class="countdown-container">
                <div id="flipdown" class="flipdown"></div>
            </div>
        </div>
    </div>
</div>

<div class="container program-container" id="program">
    <div class="wrapper">
        <h2 class="title-container" data-aos="fade-down">Программа</h2>
        <div class="program-container">
            <div class="swiper">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <div class="program-wrapper program-wrapper--direction">
                            <div class="program-event">
                                <h3>Сюрпризы</h3>
                                <p>
                                    Возьмите с собой отличное настроение!<br>
                                    Приветствуются ваши поздравления, активное участие в интерактивах, творческие выступления! Вы можете обратиться к нашему организатору для воплощения своих идей!<br>
                                    Александр <a href="tel:+79202770781">+7 (920) 277-07-81</a>
                                </p>
                            </div>
                            <div class="program-picture program-picture--gift"></div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="program-wrapper">
                            <div class="program-event">
                                <div class="event-time" data-aos="fade-right">11:40</div>
                                <div class="event-place">Торжественная регистрация, ЗАГС,<br>г. Тула, ул. Советская, 47</div>
                            </div>
                            <div class="program-event">
                                <div class="event-time" data-aos="fade-left">15:30</div>
                                <div class="event-place">Праздничный банкет,<br>Банкетный зал "VOYAGE",<br>г. Тула, ул. Станиславского, 49</div>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="program-wrapper program-wrapper--direction">
                            <div class="program-event">
                                <h3>Что дарить?</h3>
                                <p>
                                    В качестве подарка будем рады вкладу в бюджет нашей семьи. Он точно поможет воплотить нашу мечту в реальность!
                                </p>
                            </div>
                            <div class="program-picture program-picture--money"></div>
                        </div>
                    </div>
                </div>
                <div class="swiper-pagination"></div>
                <div class="swiper-button-prev"></div>
                <div class="swiper-button-next"></div>
            </div>
        </div>
    </div>
</div>

<div class="container map-container" id="map">
    <div class="wrapper">
        <h2 class="title-container" data-aos="fade-down">Карта</h2>
        <div class="container-fluid">
            <script type="text/javascript" charset="utf-8" async src="https://api-maps.yandex.ru/services/constructor/1.0/js/?um=constructor%3A324be614eb97e6eaa8ec528e30bbcadef1c091b5220d57804a932b42f414d2b1&amp;width=100%25&amp;height=439&amp;lang=ru_RU&amp;scroll=true"></script>
        </div>
    </div>
</div>

<div class="container feedback-container" id="feedback">
    <div class="wrapper">
        <h2 class="title-container" data-aos="fade-down">Анкета гостя</h2>
        <div class="container-fluid">
            <div class="row mb-5">
                <div class="feedback-wrapper col-12 col-lg-6">
                    <form action="" method="post" id="feedback-form" novalidate>
                        <input type="hidden" name="g-recaptcha-response" id="g-recaptcha-response">
                        <div class="form-group mb-3">
                            <label for="form-presense" class="form-label">Присутствие</label>
                            <select name="presense" id="form-presense" class="form-select custom-select" aria-label="Присутствие">
                                <option value="true" selected>Смогу прийти</option>
                                <option value="false">Не смогу &#128557;</option>
                            </select>
                        </div>
                        <div class="form-group mb-3">
                            <label for="form-name" class="form-label">Имя</label>
                            <input type="text" name="name" id="form-name" class="form-control" placeholder="Имя" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="form-phone" class="form-label">Телефон</label>
                            <input type="tel" name="phone" id="form-phone" class="form-control" placeholder="+7 (999) 999-99-99" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="form-email" class="form-label">Почта</label>
                            <input type="email" name="email" id="form-email" class="form-control" placeholder="name@example.com" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="form-alcohol" class="form-label">Алкоголь</label>
                            <textarea name="alcohol" id="form-alcohol" class="form-control" placeholder="Напишите ваши предпочтения по алкоголю"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Отправить</button>
                    </form>
                    <div class="loader-block" style="display: none;">
                        <img data-src="<?= IMAGE_PATH . "loading.gif"; ?>" class="img-fluid lazy-image" alt="Загрузка...">
                    </div>
                </div>
                <div class="feedback-picture__container mt-4 mt-lg-0 col-12 col-lg-6" data-aos="fade-up">
                    <img src="<?= IMAGE_PATH . "form-photo.webp"; ?>" class="img-fluid" alt="Анкета гостя">
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="form-modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
            </div>
            <div class="modal-body"></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Закрыть</button>
            </div>
        </div>
    </div>
</div>

<?php require $_SERVER["DOCUMENT_ROOT"] . "/local/template/footer.php"; ?>