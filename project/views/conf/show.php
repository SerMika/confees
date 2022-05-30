<?php $row = $data->fetch();  ?>
<script>
    window.onload = function() {
        setCenter(<?php echo $row['latitude'] ?>, <?php echo $row['longitude'] ?>);
        loadMap();
    };
</script>
<div class="container main conf">
    <div class="row">
        <div class="col-12 d-flex justify-content-center mb-4 text-center">
            <h1>Информация о конференции</h1>
        </div>
    </div>
    <div class="info info-bg">
        <div class="row">
            <div class="col-0 col-md-2"></div>
            <div class="col-5 info-bg">
                <p class="bold">Название:</p>
            </div>

            <div class="col-7 col-md-5 info-bg text-break">
                <p>
                    <?php echo $row["title"]; ?>
                </p>
            </div>
        </div>
        <div class="row">
            <div class="col-0 col-md-2"></div>
            <div class="col-5 info-bg">
                <p class="bold">Дата:</p>
            </div>

            <div class="col-5 info-bg">
                <p><?php echo $row["date"] ?></p>
            </div>
        </div>
        <div class="row">
            <div class="col-0 col-md-2"></div>
            <div class="col-5 info-bg">
                <p class="bold">Страна:</p>
            </div>

            <div class="col-5 info-bg">
                <p><?php echo $row["country"] ?></p>
            </div>
        </div>

        <div class="row">
            <div class="col-0 col-md-2"></div>
            <div class="col-5 info-bg">
                <p class="bold">Адрес:</p>
            </div>
            <div class="col-5 info-bg">
                <p id="address">
                    <?php if (!$row["latitude"] and !$row["longitude"]) {
                        echo "Без адреса";
                    } ?>
                </p>
            </div>
        </div>
        <?php if ($row["latitude"] and $row["longitude"]) { ?>
            <div class="row  ml-0">
                <div class="col-0 col-md-2"></div>
                <div class="col-12 col-md-8" id="map"></div>
            </div>
        <?php } ?>
    </div>
    <div class="row d-flex justify-content-center pt-3">
        <form class="mr-2" id="delete" action="/conf/delete" method="post">
            <button type="button" data-toggle="modal" data-target="#Modal" class="button-style btn btn-danger px-4">
                Удалить
            </button>
        </form>
        <div class="ml-2">
            <button onClick="location.href='/conf/change/<?php echo $row["id"] ?>'" type="button" class="button-style btn btn-success">
                Изменить
            </button>
        </div>
    </div>
    <div class="row d-flex justify-content-center pt-3">
        <button onClick="location.href='/list'" type="button" class="button-style btn btn-secondary px-4">
            Назад
        </button>
    </div>
    <!-- Модальное окно -->
    <div class="modal fade" id="Modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Подтверждение</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body d-flex align-content-center">
                    <h6 class="mb-0">Вы точно хотите удалить данную конференцию?</h6>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Назад</button>
                    <button type="submit" name="buttonDelete" value="<?php echo $row["id"] ?>" form="delete" class="btn btn-danger">Да, удалить</button>
                </div>
            </div>
        </div>
    </div>
</div>