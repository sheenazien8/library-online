<!DOCTYPE html>
<html>
<head>
	<title>Data buku view PDF</title>
</head>
<body>
	<h1>Data buku library online</h1>
	<hr>
	<table>
		<thead>
			<tr>
				<th>Judul</th>
				<th>Jumlah</th>
				<th>Stock</th>
				<th>Penulis</th>
			</tr>
		</thead>
		<tbody>
		@forelse ($books as $book)
			<tr>
				<td>{{ $book->title }}</td>
				<td>{{ $book->ammount }}</td>
				<td>{{ $book->stock }}</td>
				<td>{{ $book->author->name }}</td>
			</tr>
		@empty
			<tr>
				<td colspan="4" align="center">Data tidak ditemukan</td>
			</tr>
		@endforelse
			
		</tbody>
	</table>
</body>
</html>