"=== .env MAIL_* ==="
Select-String -Path 'c:\OSPanel\home\Genla\.env' -Pattern '^MAIL_' | ForEach-Object { $_.Line }
"=== .env.example MAIL_* ==="
Select-String -Path 'c:\OSPanel\home\Genla\.env.example' -Pattern '^MAIL_' | ForEach-Object { $_.Line }
"=== config/mail.php from-block ==="
Select-String -Path 'c:\OSPanel\home\Genla\config\mail.php' -Pattern "'from'","MAIL_FROM","address","name" | ForEach-Object { "L{0}: {1}" -f $_.LineNumber, $_.Line.Trim() }
"=== does the app actually SEND mail anywhere? ==="
Get-ChildItem 'c:\OSPanel\home\Genla\app' -Recurse -File -Include *.php -ErrorAction SilentlyContinue |
    Select-String -Pattern 'Mail::','Mailable','->send\(','Notification::','Notifiable','->notify\(','mail\(' |
    ForEach-Object { $rel = $_.Path.Replace('c:\OSPanel\home\Genla\',''); "{0}:L{1}: {2}" -f $rel, $_.LineNumber, $_.Line.Trim() }
"(if nothing listed above between markers, the app does not send email)"
"=== end ==="
