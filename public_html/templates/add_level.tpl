<div class="modal fade" id="edit_level{ID}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Виды тренировок</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label for="levelintensity{ID}">Название</label>
                        <input type="text" class="form-control levelintensity{ID}"  aria-describedby="" value="{LEVINTENSITY}">
                    </div>
                    <div class="form-group">
                        <label for="leveldescription{ID}">Описание</label>
                        <textarea class="form-control leveldescription{ID}" rows="10">{LEVDESC}</textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary level" data-level="{ID}" data-act="leveledit">Изменить</button>
                <button type="button" class="btn btn-primary level" data-level="{ID}" data-act="leveladd">Создать</button>
                <button type="button" class="btn btn-primary level" data-level="{ID}" data-act="leveldel">Удалить</button>
            </div>
        </div>
    </div>
</div>