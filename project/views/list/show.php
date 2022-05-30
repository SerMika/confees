<div class="container main">
    <?php $row = $data->fetch();
    if (!$row) { ?>
        <div class="row d-flex justify-content-center">
            <div class="col-12 d-flex justify-content-center text-center">
                <h2>На данный момент не существует конференций</h2>
            </div>
            <div class="col-12 d-flex justify-content-center text-center">
                <p>Вы можете создать первую конференцию по кнопке "Добавить+".</p>
            </div>
        </div>
    <?php } else { ?>
        
        <div class="row d-flex justify-content-center">
            <div class="col-7 d-flex justify-content-center">
                <h2>Название</h2>
            </div>
            <div class="col-3 col-md-4 d-flex justify-content-start pl-2">
                <h2>Дата</h2>
            </div>
        </div>

        <!--List-->
        <div class="row d-flex justify-content-center">

            <div class="col-12 list-group pl-3 pr-3">
                <?php do { ?>
                    <div class="row">
                        <div class="col-0 col-md-1"></div>
                        <div class="col-12 col-md-9 py-3">
                            <a href="/conf/show/<?php echo $row["id"]; ?>" class="list-group-item list-group-item-action">
                                <div class="row">
                                    <div class="col-7 d-flex align-items-center text-break">
                                        <p><?php echo $row["title"]; ?></p>
                                    </div>

                                    <div class="col-5 col-md-5 d-flex justify-content-center align-items-center text-center">
                                        <p><?php echo $row["date"]; ?></p>
                                    </div>

                                </div>
                            </a>
                        </div>

                        <div class="col-12 col-md-1 d-flex justify-content-center align-items-center">
                            <form id="delete" action="conf/delete" method="post">
                                <button type="button" onClick="changeButtonValue(<?php echo $row["id"] ?>)" name="deleteButton" value="" data-toggle="modal" data-target="#Modal" class="btn btn-danger" style="font-size: 0.9rem">
                                    Удалить
                                </button>
                            </form>

                        </div>
                    </div>
                <?php } while ($row = $data->fetch()) ?>
            </div>

        </div>
    <?php } ?>
    <!--Button Create-->
    <div class="row d-flex justify-content-center" style="padding-top: 15px;">
        <button type="button" onClick="location.href='/conf/create';" class="button-style btn btn-success">
            Добавить +
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
                    <button type="submit" name="buttonDelete" value="1" form="delete" class="btn btn-danger">Да, удалить</button>
                </div>
            </div>
        </div>
    </div>
</div>