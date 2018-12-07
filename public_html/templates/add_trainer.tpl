<div class="modal fade" id="edit_tr{ID}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Тренер, данные</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label for="firstname{ID}">Имя</label>
                        <input type="text" class="form-control trainername{ID}" id="trainername{ID}" aria-describedby="" value="{TRFIRSTNAME}">
                    </div>
                    <div class="form-group">
                        <label for="lastname{ID}">Фамилия</label>
                        <input type="text" class="form-control trainersurname{ID}" id="trainersurname{ID}" value="{TLASTNAME}">
                    </div>
                    <div class="form-group">
                        <label for="tel{ID}">Телефон</label>
                        <input type="text" class="form-control trainertel{ID}" id="trainertel{ID}" value="{TTEL}">
                    </div>
                    <div class="form-group">
                        <label for="vkid{ID}">ID_VK</label>
                        <input type="text" class="form-control trainervkid{ID}" id="trainervkid{ID}" value="{TVKID}">
                    </div>
                    <div class="form-check">
                        <input class="form-check-input trainermen{ID}" type="radio" name="exampleRadios" id="men{ID}" value="2" >
                        <label class="form-check-label" for="men{ID}">
                            Мужчина
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input trainerwomen{ID}" type="radio" name="exampleRadios" id="women{ID}" value="1" >
                        <label class="form-check-label" for="women{ID}">
                            Женщина
                        </label>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary trainer" data-trainer="{ID}" data-act="traineredit">Изменить</button>
                <button type="button" class="btn btn-primary trainer"  data-trainer="{ID}" data-act="traineradd">Создать</button>
                <button type="button" class="btn btn-primary trainer"  data-trainer="{ID}" data-act="trainerdel">Удалить</button>
            </div>
        </div>
    </div>
</div>