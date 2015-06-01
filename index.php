<?php
/**
 * Step 1: Require the Slim Framework
 *
 * If you are not using Composer, you need to require the
 * Slim Framework and register its PSR-0 autoloader.
 *
 * If you are using Composer, you can skip this step.
 */
// require 'Slim/Slim.php';
 
// \Slim\Slim::registerAutoloader();
 
/**
 * Step 2: Instantiate a Slim application
 *
 * This example instantiates a Slim application using
 * its default settings. However, you will usually configure
 * your Slim application now by passing an associative array
 * of setting names and values into the application constructor.
 */
require __DIR__.'/vendor/autoload.php';
$app = new \Slim\Slim();
 
error_reporting(E_ALL);
ini_set("display_errors", 1);
ini_set("memory_limit", "1024M");
ini_set('max_execution_time', 0); //300 seconds = 5 minutes
 
/**
 * Step 3: Define the Slim application routes
 *
 * Here we define several Slim application routes that respond
 * to appropriate HTTP request methods. In this example, the second
 * argument for `Slim::get`, `Slim::post`, `Slim::put`, `Slim::patch`, and `Slim::delete`
 * is an anonymous function.
 */
 
// GET route
$app->get(
    '/',
    function () {
        $template = <<<EOT
<!DOCTYPE html>
    <html>
        <head>
            <meta charset="utf-8"/>
            <title>Slim Framework for PHP 5</title>
            <style>
                html,body,div,span,object,iframe,
                h1,h2,h3,h4,h5,h6,p,blockquote,pre,
                abbr,address,cite,code,
                del,dfn,em,img,ins,kbd,q,samp,
                small,strong,sub,sup,var,
                b,i,
                dl,dt,dd,ol,ul,li,
                fieldset,form,label,legend,
                table,caption,tbody,tfoot,thead,tr,th,td,
                article,aside,canvas,details,figcaption,figure,
                footer,header,hgroup,menu,nav,section,summary,
                time,mark,audio,video{margin:0;padding:0;border:0;outline:0;font-size:100%;vertical-align:baseline;background:transparent;}
                body{line-height:1;}
                article,aside,details,figcaption,figure,
                footer,header,hgroup,menu,nav,section{display:block;}
                nav ul{list-style:none;}
                blockquote,q{quotes:none;}
                blockquote:before,blockquote:after,
                q:before,q:after{content:'';content:none;}
                a{margin:0;padding:0;font-size:100%;vertical-align:baseline;background:transparent;}
                ins{background-color:#ff9;color:#000;text-decoration:none;}
                mark{background-color:#ff9;color:#000;font-style:italic;font-weight:bold;}
                del{text-decoration:line-through;}
                abbr[title],dfn[title]{border-bottom:1px dotted;cursor:help;}
                table{border-collapse:collapse;border-spacing:0;}
                hr{display:block;height:1px;border:0;border-top:1px solid #cccccc;margin:1em 0;padding:0;}
                input,select{vertical-align:middle;}
                html{ background: #EDEDED; height: 100%; }
                body{background:#FFF;margin:0 auto;min-height:100%;padding:0 30px;width:440px;color:#666;font:14px/23px Arial,Verdana,sans-serif;}
                h1,h2,h3,p,ul,ol,form,section{margin:0 0 20px 0;}
                h1{color:#333;font-size:20px;}
                h2,h3{color:#333;font-size:14px;}
                h3{margin:0;font-size:12px;font-weight:bold;}
                ul,ol{list-style-position:inside;color:#999;}
                ul{list-style-type:square;}
                code,kbd{background:#EEE;border:1px solid #DDD;border:1px solid #DDD;border-radius:4px;-moz-border-radius:4px;-webkit-border-radius:4px;padding:0 4px;color:#666;font-size:12px;}
                pre{background:#EEE;border:1px solid #DDD;border-radius:4px;-moz-border-radius:4px;-webkit-border-radius:4px;padding:5px 10px;color:#666;font-size:12px;}
                pre code{background:transparent;border:none;padding:0;}
                a{color:#70a23e;}
                header{padding: 30px 0;text-align:center;}
            </style>
        </head>
        <body>
            <header>
                <a href="http://www.slimframework.com"><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAHIAAAA6CAYAAABs1g18AAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAABRhJREFUeNrsXY+VsjAMR98twAo6Ao4gI+gIOIKOgCPICDoCjCAjXFdgha+5C3dcv/QfFB5i8h5PD21Bfk3yS9L2VpGnlGW5kS9wJMTHNRxpmjYRy6SycgRvL18OeMQOTYQ8HvIoJKiiz43hgHkq1zvK/h6e/TyJQXeV/VyWBOSHA4C5RvtMAiCc4ZB9FPjgRI8+YuKcrySO515a1hoAY3nc4G2AH52BZsn+MjaAEwIJICKAIR889HljMCcyrR0QE4v/q/BVBQva7Q1tAczG18+x+PvIswHEAslLbfGrMZKiXEOMAMy6LwlisQCJLPFMfKdBtli5dIihRyH7A627Iaiq5sJ1ThP9xoIgSdWSNVIHYmrTQgOgRyRNqm/M5PnrFFopr3F6B41cd8whRUSufUBU5EL4U93AYRnIWimCIiSI1wAaAZpJ9bPnxx8eyI3Gt4QybwWa6T/BvbQECUMQFkhd3jSkPFgrxwcynuBaNT/u6eJIlbGOBWSNIUDFEIwPZFAtBfYrfeIOSRSXuUYCsprCXwUIZWYnmEhJFMIocMDWjn206c2EsGLCJd42aWSyBNMnHxLEq7niMrY2qyDbQUbqrrTbwUPtxN1ZZCitQV4ZSd6DyoxhmRD6OFjuRUS/KdLGRHYowJZaqYgjt9Lchmi3QYA/cXBsHK6VfWNR5jgA1DLhwfFe4HqfODBpINEECCLO47LT/+HSvSd/OCOgQ8qE0DbHQUBqpC4BkKMPYPkFY4iAJXhGAYr1qmaqQDbECCg5A2NMchzR567aA4xcRKclI405Bmt46vYD7/Gcjqfk6GP/kh1wovIDSHDfiAs/8bOCQ4cf4qMt7eH5Cucr3S0aWGFfjdLHD8EhCFvXQlSqRrY5UV2O9cfZtk77jUFMXeqzCEZqSK4ICkSin2tE12/3rbVcE41OBjBjBPSdJ1N5lfYQpIuhr8axnyIy5KvXmkYnw8VbcwtTNj7fDNCmT2kPQXA+bxpEXkB21HlnSQq0gD67jnfh5KavVJa/XQYEFSaagWwbgjNA+ywstLpEWTKgc5gwVpsyO1bTII+tA6B7BPS+0PiznuM9gPKsPVXbFdADMtwbJxSmkXWfRh6AZhyyzBjIHoDmnCGaMZAKjd5hyNJYCBGDOVcg28AXQ5atAVDO3c4dSALQnYblfa3M4kc/cyA7gMIUBQCTyl4kugIpy8yA7ACqK8Uwk30lIFGOEV3rPDAELwQkr/9YjkaCPDQhCcsrAYlF1v8W8jAEYeQDY7qn6tNGWudfq+YUEr6uq6FZzBpJMUfWFDatLHMCciw2mRC+k81qCCA1DzK4aUVfrJpxnloZWCPVnOgYy8L3GvKjE96HpweQoy7iwVQclVutLOEKJxA8gaRCjSzgNI2zhh3bQhzBCQQPIHGaHaUd96GJbZz3Smmjy16u6j3FuKyNxcBarxqWWfYFE0tVVO1Rl3t1Mb05V00MQCJ71YHpNaMcsjWAfkQvPPkaNC7LqTG7JAhGXTKYf+VDeXAX9IvURoAwtTFHvyYIxtnd5tPkywrPafcwbeSuGVwFau3b76NO7SHQrvqhfFE8kM0Wvpv8gVYiYBlxL+fW/34bgP6bIC7JR7YPDubcHCPzIp4+cum7U6NlhZgK7lua3KGLeFwE2m+HblDYWSHG2SAfINuwBBfxbJEIuWZbBH4fAExD7cvaGVyXyH0dhiAYc92z3ZDfUVv+jgb8HrHy7WVO/8BFcy9vuTz+nwADAGnOR39Yg/QkAAAAAElFTkSuQmCC" alt="Slim"/></a>
            </header>
            <h1>Welcome to Slim!</h1>
            <p>
                Congratulations! Your Slim application is running. If this is
                your first time using Slim, start with this <a href="http://www.slimframework.com/learn" target="_blank">"Hello World" Tutorial</a>.
            </p>
            <section>
                <h2>Get Started</h2>
                <ol>
                    <li>The application code is in <code>index.php</code></li>
                    <li>Read the <a href="http://docs.slimframework.com/" target="_blank">online documentation</a></li>
                    <li>Follow <a href="http://www.twitter.com/slimphp" target="_blank">@slimphp</a> on Twitter</li>
                </ol>
            </section>
            <section>
                <h2>Slim Framework Community</h2>
 
                <h3>Support Forum and Knowledge Base</h3>
                <p>
                    Visit the <a href="http://help.slimframework.com" target="_blank">Slim support forum and knowledge base</a>
                    to read announcements, chat with fellow Slim users, ask questions, help others, or show off your cool
                    Slim Framework apps.
                </p>
 
                <h3>Twitter</h3>
                <p>
                    Follow <a href="http://www.twitter.com/slimphp" target="_blank">@slimphp</a> on Twitter to receive the very latest news
                    and updates about the framework.
                </p>
            </section>
            <section style="padding-bottom: 20px">
                <h2>Slim Framework Extras</h2>
                <p>
                    Custom View classes for Smarty, Twig, Mustache, and other template
                    frameworks are available online in a separate repository.
                </p>
                <p><a href="https://github.com/codeguy/Slim-Extras" target="_blank">Browse the Extras Repository</a></p>
            </section>
        </body>
    </html>
EOT;
        echo $template;
    }
);
 
header('Access-Control-Allow-Origin: *');
if (isset($_SERVER['HTTP_ORIGIN'])) {
        //header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Credentials: true');
        header('Access-Control-Max-Age: 86400');    // cache for 1 day
    }
    // Access-Control headers are received during OPTIONS requests
    if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
 
        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
            header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");        
 
        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
            header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");
 
    }
 
    $app->map('/:x+', function($x) {
    http_response_code(200);
})->via('OPTIONS');
 
 
// POST route
$app->post(
    '/post',
    function () {
        echo 'This is a POST route';
    }
);
 
// PUT route
$app->put(
    '/put',
    function () {
        echo 'This is a PUT route';
    }
);
 
$app->get('/hello/:name', function ($name) {
    echo "Hello, " . $name;
});
function array_has_dupes($array) {
   // streamline per @Felix
   $newarray = array();
   foreach($array as $entry) {
           if(!is_null($entry)) $newarray[] = $entry;
   }
   return count($newarray) !== count(array_unique($newarray));
}
 
function get_slots_array($count) {
        $slots = array();
        for($i = 0; $i < 6; $i++) {
                $slots[] = array_fill(0, $count, NULL);
        }
        return $slots; 
}
 
function generate($array, $groups) {
        //$proffesors = array("Klysh", "lila");
        //$groups = array("ap", "s");
        //$courses = array("prog", "asd");
        //$auditories = array("403", "404", "500", "406", "700");
        $classes = $array;
        $schedule = array();
        for($i = 0; $i < 5; $i++) {
                $schedule[] = get_slots_array(count($groups));
        }
        /*
$schedule = array(
        "monday" => array(
                0 => array(
                0 => NULL, 1 => NULL),
                1 => array(
                0 => NULL, 1 => NULL),
                2 => array(
                0 => NULL, 1 => NULL),
                3 => array(
                0 => NULL, 1 => NULL),
                4 => array(
                0 => NULL, 1 => NULL),
                5 => array(
                0 => NULL, 1 => NULL)),
        "tuesday" => array(
                0 => array(
                0 => NULL, 1 => NULL),
                1 => array(
                0 => NULL, 1 => NULL),
                2 => array(
                0 => NULL, 1 => NULL),
                3 => array(
                0 => NULL, 1 => NULL),
                4 => array(
                0 => NULL, 1 => NULL),
                5 => array(
                0 => NULL, 1 => NULL)),
        "wednesday" => array(
                0 => array(
                0 => NULL, 1 => NULL),
                1 => array(
                0 => NULL, 1 => NULL),
                2 => array(
                0 => NULL, 1 => NULL),
                3 => array(
                0 => NULL, 1 => NULL),
                4 => array(
                0 => NULL, 1 => NULL),
                5 => array(
                0 => NULL, 1 => NULL)),
        "thursday" => array(
                0 => array(
                0 => NULL, 1 => NULL),
                1 => array(
                0 => NULL, 1 => NULL),
                2 => array(
                0 => NULL, 1 => NULL),
                3 => array(
                0 => NULL, 1 => NULL),
                4 => array(
                0 => NULL, 1 => NULL),
                5 => array(
                0 => NULL, 1 => NULL)),
        "friday" =>array(
                0 => array(
                0 => NULL, 1 => NULL),
                1 => array(
                0 => NULL, 1 => NULL),
                2 => array(
                0 => NULL, 1 => NULL),
                3 => array(
                0 => NULL, 1 => NULL),
                4 => array(
                0 => NULL, 1 => NULL),
                5 => array(
                0 => NULL, 1 => NULL))
        );
        $schedule = array_values($schedule);
*/
        foreach ($classes as $c) {
                $day = rand(0,4);
                $pair = rand(0,5);
                $slot = rand(0,1);
                while(isset($schedule[$day][$pair][$slot])){
                        $day = rand(0,4);
                        $pair = rand(0,5);
                        $slot = rand(0,1);
                }
                $schedule[$day][$pair][$slot] = $c;
        }
        return $schedule;
}
 
function filter_schedule($groups, $filtered) {
        $result = array();
        foreach($groups as $group) {
                $schedule = array();
                for($i = 0; $i < 5; $i++) {
                        $day = array();
                    for($j = 0; $j < 6; $j++) {
                                $pair = null;
                                $current_pair = $filtered[$i][$j];
                                foreach($current_pair as $slot) {
                                        if($slot['group'] == $group) {
                                                $pair = $slot;
                                        }
                                }
                                $day[] = $pair;    
                    }
                    $schedule[] = $day;
                }
                $result[] = $schedule;
        }
    return $result;
}
 
$app->get('/api/generate/', function () {
        $app = \Slim\Slim::getInstance();
        //$paramValue = $app->request()->getBody();
        $paramValue = $app->request()->get('data');
        $source = json_decode($paramValue, true);
        $array = $source['data'];
        $groups = $source['groups'];
        $schedules = array();
        $scores = array();
        $min = 99999999; $max = 0;
        $imin = 0; $imax = 0;
        for ($i = 0; $i < 10000; $i++) {
                                $generated = generate($array, $groups);
                                $failed = false;
                $score = 0;
                foreach($generated as $day){
                        foreach($day as $pair){
                                        //print_r($pair);
                                $pair_map_professors = array_map(function($element){
                                        return $element["professor"];
                                }, $pair);
                                //echo "PROF:";
                                //print_r($pair_map_professors);
                                $pair_map_groups = array_map(function($element){
                                        return $element["group"];
                                }, $pair);
                                $pair_map_rooms = array_map(function($element){
                                        return $element["room"];
                                }, $pair);
                                if(array_has_dupes($pair_map_professors)){
                                        $failed = true;
                                }
                                if(array_has_dupes($pair_map_groups)){
                                        $failed = true;
                                }
                                if(array_has_dupes($pair_map_rooms)){
                                        $failed = true;
                                }
                                //break;
                        }
                        //break;
                }
               
                if(!$failed) {
                        $generated = filter_schedule($groups, $generated);
                        $schedules[] = $generated;
                       
                        // calculating density score
                       
                                        foreach($generated as $groupsch) {
                                for($a = 0; $a < 5; $a++) {
                                        $started = false; $breaks = false;
                                       
                                        /*
if(!array_filter($groupsch[$a])) {
                                                $score++;
                                                        }
*/
                                                        $pairCount = 0;
                                        for($b = 0; $b < 6; $b++) {
                                                if(!is_null($groupsch[$a][$b])) {
                                                        $pairCount++;          
                                                }      
                                        }
                                       
                                        for($b = 0; $b < 6; $b++) {
                                                if(is_null($groupsch[$a][$b]) && !$started) {
                                                        $started = true;
                                                        continue;
                                                }              
                                               
                                                if(is_null($groupsch[$a][$b]) && $started) {
                                                        if($b == 5) break;
                                                       
                                                        $hasPairs = false;
                                                        for($c = $b + 1; $c < 6; $c++) {
                                                                if(!is_null($groupsch[$a][$c])) $hasPairs = true;      
                                                        }
                                                       
                                                        if($hasPairs) {
                                                                $breaks = true;
                                                        }
                                                       
                                                        break;
                                                }
                                        }
                                       
                                        if(!$breaks) $score++;
                                        if($pairCount != 1) $score++;
                                }
                        }
               
                        $index = count($schedules) - 1;
                       
                        $scores[$index] = $score;
                        //echo $i." ".$score."\n";
                        if ($score <= $min)
                        {
                                $min = $score;
                                $imin = $index;
                        }
                        if ($score > $max)
                        {
                                $max = $score;
                                $imax = $index;
                        }
                   }
        }
        $res = $app->response;
        $res->setStatus(200);
        //echo $max." ".$imax;
        //$resultSchedule = filter_schedule($groups, $schedules[$imax]);
        //echo $max;
        $res->setBody(json_encode($schedules[$imax]));
        //$res->headers->set('Access-Control-Allow-Origin', '*');
        $res->headers['Content-Type'] = 'application/json';
        $res->finalize();
});
 
$app->post('/api/generate/', function () {
        $app = \Slim\Slim::getInstance();
        $paramValue = $app->request()->getBody();
        //$paramValue = $app->request()->get('data');
        $source = json_decode($paramValue, true);
        $array = $source['data'];
        $groups = $source['groups'];
        $schedules = array();
        $scores = array();
        $min = 99999999; $max = 0;
        $imin = 0; $imax = 0;
        for ($i = 0; $i < 10000; $i++) {
                                $generated = generate($array, $groups);
                                $failed = false;
                $score = 0;
                foreach($generated as $day){
                        foreach($day as $pair){
                                        //print_r($pair);
                                $pair_map_professors = array_map(function($element){
                                        return $element["professor"];
                                }, $pair);
                                //echo "PROF:";
                                //print_r($pair_map_professors);
                                $pair_map_groups = array_map(function($element){
                                        return $element["group"];
                                }, $pair);
                                $pair_map_rooms = array_map(function($element){
                                        return $element["room"];
                                }, $pair);
                                if(array_has_dupes($pair_map_professors)){
                                        $failed = true;
                                }
                                if(array_has_dupes($pair_map_groups)){
                                        $failed = true;
                                }
                                if(array_has_dupes($pair_map_rooms)){
                                        $failed = true;
                                }
                                //break;
                        }
                        //break;
                }
               
                if(!$failed) {
                        $generated = filter_schedule($groups, $generated);
                        $schedules[] = $generated;
                       
                        // calculating density score
                       
                                        foreach($generated as $groupsch) {
                                for($a = 0; $a < 5; $a++) {
                                        $started = false; $breaks = false;
                                       
                                        /*
if(!array_filter($groupsch[$a])) {
                                                $score++;
                                                        }
*/
                                                        $pairCount = 0;
                                        for($b = 0; $b < 6; $b++) {
                                                if(!is_null($groupsch[$a][$b])) {
                                                        $pairCount++;          
                                                }      
                                        }
                                       
                                        for($b = 0; $b < 6; $b++) {
                                                if(is_null($groupsch[$a][$b]) && !$started) {
                                                        $started = true;
                                                        continue;
                                                }              
                                               
                                                if(is_null($groupsch[$a][$b]) && $started) {
                                                        if($b == 5) break;
                                                       
                                                        $hasPairs = false;
                                                        for($c = $b + 1; $c < 6; $c++) {
                                                                if(!is_null($groupsch[$a][$c])) $hasPairs = true;      
                                                        }
                                                       
                                                        if($hasPairs) {
                                                                $breaks = true;
                                                        }
                                                       
                                                        break;
                                                }
                                        }
                                       
                                        if(!$breaks) $score++;
                                        if($pairCount != 1) $score++;
                                }
                        }
               
                        $index = count($schedules) - 1;
                       
                        $scores[$index] = $score;
                        //echo $i." ".$score."\n";
                        if ($score <= $min)
                        {
                                $min = $score;
                                $imin = $index;
                        }
                        if ($score > $max)
                        {
                                $max = $score;
                                $imax = $index;
                        }
                   }
        }
        $res = $app->response;
        $res->setStatus(200);
        //echo $max." ".$imax;
        //$resultSchedule = filter_schedule($groups, $schedules[$imax]);
        //echo $max;
        $res->setBody(json_encode($schedules[$imax]));
        //$res->headers->set('Access-Control-Allow-Origin', '*');
        $res->headers['Content-Type'] = 'application/json';
        $res->finalize();
});
 
// PATCH route
$app->patch('/patch', function () {
    echo 'This is a PATCH route';
});
 
// DELETE route
$app->delete(
    '/delete',
    function () {
        echo 'This is a DELETE route';
    }
);
 
/**
 * Step 4: Run the Slim application
 *
 * This method should be called last. This executes the Slim application
 * and returns the HTTP response to the HTTP client.
 */
$app->run();