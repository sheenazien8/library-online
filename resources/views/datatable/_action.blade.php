<form class="float-right" action="{{ route('authors.destroy', $author_id) }}" method="post">
	@csrf
	@method('DELETE')


	<a href="{{ $edit_url }}" class="btn btn-secondary">Edit</a>
	<a href="{{ $detail_url }}" class="btn btn-primary">Detail</a>
	<button type="submit" class="btn btn-danger">Delete</button>
</form>
