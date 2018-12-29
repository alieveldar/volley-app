<div class="modal fade" id="add_part" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Пользователи записавшиеся на тренировку</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">                
                <div class="users container" style="width:400px; height:400px; overflow-y:scroll; border:solid 1px #C3E4FE;">
                    <ul class="trainingusers_list" style="block:inline;">
                </ul>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary group" data-trid="{ID}" data-act="checkintruders">Отметить пропустивших тренировку</button>             
            </div>
        </div>
    </div>
</div>