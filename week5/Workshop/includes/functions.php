<?php 

    function formatName($name) {
        return trim($name);
    }

    function validateEmail($email) {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }

    function cleanSkills($string) {
        $skills = explode(",", $string);
        $skills = array_map('trim', $skills);
        $skills = array_filter($skills);
        return $skills;
    }
    
    function saveStudent($name, $email, $skillsArray) {
        $file = "students.txt";

        $skillsFormatted = implode(",", $skillsArray);
        $data = $name . ";" . $email . ";" . $skillsFormatted . PHP_EOL;

        if (file_put_contents($file, $data, FILE_APPEND) === false) {
            throw new Exception("Failed to save student data.");
        }
    }

    
    function uploadPortfolioFile($file)
    {
        if (!isset($file) || $file['error'] === UPLOAD_ERR_NO_FILE) {
            return "No file selected.";
        }

        if ($file['error'] !== UPLOAD_ERR_OK) {
            return "File upload error (code: {$file['error']}).";
        }

        $allowedTypes = ['pdf', 'jpg', 'jpeg', 'png'];
        $maxSize = 2 * 1024 * 1024;

        $fileName = $file['name'];
        $fileSize = $file['size'];
        $tmpPath  = $file['tmp_name'];

        $extension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

        if (!in_array($extension, $allowedTypes)) {
            return "Invalid file format.";
        }

        if ($fileSize > $maxSize) {
            return "File exceeds 2MB limit.";
        }

        $uploadDir = __DIR__ . "/../uploads/";

        if (!is_dir($uploadDir) && !mkdir($uploadDir, 0755, true)) {
            return "Upload directory error.";
        }

        $baseName = pathinfo($fileName, PATHINFO_FILENAME);
        $safeName = strtolower(str_replace(' ', '_', $baseName));
        $newName  = $safeName . "_" . time() . "." . $extension;

        if (!move_uploaded_file($tmpPath, $uploadDir . $newName)) {
            return "Failed to upload file.";
        }

        return "success";
    }

?>