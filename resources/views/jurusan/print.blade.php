<!DOCTYPE html>
<html>
<head>
    <title>Data Jurusan</title>
</head>
<body>

<h3>Data Jurusan</h3>

<table border="1" width="100%">
    <tr>
        <th>ID Jurusan</th>
        <th>Nama Jurusan</th>
        <th>Akreditasi</th>
    </tr>

    @foreach($jurusan as $item)
    <tr>
        <td>{{ $item->id_jurusan }}</td>
        <td>{{ $item->nama_jurusan }}</td>
        <td>{{ $item->akreditasi }}</td>
    </tr>
    @endforeach
</table>

<script>
    window.print();
</script>

</body>
</html>