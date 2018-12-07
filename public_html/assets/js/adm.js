$(document).ready(function() {
    // find elements
    var trainers = $(".trainer");

    // handle click and add class
    trainers.on("click", function(event) {
        var sex;
        var target = $(event.target);
        var id = target.data("trainer");

        var action = target.data("act");

        var name = "&name=" + $(".trainername" + id).val();

        var surname = "&surname=" + $(".trainersurname" + id).val();

        var tel = "&tel=" + $(".trainertel" + id).val();

        var vkid = "&vkid=" + $(".trainervkid" + id).val();

        if ($(".trainermen" + id).prop("checked")) {
            sex = "&sex=" + $(".trainermen" + id).val();
        } else if ($(".trainerwomen" + id).prop("checked")) {
            sex = "&sex=" + $(".trainerwomen" + id).val();
        } else {
            sex = "&sex=" + 0;
        }

        id = "&id=" + id;
        var uri = "/api.php?action=" + action + id + name + surname + tel + vkid + sex;

        $.ajax({
            url: uri,
            success: function(data) {
                alert(data);
                location.reload();
            }
        });
    });

    var levels = $(".level");
    levels.on("click", function(event) {
        var target = $(event.target);
        var id = target.data("level");
        var action = target.data("act");
        var intensity = "&intensity=" + $(".levelintensity" + id).val();
        console.log(intensity);
        var description = "&description=" + $(".leveldescription" + id).val();
        console.log(description);
        id = "&id=" + id;
        console.log(id);
        var uri = "/api.php?action=" + action + id + intensity + description;
        $.ajax({
            url: uri,
            success: function(data) {
                alert(data);
                location.reload();
            }
        });
    });
});