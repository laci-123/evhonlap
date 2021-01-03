<?php
	const GET_KEY_LOCATION = "hely";
	const GET_KEY_FOLDER = "folder";
	const GET_KEY_ITEM = "kep";
	const GET_KEY_ALBUM = "album";
	
	const GET_VALUE_MAINPAGE = "fooldal";
	const GET_VALUE_CONTACT = "elerhetosegek";
	const GET_VALUE_EVENTS = "alkalmak";
	const GET_VALUE_UPCOMINGEVENTS = "aktualis";
	const GET_VALUE_ARCHIVE = "archiv";
	const GET_VALUE_CHARITY = "templomepites";
	const GET_VALUE_PEOPLE = "tisztsegviselok";
	const GET_VALUE_THOUGHTS = "gondolatok";
	const GET_VALUE_HISTORY = "tortenet";
	const GET_VALUE_GALERY = "galeria";
	const GET_VALUE_GALERYALL = "galeria_osszes";
	const GET_VALUE_THOUGHTS_TITLE = "cim";
	const GET_VALUE_SLIDESHOW = "slideshow";
	const GET_VALUE_ALBUM = "album";
	
	const FILE_FRAME = "main_frame.html";
	const FILE_SLIDESHOW_FRAME = "slideshow_frame.html";
	const FILE_MAINPAGE = "script/fo_oldal.php";
	const FILE_MAINPAGE_CONTENT = "content/fo_oldal.html";
	const FILE_CONTACTS = "script/elerhetosegek.php";
	const FILE_CONTACTS_CONTENT = "content/elerhetosegek.html";
	const FILE_EVENTS = "script/allando.php";
	const FILE_EVENTS_CONTENT = "content/allando.html";
        const FILE_UPCOMINGEVENTS = "script/aktualis.php";
        const FILE_UPCOMINGEVENTS_CONTENT = "content/aktualis.html";
        const FILE_ARCHIVE = "script/archiv.php";
	const FILE_ARCHIVE_CONTENT = "content/archiv.html";
	const FILE_CHARITY = "script/templomepites.php";
        const FILE_CHARITY_CONTENT = "content/templomepites.html"; 
	const FILE_PEOPLE = "script/tisztsegviselok.php";
        const FILE_PEOPLE_CONTENT = "content/tisztsegviselok.html";
        const FILE_THOUGHTS = "script/gondolatok.php";
        const FILE_THOUGHTS_CONTENT = "content/gondolatok.html";
	const FILE_HISTORY = "script/tortenet.php";
        const FILE_HISTORY_CONTENT = "content/tortenet.html";
        const FILE_GALERY = "script/galeria.php";
        const FILE_GALERYALL = "script/galeria_osszes.php";
        const FILE_SLIDESHOW = "script/slideshow.php";
	const FILE_LASTMODIFIED = "last_modified.txt";
	const FILE_ALBUMDATA = "/data.txt";
	
	const FOLDER_GALERY = "img/galeria/";
    
	const PLACEHOLDER_CONTENT = "content";
	const PLACEHOLDER_DAILYWORD = "DailyWord";
	const PLACEHOLDER_BACK_LINK = "back_link";
	const PLACEHOLDER_LASTMODIFIED = "LastModified";
	
	const SEGMENT_CONTENTHEADER = "<article class='content'>\n";
	const SEGMENT_CONTENTFOOTER = "</article>\n";
	const SEGMENT_SEPARATOR = "<hr id='elvalaszto'>";
	const SEGMENT_THOUGHTS_TITLE = "<h2>Gondolatok</h2>";
	const SEGMENT_LINKS_BLOCK = "<p align='center'>";
	const SEGMENT_LINKS_BLOCK_END = "</p>";
	const SEGMENT_UPCOMINGEVENTS_TITLE = "<h2>Aktuális</h2>";
	const SEGMENT_SLIDESHOW_BACKLINK = "<a id='back_link' href='?hely=galeria&album=";
	const SEGMENT_SLIDESHOW_BACKLINK_END = "'>Vissza a galériába</a>";
	const SEGMENT_SLIDESHOW_LINK = "<a class='link' href='?hely=slideshow&folder=";
	const SEGMENT_SLIDESHOW_LINK_PREV = "'>&lt;&lt;Előző&lt;&lt;</a>";
	const SEGMENT_SLIDESHOW_LINK_NEXT = "'>&gt;&gt;Következő&gt;&gt;</a>";
	const SEGMENT_GALERY_TITLE = "<h2>Galéria</h2>\n";
	const SEGMENT_GALERY_MENU = "<nav id='galeria_menu'>\n";
	const SEGMENT_GALERY_MENU_END = "</nav>\n";

	const NUM_GALERY_MAXALBUMS = 5;

	const REGEX_ENTRY = "/<!\-\-§(.*?)§\-\->/s";
	const REGEX_DAILY_WORD = "/Napi ige: <\/a>(.*?)&nbsp;/s";
	
	const URL_EVANGELIKUSHU = "https://www.evangelikus.hu/";
	
	const SCRIPT_SCROLL_TO_ANCHOR = "<script src='script/scrollToAnchor.js'></script>";
	const SCRIPT_JQUERY = "<script src='https://ajax.googleapis.com/ajax/libs/jquery/2.2.2/jquery.min.js'></script>";
	
	const ERROR_NOT_ACCESSIBLE = "<p>Ez a tartalom egy váratlan hiba miatt jelenleg nem érhető el. </p>\n";
	const ERROR_DAILYWORD_NOT_ACCESSIBLE = "<i>[Pillanatnyilag nem érhető el.]</i>";
	const ERROR_WRONG_URL = "<b>Hibás URL-cím</b>\n<br><br>\n<a href='http://budakeszi.lutheran.hu'>Főoldal</a>";
	const ERROR_INTERNAL_ERROR = "<b>Váratlan hiba történt. </b> \n<br><br><br>\nRészletek: <br>\n";
	const ERROR_OTHER_ERROR = "<b>Error: </b>";
	
	const MESSAGE_EMPTY_SECTION = "<p>Ez a szakasz jelenleg üres. </p>";
	const MESSAGE_NO_UPCOMING_EVENTS = "<p>Pillanatnyilag nincs információnk a rendszeres alkalmakon kívüli eseményekről. </p>";
?>
