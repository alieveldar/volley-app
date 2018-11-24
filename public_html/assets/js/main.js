$(document).ready(function() {
    // find elements
    var vkUsers = $(".sign-up");

    // handle click and add class
    vkUsers.on("click", function(event) {
        var target = $(event.target);
        var id = target.data("vkid");
        var sched = target.data("sched");
        if (sched == "") {
            target.text("Отписаться");
            target.data("sched", 1);
        } else if (sched == 1) {
            target.text("Записаться");
            target.data("sched" , 2);
        } else if (sched == 2) {
            target.text("Отписаться");
            target.data("sched", 1);
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