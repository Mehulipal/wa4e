<?php
$OUTPUT->bodyStart();
$R = $CFG->apphome . '/';
$set = new \Tsugi\UI\MenuSet();
$set->setHome($CFG->servicename, $CFG->apphome);
$set->addLeft('Install', $R.'install.php');
$set->addLeft('Lessons', $R.'lessons.php');
if ( isset($_SESSION['id']) ) {
	$set->addLeft('Discuss', $R.'discuss.php');
	$set->addLeft('Tools', $R.'lessons.php?anchor=tools');
}

$T = $CFG->wwwroot . '/';
if ( isset($_SESSION['id']) ) {
    $submenu = new \Tsugi\UI\Menu();
    $submenu->addLink('Profile', $T.'profile.php');
    if ( $CFG->DEVELOPER ) {
        $submenu->addLink('Test LTI Tools', $T . 'dev.php');
    }
    if ( $CFG->providekeys ) {
        $submenu->addLink('Use this Service', $T . 'admin/key/index.php');
    }
    $submenu->addLink('Logout', $T.'logout.php');
    if ( isset($_SESSION['avatar']) ) {
        $set->addRight('<img src="'.$_SESSION['avatar'].'" style="height: 2em;"/>', $submenu);
        // htmlentities($_SESSION['displayname']), $submenu);
    } else {
        $set->addRight(htmlentities($_SESSION['displayname']), $submenu);
    }
} else {
    $set->addRight('Login', $T.'login.php');
}

$set->addRight('Book', 'http://textbooks.opensuny.org/the-missing-link-an-introduction-to-web-development-and-programming/');
$set->addRight('Instructor', 'http://www.dr-chuck.com');

// Set the topNav for the session
$OUTPUT->topNavSession($set);

$OUTPUT->topNav();
$OUTPUT->flashMessages();
