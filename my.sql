

﻿CREATE TABLE `wordpress`.`wp_vip` (
   `id` INT(10) NOT NULL AUTO_INCREMENT ,
   `uid` INT(10) NOT NULL COMMENT '用户id' ,
   `expire_time` INT(20) NOT NULL COMMENT '过期时间' ,
   PRIMARY KEY (`id`), INDEX `UID_INDEX` (`uid`)
 ) ENGINE = MyISAM CHARSET=utf8 COLLATE utf8_bin COMMENT = 'vip用户表';




﻿CREATE TABLE `wordpress`.`wp_order` (
`id` INT(10) NOT NULL AUTO_INCREMENT ,
`order_id` INT(22) NOT NULL COMMENT '订单号' ,
`uid` INT(10) NOT NULL COMMENT '用户id' ,
`create_time` INT(20) NOT NULL COMMENT '订单创建时间' ,
`pay_time` INT(20) NOT NULL COMMENT '订单支付时间' ,
`pid` INT(10) NOT NULL COMMENT '购买的文章id/ 0代表vip' ,
`pay_type` VARCHAR(20) NOT NULL COMMENT '支付方式/支付宝/微信' ,
`status` VARCHAR(20) NOT NULL DEFAULT 'create' COMMENT '订单状态/创建 支付完成关闭' ,
`expires` INT(20) NOT NULL COMMENT '订单有效期' ,
`amount` TINYINT(2) NOT NULL COMMENT '订单金额' ,
PRIMARY KEY (`id`), INDEX `INDEX_ORDERID` (`order_id`), INDEX `INDEX_UID_PID` (`uid`, `pid`))
ENGINE = MyISAM CHARSET=utf8 COLLATE utf8_general_ci COMMENT = '订单表';