<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Crud2</title>
    <link rel="stylesheet" href="style.css">
    
</head>

<body>
    <nav>
        <ul>
            <li style="list-style:none"><a href='index.php'>Home</a></li>
            <li style="list-style:none"><a href='add.php'>Add</a></li>
        </ul>
        <form method='POST' action='search.php'>
            <div style='display:flex'>
                <input type="search" name="search" id="search" placeholder="Chercher">
                <button type="submit">Ok</button>
                <input type="hidden" name="engine_search" value='ok'>
            </div>
        </form>
    </nav>