<?php 
$page_title =   "404";
view('partials', 'head');
view('partials', 'header');
?>
<body>
    <div class="main_content">
        <h2>Error 404. Page not found.</h2>
        <?php if (isset($message)):?>
        <h3><?php echo $message ?></h3>
        <?php endif?>
        <a href="/home" class="secondary">Goto Home</a>
    </div>
</body>
</html>