<?php
include 'config.php';

// Debug incoming parameters
error_log("Raw GET parameters: " . print_r($_GET, true));

// Sanitize inputs - keep original values for redirection
$produk_raw = isset($_GET['produk']) ? $_GET['produk'] : '';
$kodegambar_raw = isset($_GET['kodegambar']) ? $_GET['kodegambar'] : '';

// Strip any whitespace that might have been added
$produk = trim($produk_raw);
$kodegambar = trim($kodegambar_raw);

error_log("Processing delete - Product: $produk, KodeGambar: $kodegambar"); // Debug log

// Basic validation
if ($produk === '' || $kodegambar === '') {
    error_log("Empty parameters received - Product: [$produk], KodeGambar: [$kodegambar]");
    header("Location: index.php?hal=gambarproduk&status=error&message=" . urlencode("Missing parameters"));
    exit();
}

// Check if the product exists first
$check_query = "SELECT produk FROM mstproduk2 WHERE produk = ?";
$check_stmt = mysqli_prepare($link, $check_query);
mysqli_stmt_bind_param($check_stmt, "s", $produk);
mysqli_stmt_execute($check_stmt);
$check_result = mysqli_stmt_get_result($check_stmt);

if (!mysqli_fetch_assoc($check_result)) {
    error_log("Product not found - Product ID: $produk");
    header("Location: index.php?hal=gambarproduk&status=error&message=" . urlencode("Product not found"));
    exit();
}

mysqli_begin_transaction($link);

try {
    error_log("Starting deletion process...");
    
    // Get image details first
    $query = "SELECT gambar FROM imgproduk WHERE produk = ? AND kodegambar = ?";
    $stmt = mysqli_prepare($link, $query);
    if (!$stmt) {
        error_log("Prepare failed: " . mysqli_error($link));
        throw new Exception("Database error while preparing query");
    }
    
    mysqli_stmt_bind_param($stmt, "ss", $produk, $kodegambar);
    if (!mysqli_stmt_execute($stmt)) {
        error_log("Execute failed: " . mysqli_stmt_error($stmt));
        throw new Exception("Database error while executing query");
    }
    
    error_log("Successfully executed select query");
    
    $result = mysqli_stmt_get_result($stmt);
    if (!$row = mysqli_fetch_assoc($result)) {
        throw new Exception("Image not found");
    }
    
    $deleted_image = $row['gambar'];
    error_log("Found image to delete: " . $deleted_image); // Debug log
    
    // Delete from imgproduk first
    $query = "DELETE FROM imgproduk WHERE produk = ? AND kodegambar = ?";
    $stmt = mysqli_prepare($link, $query);
    if (!$stmt) {
        throw new Exception("Prepare delete failed: " . mysqli_error($link));
    }
    
    mysqli_stmt_bind_param($stmt, "ii", $produk, $kodegambar);
    if (!mysqli_stmt_execute($stmt)) {
        throw new Exception("Failed to delete from imgproduk: " . mysqli_stmt_error($stmt));
    }
    
    // Update mstproduk
    $query = "UPDATE mstproduk2 SET 
              gambar1 = CASE WHEN gambar1 = ? THEN '' ELSE gambar1 END,
              gambar2 = CASE WHEN gambar2 = ? THEN '' ELSE gambar2 END,
              gambar3 = CASE WHEN gambar3 = ? THEN '' ELSE gambar3 END
              WHERE produk = ?";
              
    $stmt = mysqli_prepare($link, $query);
    if (!$stmt) {
        throw new Exception("Prepare update failed: " . mysqli_error($link));
    }
    
    mysqli_stmt_bind_param($stmt, "sssi", $deleted_image, $deleted_image, $deleted_image, $produk);
    if (!mysqli_stmt_execute($stmt)) {
        throw new Exception("Failed to update mstproduk: " . mysqli_stmt_error($stmt));
    }
    
    // Update mstproduk2 - shift remaining images up
    if ($position > 0) {
        $updates = array();
        for ($i = $position; $i <= 2; $i++) {
            $updates[] = "gambar$i = gambar" . ($i + 1);
        }
        $updates[] = "gambar3 = ''";
        
        $query = "UPDATE mstproduk2 SET " . implode(", ", $updates) . " WHERE produk = ?";
        $stmt = mysqli_prepare($link, $query);
        mysqli_stmt_bind_param($stmt, "i", $produk);
        if (!mysqli_stmt_execute($stmt)) {
            throw new Exception("Failed to update mstproduk");
        }
    }
    
    // Delete the physical file
    if (!empty($deleted_image)) {
        $filepath = "../resource/img/product/" . $deleted_image;
        error_log("Attempting to delete file: " . $filepath); // Debug log
        
        if (file_exists($filepath)) {
            @chmod($filepath, 0777); // Make sure we have permission to delete
            if (!@unlink($filepath)) {
                error_log("Warning: Could not delete file: $filepath");
                // Continue anyway since the database records are updated
            }
        }
    }
    
    // Normalize the remaining images (remove gaps)
    $query = "UPDATE mstproduk2 
              SET gambar1 = CASE WHEN gambar1 = '' AND gambar2 != '' THEN gambar2 
                                WHEN gambar1 = '' AND gambar3 != '' THEN gambar3 
                                ELSE gambar1 END,
                  gambar2 = CASE WHEN (gambar2 = '' OR gambar1 = gambar2) AND gambar3 != '' THEN gambar3 
                                WHEN gambar2 = gambar1 THEN ''
                                ELSE gambar2 END,
                  gambar3 = CASE WHEN gambar3 = gambar1 OR gambar3 = gambar2 THEN ''
                                ELSE gambar3 END
              WHERE produk = ?";
              
    $stmt = mysqli_prepare($link, $query);
    if (!$stmt) {
        throw new Exception("Prepare normalize failed: " . mysqli_error($link));
    }
    
    mysqli_stmt_bind_param($stmt, "i", $produk);
    if (!mysqli_stmt_execute($stmt)) {
        throw new Exception("Failed to normalize images: " . mysqli_stmt_error($stmt));
    }
    
    mysqli_commit($link);
    error_log("Successfully completed deletion process");
    
    // Use the original produk value for redirection
    header("Location: index.php?hal=gambarproduk&produk=$produk_raw&status=success&message=" . urlencode("Image deleted successfully"));
    exit();

} catch (Exception $e) {
    error_log("Error in delgambar.php: " . $e->getMessage());
    mysqli_rollback($link);
    
    // Use the original produk value for redirection
    header("Location: index.php?hal=gambarproduk&produk=$produk_raw&status=error&message=" . urlencode($e->getMessage()));
    exit();
}