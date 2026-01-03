<?php

    session_start();
    if(!$_SESSION["logged_in"]) {
        header("location:login.php");
        exit;
    }

    $theme = $_COOKIE["theme"] ?? "light";

    if (isset($_POST["logout"])) {
        session_destroy();
        header("location:login.php");
        exit;
    }

?>

<html>
    <head>
        <style>
            :root {
                --bg-color: <?php echo ($theme === "dark") ? "#000000" : "#FFFFFF"; ?>;
                --text-color: <?php echo ($theme === "dark") ? "#FFFFFF" : "#000000"; ?>;
                --hover-color: <?php echo ($theme == "dark") ? "rgba(30, 30, 30, 0.9)" : "rgba(204, 220, 225, 0.75)" ?>;
                --box-shadow-color: <?php echo ($theme == "dark") ? "rgba(255,255,255,0.35)" : "rgba(0,0,0,0.35)" ?>;
            }

            body {
                display: flex;
                justify-content: center;
                align-items: center;
                background-color: var(--bg-color);
                color: var(--text-color);
                font-family: cursive;
            }

            header {
                position: absolute;
                display: flex;
                justify-content: space-evenly;
                gap: 5%;
                top: 0px;
                left: 0px;
                width: 100%;
                height: 7.5vh;
                background: rgba(255, 255, 255, 0.15);
                box-shadow: 0 4px 25px var(--box-shadow-color);
            }

            a {
                text-decoration: none;
                color: var(--text-color);
                font-family: cursive;
            }

            .account {
                position: relative;
            }

            .acc {
                margin-top: 15%;
                text-align: center;
                border: 0px;
                background: transparent;
                cursor: pointer;
                color: var(--text-color);
                font-family: cursive;
            }

            .dropdown {
                position: absolute;
                right: 0;
                top: 101%;
                flex-direction: column;
                background: rgba(255, 255, 255, 0.15);
                backdrop-filter: blur(12px);
                border-radius: 10px;
                box-shadow: 0 4px 25px var(--box-shadow-color);
                display: none;
                overflow: hidden;
                z-index: 1000;
            }

            .account:hover .dropdown {
                display: flex;
            }

            .dropdown a,
            .dropdown button {
                padding: 12px 20px;
                background: transparent;
                border: none;
                color: var(--text-color);
                cursor: pointer;
                width: 100%;
            }

            .logout {
                font-size: 16px;
                font-family: cursive;
                margin-bottom: -16px;
            }

            .dropdown a:hover,
            .dropdown button:hover {
                background: var(--hover-color);
            }

            .main {
                width: 400px;
                background: rgba(255, 255, 255, 0.15);
                backdrop-filter: blur(12px);
                border: 1px solid rgba(255, 255, 255, 0.25);
                border-radius: 15px;
                box-shadow: 0 4px 25px var(--box-shadow-color);
                padding: 30px;
                text-align: center;
            }
            
            .buttons {
                display: flex;
                flex-direction: column;
                margin-top: 5rem;
            }

            .main button {
                margin-bottom: 25px;
                padding: 20px 0;
                text-decoration: none;
                color: var(--text-color);
                font-size: 16px;
                font-family: cursive;
                background: var(--bg-color);
                border: 1px solid black;
                text-align: center;
                border-radius: 10px;
                transition: 0.3s ease;
            }

            .main button:hover {
                transform: scale(1.08);
                background: var(--hover-color);
            }
        </style>
    </head>
    <body>
        <header>
            <a href=""><h2>Student Grade Portal</h2></a>
            <div class="account">
                <button class="acc">
                    <?php echo $_SESSION["student_id"] ?> ▼
                </button>

                <div class="dropdown">
                    <a href="preference.php">Preferences</a>
                    <form method="POST">
                        <button type="submit" name="logout" class="logout">Logout</button>
                    </form>
                </div>
            </div>
        </header>
        <div class="main">
            <h2>Welcome <?php echo $_SESSION["student_id"] ?> </h2>
            <div class="buttons">
                <button>Enrolment & Module Registration</button>
                <button>Module Results</button>
                <button>Assessments</button>
            </div>
        </div>
    </body>
</html>