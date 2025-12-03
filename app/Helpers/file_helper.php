<?php

if (!function_exists('getFileIcon')) {
    /**
     * Get icon class based on file extension
     *
     * @param string $ext File extension
     * @return string Font Awesome icon class
     */
    function getFileIcon($ext)
    {
        $ext = strtolower($ext);
        
        $iconMap = [
            'pdf'  => 'fas fa-file-pdf text-danger',
            'doc'  => 'fas fa-file-word text-primary',
            'docx' => 'fas fa-file-word text-primary',
            'xls'  => 'fas fa-file-excel text-success',
            'xlsx' => 'fas fa-file-excel text-success',
            'ppt'  => 'fas fa-file-powerpoint text-warning',
            'pptx' => 'fas fa-file-powerpoint text-warning',
            'zip'  => 'fas fa-file-archive text-secondary',
            'rar'  => 'fas fa-file-archive text-secondary',
            '7z'   => 'fas fa-file-archive text-secondary',
            'jpg'  => 'fas fa-file-image text-info',
            'jpeg' => 'fas fa-file-image text-info',
            'png'  => 'fas fa-file-image text-info',
            'gif'  => 'fas fa-file-image text-info'
        ];
        
        return $iconMap[$ext] ?? 'fas fa-file-alt text-secondary';
    }
}

if (!function_exists('formatFileSize')) {
    /**
     * Format file size to human readable format
     *
     * @param int $bytes File size in bytes
     * @return string Formatted file size
     */
    function formatFileSize($bytes)
    {
        if ($bytes === 0) {
            return '0 Bytes';
        }
        
        $units = ['Bytes', 'KB', 'MB', 'GB', 'TB'];
        $i = floor(log($bytes, 1024));
        $size = round($bytes / pow(1024, $i), 2);
        
        return $size . ' ' . $units[$i];
    }
}
