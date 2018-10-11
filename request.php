<?php

require_once(__DIR__ . '/../../config.php'); // standard config file

// Ensure the key is set.
if (isset($_POST['oauth_consumer_key'])) {
  if ($_POST['oauth_consumer_key'] === "consumerkey") {

    // Ensure a book ID has been provided.
    if (isset($_POST['custom_book_id'])) {
      $book_id = $_POST['custom_book_id'];

      // Query the database for the book, using the book id.
      $book = $DB->get_record_sql('SELECT id, name FROM {book} WHERE id = ?', array($book_id));

      // Query the database for all lessons in the book, using the book id.
      $lessons = $DB->get_records_sql('SELECT id, pagenum, title, content FROM {book_chapters} WHERE bookid=? ORDER BY pagenum ASC', array($book_id));

      // Replace characters to enable MathJax to filter WIRIS XML.
      foreach ($lessons as $lesson) {
        $lesson->content = str_replace('«', '<', $lesson->content);
        $lesson->content = str_replace('»', '>', $lesson->content);
        $lesson->content = str_replace('§', '&', $lesson->content);
        $lesson->content = str_replace('¨', '"', $lesson->content);
        $lesson->content = str_replace('´', "'", $lesson->content);
      }

    }
  }
}


// Build HTML page
?>

<html>
<head>
  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <!-- jQuery library -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <!-- Latest compiled JavaScript -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

  <script type="text/x-mathjax-config">
    MathJax.Hub.Config({
      MathML: {
        extensions: ["content-mathml.js"]
      }
    });
  </script>

  <script src='https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.5/latest.js?config=TeX-MML-AM_CHTML' async></script>

  <title></title>

  <style>

    .lti-page {
      overflow: auto;
    }

    .lti-nav {
      text-decoration: none;
      display: inline-block;
      padding: 8px 16px;
      visibility: hidden;
      cursor: pointer;
    }

    .lti-nav:hover {
      background-color: #ddd;
      color: black;
      text-decoration: none;
    }

    .back {
        background-color: #f1f1f1;
        color: black;
    }

    .next {
        background-color: #4CAF50;
        color: white;
    }

    .round {
        border-radius: 50%;
    }

    .container-left {
      padding-right: 15px;
      margin-top: -15px;
    }

    .container-left h3 {
      color: #999;
      font-size: 28px;
      font-weight: 700;
      font-family: "Open Sans", sans-serif;
    }

    #table-of-contents ul li {
      padding: 0;
      margin: 0;
      list-style: none;
      line-height: 20px;
      margin-top: .5em;
    }

    #table-of-contents ul li a {
      color: #555;
      font-family: "Open Sans", sans-serif;
      font-weight: 400;
      font-size: 14px;
      cursor: pointer;
    }

    #table-of-contents ul li a:hover {
      color: #222;
      transition: all 0.3s ease 0.1s;
      text-decoration: none;
      font-family: "Open Sans", sans-serif;
    }

    #table-of-contents h2 {
      color: #666;
      font-size: 22px;
      font-weight: 700;
      word-wrap: break-word;
      font-family: "Open Sans", sans-serif;
      margin-left: 1em;
      background: #f2f2f2;
      padding: 5px;
    }

    #table-of-contents {
      padding-left: 0px;
    }

    #bcln-body {
      visibility: hidden;
    }

  </style>

  <script>

    var currentPage = 1;
    var numberOfPages = 1;

    // Called on body load.
    function initialize() {
      // Remove the iframe border.
      $('#contentframe', window.parent.document).css("border", "none");

      // Add classes for styling purposes
      $('#page-mod-lti-view', window.parent.document).addClass("path-mod-book");

      showFirstPage();
      $("#bcln-body").css("visibility", "visible");
    }

    function updateIframeHeight() {
      $('#contentframe', window.parent.document).height($('#bcln-body').outerHeight(false));
    }

    function updateTableOfContents() {
      $(".toc-item").css("font-weight", "normal");
      $("#toc-" + currentPage).css("font-weight", "bold");
    }

    function showFirstPage() {
      numberOfPages = $(".lti-page").length;

      $(".lti-page").css("display", "none"); // Hide all pages.
      $("#page-1").css("display", "inline-block"); // Show the first page.

      updateNavigationButtons();
      updateTableOfContents();
      updateIframeHeight();
    }

    function back() {
      $(".lti-page").css("display", "none"); // Hide all pages.
      currentPage--;
      $("#page-" + currentPage).css("display", "inline-block"); // Show the current page.

      updateNavigationButtons();
      updateTableOfContents();
      updateIframeHeight();
    }

    function next() {
      $(".lti-page").css("display", "none"); // Hide all pages.
      currentPage++;
      $("#page-" + currentPage).css("display", "inline-block"); // Show the current page.

      updateNavigationButtons();
      updateTableOfContents();
      updateIframeHeight();
    }

    function navigate(pageNumber) {
      if (pageNumber > 0 && pageNumber <= numberOfPages) {
        currentPage = pageNumber;
        $(".lti-page").css("display", "none"); // Hide all pages.
        $("#page-" + currentPage).css("display", "inline-block"); // Show the current page.
      }

      updateNavigationButtons();
      updateTableOfContents();
      updateIframeHeight();
    }

    function updateNavigationButtons() {
      window.parent.document.body.scrollTop = window.parent.document.documentElement.scrollTop = 0;

      if (currentPage == 1) {
        // Just show the next button
        $("#nextBtn").css("visibility", "visible");
        $("#backBtn").css("visibility", "hidden");
      } else if (currentPage === numberOfPages) {
        // Just show the back button
        $("#backBtn").css("visibility", "visible");
        $("#nextBtn").css("visibility", "hidden");
      } else {
        // Show both buttons
        $("#nextBtn").css("visibility", "visible");
        $("#backBtn").css("visibility", "visible");
      }

    }

  </script>

</head>

<body onload="initialize()">

  <div id="bcln-body" class="container-left">
    <div class="row">
      <?php foreach ($lessons as $lesson): ?>
        <div class="col-md-9 lti-page" id="page-<?=$lesson->pagenum?>">
          <h3><?=$lesson->title?></h3>
          <hr>
          <div id="content"><?=$lesson->content?></div>
        </div>
      <?php endforeach ?>
      <aside class="col-md-3" id="table-of-contents">
        <h2>Table of Contents</h2>
        <ul>
          <?php foreach ($lessons as $lesson): ?>
            <li><a class="toc-item" id="toc-<?=$lesson->pagenum?>" onclick="navigate(<?=$lesson->pagenum?>)"><?=$lesson->title?></a></li>
          <?php endforeach ?>
        </ul>
      </aside>
    </div>
    <div class="row">
      <div class="col-md-3">
        <!--<img src="images/wcln_logo.png" alt="logo">-->
      </div>
      <div class="col-md-6 text-center">
      </div>
      <div class="col-md-3 text-right">
        <a class="back round lti-nav" id="backBtn" onclick="back()">&#8249;</a>
        <a class="next round lti-nav" id="nextBtn" onclick="next()">&#8250;</a>
      </div>
    </div>
  </div>
</body>
</html>
