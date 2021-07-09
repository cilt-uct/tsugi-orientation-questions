<?php

$REGISTER_LTI2 = array(
    "name" => "Orientation Questionnaire"
    ,"FontAwesome" => "fa-pencil-alt"
    ,"short_name" => "Orientation Questionnaire"
    ,"description" => "Simple orientation questionnaire for students to complete."
    ,"messages" => array("launch") // By default, accept launch messages..
    ,"privacy_level" => "name_only" // anonymous, name_only, public
    ,"license" => "Apache"
    ,"languages" => array(
        "English",
    )
    ,"source_url" => "https://github.com/cilt-uct/tsugi-orientation-questions"
    // For now Tsugi tools delegate this to /lti/store
    ,"placements" => array(
        /*
        "course_navigation", "homework_submission",
        "course_home_submission", "editor_button",
        "link_selection", "migration_selection", "resource_selection",
        "tool_configuration", "user_navigation"
        */
    )
    ,"screen_shots" => array(
        /* no screenshots */
    )
);