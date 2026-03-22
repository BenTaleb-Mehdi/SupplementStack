# PowerShell Script to Update PHP Upload Limits
# This script MUST be run as Administrator

Write-Host "========================================" -ForegroundColor Cyan
Write-Host "  PHP Upload Limit Configuration Tool  " -ForegroundColor Cyan
Write-Host "========================================" -ForegroundColor Cyan
Write-Host ""

$phpIniPath = "C:\php84\php.ini"

# Check if running as Administrator
$isAdmin = ([Security.Principal.WindowsPrincipal] [Security.Principal.WindowsIdentity]::GetCurrent()).IsInRole([Security.Principal.WindowsBuiltInRole]::Administrator)

if (-not $isAdmin) {
    Write-Host "ERROR: This script must be run as Administrator!" -ForegroundColor Red
    Write-Host "Right-click PowerShell and select 'Run as Administrator'" -ForegroundColor Yellow
    pause
    exit 1
}

# Check if php.ini exists
if (-not (Test-Path $phpIniPath)) {
    Write-Host "ERROR: php.ini not found at: $phpIniPath" -ForegroundColor Red
    pause
    exit 1
}

Write-Host "Found php.ini at: $phpIniPath" -ForegroundColor Green
Write-Host ""

# Backup the original file
$backupPath = "$phpIniPath.backup_$(Get-Date -Format 'yyyyMMdd_HHmmss')"
Copy-Item $phpIniPath $backupPath
Write-Host "Created backup: $backupPath" -ForegroundColor Green
Write-Host ""

# Read the file
$content = Get-Content $phpIniPath

# Track changes
$postMaxChanged = $false
$uploadMaxChanged = $false
$newContent = @()

foreach ($line in $content) {
    $trimmed = $line.Trim()
    
    # Match post_max_size (including commented lines)
    if ($trimmed -match '^;?\s*post_max_size\s*=') {
        $newContent += "post_max_size = 10M"
        $postMaxChanged = $true
        Write-Host "✓ Updated: post_max_size = 10M" -ForegroundColor Green
    }
    # Match upload_max_filesize (including commented lines)
    elseif ($trimmed -match '^;?\s*upload_max_filesize\s*=') {
        $newContent += "upload_max_filesize = 10M"
        $uploadMaxChanged = $true
        Write-Host "✓ Updated: upload_max_filesize = 10M" -ForegroundColor Green
    }
    else {
        $newContent += $line
    }
}

# Write the changes back
$newContent | Set-Content $phpIniPath -Encoding UTF8

Write-Host ""
if ($postMaxChanged -and $uploadMaxChanged) {
    Write-Host "========================================" -ForegroundColor Green
    Write-Host "  SUCCESS! Configuration Updated        " -ForegroundColor Green
    Write-Host "========================================" -ForegroundColor Green
    Write-Host ""
    Write-Host "NEXT STEPS:" -ForegroundColor Yellow
    Write-Host "1. Stop your Laravel server (Ctrl+C)" -ForegroundColor White
    Write-Host "2. Run: php artisan serve" -ForegroundColor White
    Write-Host "3. Try uploading your image again!" -ForegroundColor White
} else {
    Write-Host "WARNING: Some settings may not have been updated!" -ForegroundColor Yellow
    Write-Host "post_max_size updated: $postMaxChanged" -ForegroundColor White
    Write-Host "upload_max_filesize updated: $uploadMaxChanged" -ForegroundColor White
}

Write-Host ""
Write-Host "Press any key to exit..." -ForegroundColor Gray
$null = $Host.UI.RawUI.ReadKey("NoEcho,IncludeKeyDown")
