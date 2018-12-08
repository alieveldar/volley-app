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

    var rooms = $(".room");
    rooms.on("click", function(event) {
        var target = $(event.target);
        var id = target.data("room");
        var action = target.data("act");
        var roomname = "&roomname=" + $(".roomname" + id).val();
        var roomcity = "&roomcity=" + $(".roomcity" + id).val();
        var roomadress = "&roomadress=" + $(".roomadress" + id).val();
        var roomimage = "&roomimage=" + $(".roomimage" + id).val();
        var roomiya = "&roomiya=" + $(".roomiya" + id).val();
        id = "&id=" + id;
        var uri = "/api.php?action=" + action + id + roomname + roomcity + roomadress + roomimage + roomiya;
        $.ajax({
            url: uri,
            success: function(data) {
                alert(data);
                location.reload();
            }
        });
    });

    var roots = $(".roots");
    roots.on("click", function(event) {
        var target = $(event.target);
        var id = target.data("roots");
        console.log(id);
        var action = target.data("act");
        console.log(action);
        var rootname = "&rootname=" + $(".rootname" + id).val();
        console.log(rootname);
        var rootsurname = "&rootsurname=" + $(".rootsurname" + id).val();
        console.log(rootsurname);
        var rootidvk = "&rootidvk=" + $(".rootidvk" + id).val();        
        console.log(rootidvk);
        id = "&id=" + id;
        var uri = "/api.php?action=" + action + id + rootname + rootsurname + rootidvk;
        $.ajax({
            url: uri,
            success: function(data) {
                alert(data);
                location.reload();
            }
        });
    });

});