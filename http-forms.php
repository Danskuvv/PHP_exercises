<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Page</title>
</head>
<body>
<?php
// USER FORM
$generatedText = '';
$username = '';
$remember = '';

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Your existing form processing code here

    // New form processing
    if (isset($_POST['username'])) {
        $username = $_POST['username'];
        if (isset($_POST['remember'])) {
            setcookie('username', $username, time() + (86400 * 30), "/"); // 86400 = 1 day
            $remember = 'checked';
        } else {
            if(isset($_COOKIE['username'])) {
                unset($_COOKIE['username']);
                setcookie('username', '', time() - 3600, '/'); // empty value and old timestamp
            }
            $remember = '';
        }
    }
}

// Check if cookie is set
if(isset($_COOKIE['username'])) {
    $username = $_COOKIE['username'];
    $remember = 'checked';
}


// TEXT FORM
$generatedText = '';

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $color = $_POST['color'];
    $size = $_POST['size'];
    $fontStyle = isset($_POST['font_style']) ? $_POST['font_style'] : [];

    $styles = [
        'color' => $color,
        'font-size' => $size,
        'font-weight' => in_array('bold', $fontStyle) ? 'bold' : 'normal',
        'font-style' => in_array('italic', $fontStyle) ? 'italic' : 'normal',
    ];

    $generatedText .= '<p style="';
    foreach ($styles as $property => $value) {
        $generatedText .= $property . ': ' . $value . '; ';
    }
    $generatedText .= '">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>';
}
?>
<p> näyttää erroria kun submittaa userformin mutta ei liity toimivuuteen mitenkään, turha korjata harjoituksessa.</p>
<h1> Assignment 1 </h1>
<form method="post">
    <label>
        Color:
        <input type="radio" name="color" value="red" required> Red
        <input type="radio" name="color" value="green"> Green
        <input type="radio" name="color" value="blue"> Blue
    </label>
    <label>
        Size:
        <select name="size" required>
            <option value="">Select size</option>
            <option value="small">Small</option>
            <option value="medium">Medium</option>
            <option value="large">Large</option>
        </select>
    </label>
    <label>
        Font style:
        <input type="checkbox" name="font_style[]" value="bold"> Bold
        <input type="checkbox" name="font_style[]" value="italic"> Italic
    </label>
    <button type="submit">Submit</button>
</form>

<h1> Assignment 2 </h1>
<form method="post">
    <label>
        Username:
        <input type="text" name="username" value="<?php echo $username; ?>" required>
    </label>
    <label>
        Remember me:
        <input type="checkbox" name="remember" <?php echo $remember; ?>>
    </label>
    <button type="submit">Submit</button>
</form>

<?php
echo $generatedText;
?>
</body>
</html>