$(function(){
    var pid = getUrlParam('p');
    if(pid){
        var auth_result = asyncAjax('/video/play_auth.php',{'pid':pid});

        if(auth_result['err'] == 0 ){
            var video_title = auth_result['msg']['video_title'];
            $('.blog-single-category').html(video_title);
            //var video_url = auth_result['msg']['video_url'];

//            if (auth_result['msg']['pass'] == 1) { //鉴权通过
//               $('#Xfplay [name="URL"]').val(video_url);
//               $('#Xfplay').find('embed').attr('PARAM_URL',video_url);
//               $('#vip').show();
//            }else { //鉴权不通过,进行试看
            var doc = document;
            var f = 1;
            var o = $('.apiv-overlay');
            var video_url = auth_result['msg']['video_url'];
            if(video_url) {
                $(document).attr('title',auth_result['msg']['video_title']);
                var options = {
                    "techOrder": ["html5", "flash"],
                    "playbackRates": [2, 1.5, 1.25, 1, 0.5]
                };
                videojs("shikan_video", options, function () {
                    var a = this;
                    a.src(video_url);
                    a.on('error', function () {
                        if ((a.error().code === 3 || a.error().code === 4) && a.techName_ != 'Flash') {
                            a.src({src: a.src(), type: 'video/flv'});
                        }
                        if (a.error().code === 4) {

                            $(".vjs-error-display").on("click", function () {
                                window.location.reload();
                                // window.open(a.src())
                                // setTimeout(function () {
                                //     location.href = window.location.origin + '/magnet/';
                                // }, 456)
                            });
                        }
                    });
                    //a.el().appendChild(doc.querySelector(".apiv-overlay"));
                    $('.apiv-hero').on('click', function () {
//                     f=0;
//                     a.play();
//                     o.addClass('neno');
                    });
                    a.on(['play', 'playing'], function () {
//                     a.el().appendChild(doc.querySelector("#logo"));
//                     o.addClass('neno');
                    });
                    a.on('pause', function () {
//                     setTimeout(function(){
//                        if(a.paused()&&f==1){
//                           o.removeClass('neno');
//                        }
//                     },159)
                    });
                    $("body").one("click", function () {
                        //alert('xx');
                        //a.el().appendChild(doc.querySelector("#logo"));
                    });
//                  $(doc).keypress(function(b){
//                     var k = b.which || b.keyCode;
//                     switch(k){
//                        case 13:
//                           if(!a.isFullscreen()){
//                              a.requestFullscreen();
//                           }else{
//                              a.exitFullscreen();
//                           };
//                           break;
//
//                        case 32:
//                           if(a.paused()){
//                              a.play();
//                           }else{
//                              a.pause();
//                           }
//                           break;
//
//                        case 37:
//                           a.currentTime(a.currentTime()-5);
//                           break;
//
//                        case 39:
//                           a.currentTime(a.currentTime()+5);
//                           break;
//
//                        case 50:
//                           if(f==0){
//                              f=1;
//                              o.removeClass('neno');
//                           }else{
//                              f=0;o.addClass('neno');
//                           }
//                           break;
//
//                        case 57:
//                           //window.open(a.src());
//                           break;
//                     }
//                     return false;
//                  })

                    if (auth_result['msg']['pass'] != 1) {
                        a.on('timeupdate', function () {
                            var whereYouAt = this.currentTime();
                            if (whereYouAt > 300) {
                                this.pause();
                                setTimeout(function () {
                                    if (a.paused() && f == 1) {
                                        o.removeClass('neno');
                                    }
                                    if (a.isFullscreen()) {
                                        a.exitFullscreen();
                                    }
                                    ;
                                }, 159)
                                //$('#shikan_video').remove();
                                //var info = $('#dialog').html();
                                //$('#shikan').html(info);
                                //$( "#dialog" ).dialog();
                                //$('.apiv-overlay neno').show();
                            }else{
                                o.addClass('neno');
                                a.play();
                            }

                        });
                    }
                });
                $('#code').focus(function(){
                    $(this).val('');
                })
                $('#exchange_result').click(function(){
                    var code = $('#code').val();
                    if(!code){
                        alert('请输入兑换码');
                    }else{
                        var exchange_data = {
                            'pid' : pid,
                            'code' : code
                        }
                        var exchange_result = asyncAjax('/video/exchange.php',exchange_data);
                        if(exchange_result['err'] == 0 ){
                            if(exchange_result['status'] == '0000'){//兑换成功
                                //$( "#dialog" ).dialog('close');
                                //alert();
                                $('#dialog').html(exchange_result['msg']);
                                setTimeout("window.location.reload()",2000);
                            }else{
                                alert(exchange_result['msg']);
                                //$('#error').html(exchange_result['msg']);
                            }
                        }else{
                            //$('#error').html(exchange_result['msg']);
                            alert(exchange_result['msg'])
                        }
                    }
                })

                $('#shikan').show();
            }else {
                $("body").css("background-color",'white');
                $('#shikan').hide();
                $('#download').show();

            }
            //}
        }else{
            if(auth_result['status'] == '0001'){//未登录
                alert(auth_result['msg']);
                var url = '/wp-login.php?redirect_to=' + encodeURI(window.location.href);
                window.location.href = url;
            }

        }
    }else{
        alert('pid不能为空');
        return false;
    }

})
