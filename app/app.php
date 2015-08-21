<?php

    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/Client.php";
    require_once __DIR__."/../src/Stylist.php";

    //Start of Silex App
    $app = new Silex\Application();
    $server = 'mysql:host=localhost:8888;dbname=hair_salon';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    //Twig Path
    $app->register(new Silex\Provider\TwigServiceProvider(), array(
        'twig.path' => __DIR__.'/../views'
    ));

        //Homepage
        $app->get('/', function() use($app) {
            return $app['twig']->render('index.html.twig', array('stylists' => Stylist::getAll()));
        });

        $app->post('/stylists', function() use($app) {
            $id = null;
            $stylist = new Stylist($id, $_POST['name']);
            $stylist->save();
            return $app['twig']->render('index.html.twig', array('stylists' => Stylist::getAll()));
        });

        //Delete all for stylist
        $app->post('/delete_stylists', function() use($app) {
            Stylist::deleteAll();
            return $app['twig']->render('index.html.twig', array('stylists' => Stylist::getAll()));
        });

        //Delete all for clients
        $app->post('/delete_clients', function() use($app) {
            Client::deleteAll();
            return $app['twig']->render('index.html.twig', array('stylists' => Stylist::getAll()));
        });

        //Go to a specific stylist
        $app->get('/stylists/{id}', function($id) use ($app) {
            $stylist = Stylist::find($id);
            return $app['twig']->render('stylist.html.twig', array('stylist' => $stylist, 'clients' => $stylist->getClients()));
        });

        //Add a client to stylist list
        $app->post('clients', function() use($app) {
            $name = $_POST['name'];
            $phone = $_POST['phone'];
            $next_visit = $_POST['last_visit'];
            $stylist_id = $_POST['stylist_id'];
            $client = new Client($id = null, $name, $phone, $next_visit, $stylist_id);
            $client->save();
            $stylist = Stylist::find($stylist_id);
            $clients = $stylist->getClients();
            return $app['twig']->render('stylist.html.twig', array('stylist' => $stylist, 'clients' => $clients));
        });


        return $app;

?>
