$(document).ready(function() {
    // find elements
    var trainers = $(".trainer");

    // handle click and add class
    trainers.on("click", function(event) {
        var sex;
        var target = $(event.target);
        var id = target.data("trainer");
        console.log(id);
        var action = target.data("act");
        console.log(action);
        var name = "&name=" + $(".trainername" + id).val();
        console.log(name);
        var surname = "&surname=" + $(".trainersurname" + id).val();
        console.log(surname);
        var tel = "&tel=" + $(".trainertel" + id).val();
        console.log(tel);
        var vkid = "&vkid=" + $(".trainervkid" + id).val();
        console.log(vkid);
        if ($(".trainermen" + id).prop("checked")) {
            sex = "&sex=" + $(".trainermen" + id).val();
        } else if ($(".trainerwomen" + id).prop("checked")) {
            sex = "&sex=" + $(".trainerwomen" + id).val();
        } else {
            sex = "&sex=" + 0;
        }
        console.log(sex);
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

});