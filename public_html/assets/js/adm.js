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

    var news = $(".news");
    news.on("click", function(event) {
        var target = $(event.target);
        var id = target.data("news");
        var action = target.data("act");
        var newstext = "&newstext=" + encodeURIComponent($(".newstext" + id).val());
        id = "&id=" + id;
        var uri = "/api.php?action=" + action + id + newstext;
        $.ajax({
            url: uri,
            success: function(data) {
                alert(data);
                location.reload();
            }
        });
    });

    var training = $(".training");
    training.on("click", function(event) {
        var target = $(event.target);
        var id = target.data("training");
        var action = target.data("act");
        var trainer = "&trainer=" + $(".training_trainer" + id).val();
        var room = "&volley_room=" + $(".training_room" + id).val();
        var date = "&date=" + $(".training_date" + id).val();
        console.log(date);
        var day = "&day_of_week=" + $(".training_weekDay" + id).val();
        console.log(day);
        var startTime = "&start_time=" + $(".training_time" + id).val();
        var capacity = "&capacity=" + $(".training_capacity" + id).val();
        var intensity = "&level=" + $(".training_level" + id).val();
        var price = "&price=" + $(".training_price" + id).val();
        id = "&id=" + id;
        var uri = "/api.php?action=" + action + id + trainer + room + date + day + startTime + capacity + intensity + price;
        $.ajax({
            url: uri,
            success: function(data) {
                alert(data);
                location.reload();
            }
        });
    });

    var groups = $(".group");
    groups.on("click", function(event) {
        var target = $(event.target);
        var id = target.data("group");
        var action = target.data("act");        
        var checked = $('.users_list' + id);
        var idvkstr = '&idvk=';        
        var groupname = '&groupname=' + $('.groupname' + id).val();        
        checked.each(function() {
            if ($(this).prop('checked')) {
               // checked.push($(this).data("vkid"));
               idvkstr = idvkstr +  ($(this).data("vkid")) + ',';
            }
        });        
        id = "&id=" + id;
        var uri = "/api.php?action=" + action + idvkstr + id + groupname;        
        $.ajax({
            url: uri,
            success: function(data) {
                alert(data);
                location.reload();
            }
        });
    });

    var trainMessage = $(".tmess");
    trainMessage.on("click", function(event){
        var target = $(event.target);
        var id = target.data('trid');
        var action = target.data("act");
        var message = "&message=" + encodeURIComponent($('.messtext' + id).val());
        id = "&trid=" + id;
        var uri = "/api.php?action=" + action + id + message;
       $.ajax({
            url: uri,
            success: function(data) {
                alert(data);
                location.reload();
            }
        }); 
    });

    var groupMessage = $(".gmess");
    groupMessage.on("click", function(event){
        var target = $(event.target);
        var id = target.data('grid');
        var action = target.data("act");
        var message = "&message=" + encodeURIComponent($('.messtext' + id).val());
        id = "&grid=" + id;        
        var uri = "/api.php?action=" + action + id + message;
       $.ajax({
            url: uri,
            success: function(data) {
                alert(data);
                location.reload();
            }
        }); 
    });
});