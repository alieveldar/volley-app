<div class="modal fade" id="add_friend" role="dialog" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLiveLabel">
                    Поиск друзей
                </h5>
                <button aria-label="Close" class="close" data-dismiss="modal" type="button">
                    <span aria-hidden="true">
                        &times;
                    </span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>
                        Поиск в списке друзей
                    </label>
                    <input class="form-control {SEARCHING}" onkeyup="if($(this).val().length>2) searchFriends($(this).val()); return false;" placeholder="Начните вводить имя друга" type="text">
                </div>
                <ul class="search_result list-group">
                </ul>
            </div>
        </div>
    </div>
</div>