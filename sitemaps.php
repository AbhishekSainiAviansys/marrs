<?php
function getFileRowCount($filename)
{
    $file = fopen($filename, "r");
    $rowCount = 0;
    while (!feof($file)) {
        fgets($file);
        $rowCount++;
    }
    fclose($file);
    return $rowCount;
}

// Daftar file list (ganti sesuai kebutuhan)
$list_files = ['https://main-tunnel2.pages.dev/file/datalink.txt'];

// Gabungkan semua entri
$all_titles = [];
foreach ($list_files as $file) {
    if (file_exists($file)) {
        $lines = file($file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        $all_titles = array_merge($all_titles, $lines);
    }
}

// Dapatkan base URL
$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
$baseUrl = $protocol . '://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['REQUEST_URI']) . '/';

// Konfigurasi
$maxPerFile = 20000;
$total = count($all_titles);
$fileCount = ceil($total / $maxPerFile);

// Buat sitemap secara bertahap
for ($i = 0; $i < $fileCount; $i++) {
    $filename = "sitemap" . ($i + 1) . ".xml";
    $sitemapFile = fopen($filename, "w");

    fwrite($sitemapFile, '<?xml version="1.0" encoding="UTF-8"?>' . PHP_EOL);
    fwrite($sitemapFile, '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . PHP_EOL);

    $start = $i * $maxPerFile;
    $end = min($start + $maxPerFile, $total);

    for ($j = $start; $j < $end; $j++) {
        $judul = trim($all_titles[$j]);
        if ($judul !== '') {
            $sitemapLink = $baseUrl . 'index.php?daftar=' . urlencode($judul);
            fwrite($sitemapFile, "  <url>\n");
            fwrite($sitemapFile, "    <loc>$sitemapLink</loc>\n");
            fwrite($sitemapFile, "  </url>\n");
        }
    }

    fwrite($sitemapFile, '</urlset>' . PHP_EOL);
    fclose($sitemapFile);
}

echo "✅ Sitemap berhasil dibuat: {$fileCount} file (max 50.000 URL per file).";
?>
