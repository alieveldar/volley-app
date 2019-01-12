<div class="modal fade" id="edit_room{ID}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Спортивнй зал</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label for="roomname{ID}">Название</label>
                        <input type="text" class="form-control roomname{ID}" id="roomname{ID}" aria-describedby="" value="{ROOMNAME}">
                    </div>
                    <div class="form-group">
                        <label for="roomcity{ID}">Город</label>
                        <input type="text" class="form-control roomcity{ID}" id="roomcity{ID}" value="{ROOMCITY}">
                    </div>
                    <div class="form-group">
                        <label for="roomadress{ID}">Адресс</label>
                        <input type="text" class="form-control roomadress{ID}" id="roomadress{ID}" value="{ROOMADRESS}">
                    </div>
                    <div class="form-group">
                        <label for="roomimage{ID}">Ссылка на фото</label>
                        <input type="text" class="form-control roomimage{ID}" id="roomimage{ID}" value="{ROOMIMAGE}">
                    </div>
                    <div class="form-group">
                        <input id="sortpicture{ID}" type="file" name="sortpic" accept="image/*"/>
                        <button id="upload" class="btn btn-warning" data-id="{ID}">Загрузить</button>
                    </div>
                    <div class="alert alert-success" role="alert">
                        <strong class="filebanner"></strong> 
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="roomiya{ID}">Скрипт Яндекс Карт</label>
                        <input type="text" class="form-control roomiya{ID}" id="roomiya{ID}" value="{ROOMIYA}">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary room" data-room="{ID}" data-act="roomedit">Изменить</button>
                <button type="button" class="btn btn-primary room" data-room="{ID}" data-act="roomadd">Создать</button>
                <button type="button" class="btn btn-primary room" data-room="{ID}" data-act="roomdel">Удалить</button>
            </div>
        </div>
    </div>
</div>