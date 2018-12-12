<div class="modal fade" id="edit_root{ID}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Администраторы приложения</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label for="rootname{ID}">Имя</label>
                        <input type="text" class="form-control rootname{ID}" id="rootname{ID}" aria-describedby="" value="{ROOTNAME}">
                    </div>
                    <div class="form-group">
                        <label for="rootsurname{ID}">Фамилия</label>
                        <input type="text" class="form-control rootsurname{ID}" id="rootsurname{ID}" value="{ROOTSURNAME}">
                    </div>
                    <div class="form-group">
                        <label for="rootidvk{ID}">idVk</label>
                        <input type="text" class="form-control rootidvk{ID}" id="rootidvk{ID}" value="{ROOTIDVK}">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary roots" data-roots="{ID}" data-act="rootedit">Изменить</button>
                <button type="button" class="btn btn-primary roots" data-roots="{ID}" data-act="rootadd">Создать</button>
                <button type="button" class="btn btn-primary roots" data-roots="{ID}" data-act="rootdel">Удалить</button>
            </div>
        </div>
    </div>
</div>