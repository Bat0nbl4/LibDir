<?php \core\rendering\View::title(BASE_PAGE_NAME.$event["title"]); ?>
<div class="bg-white py-5">
    <div class="container">
        <h2 class="text-center text-main mb-4"><?php echo $event["title"] ?></h2>
        <img class="img-fluid rounded-3" src="<?php echo \core\helpers\Resource::get("img/storage/".$event["img"]) ?>">
        <p class="fs-4"><?php echo $event["short_description"] ?></p>
        <p class="fs-4"><?php echo $event["description"] ?></p>
        <div class="d-flex align-items-center gap-3 flex-wrap">
            <h4 class="m-0 <?php echo $event["status_style"] ?>"><?php echo $event["status"] ?></h4>
            <?php if ($event["status"] == "Идёт набор"): ?>
                <button type="button" class="btn btn-main" data-bs-toggle="modal" data-bs-target="#event_signup">Записаться</button>
            <?php endif; ?>
            <span class="text-secondary ms-auto"><?php echo \core\helpers\Date::normal_date($event["end_date"]) ?></span>
        </div>
    </div>
</div>


<?php if ($event["status"] == "Идёт набор"): ?>
    <!-- Modal -->
    <div class="modal fade" id="event_signup" tabindex="-1" aria-labelledby="event_signup" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title text-main" id="event_signup">Запись на мероприятие</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="get" action="">
                        <p><?php echo $event["start_date"] ?></p>
                        <button type="button" class="btn btn-main">Записаться</button>
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Закрыть окно</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>