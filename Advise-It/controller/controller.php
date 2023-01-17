<?php
class Controller
{
    private $_f3; //F3 object

    function __construct($f3)
    {
        $this->_f3 = $f3;
    }

    function home()
    {
        $view = new Template();
        echo $view->render('views/home.html');
    }


    function createPlan()
    {
        //Initialize input variables
        $food = "";
        $meal = "";

        //If the form has been posted
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            // = $f3->get('POST.food');
            $food = $_POST['food'];
            $meal = $_POST['meal'];

            //Instantiate an order object
            //$order = new Order();
            //$_SESSION['order'] = $order;

            $_SESSION['plan'] = new Plan();
            $_SESSION['plan'].getToken();

            //Redirect user to next page if there are no errors
            $this->_f3->reroute('plan');

        }
    }
    function savePlan()
    {
        //Initialize input variables
        $fall = "";
        $winter = "";
        $spring = "";
        $summer = "";

        //If the form has been posted
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            // = $f3->get('POST.food');
            $fall = $_POST['fall'];
            $winter = $_POST['winter'];
            $spring = $_POST['spring'];
            $summer = $_POST['summer'];


            //Add the data to the session variable
            $_SESSION['plan']->setFall($fall);

            //Add the data to the session variable
            $_SESSION['plan']->setWinter($winter);

            //Add the data to the session variable
            $_SESSION['plan']->setSpring($spring);

            //Add the data to the session variable
            $_SESSION['plan']->setSummer($summer);

            $GLOBALS['dataLayer']->saveOrder($_SESSION['order']);

        }
    }
}