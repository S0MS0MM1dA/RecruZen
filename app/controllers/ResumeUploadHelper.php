<?php
function saveUploadedResume(array $uploadFile, string $targetDir): ?string
{
    if (!isset($uploadFile['error']) || $uploadFile['error'] !== UPLOAD_ERR_OK) {
        return null;
    }
    if ($uploadFile['size'] <= 0 || $uploadFile['size'] > 5 * 1024 * 1024) { // 5MB limit
        return null;
    }

    $allowedExt = ['pdf', 'doc', 'docx'];
    $ext = strtolower(pathinfo($uploadFile['name'], PATHINFO_EXTENSION));
    if (!in_array($ext, $allowedExt, true)) {
        return null;
    }

    $allowedMime = [
        'application/pdf' => ['pdf'],
        'application/msword' => ['doc'],
        'application/vnd.openxmlformats-officedocument.wordprocessingml.document' => ['docx'],
        // docx files are zip archives; some systems report this generic type
        'application/zip' => ['docx'],
    ];
    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    $mime  = finfo_file($finfo, $uploadFile['tmp_name']);
    finfo_close($finfo);

    if (!isset($allowedMime[$mime]) || !in_array($ext, $allowedMime[$mime], true)) {
        return null;
    }

    $newName = bin2hex(random_bytes(16)) . '.' . $ext;

    if (!move_uploaded_file($uploadFile['tmp_name'], $targetDir . $newName)) {
        return null;
    }

    return $newName;
}