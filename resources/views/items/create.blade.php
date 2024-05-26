<!DOCTYPE html>
<html>
<head>
    <title>Create Item</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h2>Create New Item</h2>
        <form action="{{ route('items.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="price">Price (RM):</label>
                <input type="number" step="0.01" class="form-control" id="price" name="price" required>
            </div>
            <div class="form-group">
                <label for="details">Details:</label>
                <textarea class="form-control" id="details" name="details" required></textarea>
            </div>
            <div class="form-group">
                <label for="status">Publish:</label>
                <select class="form-control" id="status" name="status" required>
                    <option value="1">Yes</option>
                    <option value="0">No</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Create</button>
            <button type="button" class="btn btn-danger" id="discardButton">Discard</button>
        
        </form>
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <script>
            $(document).ready(function() {
                $('#discardButton').click(function() {
                    window.location.href = "{{ route('items.index') }}";
                });
            });
        </script>
    </div>
</body>
</html>
