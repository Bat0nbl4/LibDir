<?php \core\rendering\View::title("Поиск"); ?>

<?php if (isset($books)): ?>
<div class="flex w100 center column">
    <?php if (isset($search)): ?>
        <p class="text-center">Результаты поиска по запросу "<?php echo $search ?? "Null"?>":</p>
    <?php endif; ?>
    <div class="flex w100 row wrap center gap-20">
        <?php foreach ($books as $book): ?>
            <a href="<?php echo \core\routing\Router::route("show_book", ["id" => $book["id"]]) ?>" class="card card_book"><img src="<?php echo \core\helpers\Resource::resource("img/Book/".$book["cover_url"]) ?>" alt=""></a>
        <?php endforeach; ?>
    </div>
</div>
<?php elseif (isset($message)): ?>
    <div class="flex w100 center column">
        <p class="text-center mTop-20"><?php echo $message ?></p>
    </div>
<?php endif; ?>
