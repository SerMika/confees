<script>
    window.onload = function() {
        loadMapCreate();
        validate();
        
    };
</script>
<div class="container main conf">
    <div class="row">
        <div class="col-12 d-flex justify-content-center mb-4 text-center">
            <h1>Создание конференции</h1>
        </div>
    </div>
    <div class="info info-bg">
        <form id="createConf" name="createConf" action="/conf/create" method="post">
            <div class="row">
                <div class="col-0 col-md-2"></div>
                <div class="form-group col-12 col-md-8">
                    <label for="title">
                        <h4>Название</h4>
                    </label>
                    <input type="text" minlength="2" maxlength="255" name="title" class="form-control" id="title" placeholder="Конференция по..." required>
                </div>

            </div>
            <div class="row">
                <div class="col-0 col-md-2"></div>
                <div class="form-group col-12 col-md-8">
                    <label for="formGroupExampleInput">
                        <h4>Дата</h4>
                    </label>
                    <input type="datetime-local" name="date" class="form-control" id="formGroupExampleInput" placeholder="Конференция по..." required>
                </div>
            </div>
            <div class="row">
                <div class="col-0 col-md-2"></div>
                <div class="form-group col-12 col-md-8">
                    <label for="exampleFormControlSelect1">
                        <h4>Страна</h4>
                    </label>
                    <select class="form-control" name="country" id="exampleFormControlSelect1" required>
                        <option>Украина</option>
                        <option>Великобритания</option>
                        <option>США</option>
                        <option>Чехия</option>
                        <option>Польша</option>
                    </select>
                </div>
            </div>

            <div class="row">
                <div class="col-0 col-md-2"></div>
                <div class="form-group col-12 col-md-8">
                    <label for="formGroupExampleInput" class="d-flex" style="width: 100px;">
                        <h4>Адрес</h4>
                        <div class="form-check" style="padding-left: 30px; padding-top: 6px;">
                            <input class="form-check-input position-static" type="checkbox" id="blankCheckbox" name="addressIsSet" value="true" aria-label="..." onClick="disableAddress()">
                        </div>
                    </label>
                    <div class="form-row">
                        <div class="col-6">
                            <input id="lat" name="latitude" type="number" step="0.00001" min="-90" max="90" class="form-control" id="formGroupExampleInput" placeholder="Широта" disabled>
                        </div>
                        <div class="col-6">
                            <input id="lng" name="longitude" type="number" step="0.00001" min="-180" max="180" class="form-control" id="formGroupExampleInput" placeholder="Долгота" disabled>
                        </div>
                    </div>

                </div>
            </div>

            <div class="row ml-0">
                <div class="col-0 col-md-2"></div>
                <div class="col-12 col-md-8" id="map"></div>
            </div>

        </form>
    </div>
    <div class="row d-flex justify-content-center pt-3">
        <button type="submit" id="submit" form="createConf" class="button-style btn btn-success">
            Добавить
        </button>
    </div>
    <div class="row d-flex justify-content-center pt-3">
        <button onClick="location.href='javascript:history.go(-1)'" type="button" class="button-style btn btn-secondary">
            Назад
        </button>
    </div>
</div>