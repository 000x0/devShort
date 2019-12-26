<?php

// All relevant changes can be made in the data file. Please read the docs: https://github.com/flokX/devShort/wiki

$base_path = implode(DIRECTORY_SEPARATOR, array(__DIR__, "data"));
$config_content = json_decode(file_get_contents($base_path . DIRECTORY_SEPARATOR . "config.json"), true);

// Counts the access
$filename = $base_path . DIRECTORY_SEPARATOR . "stats.json";
$stats = json_decode(file_get_contents($filename), true);
$stats["Index"][mktime(0, 0, 0)] += 1;
file_put_contents($filename, json_encode($stats, JSON_PRETTY_PRINT));

// Generator for page customization
$links_string = "";
if ($config_content["settings"]["custom_links"]) {
    foreach ($config_content["settings"]["custom_links"] as $name => $url) {
        $links_string = $links_string . "<a href=\"$url\" class=\"badge badge-secondary\">$name</a> ";
    }
    $links_string = substr($links_string, 0, -1);
}

?>

<!doctype html>
<html class="h-100" lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="robots" content="noindex, nofollow">
    <meta name="author" content="<?php echo $config_content["settings"]["author"]; ?> and the devShort team">
    <link href="<?php echo $config_content["settings"]["favicon"]; ?>" rel="icon">
    <title><?php echo $config_content["settings"]["name"]; ?></title>
    <link href="assets/vendor/bootstrap/bootstrap.min.css" rel="stylesheet">
    <link href="assets/main.css" rel="stylesheet">
</head>

<body class="d-flex flex-column h-100">

    <main class="flex-shrink-0">
        <div class="container">
            <nav class="mt-3" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?php echo $config_content["settings"]["home_link"]; ?>">Home</a></li>
                    <li class="breadcrumb-item" aria-current="page"><?php echo $config_content["settings"]["name"]; ?></li>
                </ol>
            </nav>
            <h1 class="mt-5"><?php echo $config_content["settings"]["name"]; ?></h1>
            <p class="lead">This is a shortlink service. You need a valid shortlink to get redirected.</p>
            <ul class="list-inline">
                <li class="list-inline-item"><a href="https://github.com/flokX/devShort/wiki/What-is-URL-shortening%3F">What is URL shortening?</a></li>
                <li class="list-inline-item">-</li>
                <li class="list-inline-item"><a href="<?php echo $config_content["settings"]["home_link"]; ?>">Home page</a></li>
                <li class="list-inline-item">-</li>
                <li class="list-inline-item"><a href="admin.php">Admin panel</a></li>
            </ul>
        </div>
    </main>

    <footer class="footer mt-auto py-3 bg-light">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center">
                <span class="text-muted">&copy; <?php echo date("Y") . " " . $config_content["settings"]["author"]; ?> and <a href="https://github.com/flokX/devShort">devShort</a></span>
                <?php if ($links_string) { echo "<span class=\"text-muted\">$links_string</span>"; } ?>
            </div>
        </div>
    </footer>

</body>

</html>
