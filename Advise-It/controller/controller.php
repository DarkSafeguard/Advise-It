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

    function login()
    {
        $view = new Template();
        echo $view->render('views/login.html');

        $username = $_POST['user'];
        $password = $_POST['password'];

        if ($username == "admin" && $password == "admin")
        {
            $_SESSION['loggedIn'] = true;
            $this->_f3->reroute('/admin');
        }
        else{
            $_SESSION['loggedIn'] = false;
        }
    }

    function admin()
    {
        if($_SESSION['loggedIn'])
        {
            $allPlans = $GLOBALS['dataLayer']->getAllPlans();
            $this->_f3->set('plans', $allPlans);

            $view = new Template();
            echo $view->render('views/admin.html');
        }
        else{
            $this->_f3->reroute('/login');
        }

    }

    function createPlan()
    {
        $_SESSION['plan'] = new Plan();
        $token = $_SESSION['plan']->getToken();

        $GLOBALS['dataLayer']->createPlan($_SESSION['plan']);

        $this->_f3->reroute('/plan/'.$token);
    }


    function getPlan($token)
    {
        if($_SESSION['plan'] == null)
        {
            $_SESSION['plan'] = new Plan();
        }

        $retrievedPlan = $GLOBALS['dataLayer']->getPlan($token);

        if($retrievedPlan != null)
        {
            $this->updatePlanPage($token, $retrievedPlan);

            if ($_SERVER['REQUEST_METHOD'] == 'POST')
            {
                $this->savePlan();
                $this->_f3->reroute('/plan/'.$token);
            }
        }
        else
        {
            //$this->reRouteHome();
        }
    }

    function updatePlanPage($token, $retrievedPlan)
    {
        echo $retrievedPlan.' this is the retrieved plan using the db token: ' . $token . "<br>";

        $this->setSessionPlan($retrievedPlan);

        $sessionToken = $_SESSION['plan']->getToken();
        $advisor = $_SESSION['plan']->getAdvisor();
        $fall = $_SESSION['plan']->getFall();
        $winter = $_SESSION['plan']->getWinter();
        $spring = $_SESSION['plan']->getSpring();
        $summer = $_SESSION['plan']->getSummer();

        echo "<br>" . "Token: " . $sessionToken . "<br>" . "Advisor: " . $advisor . "<br>" . " Fall Class: " . $fall . "<br>" . " Winter Class: " . $winter . "<br>" . " Spring Class: " . $spring . "<br>" . " Summer Class: " . $summer;

        $this->_f3->set('advisor', $advisor);
        $this->_f3->set('fall', $fall);
        $this->_f3->set('winter', $winter);
        $this->_f3->set('spring', $spring);
        $this->_f3->set('summer', $summer);
        if($_SESSION['saved'])
        {
            $this->_f3->set('saveMessage', 'Plan saved at: ' . date("Y-m-d") . " " . date("H:i:s"));
            $_SESSION['saved'] = false;
        }

        $view = new Template();
        echo $view->render('views/plan.html');
    }

    function setSessionPlan($retrievedPlan)
    {
        $_SESSION['plan']->setToken($retrievedPlan["token"]);

        if($retrievedPlan["advisor"] != null)
        {
            $_SESSION['plan']->setAdvisor($retrievedPlan["advisor"]);
        }
        else
        {
            $_SESSION['plan']->setAdvisor("");
        }

        if($retrievedPlan["fall"] != null)
        {
            $_SESSION['plan']->setFall($retrievedPlan["fall"]);
        }
        else
        {
            $_SESSION['plan']->setFall("");
        }

        if($retrievedPlan["winter"] != null)
        {
            $_SESSION['plan']->setWinter($retrievedPlan["winter"]);
        }
        else
        {
            $_SESSION['plan']->setWinter("");
        }

        if($retrievedPlan["spring"] != null)
        {
            $_SESSION['plan']->setSpring($retrievedPlan["spring"]);
        }
        else
        {
            $_SESSION['plan']->setSpring("");
        }

        if($retrievedPlan["summer"] != null)
        {
            $_SESSION['plan']->setSummer($retrievedPlan["summer"]);
        }
        else
        {
            $_SESSION['plan']->setSummer("");
        }
    }

    function savePlan()
    {
            $advisor = $_POST['advisor'];
            $fall = $_POST['fall'];
            $winter = $_POST['winter'];
            $spring = $_POST['spring'];
            $summer = $_POST['summer'];

            //Add the data to the session variable
            $_SESSION['plan']->setAdvisor($advisor);
            $_SESSION['plan']->setFall($fall);
            $_SESSION['plan']->setWinter($winter);
            $_SESSION['plan']->setSpring($spring);
            $_SESSION['plan']->setSummer($summer);

            $GLOBALS['dataLayer']->savePlan($_SESSION['plan']);
            $_SESSION['saved'] = true;
    }

    function reRouteHome()
    {
        $this->_f3->reroute('/');
    }
}