var action_url = '/vkapi/core/action/index.php?mobile_view='+mobile_view+'&auth_key='+auth_key+'&qr='+qr+'&sex_member='+sex_member+'&viewer_id='+viewer_id+'&group_id='+group_id+'&action=';

Event = {
    reg: function (el, training_id, sex_training, last_name, first_name) {
        var sex_error = false;
        // if (sex_training != 3 && sex_member != sex_training) {
        //     CoreJS.notify('Тренировка не подходит для Вас по половому признаку!'); 
        //     sex_error = true;
        // }

        if (!sex_error) {
            $.ajax({
                url: action_url + 'EventReg', dataType: "json", type: "POST", data: {training_id: training_id, last_name: last_name, first_name: first_name},
                success: function(data) {
                    //if (viewer_id == 3017816 || viewer_id == 56610730) alert(data);
                    if ( data.error ) {
                    	CoreJS.notify(data.error);
                    }
                    else {
                    	CoreJS.notify(data.result,'Правила','CoreJS.tplmodal(\'rules\');return false;');
                    }
                },
                complete : function () {
                    Event.list(last_name,first_name);
                },
                fail: function () {
                    alert('error reg');
                }
            });
        }
    },
    
    unreg: function (el, training_id, last_name, first_name) {

        $.ajax({
            url: action_url + 'EventUnreg', type: "POST", data: {training_id: training_id},
            success: function(data) {
                CoreJS.notify(data);
            },
            complete : function (data) {
                Event.list(last_name,first_name);
            },
            fail: function () {
                alert('error unreg');
            }
        });
    },
    
    mdelete: function (el, training_id, member_delete) {

        $.ajax({
            url: action_url + 'MemberDelete', type: "POST", data: {training_id: training_id, member_delete: member_delete},
            success: function(data) {
                CoreJS.notify(data);
                console.log(data);
            },
            complete : function (data) {
                Event.list(last_name,first_name);
            },
            fail: function () {
                alert('error mdelete');
            }
        });
    },
    
    msearch: function (val,param) {

        $.ajax({
            url: action_url + 'MemberSearch', type: "POST", data: {val: val, param: param},
            success: function(data) {
                // CoreJS.notify(data);
                 $('.search_result').html(data);
                 $('#modal').modal('handleUpdate');
            },
            complete : function (data) {
               
            },
            fail: function () {
                alert('error mdelete');
            }
        });
    },
    
    mreserve: function (reserve_vkid,training_id) {

        $.ajax({
            url: action_url + 'EventReg', type: "POST", data: {reserve_vkid: reserve_vkid, training_id: training_id, sex_member: sex_member, last_name: last_name, first_name: first_name},
            success: function(data) {
                CoreJS.notify(data);
                Event.list(last_name,first_name);
            },
            complete : function (data) {
               
            },
            fail: function () {
                alert('error mdelete');
            }
        });
    },

    members: function (el, training_id) {
     
     var block_users = $(el).parent().parent().parent().find('.users');

     $.ajax({
        url: action_url + 'EventMembers', type: "POST", data: {training_id: training_id},
            success: function (data) {
                $(block_users).find('.users_content').html(data);
            },
            complete : function (data) {
         		$('.users').hide();
                $(block_users).show();
            },
            fail: function () {
                console.log('error members');
            }
        });
    },

    list: function (last_name,first_name) {

        $.ajax({
        url: action_url + 'EventList', dataType: "json", type: "POST", data: {last_name: last_name, first_name: first_name},
            success: function (data) {
                $('.events_content').html(data.result);
                $('.events_content.events_fixed').html(data.result_fixed);
            },
            complete : function (data) {
            },
            fail: function () {
                alert('error list');
            }
        });

    },

    list_filter: function (filter) {
        if ( filter != '' ) {
            console.log(filter);
            $(".events_content_filter .item").hide();
            $(".events_content_filter .item").filter(function (filter){
                return $(this).attr( "class" ) === filter
            }).toggle('show');
        }
        // $.ajax({
        // url: action_url + 'EventList', type: "POST", data: {last_name: last_name, first_name: first_name, filter: filter},
        //     success: function (data) {
        //         $('.events_content_filter').html(data);
        //     },
        //     complete : function (data) {
        //     },
        //     fail: function () {
        //         alert('error list');
        //     }
        // });
    },

    delete: function (el, training_id, notify) {

        $.ajax({
        url: action_url + 'EventDelete', type: "POST", data: {id: training_id, notify: notify},
            success: function (data) {
                $('.events_content').html(data);
            },
            complete : function (data) {
            },
            fail: function () {
                alert('error delete');
            }
        });
    },

    recall: function (training_id, texts) {

        /*if ( text.length < 10 && text.length > 400 ) CoreJS.notify("Текст должен быть не менее 10 и не более 400 символов.");
        else {*/
            $.ajax({
            url: action_url + 'EventRecall', type: "POST", data: {id: training_id, texts: texts},
                success: function (data) {
                    console.log(data);
                    $('.events_content').html(data);
                },
                complete : function (data) {
                	console.log(data);
                },
                fail: function () {
                    alert('error delete');
                }
            });
        //}
    }
}
Lease = {
    send: function(need_time, obj_week, viewer_id) {
            var i = false;
            var day_week = ['Понедельник','Вторник','Среда','Четверг','Пятница','Суббота','Воскресенье'];
            var lang_week = [];
            $("#day_week .custom-control-input:checked").each(function(){
                i = true;
                lang_week.push(day_week[parseInt($(this).val()) - 1]);
            });

        if ( i ) {
            CoreJS.sendmessage('56610730,3949085','Запрос на зал от https://vk.com/id'+viewer_id+'. Дни недели: ' + lang_week.join('; ') + '. Желаемое время: ' + need_time + ':00');

            CoreJS.notify("Запрос отправлен");
        }
        else {
            CoreJS.notify("Выберите дни недели");
        }
    }
}
CoreJS = {
    sendmessage: function(list,message) {
        $.ajax({
          url: action_url + 'SendMessage', type: "POST", data: {list:list,message:message},
            success: function (data) {
                console.log(data);
            },
            complete : function (data) {
                console.log(data);
            },
            fail: function () {
                console.log('error');
            }
         });
    },
    autosize: function() {
        if (!document.getElementById('isload')) {
            alert('error');
            return;
        }

        h = 0;
        if (typeof VK.callMethod != 'undefined') {
            modal_height = 0;
            if (document.getElementById('ajaxModal')) {
                h = $('.modal-dialog').height() + 60;
                if ( h < document.getElementById('isload').clientHeight ) h = document.getElementById('isload').clientHeight;
            }
            else {
                h = document.getElementById('isload').clientHeight;
            }

            VK.callMethod('resizeWindow', 0, h + 20);
        } else {
            alert('error #2');
        }
    },
    // loadCallback : function(vk_hash) {
    //     CoreJS.autosize(607);
    //         if ( vk_hash != 0 ) VK.callMethod("setLocation", vk_hash, false);
    // },
    notify: function (text,b2,f) {
        VK.callMethod('scrollWindow', 0);
        // $('#notify').html(text).show().animate({opacity: 1}, 1500).fadeOut(5500);
        CoreJS.modal(0, text, 'Закрыть',b2,f);
    },
    addnoreg: function (phone,fio, training_id) {
        $.ajax({
          url: action_url + 'MemberRegPhone', type: "POST", data: {phone:phone,fio:fio, training_id:training_id},
            success: function (data) {
                console.log(data);
            },
            complete : function (data) {
                console.log(data);
            },
            fail: function () {
                console.log('error');
            }
         });
    },
    modal: function (title,text,b1,b2,f) {
        $.ajax({
          url: action_url + 'ModalInit', type: "POST", data: {text:text,title:title,b1:b1,b2:b2,f:f},
            success: function (data) {
                VK.callMethod('scrollWindow', 0);
                $('#modal').html(data);
                $('#modal #ajaxModal').modal('show');
                $('#modal').on('hidden.bs.modal', function (e) {
                  $('#modal').empty();
                  $('.modal-backdrop').remove();  
                  $('body').scrollTop(10);
                });
                $('#modal').modal('handleUpdate');
            },
            complete : function (data) {
            },
            fail: function () {
                console.log('error');
            }
         });
    },
    tplmodal: function (tpl,param) {
        $.ajax({
          url: action_url + 'ModalInit', type: "POST", data: {tpl:tpl,param:param},
            success: function (data) {
                VK.callMethod('scrollWindow', 0);
                $('#modal').html(data);
                $('#modal #ajaxModal').modal('show');
                $('#modal').on('hidden.bs.modal', function (e) {
                  $('.modal-backdrop').remove();  
                  $('#modal').empty();
                  $(this).empty();
                });
                $('#modal').modal('handleUpdate');

            },
            complete : function (data) {
                $('#modal').modal('handleUpdate');
            },
            fail: function () {
                console.log('error');
                $('#modal').modal('handleUpdate');
            }
         });
    },
    widget: function () {
        $.ajax({
          url: action_url + 'WidgetUpdate', type: "POST", data: {},
            success: function (data) {
                alert(data);
            },
            complete : function (data) {
            },
            fail: function () {
                console.log('error');
            }
         });
    },
    map: function (center) {
        
         $.ajax({
          url: action_url + 'ModalInit', type: "POST", data: {tpl:'place'},
            success: function (data) {
                $('#modal').modal('handleUpdate');
                VK.callMethod('scrollWindow', 0);
                $('#modal').html(data);
                $('#modal #ajaxModal').modal('show');
                $('#modal').on('shown.bs.modal', function (e) {
                  
                });

            },
            complete : function (data) {
                $('#modal').modal('handleUpdate');
                myMap = new ymaps.Map('map', {
                    center: [54.69937857, 56.00155850],
                    zoom: 15,
                });         
                $('#modal').modal('handleUpdate');
            },
            fail: function () {
                console.log('error');
            }
         });

        console.log(center);
    }
}
uiActionsMenu = {
    keyToggle: function(t, e) {
        if (!checkKeyboardEvent(e)) return !1;
        var i = domClosest("_ui_menu_wrap", t);
        i && uiActionsMenu.toggle(i, !hasClass(i, "shown"))
    },
    toggle: function(el, s) {
        var dummyMenu = data(el, "dummyMenu");
        dummyMenu && (el = dummyMenu), toggleClass(el, "shown", s);
        var onhide = attr(el, "onHide");
        onhide && !hasClass(el, "shown") && eval(onhide)
    },
    show: function(t, e, i) {
        var s = data(t, "hidetimer");
        s && (clearTimeout(s), data(t, "hidetimer", 0));
        var o = data(t, "origMenu");
        if (o && (s = data(o, "hidetimer")) && (clearTimeout(s), data(t, "hidetimer", 0)), i && i.delay) {
            cur.uiActionsMenuShowTimeout && clearTimeout(cur.uiActionsMenuShowTimeout);
            var n = i.delay;
            return delete i.delay, void(cur.uiActionsMenuShowTimeout = setTimeout(uiActionsMenu.show.pbind(t, e, i), n))
        }
        if (cur.uiActionsMenuShowTimeout && (clearTimeout(cur.uiActionsMenuShowTimeout), delete cur.uiActionsMenuShowTimeout), i && i.appendParentCls) {
            var r, l, a = geByClass1("_ui_menu", t);
            if (a) {
                l = domClosest(i.appendParentCls, a), r = domClosest("_ui_menu_wrap", t);
                var h = se('<div class="' + r.className + ' ui_actions_menu_dummy_wrap" onmouseover="uiActionsMenu.show(this);" onmouseout="uiActionsMenu.hide(this);"></div>');
                if (h.appendChild(a), l.appendChild(h), data(t, "dummyMenu", h), data(h, "origMenu", t), t = h, data(a, "top", intval(getStyle(a, "top"))), data(a, "left", intval(getStyle(a, "left"))), data(a, "right", intval(getStyle(a, "right"))), i.processHoverCls) {
                    var d = domClosest(i.processHoverCls, r);
                    addEvent(t, "mouseover", addClass.pbind(d, "hover")), addEvent(t, "mouseout", removeClass.pbind(d, "hover"))
                }
            } else t = data(t, "dummyMenu");
            var u = data(t, "origMenu");
            a = geByClass1("_ui_menu", t), r = domClosest("_ui_menu_wrap", u), l = domClosest(i.appendParentCls, a), setStyle(a, {
                display: "block"
            });
            var c = getXY(l),
                p = getXY(r),
                m = data(a, "top"),
                g = data(a, "left"),
                v = data(a, "right"),
                _ = {
                    top: p[1] - c[1] + m
                };
            v ? _.right = getSize(l)[0] + c[0] - p[0] - getSize(r)[0] + v : _.left = p[0] - c[0] + g, setStyle(a, _)
        }
        var a = geByClass1("_ui_menu", t);
        if (i && i.autopos && a && !hasClass(t, "shown")) {
            removeClass(t, "ui_actions_menu_left");
            var f = getXY(t)[1],
                b = getSize(t)[1],
                w = getSize(a)[1],
                S = i.dy || 10,
                C = getXY(a)[0];
            removeClass(t, "ui_actions_menu_top"), addClass(t, "no_transition"), f + b + S + w > (browser.mozilla ? getSize("page_wrap")[1] : scrollGetY() + (window.lastWindowHeight || 0)) && addClass(t, "ui_actions_menu_top"), f - S - w < scrollGetY() + getSize("page_header_wrap")[1] && removeClass(t, "ui_actions_menu_top"), toggleClass(t, "ui_actions_menu_left", 0 > C), removeClass(t, "no_transition")
        }
        i && i.scroll && i.maxHeight && (a.style.maxHeight = (intval(i.maxHeight) || 200) + "px", a.__uiScroll__ || new uiScroll(a)), uiActionsMenu.toggle(t, !0)
    },
    hide: function(t, e) {
        cur.uiActionsMenuShowTimeout && (clearTimeout(cur.uiActionsMenuShowTimeout), delete cur.uiActionsMenuShowTimeout);
        var i = data(t, "hidedelay");
        i ? data(t, "hidedelay", !1) : i = 200;
        var s = data(t, "hidetimer");
        s || data(t, "hidetimer", setTimeout(function() {
            uiActionsMenu.toggle(t, !1), data(t, "hidetimer", 0)
        }, i))
    },
    hideDelay: function(t, e) {
        data(t, "hidedelay", e)
    }
}

VK.init(
    function() {
        if (mobile_view) {
            $(".wrap").addClass('mobile');
        } 

        // VK.callMethod("setTitle", "Расписание тренировок rgsport.ru");


        Event.list(last_name,first_name);
        filter = '';
        Event.list(last_name,first_name,filter);
        
        setInterval('CoreJS.autosize(607)', 500);
        // if (viewer_id == 56610730) {VK.callMethod("showGroupSettingsBox", 64); VK.callMethod('showAppWidgetPreviewBox', 'text', 'return {' + '"title": "",' + '"text": ""' + '};'); }
        if (!messagefromgroup) VK.callMethod("showAllowMessagesFromCommunityBox");
    }, 
    function() {
     console.log('API initialization failed');
    },
    '5.78'
);