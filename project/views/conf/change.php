<?php $row = $data->fetch(); ?>
<script>
    window.onload = function() {

        <?php if ($row["latitude"] and $row["longitude"]) { ?>
            setCenter(<?php echo $row['latitude']; ?>, <?php echo $row['longitude']; ?>);
            disableAddress();
        <?php } ?>
        loadMapCreate();
        selectDefaultOption('<?php echo $row["country"] ?>');
        validate();
    };
</script>

<div class="container main conf">
    <div class="row">
        <div class="col-12 d-flex justify-content-center mb-4 text-center">
            <h1>Изменение конференции</h1>
        </div>
    </div>
    <div class="info info-bg">
        <form id="changeConf" name="changeConf" action="/conf/change/<?php echo $row["id"]; ?>" method="post">
            <div class="row">
                <div class="col-0 col-md-2"></div>
                <div class="form-group col-12 col-md-8">
                    <label for="formGroupExampleInput">
                        <h4>Название</h4>
                    </label>
                    <input type="text" minlength="2" maxlength="255" name="title" value="<?php echo $row["title"] ?>" class="form-control" id="formGroupExampleInput" placeholder="Конференция по..." required>
                </div>

            </div>
            <div class="row">
                <div class="col-0 col-md-2"></div>
                <div class="form-group col-12 col-md-8">
                    <label for="formGroupExampleInput">
                        <h4>Дата</h4>
                    </label>
                    <input type="datetime-local" name="date" value="<?php echo implode("T", explode(" ", $row["date"])) ?>" class="form-control" id="formGroupExampleInput" placeholder="Конференция по..." required>
                </div>
            </div>
            <div class="row">
                <div class="col-0 col-md-2"></div>
                <div class="form-group col-12 col-md-8">
                    <label for="select">
                        <h4>Страна</h4>
                    </label>
                    <select class="form-control" name="country" id="select" required>
                        <option id="Ukraine">Украина</option>
                        <option id="UK">Великобритания</option>
                        <option id="USA">США</option>
                        <option id="Czech">Чехия</option>
                        <option id="Poland">Польша</option>
                    </select>
                </div>
            </div>

            <div class="row">
                <div class="col-0 col-md-2"></div>
                <div class="form-group col-12 col-md-8">
                    <label for="formGroupExampleInput" class="d-flex" style="width: 100px;">
                        <h4>Адрес</h4>
                        <div class="form-check" style="padding-left: 30px; padding-top: 6px;">
                            <input class="form-check-input position-static" <?php if ($row["latitude"] and $row["longitude"]) {
                                                                                echo 'checked';
                                                                            } ?> type="checkbox" id="blankCheckbox" name="addressIsSet" value="true" aria-label="..." onClick="disableAddress()">
                        </div>
                    </label>
                    <div class="form-row">
                        <div class="col-6">
                            <input id="lat" name="latitude" value="<?php echo $row["latitude"] ?>" type="number" step="0.00001" min="-90" max="90" class="form-control" id="formGroupExampleInput" placeholder="Широта" disabled>
                        </div>
                        <div class="col-6">
                            <input id="lng" name="longitude" value="<?php echo $row["longitude"] ?>" type="number" step="0.00001" min="-180" max="180" class="form-control" id="formGroupExampleInput" placeholder="Долгота" disabled>
                        </div>
                    </div>

                </div>
            </div>

            <div class="row  ml-0">
                <div class="col-0 col-md-2"></div>
                <div class="col-12 col-md-8" id="map"></div>
            </div>

        </form>
    </div>
    <div class="row d-flex justify-content-center pt-3">
        <button type="submit" id="submit" form="changeConf" class="button-style btn btn-success">
            Подтвердить
        </button>
    </div>
    <div class="row d-flex justify-content-center pt-3">
        <button onClick="location.href='javascript:history.go(-1)'" type="button" class="button-style btn btn-secondary ">
            Назад
        </button>
    </div>
</div>