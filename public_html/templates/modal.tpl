<div class="modal fade" id="{CELL_ID}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{DAY} {ADRESS} {CAPACITY}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="contacts">
                    {CONTACTS} </div>
                <div class="room_map">{YA_MAP}
                </div>
                <div class="date_cost">{DATE}
                    {PRICE}
                </div>
                <div class="training_desc">{TRAINING_DESC} </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary sign-up " data-vkid="{vkid}" data-trid = "{trid}" data-sched = "{sched}">{schedbutton}</button>
                <button type="button" class="btn btn-primary signup-friend" data-vkid="{vkid}">Записать друга</button>
            </div>
        </div>
    </div>
</div>