$(document).ready(function() {
    // find elements
    var vkUsers = $(".sign-up");

    // handle click and add class
    vkUsers.on("click", function(event) {
        var target = $(event.target);
        var id = target.data("vkid");
        var trid = target.data("trid");
        var sched = target.attr("data-sched");
        var hideUser = $(".u" + id + trid);
        var currUser = $(".c"+ id);
        if (sched == "") {
            target.text("Отписаться");
            target.attr("data-sched", 3);            
            currUser.show();
            
        } else if (sched == 1) {
            target.text("Записаться");
            target.attr("data-sched" , 2);
            hideUser.hide();
            currUser.hide();
        } else if (sched == 2) {
            target.text("Отписаться");
            target.attr("data-sched", 1);
            currUser.show();
            
        } else if (sched == 3) {
            target.text("Записаться");
            target.attr("data-sched", "");
            currUser.hide();
        }
        
        var uri = "/api.php?action=";
        var action = "schedule";
        var vkid = "&vkid=" + target.data("vkid");
        var trid = "&trid=" + target.data("trid");

        $.ajax({
            url: uri + action + vkid + trid,
            success: function(data) {
                alert(data);
            }
        });

    });
});