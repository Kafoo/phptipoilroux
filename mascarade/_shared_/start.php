<?php
session_start();

/* ---------- REFRESH ISSUE ---------- */

    if(!empty($_POST) OR !empty($_FILES)){
        $_SESSION['sauvegarde'] = $_POST ;
        $_SESSION['sauvegardeFILES'] = $_FILES ;
        
        $fichierActuel = $_SERVER['PHP_SELF'] ;
        if(!empty($_SERVER['QUERY_STRING'])){
            $fichierActuel .= '?' . $_SERVER['QUERY_STRING'] ; 
        }
        
        header('Location: ' . $fichierActuel);
        exit;
    }
    if(isset($_SESSION['sauvegarde'])){
        $_POST = $_SESSION['sauvegarde'] ;
        $_FILES = $_SESSION['sauvegardeFILES'] ;
        
        unset($_SESSION['sauvegarde'], $_SESSION['sauvegardeFILES']);
    }


/* ---------- CONNECT TO DATABASE ---------- */

    include("connectDB.php");

/* ---------- USER CONNECTION ---------- */

if (!isset($_SESSION['connected'])) {

    //------ IF COOKIE : ------
    if (isset($_COOKIE['auth'])) {
        $auth = $_COOKIE['auth'];
        $auth = explode("---", $auth);
        $checkUser = $bdd->query("SELECT * FROM ss_membres WHERE id='$auth[0]' ")->fetch();
        $key = sha1($checkUser['pseudo']);
        if ($key === $auth[1]) {
            $userID = $checkUser['id'];
            $reqUser = $bdd->query("SELECT * FROM ss_membres WHERE id='$userID' ");
                $userInfo = $reqUser->fetch();
                $canSetSession = True;
        }
    }

    //------ IF CONNECTION SUBMIT : ------
    if (isset($_POST['connectionSubmit'])) {

        $pseudoConnect = htmlspecialchars($_POST['pseudoConnect']);
        $passwordConnect = sha1($_POST['passwordConnect']);

        if (!empty($_POST['pseudoConnect']) AND !empty($_POST['passwordConnect'])) {

            $reqUser = $bdd->prepare("SELECT * FROM ss_membres WHERE pseudo=? AND password=?");
            $reqUser->execute(array($pseudoConnect, $passwordConnect));
            $userExist = $reqUser->rowCount();
            if ($userExist == 1) {
                $userInfo = $reqUser->fetch();
                $canSetSession = True;
                /*On créé un cookie*/
                setcookie('auth', $userInfo['id'].'---'.sha1($userInfo['pseudo']), time()+3600*24*365, null, null, false, true);
                /*On redirige vers l'accueil si on est sur une page éphémère*/
                if (basename($_SERVER['PHP_SELF']) == "subscribe.php"){
                    header("Location: accueil.php");
                } 
            }
            else{
                $error = "Pseudo ou Mot de passe incorrect !";
            }
        }
        elseif (!empty($_POST['passwordConnect'])){
            $error = "Rentre ton pseudo, ça marchera mieux =P";
        }
        elseif (!empty($pseudoConnect)){
            $error = "Rentre ton mot de passe, ça marchera mieux =P";
        }
        else{
            $error = "Va falloir me donner un peu plus d'infos que ça !";
        }
    }

    /*------- DECLARATION DES VARIABLES DE SESSION --------*/
    if (isset($canSetSession) AND $canSetSession==True) {
        $persoID = $userInfo['id'];
        $reqActifPerso = $bdd->query("SELECT nom from ss_persos WHERE membreID = '$persoID' AND actif = '1'");
        $_SESSION['connected'] = True;
        $_SESSION['id'] = $userInfo['id'];
        $_SESSION['pseudo'] = $userInfo['pseudo'];
        $_SESSION['password'] = $userInfo['password'];
        $_SESSION['grade'] = $userInfo['grade'];
        $_SESSION['nombremsg'] = $userInfo['nombremsg'];
        $_SESSION['actifPerso'] = $reqActifPerso->fetch()[0];

        $canSetSession = False;
    }

}   

?>