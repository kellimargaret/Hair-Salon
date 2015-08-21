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

    use Symfony\Component\HttpFoundation\Request;
        Request::enableHttpMethodParameterOverride();
        //Default route
        $app->get('/', function() use($app) {
            return $app['twig']->render('index.html.twig', array('stylists' => Stylist::getAll()));
        });
        //Adds a stylist to the database
        $app->post('/stylists', function() use($app) {
            $id = null;
            $stylist = new Stylist($id, $_POST['name']);
            $stylist->save();
            return $app['twig']->render('index.html.twig', array('stylists' => Stylist::getAll()));
        });
        //Delete all stylists
        $app->post('/delete_stylists', function() use($app) {
            Stylist::deleteAll();
            return $app['twig']->render('index.html.twig', array('stylists' => Stylist::getAll()));
        });
        //Delete all clients
        $app->post('/delete_clients', function() use($app) {
            Client::deleteAll();
            return $app['twig']->render('index.html.twig', array('stylists' => Stylist::getAll()));
        });
        //Go to a specific stylist's page
        $app->get('/stylists/{id}', function($id) use ($app) {
            $stylist = Stylist::find($id);
            return $app['twig']->render('stylist.html.twig', array('stylist' => $stylist, 'clients' => $stylist->getClients()));
        });
        //Add a client to a stylist's page
        $app->post('clients', function() use($app) {
            $name = $_POST['name'];
            $phone = $_POST['phone'];
            $last_visit = $_POST['last_visit'];
            $stylist_id = $_POST['stylist_id'];
            $client = new Client($id = null, $name, $phone, $last_visit, $stylist_id);
            $client->save();
            $stylist = Stylist::find($stylist_id);
            $clients = $stylist->getClients();
            return $app['twig']->render('stylist.html.twig', array('stylist' => $stylist, 'clients' => $clients));
        });
        //Route to the page where we can edit a stylist's name
        $app->get('/stylists/{id}/edit', function($id) use($app) {
            $stylist = Stylist::find($id);
            return $app['twig']->render('stylist_edit.html.twig', array('stylist' => $stylist));
        });
        //Route to update a stylist's name in the database
        $app->patch('/stylists/{id}', function($id) use($app) {
            $name = $_POST['name'];
            $stylist = Stylist::find($id);
            $stylist->update($name);
            return $app['twig']->render('stylist.html.twig', array('stylist' => $stylist, 'clients' => $stylist->getClients()));
        });
        //Route to delete a patricular stylist
        $app->delete('/stylists/{id}', function($id) use($app) {
            $stylist = Stylist::find($id);
            $stylist->delete();
            return $app['twig']->render('index.html.twig', array('stylists' => Stylist::getAll()));
        });
        //Route to the landing page to edit a client's information
        $app->get('/clients/{id}/edit', function($id) use($app) {
            $client = Client::find($id);
            $stylist_id = $client->getStylistId();
            $stylist = Stylist::find($stylist_id);
            return $app['twig']->render('client_edit.html.twig', array('client' => $client, 'stylist' => $stylist));
        });
        //Route to update a client's information
        $app->patch('/clients/{id}', function($id) use($app) {
            $client = Client::find($id);
            $stylist_id = $_POST['stylist_id'];
            $stylist = Stylist::find($stylist_id);
            foreach ($_POST as $field => $new_value) {
                if (!empty($new_value)) {
                    $client->update($field, $new_value);
                }
            }
            return $app['twig']->render('stylist.html.twig', array('stylist' => $stylist, 'clients' => $stylist->getClients()));
        });
        //Route to delete a particluar client
        $app->delete('/clients/{id}', function($id) use($app) {
            $client = Client::find($id);
            $stylist = Stylist::find($client->getStylistId());
            $client->delete();
            return $app['twig']->render('stylist.html.twig', array('stylist' => $stylist, 'clients' => $stylist->getClients()));
        });
        return $app;

?>
