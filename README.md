# Vue
Vue.js Net Notebook

### Features
 + Note Real Time Add
 + Input Auto Clear
 + Anti SQL-Injection
 + Order By DESC
 + Task Period Calculate

### Screenshot
![Screenshots](https://github.com/lifankohome/vue/blob/master/Vue-screenshot.jpg?raw=true)

### Mysql
```
CREATE TABLE `lifanko`.`note` 
( `id` INT NOT NULL AUTO_INCREMENT , 
`name` VARCHAR(8) NOT NULL , 
`todo` VARCHAR(32) NOT NULL , 
`status` TINYINT(1) NOT NULL DEFAULT 0 , 
`start` VARCHAR(16) NOT NULL , 
`end` VARCHAR(16) NOT NULL , 
PRIMARY KEY (`id`))
ENGINE = InnoDB CHARACTER SET utf8 COLLATE utf8_general_ci COMMENT = '网络笔记本';
```