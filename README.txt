
================ iframe pop插件的源码更改 ===========
1、iframe的播放器全屏

打开 wordpress根目录/wp-content/plugins/iframe-popup/inc/jquery.fancybox-1.3.4.js

找到 if (currentOpts.type == 'iframe') 这句话。把他改成下面的
          if (currentOpts.type == 'iframe') {
   				$('<iframe allowfullscreen="true" webkitallowfullscreen="true" mozallowfullscreen="true" id="fancybox-frame" name="fancybox-frame' + new Date().getTime() + '" frameborder="0" hspace="0" ' + ($.browser.msie ? 'allowtransparency="true""' : '') + ' scrolling="' + selectedOpts.scrolling + '" src="' + currentOpts.href + '"></iframe>').appendTo(content);
   			}


2、不是自动跳出iframe,改为点击弹出

  打开 wordpress根目录/wp-content/plugins/iframe-popup/classes/iframe-widget.php

  注释掉 setTimeout('iframepopupwidow()', '<?php echo $form['timeout']; ?>');

  在最后加上
  <input type='button' value="点击播放" onclick="iframepopupwidow()"> (样式还需要再调整)

  或者这句话就直接在文章里面加。这样也好自定义的放按钮的位置



