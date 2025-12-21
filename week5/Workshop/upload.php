<?php
    include 'includes/header.php';
    require 'includes/functions.php';

    $message = "";

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // print_r($_FILES);
        $result = uploadPortfolioFile($_FILES['file']);

        $message = ($result === "success")
            ? "<p style='color:green;text-align:center;'>File uploaded successfully.</p>"
            : "<p style='color:red;text-align:center;'>$result</p>";
    }    
?>

<html>
    <head>
        <style>
            body {
                display: flex;
                justify-content: center;
                align-items: center;
            }

            .main {
                width: 400px;
                background: rgba(255, 255, 255, 0.15);
                backdrop-filter: blur(12px);
                border: 1px solid rgba(255, 255, 255, 0.25);
                border-radius: 15px;
                box-shadow: 0 4px 25px rgba(0,0,0,0.35);
                padding: 30px;
            }

            .main h2 {
                text-align: center;
                margin-bottom: 25px;
                color: black;
                font-family: cursive;
            }

            .main input {
                width: 100%;
                margin: 12px 0;
                padding: 10px 5px;
                background: transparent;
                border: none;
                border-bottom: 2px solid rgba(255, 255, 255, 1);
                border-radius: 10px;
                color: black;
                font-size: 16px;
                resize: none;
                outline: none;
                transition: 0.3s ease;
                font-family: cursive;
            }

            .main input::placeholder {
                color: rgba(0, 0, 0 ,1);
                font-family: cursive;
            }

            .main input:hover {
                background: rgba(255, 255, 255, 0.35);
                transform: translateY(-2px);
                box-shadow: 0 5px 15px rgba(0,0,0,0.25);
            }

            .main input:focus {
                border-bottom: 2px solid rgba(0, 0, 0, 1);
            }

            .upload_container {
                display:flex;
                justify-content: center;
                align-items: center;
            }

            .upload {
                display: flex;
                justify-content: center;
                text-align: center;
                cursor: pointer;
                font-family: cursive;
                border: 1px solid black;
                border-radius: 15px;
                padding: 20px 35px;
            }

            .upload:hover {
                background: rgba(255, 255, 255, 0.35);
                transform: translateY(-2px);
                box-shadow: 0 5px 15px rgba(0,0,0,0.25);
            }

            button {
                width: 100%;
                padding: 12px 0;
                margin-top: 15px;
                background: rgba(255, 255, 255, 0.25);
                border: none;
                border-radius: 8px;
                color: black;
                font-size: 17px;
                font-weight: bold;
                font-family: cursive;
                letter-spacing: 1px;
                backdrop-filter: blur(4px);
                cursor: pointer;
                transition: 0.3s ease;
            }

            button:hover {
                background: rgba(255, 255, 255, 0.35);
                transform: translateY(-2px);
                box-shadow: 0 5px 15px rgba(0,0,0,0.25);
            }

            button:active {
                transform: translateY(1px);
            }
        </style>
    </head>
    <body>
        <div class="main">
            <h2>Upload Portfolio File</h2>
            <form action="" method="post" enctype="multipart/form-data">
                <div class="upload_container">
                    <div onclick="fileInput.click()" class="upload"><img src="icons/file.png" style="height:30px; margin-top: -5px; margin-right: 10px;"></img><span id="fileText">Choose a file</span></div>
                </div>
                <input id="fileInput" type="file" name="file" accept=".pdf,.jpg,.png" onchange="document.getElementById('fileText').textContent = this.files[0]?.name || 'Choose a file';" hidden>
                <?php if (!empty($message)) echo $message; ?>
                <button type="submit">Upload</button>
            </form>
        </div>
    </body>
</html>

<?php
    include 'includes/footer.php';
?>