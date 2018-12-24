$(document).ready(function() {
    // find elements
    var vkUsers = $(".sign-up");
    var searchVkid;
    var searchTrid;
    // handle click and add class
    vkUsers.on("click", function(event) {
        var target = $(event.target);
        var id = target.data("vkid");
        var trid = target.data("trid");
        var sched = target.attr("data-sched");
        var hideUser = $(".u" + id + trid);
        var currUser = $(".c"+ id +trid);

        if (sched == "") {
            target.text("Отписаться");
            target.attr("data-sched", 5);            
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
            
        } else if (sched == 5) {
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
                location.reload();
            }
        });

        
        

    });

 VK.init(function() { 
     // API initialization succeeded 
     // Your code here 

  }, function() { 
     // API initialization failed 
     // Can reload page here 
     location.reload();
}, '5.92'); 
 var vkFUsers = $(".signup-friend");
  vkFUsers.on("click", function(event){
 //VK.callMethod("showInviteBox");
 var target = $(event.target);
 window.searchVkid = target.data('vkid');
 window.searchTrid = target.data('trid'); 
});
  function searchFriends(name){
    var url = "/api.php?action=friendssearch&q=" + name + "&vkid=" + window.searchVkid + "&trid=" + window.searchTrid;
    alert(url);
  }
  //VK.callMethod("showAllowMessagesFromCommunityBox", -173367750); //запрос сообщений группы
});