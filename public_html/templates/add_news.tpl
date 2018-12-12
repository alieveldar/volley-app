<div class="modal fade" id="edit_news{ID}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Нвости приложения</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label for="newstext{ID}">Скрипт нвоости</label>
                        <textarea type="text" class="form-control newstext{ID}" id="newstext{ID}" rows="10">{NEWS}</textarea>
                    </div>                    
                </form>                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary news" data-news="{ID}" data-act="newsedit">Изменить</button>
                <button type="button" class="btn btn-primary news" data-news="{ID}" data-act="newsadd">Создать</button>
                <button type="button" class="btn btn-primary news" data-news="{ID}" data-act="newsdel">Удалить</button>
            </div>
        </div>
    </div>
</div>