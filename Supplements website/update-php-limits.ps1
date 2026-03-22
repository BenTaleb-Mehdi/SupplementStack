# PowerShell script to update PHP upload limits
# Run this as Administrator

$phpIniPath = "C:\php84\php.ini"

Write-Host "Reading php.ini from: $phpIniPath" -ForegroundColor Cyan

if (-not (Test-Path $phpIniPath)) {
    Write-Host "ERROR: php.ini not found at $phpIniPath" -ForegroundColor Red
    exit 1
}

# Read the file
$content = Get-Content $phpIniPath

# Update the values
$updated = $false
$newContent = @()

foreach ($line in $content) {
    if ($line -match '^\s*post_max_size\s*=') {
        $newContent += "post_max_size = 12M"
        $updated = $true
        Write-Host "Updated: post_max_size = 12M" -ForegroundColor Green
    }
    elseif ($line -match '^\s*upload_max_filesize\s*=') {
        $newContent += "upload_max_filesize = 12M"
        $updated = $true
        Write-Host "Updated: upload_max_filesize = 12M" -ForegroundColor Green
    }
    else {
        $newContent += $line
    }
}

# Write back to file
$newContent | Set-Content $phpIniPath

Write-Host "`nSuccess! PHP limits have been updated." -ForegroundColor Green
Write-Host "`nIMPORTANT: You MUST restart your 'php artisan serve' for changes to take effect!" -ForegroundColor Yellow
Write-Host "1. Press Ctrl+C in the terminal running 'php artisan serve'" -ForegroundColor Yellow
Write-Host "2. Run 'php artisan serve' again" -ForegroundColor Yellow
