$(document).ready(function() {
    // find elements
    var vkUsers = $(".sign-up");

    // handle click and add class
    vkUsers.on("click", function(event) {
        var target = $(event.target);
        var id = target.data("vkid");
        var text = target.text();

        target.text("ОТПИСАТЬСЯ");
        //$(".signup-friend").addClass('MyClass');
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