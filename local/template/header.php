<?php require $_SERVER["DOCUMENT_ROOT"] . "/local/php_interface/init.php"; ?>

<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Приглашение на свадьбу Максима и Вики, которая состоится 23 августа 2025 года в ресторане 'VOYAGE', по адресу г. Тула, ул. Станиславского, 49. Будем рады видеть вас на нашем празднике!">
    <meta name="keywords" content="свадьба Максима и Вики, свадебное приглашение, свадьба 2025, свадьба Тула, ресторан VOYAGE, 23 августа 2025">
    <meta property="og:title" content="Приглашение на свадьбу Максима и Вики">
    <meta property="og:description" content="Приглашение на свадьбу Максима и Вики, которая состоится 23 августа 2025 года в ресторане 'VOYAGE', по адресу г. Тула, ул. Станиславского, 49. Будем рады видеть вас на нашем празднике!">
    <meta property="og:image" content="https://maxim-and-vika.ru/local/template/images/open-graph.jpg">
    <meta property="og:image:type" content="image/jpeg">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://maxim-and-vika.ru">
    <meta property="og:locale" content="ru_RU">
    <meta property="og:site_name" content="maxim-and-vika.ru">
    <link rel="icon" href="https://maxim-and-vika.ru/favicon.ico" type="image/x-icon">
    <title>Приглашение на свадьбу Максима и Вики</title>

    <link rel="stylesheet" href="https://necolas.github.io/normalize.css/8.0.1/normalize.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css" />
    <link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="/local/vendor/js/flipdown-master/flipdown.css">
    <link rel="stylesheet" href="/local/template/style.css">

    <script type="application/ld+json">
        {
            "@context": "https://schema.org",
            "@type": "Event",
            "name": "Свадьба Максима и Вики",
            "startDate": "2025-08-23T11:40:00+03:00",
            "eventAttendanceMode": "https://schema.org/OfflineEventAttendanceMode",
            "eventStatus": "https://schema.org/EventScheduled",
            "location": {
                "@type": "Place",
                "name": "Ресторан VOYAGE",
                "address": {
                    "@type": "PostalAddress",
                    "addressLocality": "Тула",
                    "addressRegion": "RU",
                    "streetAddress": "ул. Станиславского, 49"
                }
            },
            "image": "https://maxim-and-vika.ru/local/template/images/open-graph.jpg",
            "description": "Приглашение на свадьбу Максима и Вики, которая состоится 23 августа 2025 года в ресторане 'VOYAGE', по адресу г. Тула, ул. Станиславского, 49. Будем рады видеть вас на нашем празднике!",
            "organizer": {
                "@type": "Person",
                "name": "Максим и Вика"
            }
        }
    </script>
    <script>
        const siteKey = '<?= SITE_KEY; ?>';
    </script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js" defer></script>
    <script src="https://unpkg.com/aos@2.3.4/dist/aos.js" defer></script>
    <script src="https://www.google.com/recaptcha/api.js?render=<?= SITE_KEY; ?>"></script>
    <script src="https://cdn.jsdelivr.net/npm/js-confetti@latest/dist/js-confetti.browser.js" defer></script>
    <script src="/local/vendor/js/custom-select-bs/custom-select.js" defer></script>
    <script src="/local/vendor/js/maskedinput/jquery.maskedinput.min.js" defer></script>
    <script src="/local/vendor/js/flipdown-master/flipdown.js" defer></script>
    <script src="/local/template/script.js" defer></script>
</head>

<body>
    <header id="header">
        <div class="menu-container">
            <div class="menu-item" data-target-link="main-content">Галерея</div>
            <div class="menu-item" data-target-link="calendar">Дата</div>
            <div class="menu-item" data-target-link="program">Программа</div>
            <div class="menu-item" data-target-link="map">Карта</div>
            <div class="menu-item" data-target-link="feedback">Анкета</div>
        </div>
        <div class="menu-mobile-container">
            <div class="menu-mobile__open">
                <svg width="28" height="24" viewBox="0 0 28 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M0 24H28V20H0V24ZM0 14H28V10H0V14ZM0 0V4H28V0H0Z" fill="white" />
                </svg>
            </div>
            <div class="menu-mobile__popup-container">
                <div class="menu-mobile__close">
                    <svg width="28" height="28" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M28 2.83L25.17 0L14 11.17L2.83 0L0 2.83L11.17 14L0 25.17L2.83 28L14 16.83L25.17 28L28 25.17L16.83 14L28 2.83Z" fill="white" />
                    </svg>
                </div>
                <div class="menu-mobile__popup">
                    <div class="menu-item" data-target-link="main-content">Галерея</div>
                    <div class="menu-item" data-target-link="calendar">Дата</div>
                    <div class="menu-item" data-target-link="program">Программа</div>
                    <div class="menu-item" data-target-link="map">Карта</div>
                    <div class="menu-item" data-target-link="feedback">Анкета</div>
                </div>
            </div>
        </div>
    </header>

    <main id="main">