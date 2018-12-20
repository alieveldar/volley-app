<div class="modal fade" id="edit_messgroup{ID}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Группа рассылки</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label for="groupname{ID}">Название</label>
                        <input type="text" class="form-control groupname{ID}" id="groupname{ID}" aria-describedby="" value="{GROUPNAME}">
                    </div>
                </form>
                <div class="users container" style="width:400px; height:400px; overflow-y:scroll; border:solid 1px #C3E4FE;">
                    {GROUPUSERS}
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary group" data-group="{ID}" data-act="groupedit">Изменить</button>
                <button type="button" class="btn btn-primary group" data-group="{ID}" data-act="groupadd">Создать</button>
                <button type="button" class="btn btn-primary group" data-group="{ID}" data-act="groupdel">Удалить</button>
            </div>
        </div>
    </div>
</div>