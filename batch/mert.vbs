Dim FSO
Dim oShell
Set oShell = WScript.CreateObject("WScript.Shell")
Set FSO = WScript.CreateObject("Scripting.FileSystemObject")
oShell.run "cmd.exe /c echo " & FSO.GetAbsolutePathName(WScript.Arguments(0)) & " |clip", 0 , True

Set oShell = Nothing



