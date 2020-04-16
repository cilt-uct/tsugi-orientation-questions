<?php

namespace AppBundle;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use \Tsugi\Core\Settings;
use \Tsugi\Util\Net;

class Home {

    public function get(Request $request, Application $app)
    {
        global $CFG, $PDOX;
        $p = $CFG->dbprefix;

        $EID = $app['tsugi']->context->launch->ltiRawParameter('lis_person_sourcedid', $app['tsugi']->user->id);
        
        $context = array();
    	$context['style'] = $CFG->getCurrentFileUrl('static/user.css');
	    $context['submit'] = addSession('/tsugi/mod/tsugi-orientation-questions/index.php'); //$CFG->getCurrentFileUrl('index.php'));
        
        $rows = $PDOX->allRowsDie("SELECT answer FROM {$p}Orientation_Questions
                    WHERE EID = :EID and user_id = :user_id",
                    array(':user_id' => $app['tsugi']->user->id, ':EID' => $EID)
                );
        if (count($rows) > 0) {
            $context['selected'] = $rows[0];
        } else {
            $context['selected'] = array('answer' => -1);
        }
        
        $context['path'] = $CFG->staticroot;
        $context['email'] = $app['tsugi']->user->email;
        $context['user'] = $app['tsugi']->user->displayname;
        $context['username'] = $EID;

        return $app['twig']->render('Home.twig', $context);
    }

    public function post(Request $request, Application $app) {
        global $CFG, $PDOX;
        $p = $CFG->dbprefix;

        $EID = $app['tsugi']->context->launch->ltiRawParameter('lis_person_sourcedid', $app['tsugi']->user->id);
        $PDOX->queryDie("INSERT INTO {$p}Orientation_Questions
            (link_id, user_id, ipaddr, EID, answer, updated)
            VALUES ( :LI, :UI, :IP, :EID, :answer, NOW() )
            ON DUPLICATE KEY UPDATE updated = NOW(), answer = :answer",
            array(
                ':LI' => $app['tsugi']->link->id,
                ':UI' => $app['tsugi']->user->id,
                ':IP' => Net::getIP(),
                'EID' => $app['tsugi']->context->launch->ltiRawParameter('lis_person_sourcedid','none'),
                ':answer' => $_POST['val']
            )
        );
        // $app->tsugiFlashSuccess(__('Attendance Recorded...'));
        return json_encode(['done' => 1, 'answer' => $_POST['val']]);
    }
}
