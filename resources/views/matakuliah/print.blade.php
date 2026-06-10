<!DOCTYPE html>
<html>
<head>
    <title>Data Matakuliah</title>
</head>
<body>

<h3>Data Matakuliah</h3>

<table border="1" width="100%">
    <tr>
        <th>ID</th>
        <th>Nama Matakuliah</th>
        <th>SKS</th>
        <th>Jurusan</th>
    </tr>

    @foreach($matakuliah as $item)
    <tr>
        <td>{{ $item->id_matakuliah }}</td>
        <td>{{ $item->nama_matakuliah }}</td>
        <td>{{ $item->sks }}</td>
        <td>{{ $item->jurusan->nama_jurusan ?? '-' }}</td>
    </tr>
    @endforeach
</table>

<script>
    window.print();
</script>

</body>
</html>