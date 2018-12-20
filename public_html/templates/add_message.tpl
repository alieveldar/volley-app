<div class="modal fade" id="group_message{ID}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Отправить сообщение записавшимся</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label for="msgtext{ID}">Текст сообщения</label>
                        <textarea type="text" class="form-control messtext{ID}" id="messtext{ID}" rows="10"></textarea>
                    </div>                    
                </form>                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary gmess" data-grid="{ID}" data-act="sendmessgroup">Отправить</button>
            </div>
        </div>
    </div>
</div>