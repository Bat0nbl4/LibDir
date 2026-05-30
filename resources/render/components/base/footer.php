<footer class="footer text-white pt-4 pb-3 line-gradient-dark">
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-6 col-lg-3">
                <div class="d-flex flex-column align-items-center mb-3">
                    <a style="max-width: 250px" href="<?php echo \core\routing\Router::route("index") ?>">
                        <img class="img-fluid" src="<?php echo \core\helpers\Resource::get("img/app/icon.svg") ?>">
                    </a>
                    <span class="text-center ">Краевой Дворец Молодёжи</span>
                </div>
                <p class="text-secondary">Учредитель&nbsp;—&nbsp;управление молодёжной политики и реализации программ общественного развития Алтайского края</p>
            </div>
            <div class="col-12 col-md-6 col-lg-4">
                <span class="d-block text-center fw-bold">Контактная информация</span>
                <div class="line-gradient-light mt-2 mb-2"></div>
                <div class="d-flex flex-column gap-2">
                    <div class="d-flex flex-row gap-1">
                        <span>📍&nbsp;Адрес:</span>
                        <span class="d-block flex-fill text-secondary text-end">656019, Россия, Алтайский&nbsp;край,<br>г.&nbsp;Барнаул, ул.&nbsp;Юрина, 204В</span>
                    </div>
                    <div class="d-flex flex-row gap-1">
                        <span>📞&nbsp;Телефон:</span>
                        <span class="d-block flex-fill text-secondary text-end">
                        <a class="footer-link" href="tel:+73852559468">+7 (3852) 559-468</a><br>
                        <a class="footer-link" href="tel:+73852559570">+7 (3852) 559-570</a>
                    </span>
                    </div>
                    <div class="d-flex flex-row gap-1">
                        <span>📧&nbsp;Email:</span>
                        <span class="d-block flex-fill text-secondary text-end">
                            <a class="footer-link" href="delo@altaikdm.ru">delo@altaikdm.ru</a>
                        </span>
                    </div>
                    <div class="d-flex flex-row gap-1">
                        <span>🌐&nbsp;Сайт:</span>
                        <span class="d-block flex-fill text-secondary text-end">
                            <a  class="footer-link" href="https://altaikdm.ru">altaikdm.ru</a>
                        </span>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-8 col-lg-3">
                <span class="d-block text-center fw-bold">Разделы</span>
                <div class="line-gradient-light mt-2 mb-2"></div>
                <div class="d-flex gap-2">
                    <div class="w-100 d-flex flex-column gap-2">
                        <a class="footer-link" href="<?php echo \core\routing\Router::route("about") ?>">О нас</a>
                        <a class="footer-link" href="<?php echo \core\routing\Router::route("residents") ?>">Резиденты</a>
                        <a class="footer-link" href="<?php echo \core\routing\Router::route("contacts") ?>">Контакты</a>
                    </div>
                    <div class="w-100 d-flex flex-column gap-2">
                        <a class="footer-link" href="#">Обратная связь</a>
                        <a class="footer-link" href="#">Пресс-служба</a>
                        <a class="footer-link" href="<?php echo \core\routing\Router::route("event.list") ?>">Календарь мероприятий</a>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-4 col-lg-2">
                <span class="d-block text-center fw-bold">Мы в соцетях</span>
                <div class="line-gradient-light mt-2 mb-2"></div>
                <div class="d-flex flex-row flex-wrap align-items-center gap-2">
                    <a class="d-flex flex-row btn btn-dark rounded-5 p-1 pe-2" href="https://vk.com/altaikdm">
                        <img class="contact" src="<?php echo \core\helpers\Resource::get("img/app/vk.png") ?>">&nbsp;VK
                    </a>
                    <a class="d-flex flex-row btn btn-dark rounded-5 p-1 pe-2" href="">
                        <img class="contact" src="<?php echo \core\helpers\Resource::get("img/app/max.png") ?>">&nbsp;Мах
                    </a>
                    <a class="d-flex flex-row btn btn-dark rounded-5 p-1 pe-2" href="https://ok.ru/group/70000000669637">
                        <img class="contact" src="<?php echo \core\helpers\Resource::get("img/app/ok.svg") ?>">&nbsp;Одноклассники
                    </a>
                    <a class="d-flex flex-row btn btn-dark rounded-5 p-1 pe-2" href=https://t.me/KDM_Altay">
                        <img class="contact" src="<?php echo \core\helpers\Resource::get("img/app/tg.ico") ?>">&nbsp;Telegram
                    </a>
                </div>
            </div>
        </div>
        <hr class="text-secondary">
        <div class="row">
            <div class="col-12 text-center">
                <span class="text-secondary">© 2003—2026 КГАУ «Краевой дворец молодёжи». Все права защищены.</span><br>
                <span class="text-secondary fs-7">Разработка и поддержка — Пресс-служба КДМ</span>
            </div>
        </div>
    </div>
</footer>
<script src="<?php echo \core\helpers\Resource::get("js/bootstrap/bootstrap.js") ?>"></script>
<script src="<?php echo \core\helpers\Resource::get("js/header-margin.js") ?>"></script>
