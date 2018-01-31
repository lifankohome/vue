# Vue
Vue.js 网络记事本

###mysql
```
CREATE TABLE `lifanko`.`note` 
( `id` INT NOT NULL AUTO_INCREMENT , 
`name` VARCHAR(8) NOT NULL , 
`todo` VARCHAR(32) NOT NULL , 
`status` BOOLEAN NOT NULL DEFAULT TRUE , 
`start` VARCHAR(16) NOT NULL , 
`end` VARCHAR(16) NOT NULL , 
PRIMARY KEY (`id`))
ENGINE = InnoDB CHARACTER SET utf8 COLLATE utf8_general_ci COMMENT = '网络笔记本';
```