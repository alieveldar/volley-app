<div class="modal fade" id="edit_training{ID}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Тренировка</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="input-group mb-3">
                        <select class="custom-select training_trainer{ID}" id="inputGroupSelect02">
                            <option selected value="{TRAINERID}">{TRAINERNAME}</option>
                            {TRAINERS}
                        </select>
                    </div>
                    <div class="input-group-append">
                        <label class="input-group-text" for="inputGroupSelect02">Тренер</label>
                    </div>
                    <div class="input-group mb-3">
                        <select class="custom-select training_room{ID}" id="inputGroupSelect02">
                            <option selected value="{VOLLEYID}">{VOLLEYROOM}</option>
                            {VOLLEYROOMS}
                        </select>
                        <div class="input-group-append">
                            <label class="input-group-text" for="inputGroupSelect02">Зал</label>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="example-date-input" class="col-2 col-form-label">Дата</label>
                        <div class="col-10">
                            <input class="form-control training_date{ID}" type="date" value={TRAININGDATE} id="example-date-input">
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <select class="custom-select training_weekDay{ID}" disabled="disabled" id="inputGroupSelect02">
                            <option selected>{WEEKDAY}</option>
                            {WEEKDAYS}
                        </select>
                        <div class="input-group-append">
                            <label class="input-group-text" for="inputGroupSelect02">День недели</label>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="example-time-input" class="col-2 col-form-label">Время</label>
                        <div class="col-10">
                            <input class="form-control training_time{ID}" type="time" value={TRTAIM} id="example-time-input">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="training_capacity{ID}">Мест</label>
                        <input type="text" class="form-control training_capacity{ID}" id="training_capacity{ID}" value="{TRCAPACITY}">
                    </div>
                    <div class="input-group mb-3">
                        <select class="custom-select training_level{ID}" id="inputGroupSelect02">
                            <option selected value="{LEVELID}">{TRAININGLEVEL}</option>
                            {TRAININGLEVELS}
                        </select>
                        <div class="input-group-append">
                            <label class="input-group-text" for="inputGroupSelect02">Тип тренировки</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="training_price{ID}">Цена</label>
                        <input type="text" class="form-control training_price{ID}" id="training_price{ID}" value="{TRPRICE}">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary training" data-training="{ID}" data-act="trainingedit">Изменить</button>
                <button type="button" class="btn btn-primary training" data-training="{ID}" data-act="trainingadd">Создать</button>
                <button type="button" class="btn btn-primary training" data-training="{ID}" data-act="trainingdel">Удалить</button>
            </div>
        </div>
    </div>
</div>