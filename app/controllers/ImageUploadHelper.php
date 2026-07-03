<?php
/**
 * Validates and safely saves an uploaded image.
 * @param array $uploadFile The uploaded file information from $_FILES.
 * @param string $targetDir The directory where the file should be saved.
 * @return string|null The new filename if successful, or null on failure.
 */
function saveUploadedImage(array $uploadFile, string $targetDir): ?string
{
    // Basic upload sanity checks
    if (!isset($uploadFile['error']) || $uploadFile['error'] !== UPLOAD_ERR_OK) {
        return null;
    }
    if ($uploadFile['size'] <= 0 || $uploadFile['size'] > 2 * 1024 * 1024) { // 2MB limit
        return null;
    }

    // Whitelist of allowed extensions
    $allowedExt = ['jpg', 'jpeg', 'png', 'webp'];
    $ext = strtolower(pathinfo($uploadFile['name'], PATHINFO_EXTENSION));
    if (!in_array($ext, $allowedExt, true)) {
        return null;
    }

    // Check the REAL mime type by inspecting file content, not the
    // browser-supplied Content-Type (which is trivial to fake)
    $allowedMime = [
        'image/jpeg' => ['jpg', 'jpeg'],
        'image/png'  => ['png'],
        'image/webp' => ['webp'],
    ];
    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    $mime  = finfo_file($finfo, $uploadFile['tmp_name']);
    finfo_close($finfo);

    if (!isset($allowedMime[$mime]) || !in_array($ext, $allowedMime[$mime], true)) {
        return null;
    }

    // Double-check it's a genuine image (catches polyglot files too)
    if (@getimagesize($uploadFile['tmp_name']) === false) {
        return null;
    }

    // Generate a random, safe filename — never trust the original name
    $newName = bin2hex(random_bytes(16)) . '.' . $ext;

    if (!move_uploaded_file($uploadFile['tmp_name'], $targetDir . $newName)) {
        return null;
    }

    return $newName;
}