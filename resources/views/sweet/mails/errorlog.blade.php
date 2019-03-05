<h3>Error Log Informtion from laravel website:</h3>
<strong>Date:</strong> {{ date('M d, Y H:iA') }}
<br>

<strong>Message:</strong> {{ $e->getMessage() }}
<br>
<strong>Code:</strong> {{ $e->getCode() }}
<br>
<strong>File:</strong> {{ $e->getFile() }}
<br>
<strong>Line:</strong> {{ $e->getLine() }}