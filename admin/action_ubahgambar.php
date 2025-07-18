<?php
include 'config.php';

// Sanitize inputs
$produk = mysqli_real_escape_string($link, $_POST['produk']);
$kodegambar = mysqli_real_escape_string($link, $_POST['kodegambar']);
$varian = mysqli_real_escape_string($link, $_POST['varian']);
$angel = mysqli_real_escape_string($link, $_POST['angel']);
$gambardefault = isset($_POST['gambardefault']) ? 1 : 0;

// Validate required fields
if (empty($produk) || empty($kodegambar)) {
    header("Location: index.php?hal=editgambar&status=4&message=" . urlencode("Product ID and Image ID are required"));
    exit();
}

$nama_baru1 = '';
$old_image = '';

// Get current image name before update
$query = "SELECT gambar FROM imgproduk WHERE produk = ? AND kodegambar = ?";
$stmt = mysqli_prepare($link, $query);
mysqli_stmt_bind_param($stmt, "ss", $produk, $kodegambar);
mysqli_stmt_execute($stmt);
mysqli_stmt_bind_result($stmt, $old_image);
mysqli_stmt_fetch($stmt);
mysqli_stmt_close($stmt);

// Handle file upload if new image is provided
if (isset($_FILES['nama_file1']) && $_FILES['nama_file1']['size'] > 0) {
    $upload = handleImageUpload($_FILES['nama_file1'], $produk);
    if ($upload['success']) {
        $nama_baru1 = $upload['filename'];
    } else {
        header("Location: index.php?hal=editgambar&produk=$produk&kodegambar=$kodegambar&status=" . $upload['status'] . "&message=" . urlencode($upload['message']));
        exit();
    }
}

// Start transaction
mysqli_begin_transaction($link);

try {
    // If this is set as default image, unset other default images for this product
    if ($gambardefault == 1) {
        $query = "UPDATE imgproduk SET gambardefault = '0' WHERE produk = ? AND kodegambar != ?";
        $stmt = mysqli_prepare($link, $query);
        mysqli_stmt_bind_param($stmt, "ss", $produk, $kodegambar);
        mysqli_stmt_execute($stmt);
    }

    // Update image record
    if (!empty($nama_baru1)) {
        $query = "UPDATE imgproduk SET gambar = ?, varian = ?, angel = ?, gambardefault = ? WHERE produk = ? AND kodegambar = ?";
        $stmt = mysqli_prepare($link, $query);
        mysqli_stmt_bind_param($stmt, "sssiss", $nama_baru1, $varian, $angel, $gambardefault, $produk, $kodegambar);
    } else {
        $query = "UPDATE imgproduk SET varian = ?, angel = ?, gambardefault = ? WHERE produk = ? AND kodegambar = ?";
        $stmt = mysqli_prepare($link, $query);
        mysqli_stmt_bind_param($stmt, "ssiss", $varian, $angel, $gambardefault, $produk, $kodegambar);
    }

    if (!mysqli_stmt_execute($stmt)) {
        throw new Exception("Failed to update image record");
    }

    // If update successful and we uploaded a new image, delete the old one
    if (!empty($nama_baru1) && !empty($old_image)) {
        $old_file = "../resource/img/product/" . $old_image;
        if (file_exists($old_file)) {
            unlink($old_file);
        }
    }

    // Commit transaction
    mysqli_commit($link);
    header("Location: index.php?hal=gambarproduk&produk=$produk&status=success&message=" . urlencode("Image updated successfully"));

} catch (Exception $e) {
    // Rollback on error
    mysqli_rollback($link);
    
    // If we uploaded a new file but the database update failed, delete the uploaded file
    if (!empty($nama_baru1)) {
        $new_file = "../resource/img/product/" . $nama_baru1;
        if (file_exists($new_file)) {
            unlink($new_file);
        }
    }
    
    header("Location: index.php?hal=editgambar&produk=$produk&kodegambar=$kodegambar&status=error&message=" . urlencode($e->getMessage()));
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
        mkdir($upload_dir, 0777, true);
    }

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