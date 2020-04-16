<?php

// The SQL to uninstall this tool
$DATABASE_UNINSTALL = array(
"drop table if exists {$CFG->dbprefix}Orientation_Questions"
);

// The SQL to create the tables if they don't exist
$DATABASE_INSTALL = array(
array( "{$CFG->dbprefix}Orientation_Questions",
"create table {$CFG->dbprefix}Orientation_Questions (
    `link_id` int(11) NOT NULL,
    `user_id` int(11) NOT NULL,
    `answer` tinyint(1) NOT NULL,
    `ipaddr` varchar(64) DEFAULT NULL,
    `created` datetime DEFAULT CURRENT_TIMESTAMP,
    `updated` datetime DEFAULT CURRENT_TIMESTAMP,

    CONSTRAINT `{$CFG->dbprefix}orientation_ibfk_1`
        FOREIGN KEY (`link_id`)
        REFERENCES `{$CFG->dbprefix}lti_link` (`link_id`)
        ON DELETE CASCADE ON UPDATE CASCADE,

    CONSTRAINT `{$CFG->dbprefix}orientation_ibfk_2`
        FOREIGN KEY (`user_id`)
        REFERENCES `{$CFG->dbprefix}lti_user` (`user_id`)
        ON DELETE CASCADE ON UPDATE CASCADE,

    UNIQUE(link_id, user_id),
    KEY `IDX_ANSWER` (`answer`)

) ENGINE = InnoDB DEFAULT CHARSET=utf8")
);
