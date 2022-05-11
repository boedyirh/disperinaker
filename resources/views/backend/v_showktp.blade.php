<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Foto KTP</title>
</head>
<body>
    <p>Foto KTP {{ $data_pemohon->nama }}</p>
    <img   src="{{ url('storage/foto_ktp/'.$data_pemohon->foto_ktp) }}" width="450" height="300" alt="Foto diri">


   <a href="#" onClick="window.open('yourpage.htm','pagename','resizable,height=260,width=370'); return false;">New Page</a>
   <noscript>You need Javascript to use the previous link or use <a href="yourpage.htm" target="_blank">New Page</a></noscript>




</body>
</html>