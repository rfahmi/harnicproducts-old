<?php
include 'config.php';

// Sanitize inputs
$produk = mysqli_real_escape_string($link, $_POST['produk']);
$keterangan = isset($_POST['keterangan']) ? mysqli_real_escape_string($link, $_POST['keterangan']) : '';

// Validate product ID
if (empty($produk)) {
    header("Location: index.php?hal=addgambar&status=4&message=" . urlencode("Product ID is required"));
    exit();
}

$nama_baru1 = '';
$upload_success = true;
$error_message = '';

// Handle file upload
if (isset($_FILES['nama_file1']) && $_FILES['nama_file1']['size'] > 0) {
    $upload = handleImageUpload($_FILES['nama_file1'], $produk);
    if ($upload['success']) {
        $nama_baru1 = $upload['filename'];
    } else {
        header("Location: index.php?hal=addgambar&produk=$produk&status=" . $upload['status'] . "&message=" . urlencode($upload['message']));
        exit();
    }
} else {
    header("Location: index.php?hal=addgambar&produk=$produk&status=1&message=" . urlencode("Please select an image file"));
    exit();
}

// Start transaction
mysqli_begin_transaction($link);

try {
    // Count existing images for this product
    $query = "SELECT COUNT(*) as count FROM imgproduk WHERE produk = ?";
    $stmt = mysqli_prepare($link, $query);
    mysqli_stmt_bind_param($stmt, "i", $produk);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($result);
    
    if ($row['count'] >= 3) {
        throw new Exception("Maximum of 3 images allowed per product");
    }

    // Get current image position (1, 2, or 3)
    $imagePosition = $row['count'] + 1;

    // Insert new image record in imgproduk
    $query = "INSERT INTO imgproduk (produk, gambar, keterangan, tipegambar) VALUES (?, ?, ?, '1')";
    $stmt = mysqli_prepare($link, $query);
    
    if (!$stmt) {
        throw new Exception("Prepare failed: " . mysqli_error($link));
    }
    
    // Update mstproduk with the new image
    $updateField = "gambar" . $imagePosition;
    $updateQuery = "UPDATE mstproduk SET $updateField = ? WHERE produk = ?";
    $updateStmt = mysqli_prepare($link, $updateQuery);
    
    if (!$updateStmt) {
        throw new Exception("Prepare failed for mstproduk update: " . mysqli_error($link));
    }
    
    mysqli_stmt_bind_param($updateStmt, "si", $nama_baru1, $produk);
    if (!mysqli_stmt_execute($updateStmt)) {
        throw new Exception("Failed to update mstproduk: " . mysqli_stmt_error($updateStmt));
    }
    
    if (!mysqli_stmt_bind_param($stmt, "iss", $produk, $nama_baru1, $keterangan)) {
        throw new Exception("Binding parameters failed: " . mysqli_stmt_error($stmt));
    }
    
    if (!mysqli_stmt_execute($stmt)) {
        throw new Exception("Execute failed: " . mysqli_stmt_error($stmt));
    }
    
    // Log successful insert
    error_log("Successfully inserted image record. Product: $produk, Image: $nama_baru1");

    // Commit transaction
    mysqli_commit($link);
    header("Location: index.php?hal=gambarproduk&produk=$produk&status=success&message=" . urlencode("Image added successfully"));

} catch (Exception $e) {
    // Rollback on error
    mysqli_rollback($link);
    header("Location: index.php?hal=addgambar&produk=$produk&status=error&message=" . urlencode($e->getMessage()));
}

// Helper function to handle image upload
function handleImageUpload($file, $produk) {
    $result = array(
        'success' => false,
        'filename' => '',
        'status' => 0,
        'message' => ''
    );

    // Validate file size (500KB)
    $MAX_FILE_SIZE = 500000;
    if ($file['size'] > $MAX_FILE_SIZE) {
        $result['status'] = 3;
        $result['message'] = 'File size must be less than 500KB';
        return $result;
    }

    // Validate file type
    $allowed_types = array("image/jpg", "image/jpeg", "image/gif", "image/png");
    if (!in_array($file['type'], $allowed_types)) {
        $result['status'] = 2;
        $result['message'] = 'Only JPG, JPEG, GIF and PNG files are allowed';
        return $result;
    }

    // Generate unique filename
    $file_extension = pathinfo($file['name'], PATHINFO_EXTENSION);
    $base_name = preg_replace("/[^a-zA-Z0-9]/", "_", pathinfo($file['name'], PATHINFO_FILENAME));
    $nama_baru1 = $base_name . '_' . $produk . '_' . time() . '.' . $file_extension;
    $direktori1 = "../resource/img/product/" . $nama_baru1;

    // Create directory if it doesn't exist
    $upload_dir = "../resource/img/product";
    if (!file_exists($upload_dir)) {
        if (!mkdir($upload_dir, 0777, true)) {
            error_log("Failed to create directory: $upload_dir");
            $result['status'] = 5;
            $result['message'] = 'Failed to create upload directory';
            return $result;
        }
    }
    
    // Try to move the uploaded file
    if (!move_uploaded_file($file['tmp_name'], $direktori1)) {
        error_log("Failed to move uploaded file from {$file['tmp_name']} to $direktori1");
        $result['status'] = 6;
        $result['message'] = 'Failed to save uploaded file';
        return $result;
    }
    
    error_log("Successfully uploaded file to: $direktori1");
    $result['success'] = true;
    $result['filename'] = $nama_baru1;
    return $result;

    // Move uploaded file
    if (move_uploaded_file($file['tmp_name'], $direktori1)) {
        // Optimize image if possible
        if (function_exists('imagecreatefromjpeg')) {
            optimizeImage($direktori1, $file['type']);
        }
        
        $result['success'] = true;
        $result['filename'] = $nama_baru1;
        return $result;
    }

    $result['status'] = 5;
    $result['message'] = 'Failed to upload file';
    return $result;
}

// Helper function to optimize image
function optimizeImage($filepath, $mime_type) {
    list($width, $height) = getimagesize($filepath);
    
    // Maximum dimensions
    $max_width = 1200;
    $max_height = 1200;
    
    // Calculate new dimensions while maintaining aspect ratio
    if ($width > $max_width || $height > $max_height) {
        $ratio = min($max_width / $width, $max_height / $height);
        $new_width = round($width * $ratio);
        $new_height = round($height * $ratio);
        
        $new_image = imagecreatetruecolor($new_width, $new_height);
        
        switch ($mime_type) {
            case 'image/jpeg':
            case 'image/jpg':
                $source = imagecreatefromjpeg($filepath);
                imagecopyresampled($new_image, $source, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
                imagejpeg($new_image, $filepath, 85);
                break;
                
            case 'image/png':
                $source = imagecreatefrompng($filepath);
                imagealphablending($new_image, false);
                imagesavealpha($new_image, true);
                imagecopyresampled($new_image, $source, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
                imagepng($new_image, $filepath, 8);
                break;
                
            case 'image/gif':
                $source = imagecreatefromgif($filepath);
                imagecopyresampled($new_image, $source, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
                imagegif($new_image, $filepath);
                break;
        }
        
        imagedestroy($new_image);
        imagedestroy($source);
    }
}
?>