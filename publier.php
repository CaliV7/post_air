<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body>


<form class='form' method='post' action='index.php'>
    <label for="titre">Choisissez un titre :</label>
    <select name="titre">
        <option value="devinette">Devinette</option>
        <option value="charade">Charade</option>
        <option value="blague">Blague</option>
        <option value="blague pourrie">Blague pourrie</option>
    </select>
    <textarea name='contenu' placeholder="votre post" required></textarea>
    <button type='submit'>Poster</button>

</form>
</body>
</html>